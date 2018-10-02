<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use Auth;
use Alert;

class OrderController extends Controller
{
    public function activeOrders()
    {
    	 $orders = Order::where('user_id',Auth::guard('client')->id())->whereIn('status',[2,4,5])->with('items')->get();
    	return view('site.orders.active',compact('orders'));
    }

    public function cancelOrder(Request $request)
    {
    	$data = $request->all();
    	$updateOrder = Order::where('id',$data['order_id'])->update([
    		'status'=>3,
    	]);
    	return redirect()->back();
    }

    public function historyOrders()
    {
    	$orders = Order::where('user_id',Auth::guard('client')->id())->whereIn('status',[3,6,7,8,9,10,11])->with('items')->get();
    	return view('site.orders.history',compact('orders'));
    }

    public function orderDetails($id)
    {
        $order = Order::where('id',$id)->with('items','user.address')->first();
    	return view('site.orders.details',compact('order'));
    }

    public function submitDispute($id)
    {
        $id = $id;
        return view('site.orders.disbute',compact('id'));
    }

    public function orderDisputeSubmit(Request $request)
    {
         $data = $request->all();
        $updateOrder = Order::where('id',$data['order_id'])->update([
            'status'=>$data['status'],
        ]);
        if($request->input('dispute_comment')){
           $updateOrderNote = Order::where('id',$data['order_id'])->update([
                'dispute_comment'=>$data['dispute_comment'],
            ]); 
        }
         Alert::success('Your Dispute has been submited', 'Done!')->persistent('Close');
          return redirect()->back();
    }

    public function userReorder(Request $request)
    {
        $data = $request->all();
        $order = Order::where('id',$data['order_id'])->first();
        $newOrder = $order->replicate();
        $newOrder->status = 2;
        $newOrder->total_price_after_discount = 0;
        $newOrder->save();
        $items = OrderProduct::where('order_id',$data['order_id'])->get();
        foreach ($items as $item) {
            $newItem = $item->replicate();
            $newItem->order_id = $newOrder->id;
            $newItem->save();
        }
        $order = Order::where('id',$newOrder->id)->with('items')->first();
        return redirect()->route('web.active.orders');
        return 'Wait for checkout page integration ';
        //return view('web.cart.checkout',compact('order'));
    }
}
