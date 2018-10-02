<?php
namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Dashboard\MerchantRegisterRequest;
use App\Models\Merchant;
use App\Models\MerchantAdmin;
class DashboardController extends Controller
{
    public function getLoginForm()
    {
        return view('dashboard.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = $request['email'];
        $password = $request['password'];
        $remember = $request['remember'];

        $guard = 'web';

        if (Auth::guard($guard)->attempt(['email' => $email, 'password' => $password], $remember)) {
            return redirect(route('dashboard.index'))->with('success', 'Logged in successfully.');
        }
        return back()->with('info', 'Wrong data.');
    }

    public function logout()
    {
        $guard = 'web';
        Auth::guard($guard)->logout();
        // $request->session()->flush();
        // $request->session()->regenerate();
        if (Auth::guard($guard)->check()) {
            return back()->with('info', 'Something went wrong. Try again to logout.');
        }
        return redirect()->route('login')->with('success', 'You logged out.');
    }
}
