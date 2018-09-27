<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Models\Order;
use App\Models\OrderProduct;
use Cart;

class ShareSessionItems
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
        $route_name = \Request::route()->getName();
        if(strpos($route_name, 'web.') !== false || $route_name === 'login' || $route_name === 'index' || $route_name === 'home' || $route_name === 'register' || $route_name === 'reset.password' || $route_name === 'client.reset.password' || $route_name === 'client.change.password' || $route_name === 'merchant.register.get') {
            view()->share([
                'cart' => Cart::content(),
                'total' => Cart::subtotal()
            ]);
        }
        return $next($request);
    }
}
