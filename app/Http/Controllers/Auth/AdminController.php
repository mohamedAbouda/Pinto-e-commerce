<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\UserRegisterRequest;
use App\Models\User;
use App\Models\Country;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // public function getRegisterForm()
    // {
    //     $data['countries'] = Country::pluck('name' , 'id')->toArray();
    //     return view('web.auth.register',$data);
    // }
    // public function postRegister(UserRegisterRequest $request)
    // {
    //     $user = User::register($request->all());
    //     if ($request->get('newsletter') == 1 && !Subscriber::where('email',$user->email)->first()) {
    //         Subscriber::create([
    //             'email' => $user->email
    //         ]);
    //     }
    //     if (!$user) {
    //         return redirect()->back()->withErrors(['msg' => 'Something went wrong please try again later.']);
    //     }
    //     return redirect()->back()->with('success', 'User signed up successfully.');
    // }

    public function getLoginForm()
    {
        return view('superadmin.login');
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
        if (Auth::guard('admin')->attempt(['email' => $email, 'password' => $password], $remember)) {
            return redirect()->route('superadmin.index')->with('success', 'Logged in successfully.');
        }
        return back()->withErrors(['msg' => 'Wrong credentials.']);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('superadmin.getLogin');
    }
}
