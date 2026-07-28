<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class SocialLoginController extends Controller
{
    //

     public function redirect($provider){
            // dd($provider);
         return Socialite::driver($provider)->redirect();


    }

     //callback
    public function callback($provider){
    

      $socialLoginData = Socialite::driver($provider)->user();
    
        $user = User::updateOrCreate([
      'provider_id'=> $socialLoginData->id,
      
    ], 
     [
   
        'name'=>$socialLoginData->name,
        'email'=>$socialLoginData->email,
        'nickname'=>$socialLoginData->nickname,
        'profile'=>$socialLoginData->avatar,
        'provider'=>$provider, //github || google
        'provider_id'=>$socialLoginData->id,
        'provider_token'=>$socialLoginData->token,
        'role'=>'user'
    ]
    
    );

    

     Auth::login($user);

      return to_route('customerHome');
   
    }
   

  

}
