<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Stock;
use App\Models\OrderProduct;
use Cart;

class CartController extends Controller
{
	public function AddCart(Request $request)
	{
		if(!$request->input('product_id')){
			return response()->json([
				'error' => 'Please provide the Product id',
			],404);
		}
		$data = $request->all();
		$price = 0;
		$stockSum = Stock::where('product_id',$request->input('product_id'))->sum('amount');
		$productOrdersSum = OrderProduct::where('product_id',$request->input('product_id'))->sum('amount');
		$availableItems = $stockSum - $productOrdersSum;
		if($request->get('qty' ,1) > $availableItems){
			return response()->json([
				'error' => 'Not Available Amount',
			],404);
		}
		$product = Product::where('id',$request->input('product_id'))->with('discount')->first();
		$price = $product->price;
		if($product->discount){
			$discountPrice = ($product->price * $product->discount->percentage)/100;
			$price = $product->price - $discountPrice;
		}
		$item = Cart::add([
			'id' => $product->id,
			'name' => $product->name,
			'qty' => $request->get('qty' ,1),
			'price' =>$price,
			'options' => [
				'obj' => $product,
				'color' => $request->input('color' , NULL),
				'size' => $request->input('size' , NULL),
			]
		]);
		return response()->json([
			'success' => 'Product Added to cart',
		],200);
	}

	public function getCart()
	{
		Cart::content();
		$data = array();
		foreach (Cart::content() as $key => $cartItem) {
			$data[] = array('row_id'=>$cartItem->rowId,'name'=>$cartItem->name,'qty'=>$cartItem->qty,'price'=>$cartItem->price,'product'=>$cartItem->options->obj);
		}
		return response()->json([
			'data' =>  (array) $data,
		],200);
	}

	public function cartRemoveItem(Request $request)
	{
		if(!$request->input('row_id')){
			return response()->json([
				'error' => 'Please provide the row id',
			],404);
		}
		Cart::remove($request->input('row_id'));
		return response()->json([
			'success' => 'Product removed from you cart',
		],200);
	}
}
