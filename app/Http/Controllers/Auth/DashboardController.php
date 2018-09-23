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
        if (strpos(request()->route()->getName(), 'dashboard.merchant') !== false) {
            if (Auth::guard('merchant')->check()) {
                return redirect()->route('dashboard.index');
            }
            return view('auth.login');
        }elseif (Auth::check()) {
            return redirect()->route('dashboard.index');
        }
        return view('dashboard.login');
    }

    public function getRegisterForm()
    {
        return view('auth.register');
    }
    public function register(MerchantRegisterRequest $request)
    {
        $data = $request->all();
        $data['approved'] = 0;
        $data['primary'] = 1;
        $data['password'] = bcrypt($data['password']);
        $createMerchant = Merchant::create($data);
        $data['merchant_id'] = $createMerchant->id;
        $createMerchantAdmin = MerchantAdmin::create($data);
        return redirect()->back()->with('success', 'Wait for admin approval.');
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
        if (strpos(request()->route()->getName(), 'dashboard.merchant') !== false) {
            $guard = 'merchant';
        }

        if (Auth::guard($guard)->attempt(['email'=>$email, 'password'=>$password], $remember)) {
            $user = Auth::guard($guard)->user();
            if ($user instanceof MerchantAdmin) {
                if (!$user->merchant->approved) {
                    Auth::guard($guard)->logout();
                    return back()->with('info', 'This account is disabled.');
                }
            }
            return redirect(route('dashboard.index'))->with('success', 'Logged in successfully.');
        }
        return back()->with('info', 'Wrong data.');
    }

    public function logout()
    {
        $guard = 'web';
        if (strpos(request()->route()->getName(), 'dashboard.merchant') !== false) {
            $guard = 'merchant';
        }
        Auth::guard($guard)->logout();
        // $request->session()->flush();
        // $request->session()->regenerate();
        if (Auth::guard($guard)->check()) {
            return back()->with('info', 'Something went wrong. Try again to logout.');
        }
        if ($guard === 'merchant') {
            return redirect()->route('dashboard.merchant.loginForm')->with('success', 'You logged out.');
        }
        return redirect()->route('dashboard.loginForm')->with('success', 'You logged out.');
    }
}
