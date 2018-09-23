<?php
namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\FirstTimeInstallingRequest;
use App\Models\RedeemedGift;
use Illuminate\Support\Facades\Auth;

class HomeController extends BaseController
{
    public function index()
    {
        $data['redeemed_gifts'] = RedeemedGift::get();
        return view('dashboardV2.blank' , $data);
        return view('dashboard.index' , $data);
        // if (Auth::check()) {
        //     dd(Auth::user());
        //     if (Auth::user()->hasRole('admin')) {
        //
        //     }
        //     return redirect('/')->with('info', 'You do not have permission to access this page.');
        // }
        // return redirect(route('dashboard.login'));
    }


    public function getInstall()
    {
        return view('dashboard.install');
    }

    public function install(FirstTimeInstallingRequest $request)
    {
       
    }
}
