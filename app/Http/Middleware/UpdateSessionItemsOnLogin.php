<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Models\Order;
use App\Models\OrderProduct;
use Cart;

class UpdateSessionItemsOnLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
       /* $idsArray = [];
        $cartContent = Cart::content();
        foreach ($cartContent as $cart) {
            array_push($idsArray, $cart->id);
        }
        if(Auth::guard('client')->check()){
            $checkOrder = Order::where('user_id',Auth::guard('client')->id())->where('status',1)->first();
            if($checkOrder){
                foreach($checkOrder->items as $item){
                    if(in_array($item->id, $idsArray)){
                 
                    }else{
                           $item = Cart::add([
                        'id' => $item->product->id,
                        'name' => $item->product->name,
                        'qty' => $item->amount,
                        'price' =>$item->price_per_item,
                        'options' => [
                            'obj' => $item->product,
                            'color_id' => $item->color_id,
                            'size_id' => $item->size_id,
                        ]
                    ]);
                    }
                }
            }
        }*/
        return $next($request);
    }
}
