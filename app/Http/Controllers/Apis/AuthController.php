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
		Auth::guard('client')->attempt($request->only('email' ,'password'));
		$user = Auth::guard('client')->user();
		if($user){
			$user->api_token = str_random(60);
			$user->save();
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
		if ($address) {
			$user_data['address_id'] = $address->id;
		}

		if ($client = Client::create($user_data)) {
			$client->update(['api_token'=> str_random(60)]);
			return response()->json(['data'=>
				fractal()
				->item($client)
				->transformWith(new ClientTransformer)
				->serializeWith(new \League\Fractal\Serializer\ArraySerializer())
				->toArray()
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
		$data['valid'] = 1;
		$data['is_confirmed'] = 1;
		$client = Client::create($data);
		return response()->json(['data'=>
			fractal()
			->item($client)
			->transformWith(new ClientTransformer)
			->serializeWith(new \League\Fractal\Serializer\ArraySerializer())
			->toArray()
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
		$user->update(['api_token'=>str_random(60)]);
		return response()->json(['data'=>
			fractal()
			->item($user)
			->transformWith(new ClientTransformer)
			->serializeWith(new \League\Fractal\Serializer\ArraySerializer())
			->toArray()
		],200);
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
}
