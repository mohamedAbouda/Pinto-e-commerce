<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Transformers\ClientTransformer;
use Hash;

class ProfileController extends Controller
{
	public function userProfile(Request $request)
	{
		return response()->json(['data'=>
			fractal()
			->item($request->user())
			->transformWith(new ClientTransformer)
			->serializeWith(new \League\Fractal\Serializer\ArraySerializer())
			->toArray()
		],200);
	}

	public function editUserProfile(Request $request)
	{
		$data = $request->all();
		$user = Client::where('id',$request->user()->id)->first();
		$user->update($data);

		return response()->json([
			'success' => 'User updated successfully',
		],200);
	}

	public function changeUserPassword(Request $request)
	{
		if(!$request->input('new_password') || !$request->input('old_password')){
			return response()->json([
				'error' => 'Please provide the old password and new password',
			],404);
		}
		$newPassword=$request->input('new_password');
		$oldPassword=$request->input('old_password');
		$authUser=$request->user();
		if(!empty($authUser->social_id) && empty($authUser->password)){
			return response()->json([
				'error'=>'You are logged in with Social media account',
			]);
		}
		else{
			if( Hash::check( $oldPassword,$authUser->password)){
				$update=Client::where('id','=',$authUser->id)->update([
					'password'=>bcrypt($newPassword),
				]);

				if($update){

					return response()->json([
						'success'=>'Your Password has been Updated',
					]);
				}
				else{
					return response()->json([
						'error'=>'an error occurred while you Updating your password',
					]);
				}
			}
			else{
				return response()->json([
					'error'=>'the old Password in incorrect',
				]);

			}

		}  
	}
}
