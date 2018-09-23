<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;

class FirstTimeDashboardAccess
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
        # do stuff here
        // dd("a7a");
        $not_first_time_ever = User::where('first_time' , 1)->exists();
        if (auth()->user() && auth()->user()->first_time === 0 && !$not_first_time_ever) {
            return redirect()->route('dashboard.getFt');
        }
        # continue with the request
        return $next($request);
    }
}
