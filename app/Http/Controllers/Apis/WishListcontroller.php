<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\WishList;
use App\Transformers\SimpleProductTransformer;
use App\Models\Product;

class WishListcontroller extends Controller
{
	public function userWishList(Request $request)
	{
		$wishlist = WishList::where('client_id',$request->user()->id)->pluck('product_id')->toArray();
		$products = Product::whereIn('id',$wishlist)->get();
		return response()->json(
			fractal()
			->collection($products)
			->transformWith(new SimpleProductTransformer)
			->serializeWith(new \League\Fractal\Serializer\ArraySerializer())
			->toArray()
			,200);
	}

	public function userAddWishList(Request $request)
	{
		if(!$request->input('product_id')){
			return response()->json([
				'error' => 'Please provide the Product id',
			],404);
		}
		$productCheck = Product::where('id',$request->input('product_id'))->first();
		if(!$productCheck){
			return response()->json([
				'error' => 'No Product with this id',
			],404);
		}
		$data['client_id'] = $request->user()->id;
		$data['product_id'] = $request->input('product_id');
		$createWishList = WishList::create($data);
		return response()->json([
			'success' => 'Product added to wishlist successfully',
		],200);
	}

	public function userDeleteWishList(Request $request)
	{
		if(!$request->input('product_id')){
			return response()->json([
				'error' => 'Please provide the Product id',
			],404);
		}
		$remove = wishlist::where('client_id',$request->user()->id)->where('product_id',$request->input('product_id'))->delete();
		return response()->json([
			'success' => 'Product deleted from wishlist successfully',
		],200);
		}
	}
