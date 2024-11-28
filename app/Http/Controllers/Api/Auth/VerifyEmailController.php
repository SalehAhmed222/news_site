<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Notifications\SendOtpVerifyUserEmail;
use Ichtrojan\Otp\Otp;
use Illuminate\Http\Request;

class VerifyEmailController extends Controller
{

    protected $otp;
    public function __construct()
    {
        $this->otp=new Otp();

    }
     public function verify(Request $request){
        $request->validate([

            'token'=>['required','max:8'],
        ]);
        $user=$request->user();
        if(!$user){
            return apiResponse(401,'User is unauthenticated');
        }

        $otp2=$this->otp->validate($user->email ,$request->token );
        if($otp2->status == false){
            return apiResponse(400,'code is invaild');
        }
        $user->update(['email_verified_at'=>now()]);
        return apiResponse(201,'Email Verify Successfully!');
     }

     public function sendOtpAgain(){
        $user=request()->user();

        $user->notify(new SendOtpVerifyUserEmail);

       return apiResponse(201,'Otp Send successfully!');

     }
}
