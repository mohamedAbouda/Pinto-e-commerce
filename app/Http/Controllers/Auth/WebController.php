<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\UserRegisterRequest;
use App\Http\Requests\Web\ClientResetPassword;
use App\Http\Requests\Web\PasswordForgetRequest;
use App\Http\Requests\Dashboard\CreateMerchantRequest;
use App\Models\Client;
use App\Models\Address;
use App\Models\PasswordReset;
use App\Models\ClientPasswordReset;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Merchant;
use App\Models\MerchantAdmin;
use App\Mail\ClientResetPassword as ClientResetPasswordMail;
use App\Mail\verficationCode;
use App\Notifications\ResetPassword;
use App\Notifications\ForgetPassword;
use Carbon\Carbon;
use Cart;
use Mail;


class WebController extends Controller
{
    public function getRegisterForm()
    {
        return view('site.register');
    }

    public function postRegister(UserRegisterRequest $request)
    {
        $user_data = $request->except(['address' , 'city']);
        $address_data = $request->only(['address' , 'city']);
        $address = Address::create($address_data);
        $user_data['valid'] = 1;
        if ($address) {
            $user_data['address_id'] = $address->id;
        }
        $user_data['phone_verfication_code'] = rand(10000,99999);


        if ($client = Client::create($user_data)) {
            try {
                Mail::to($client->email)->send(new verficationCode($client->phone_verfication_code));
            } catch (Exception $e) {
            }
            alert()->success('You\'ve signed up successfully', 'Success');
            return redirect()->route('web.login');
        }
        alert()->error('Something went wrong ! please try again.' , 'Error');
        return redirect()->back();
    }

    public function getLoginForm()
    {
        if (Auth::guard('client')->check()) {
            return redirect('/');
        }
        return view('site.login');
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
        if (Auth::guard('client')->attempt(['email' => $email, 'password' => $password , 'valid' => 1], $remember)) {
            alert()->success('Logged in successfully.', 'Success');
            return redirect()->route('index');
        }
        alert()->error('Wrong credentials.' , 'Error');
        return redirect()->back()->withErrors(['msg' => 'Wrong credentials.']);
    }

    public function logout()
    {
        Auth::guard('client')->logout();
        return redirect()->route('index');
    }

    public function getForgetPassword()
    {
        return view('site.auth.passwordReset');
    }

    /**
    * Check the email , send the reset link (notify) and redirect back to home.
    *
    * @param  \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
    public function postForgetPassword(PasswordForgetRequest $request)
    {
        $email = $request->get('email');
        $client = Client::where('email' , $email)->first();
        $token = str_random(16);
        PasswordReset::create([
            'email' => $email , 'token' => $token , 'created_at' => Carbon::now()->toDateTimeString()
        ]);
        try {
            Mail::to($email)->send(new ClientResetPasswordMail($token));
        } catch (\Exception $e) {
            alert()->error('Something went wrong ! please try again.' , 'Error');
            return redirect()->back();
        }

        alert()->success('Reset link has been sent to your email for confirmation please check your mail.', 'Success');
        return redirect()->route('index');
    }

    /**
    * Display the page for the user to reset the password if the {$code} is
    * correct.
    *
    * @param  String $code
    * @return \Illuminate\Http\Response
    */
    public function getResetPassword($token = NULL)
    {
        $reset = PasswordReset::where('token' , $token)->first();
        if (!$reset) {
            alert()->error('Invalid reset code !' , 'Error');
            return redirect()->route('web.index');
        }
        $hours = Carbon::now()->diffInHours(Carbon::parse($reset->created_at));
        if ($hours > 12) {
            alert()->error('Reset code expired !' , 'Error');
            return redirect()->route('web.index');
        }
        return view('site.reset-password' , compact('token'));
    }

    /**
    * Submit the new password and redirect back to login page.
    *
    * @param  \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
    public function postResetPassword(ClientResetPassword $request , $token)
    {
        $reset = PasswordReset::where('token' , $token)->first();
        if (!$reset) {
            alert()->error('Invalid reset code !' , 'Error');
            return redirect()->route('web.index');
        }
        $client = Client::where('email' , $reset->email)->first();
        if (!$client) {
            alert()->error('Invalid reset code !' , 'Error');
            return redirect()->route('web.index');
        }
        $client->password = $request->get('password');
        $client->save();

        // try {
            $client->notify(new ResetPassword);
        // } catch (\Exception $e) {
        //     alert()->error('Something went wrong ! please try again.' , 'Error');
        //     return redirect()->back();
        // }

        alert()->success('Your password has been changed', 'Success');
        return redirect()->route('web.index');
    }

    public function resetPassword()
    {
        return view('site.auth.passwordReset');
    }



    public function clientResetPasswordGet($token)
    {

        $reset = PasswordReset::where('token' , $token)->first();
        if (!$reset) {
            alert()->error('Invalid reset code !' , 'Error');
            return redirect()->route('index');
        }
        $hours = Carbon::now()->diffInHours(Carbon::parse($reset->created_at));
        if ($hours > 12) {
            alert()->error('Reset code expired !' , 'Error');
            return redirect()->route('index');
        }
        return view('site.resetPassword' , compact('token','reset'));
    }

    public function clientChangePassword(ClientResetPassword $request)
    {
        $data = $request->all();
        $update = Client::where('email',$request->input('email'))->first();
        $update->update($data);
        alert()->success('Your password has been changed', 'Success');
        return redirect()->route('index');
    }

    public function merchantRegisterGet()
    {
        return view('site.auth.registerMerchant');
    }

    public function storeMerchantDataRegister(CreateMerchantRequest $request)
    {
        $data = $request->all();
        $createAddress = Address::create($data);
        $data['address_id'] = $createAddress->id;
        $data['password'] = bcrypt($request->input('password'));
        $createMerchant = Merchant::create($data);

        $data['merchant_id'] = $createMerchant->id;
        $data['primary'] = 1;
        MerchantAdmin::create($data);
        alert()->success('Your data has been saved', 'Success');
        return redirect()->route('index');
    }

    public function getForgetPasswordForm()
    {
        return view('site.forgetPassword');
    }
    public function ForgetPassword(Request $request)
    {
        $email = $request->get('email');
        $client = Client::where('email' , $email)->first();
        if (!$client) {
            alert()->error('This email is invalid or doesn\'t exist.' , 'Error');
            return redirect()->back();
        }
        $token = str_random(16);
        PasswordReset::create([
            'email' => $email , 'token' => $token , 'created_at' => Carbon::now()->toDateTimeString()
        ]);
        try {
            Mail::to($email)->send(new ClientResetPasswordMail($token));
        } catch (\Exception $e) {
            alert()->error('Something went wrong ! please try again.' , 'Error');
            return redirect()->back();
        }

        alert()->success('Reset link has been sent to your email for confirmation please check your mail.', 'Success');
        return redirect()->back();
    }


}
