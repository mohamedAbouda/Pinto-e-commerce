<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Client;

class AddressController extends Controller
{
	public function userAddAddress(Request $request)
	{
		$data = $request->all();
		$createAddress = Address::create($data);
		$user = Client::where('id',$request->user()->id)->first();
		$user->update(['address_id'=>$createAddress->id]);
		return response()->json([
			'success' => 'Address Added successfully',
		],200);
	}

	public function userEditAddress(Request $request)
	{
		if(!$request->input('address_id')){
			return response()->json([
				'error' => 'Please provide the address id'
			],404);
		}
		$data = $request->all();
		$address = Address::where('id',$request->input('address_id'))->first();
		$address->update($data);
		return response()->json([
			'success' => 'Address updated successfully',
		],200);
	}
}
