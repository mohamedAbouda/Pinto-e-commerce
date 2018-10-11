<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Auth;
use App\Http\Requests\Apis\RegisterController;
use App\Http\Requests\Apis\SocialRegisterController;
use App\Transformers\ClientTransformer;
use App\Models\Client;
use App\Models\Address;
use App\Models\PasswordReset;
use Carbon\Carbon;
use Mail;
use App\Mail\ClientResetPassword as ClientResetPasswordMail;
class AuthController extends Controller
{
	public function loginClient(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'email' => 'required',
			'password' => 'required',
		]);
		if ($validator->fails()) {
			return response()->json([
				'error' => $validator->errors()
			],422);
		}
		$check = Auth::guard('client')->attempt($request->only('email' ,'password'));

		if($check){
			$user = Auth::guard('client')->user();
			if($user->is_phone_verfied == 0){
				if(!$user->api_token){
					$user->api_token = str_random(60);
					$user->save();
				}
				return response()->json(['token'=> $user->api_token,
					'phone_verfication_code'=>$user->phone_verfication_code,
				],200);
			}else{
				$user->api_token = str_random(60);
				$user->save();
			}
		}else{
			return response()->json([
				'error' => 'wrong credentials',
			],401);
		}

		return response()->json(['data'=>
			fractal()
			->item($user)
			->transformWith(new ClientTransformer)
			->serializeWith(new \League\Fractal\Serializer\ArraySerializer())
			->toArray()
		],200);
	}

	public function registerClient(RegisterController $request)
	{
		$user_data = $request->except(['address' , 'city']);
		$address_data = $request->only(['address' , 'city']);
		$address = Address::create($address_data);
		$user_data['valid'] = 1;
		$user_data['is_phone_verfied'] = 0;
		if ($address) {
			$user_data['address_id'] = $address->id;
		}

		if ($client = Client::create($user_data)) {
			$client->update(['api_token'=> str_random(60),'phone_verfication_code'=>rand(10000,99999)]);
			return response()->json(['token'=> $client->api_token,
				'phone_verfication_code'=>$client->phone_verfication_code,
			],200);
			
		}
		return response()->json([
			'error' => 'something went wrong',
		],422);
	}

	public function socialRegisterClient(SocialRegisterController $request)
	{
		$data = $request->all();
		$data['api_token'] = str_random(60);
		$data['is_phone_verfied'] = 0;
		$data['phone_verfication_code'] = rand(10000,99999);
		$data['valid'] = 1;
		$data['is_confirmed'] = 1;
		$client = Client::create($data);
		return response()->json(['token'=> $client->api_token,
			'phone_verfication_code'=>$client->phone_verfication_code,
		],200);
	}

	public function socialLoginClient(Request $request)
	{
		if(!$request->input('social_id') || !$request->input('social_type')){
			return response()->json([
				'error' => 'please provide social id and type',
			],422);
		}
		$input = $request->all();
		$user = Client::where('social_id',$input['social_id'])->where('social_type',$input['social_type'])->first();
		if(!$user){
			return response()->json([
				'status' => 'false',
				'error' => 
				'Wrong credentials.'
				,
			],422);
		}
		if($user->is_phone_verfied == 1){
			$user->update(['api_token'=>str_random(60)]);
			return response()->json(['data'=>
				fractal()
				->item($user)
				->transformWith(new ClientTransformer)
				->serializeWith(new \League\Fractal\Serializer\ArraySerializer())
				->toArray()
			],200);
		}else{
			if(!$user->api_token){
				$user->api_token = str_random(60);
				$user->save();
			}
			return response()->json(['token'=> $user->api_token,
				'phone_verfication_code'=>$user->phone_verfication_code,
			],200);
		}
	}

	public function forgetPassword(Request $request)
	{
		if(!$request->input('email')){
			return response()->json([
				'error' => 'please provide email address',
			],422);
		}

		$email = $request->get('email');
		$client = Client::where('email' , $email)->first();
		$token = str_random(16);
		PasswordReset::create([
			'email' => $email , 'token' => $token , 'created_at' => Carbon::now()->toDateTimeString()
		]);
		try {
			Mail::to($email)->send(new ClientResetPasswordMail($token));
		} catch (\Exception $e) {

			return response()->json([
				'error' => 'something went wrong',
			],422);
		}

		return response()->json([
			'success' => 'email sent successfully',
		],200);
	}

	public function phoneVerfiy(Request $request)
	{
		if(!$request->input('phone_verfication_code')){
			return response()->json([
				'error' => 'please provide phone verfication code',
			],422);
		}
		$user = Client::where('id',$request->user()->id)->where('phone_verfication_code',$request->input('phone_verfication_code'))->first();
		if($user){
			$user->update(['is_phone_verfied'=>1,'phone_verfication_code'=>null]);
			return response()->json(['data'=>
				fractal()
				->item($user)
				->transformWith(new ClientTransformer)
				->serializeWith(new \League\Fractal\Serializer\ArraySerializer())
				->toArray()
			],200);
		}else{
			return response()->json([
				'error' => 'no user found with this token or code.',
			],404);
		}
	}
}
