<?php

namespace App\Http\Middleware;

use App\Models\Notification;
use Closure;

class DashboardIntialization
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
        // if ($request->method() === 'GET') {
        //     view()->share([
        //         'new_notifications' => Notification::where('seen' , 0)->count(),
        //         'notifications' => Notification::orderBy('created_at','DESC')
        //         ->take(5)->get()
        //     ]);
        // }
        return $next($request);
    }
}
