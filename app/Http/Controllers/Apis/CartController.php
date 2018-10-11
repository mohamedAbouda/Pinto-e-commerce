<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\OrderProduct;
use App\Models\OrderDate;
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

	public function getCoupon(Request $request)
	{
		if(!$request->input('coupon_code')){
			return response()->json([
				'error' => 'Please provide the coupon code',
			],422);
		}
		$coupon = Coupon::where('code',$request->input('coupon_code'))->first();
		if($coupon){
			return response()->json([
				'data' => $coupon,
			],200);
		}else{
			return response()->json([
				'error' => 'NO coupon with this code',
			],404);
		}
	}

	public function checkout(Request $request)
	{
		$data = $request->all();
		$coupon_code = $request->input('coupon_code',null);
		$cart = Cart::content();
		$data['total_price'] = 0;
		$data['status'] = 1;
		$data['payment_method'] = 1;
		$data['user_id'] = $request->user()->id;
		$createOrder = Order::create($data);
		if(Cart::count() == 0){
			return response()->json([
				'error' => 'Your cart is empty',
			],422);
		}
		foreach ($cart as $key => $item) {
			$createOrderItem = new OrderProduct;
			$createOrderItem->product_id = $item->options->obj->id;
			$createOrderItem->order_id = $createOrder->id;
			$createOrderItem->amount = $item->qty;
			$createOrderItem->price_per_item = $item->price;
			$createOrderItem->save();
			$data['total_price'] += $item->qty * $item->price;
		}
		$updateOrder = $createOrder->update(['total_price'=>$data['total_price']]);
		if($coupon_code != null){
			$checkCode = Coupon::where('code',$request->input('coupon_code'))->first();
			if($checkCode){
				$data['total_price_after_discount'] = $createOrder->total_price - (($createOrder->total_price * $checkCode->percentage) / 100);
				$updateOrder = $createOrder->update(['total_price_after_discount'=>$data['total_price_after_discount'],'coupon_id'=>$checkCode->id]);
			}
		}
		if($data['delivery_dates']){
			foreach ($data['delivery_dates'] as $key => $date) {
				$createOrderDate = new OrderDate;
				$createOrderDate->date_from = $date['date_from'];
				$createOrderDate->date_to = $date['date_to'];
				$createOrderDate->order_id = $createOrder->id;
				$createOrderDate->save();
			}
		}
		
		Cart::destroy();
		return response()->json([
			'success' => 'your order has been submitted',
		],200);
	}
}
