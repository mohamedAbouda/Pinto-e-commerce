<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Client;
use Socialite;
use Auth;

class SocialiteController extends Controller
{
    	
    public function facebookRedirect()
	
    {
        return Socialite::driver('facebook')->redirect();   
    }  
    public function facebookCallBack()
    {
       
       $facebook=$this->checkUser('facebook');
       return redirect()->route('index');
    }

    public function googleRedirect()
	
    {
        return Socialite::driver('google')->redirect();   
    }  
    public function googleCallBack()
    {
       
       $google=$this->checkUser('google');
       return redirect()->route('index');
    }

    public function checkUser($socialite)
    {
    	$user=Socialite::driver($socialite)->stateless()->user();
		$check=Client::where('social_id','=',$user->getId())->first();
		if(! $check){
			$emailCheck=Client::where('email','=',$user->getEmail())->where('social_id','!=',$user->getId())->first();
            if($emailCheck){
                if($emailCheck->social_type){
                alert()->error('This E-mail is used before with '.$emailCheck->social_type.'.', 'Error')->persistent("Close this");
                return redirect()->back();
                }else{
                alert()->error('This E-mail is used before.', 'Error')->persistent("Close this");
                return redirect()->back();
                }
            }
			$check=new Client;
			$check->name=$user->getName();
			$check->social_id=$user->getId();
			$check->social_type=$socialite;
            $check->email = $user->getEmail();
			$check->save();
		}	

		//login and start session with the current auth user.
		Auth::guard('client')->loginUsingId($check->id);
    }
}
