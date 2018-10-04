<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Transformers\OrderTransformer;

class OrderController extends Controller
{
    public function historyOrders(Request $request)
    {
    	$historyOrders = Order::where('user_id',$request->user()->id)->where('status',3)->get();
    	return response()->json(
			fractal()
			->collection($historyOrders)
			->transformWith(new OrderTransformer)
			->serializeWith(new \League\Fractal\Serializer\ArraySerializer())
			->toArray()
			,200);
    }

    public function activeOrders(Request $request)
    {
    	$activeOrders = Order::where('user_id',$request->user()->id)->whereIn('status',[1,2])->get();
    	return response()->json(
			fractal()
			->collection($activeOrders)
			->transformWith(new OrderTransformer)
			->serializeWith(new \League\Fractal\Serializer\ArraySerializer())
			->toArray()
			,200);
    }

    public function orderDetails(Request $request)
    {
    	if(!$request->input('order_id')){
			return response()->json([
				'error' => 'Please provide the order id',
			],404);
		}
    	$order = Order::where('id',$request->input('order_id'))->first();
    	return response()->json(
			fractal()
			->item($order)
			->transformWith(new OrderTransformer)
			->serializeWith(new \League\Fractal\Serializer\ArraySerializer())
			->toArray()
			,200);
    }
}
