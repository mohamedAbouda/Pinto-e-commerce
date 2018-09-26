<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function __construct()
    {
        $route_name = \Request::route()->getName();
        if(strpos($route_name, 'web.') !== false || $route_name === 'login' || $route_name === 'index' || $route_name === 'home' || $route_name === 'register' || $route_name === 'reset.password' || $route_name === 'client.reset.password' || $route_name === 'client.change.password' || $route_name === 'merchant.register.get') {
            view()->share([
                'categories' => \App\Models\Category::with('subCategories')->get(),
                'contact_details' => \App\Models\Contact::first()
            ]);
        }

         App::setLocale('en');
    }

    public function uploadImage($image)
    {
        $fileName = time() . '_' . str_random(4) . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('uploads/images/');
        $image->move($destinationPath,$fileName);
        return asset('public/uploads/images/' . $fileName);
    }
}
