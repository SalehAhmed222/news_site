<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;

class LoginController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'email'=>['required','email','max:50'],
            'password'=>['required','max:20'],
        ]);

        //this for Rate Limiter scond way

        if(RateLimiter::tooManyAttempts($request->ip(),2)){
            $time=RateLimiter::availableIn($request->ip());

            return apiResponse(429,'too many attempts ,Try again after  '. $time . '  seconds');
        }
        RateLimiter::increment($request->ip());

        $remaining=RateLimiter::remaining($request->ip(),2);


        $user=User::whereEmail($request->email)->first();

        if($user && Hash::check($request->password, $user->password)){
            RateLimiter::clear($request->ip());

            $token=$user->createToken('user_token',[],now()->addMinutes(60))->plainTextToken;
            return apiResponse(200,'user logged successfully!!',['token'=>$token]);

        }

        return apiResponse(401,'credentials does not match',['remaining'=>$remaining]);


    }



    public function logout(){
        $user=Auth::guard('sanctum')->user();

        //for delete current token
        $user->currentAccessToken()->delete();

        return apiResponse(200,'Token Deleted Successfully!!');


    }
}
