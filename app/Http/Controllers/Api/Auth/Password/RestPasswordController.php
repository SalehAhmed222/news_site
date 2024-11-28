<?php

namespace App\Http\Controllers\Api\Auth\Password;

use App\Http\Controllers\Controller;
use App\Models\User;
use Ichtrojan\Otp\Otp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RestPasswordController extends Controller
{

    protected $otp;
    public function __construct()
    {
       $this->otp=new Otp();
    }
    public function restPassword(Request  $request){

        $request->validate([
            'email'=>['required','email','max:40'],
            'code'=>['required','max:8'],
            'password'=>['required','min:6','max:20','confirmed'],
            'password_confirmation'=>['required'],
        ]);

        $otp2=$this->otp->validate($request->email,$request->code);
        if($otp2->status ==false){
            return apiResponse(400,'Code is invalid');
        }

        $user=User::whereEmail($request->email)->first();
        if(!$user){
            return apiResponse(404,'user not found');
        }
        $user->update([
            'password'=>Hash::make($request->password),
        ]);

        return apiResponse(201,' Password Updated Successfully!!');
    }
}
