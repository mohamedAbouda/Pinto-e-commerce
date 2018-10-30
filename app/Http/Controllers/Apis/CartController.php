<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Color;
use App\Models\Size;
use App\Models\OrderProduct;
use App\Transformers\ProductSizeTransformer;
use App\Transformers\ProductColorTransformer;
use App\Models\OrderDate;
use App\Transformers\ProductTransformer;
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
		$product = Product::where('id',$request->input('product_id'))->with('discount','brand','images','subcategory','reviews','sizes','tags','colors')->first();
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
				'obj' =>
				fractal()
				->item($product)
				->transformWith(new ProductTransformer)
				->serializeWith(new \League\Fractal\Serializer\ArraySerializer())
				->toArray()
				,
				'color_id' => $request->input('color_id' , NULL),
				'size_id' => $request->input('size_id' , NULL),
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
		$color = null;
		$size = null;
		foreach (Cart::content() as $key => $cartItem) {
			if($cartItem->options->size_id != null){
				$size = Size::where('id',$cartItem->options->size_id)->first();
				if($size){
					$size = fractal()
					->item($size)
					->transformWith(new ProductSizeTransformer)
					->serializeWith(new \League\Fractal\Serializer\ArraySerializer())
					->toArray();
				}
			}
			if($cartItem->options->color_id != null){
				$color = Color::where('id',$cartItem->options->color_id)->first();
				if($color){
					$color = fractal()
					->item($color)
					->transformWith(new ProductColorTransformer)
					->serializeWith(new \League\Fractal\Serializer\ArraySerializer())
					->toArray();
				}
			}
			$data[] = array('row_id'=>$cartItem->rowId,'name'=>$cartItem->name,'qty'=>$cartItem->qty,'price'=>$cartItem->price,'product'=>$cartItem->options->obj,'size'=>$size,'color'=>$color);
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
			$createOrderItem->product_id = $item->options->obj['id'];
			$createOrderItem->order_id = $createOrder->id;
			$createOrderItem->amount = $item->qty;
			$createOrderItem->price_per_item = $item->price;
			$createOrderItem->color_id = $item->options->color_id;
			$createOrderItem->size_id = $item->options->size_id;
			$createOrderItem->save();
			$data['total_price'] += $item->qty * $item->price;
		}

		$updateOrder = $createOrder->update(['total_price'=>$data['total_price'],'total_price_after_discount'=>$data['total_price']]);
		if($coupon_code != null){
			$checkCode = Coupon::where('code',$request->input('coupon_code'))->first();
			if($checkCode){
				if($checkCode->percentage < 1){
				$data['total_price_after_discount'] = $createOrder->total_price - (($createOrder->total_price * ($checkCode->percentage*100)) / 100);
				}else{
					$data['total_price_after_discount'] = $createOrder->total_price - $checkCode->percentage;
				}
				$updateOrder = $createOrder->update(['total_price_after_discount'=>$data['total_price_after_discount'],'coupon_id'=>$checkCode->id]);
			}
		}
	/*	if($data['delivery_dates']){
			foreach ($data['delivery_dates'] as $key => $date) {
				$createOrderDate = new OrderDate;
				$createOrderDate->date_from = $date['date_from'];
				$createOrderDate->date_to = $date['date_to'];
				$createOrderDate->order_id = $createOrder->id;
				$createOrderDate->save();
			}
		}*/
		
		Cart::destroy();
		return response()->json([
			'success' => 'your order has been submitted',
		],200);
	}

	public function updateCart(Request $request)
	{
		if(!$request->input('row_id')){
			return response()->json([
				'error' => 'Please provide row id',
			],422);
		}
		if($request->input('qty')){
			Cart::update($request->input('row_id'), $request->input('qty'));
		}
		if($request->input('color_id')){
			$item = Cart::get($request->input('row_id'));
			$options = $item->options->merge(['color_id' => $request->input('color_id')]);
			Cart::update($request->input('row_id'), ['options'=>$options]);
		}
		if($request->input('size_id')){
			$item = Cart::get($request->input('row_id'));
			$options = $item->options->merge(['size_id' => $request->input('size_id')]);
			Cart::update($request->input('row_id'), ['options'=>$options]);
		}
		return response()->json([
			'success' => 'Cart item updated',
		],200);
	}
}
