<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Cart;
use App\Models\WishList;

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
        if(strpos($route_name, 'web.') !== false || $route_name === 'web.login' || $route_name === 'index' || $route_name === 'home' || $route_name === 'web.register' || $route_name === 'web.reset.password' || $route_name === 'client.reset.password' || $route_name === 'client.change.password' || $route_name === 'merchant.register.get') {
            $data = [
                'cart' => Cart::content(),
                'total' => Cart::subtotal()
            ];
            $client = Auth::guard('client')->user();
            if ($client) {
                $data['wishlist'] = WishList::where('client_id' ,$client->id)->get();
            }
            view()->share($data);
        }
        return $next($request);
    }
}
