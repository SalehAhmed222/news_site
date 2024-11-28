<?php

namespace App\Http\Controllers\Api\Auth\Password;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\SendOtpVerifyForgetPassword;
use Illuminate\Http\Request;

class ForgetPasswordController extends Controller
{
    public function snedOtp(Request $request){

        $request->validate(['email'=>['required','max:40','email']]);

        // $user=User::Where('email',$request->email)->first();
        $user=User::whereEmail($request->email)->first();

        if(!$user){
            return apiResponse(404,'User Not Fond');
        }

        $user->notify(new SendOtpVerifyForgetPassword);

        return  apiResponse(200,'otp send ,check your email');



    }
}
