<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\MerchantResetPassword;
use App\Http\Requests\Dashboard\MerchantPasswordForgetRequest;
use App\Notifications\ResetPassword;
use App\Notifications\ForgetPassword;
use App\Models\Merchant;
use App\Models\MerchantAdmin;
use App\Models\PasswordReset;
use Carbon\Carbon;

class MerchantForgetPasswordController extends Controller
{
    public function getForgetPassword()
    {
        return view('auth.passwords.email');
    }

    /**
    * Check the email , send the reset link (notify) and redirect back to home.
    *
    * @param  \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
    public function postForgetPassword(MerchantPasswordForgetRequest $request)
    {
        $email = $request->get('email');
        $merchant = MerchantAdmin::where('email' , $email)->first();
        $token = str_random(16);
        PasswordReset::create([
            'email' => $email , 'token' => $token , 'created_at' => Carbon::now()->toDateTimeString()
        ]);
        try {
            $merchant->notify(new ForgetPassword($token , true));
        } catch (\Exception $e) {
            alert()->error('Something went wrong ! please try again.' , 'Error');
            return redirect()->back();
        }

        alert()->success('Reset link has been sent to your email for confirmation please check your mail.', 'Success');
        return redirect()->route('dashboard.merchant.login');
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
            return redirect()->route('dashboard.merchant.login');
        }
        $hours = Carbon::now()->diffInHours(Carbon::parse($reset->created_at));
        if ($hours > 12) {
            alert()->error('Reset code expired !' , 'Error');
            return redirect()->route('dashboard.merchant.login');
        }
        return view('auth.passwords.reset' , compact('token'));
    }

    /**
    * Submit the new password and redirect back to login page.
    *
    * @param  \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
    public function postResetPassword(MerchantResetPassword $request , $token)
    {
        $reset = PasswordReset::where('token' , $token)->first();
        if (!$reset) {
            alert()->error('Invalid reset code !' , 'Error');
            return redirect()->route('dashboard.merchant.login');
        }
        $merchant = MerchantAdmin::where('email' , $reset->email)->first();
        if (!$merchant) {
            alert()->error('Invalid reset code !' , 'Error');
            return redirect()->route('dashboard.merchant.login');
        }
        $merchant->password = bcrypt($request->get('password'));
        $merchant->save();

        try {
            $merchant->notify(new ResetPassword(true));
        } catch (\Exception $e) {
            alert()->error('Something went wrong ! please try again.' , 'Error');
            return redirect()->back();
        }

        alert()->success('Your password has been changed', 'Success');
        return redirect()->route('dashboard.merchant.login');
    }
}
