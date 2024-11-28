<?php

namespace App\Http\Controllers\Admin\Auth\Password;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    public function showResetForm($email){

      return view('admin.auth.passwords.reset',['email'=>$email]);
    }
    public function resetPassword(Request $request){
        $request->validate([
            'email'=>['required','email'],
            'password'=>['required','min:8','confirmed'],
            'password_confirmation'=>['required'],
        ]);

        $admin=Admin::where('email',$request->email)->first();
        if(!$admin){
            return redirect()->back()->with('error' , 'Try again!!');
        }
        $admin->update([
            'password'=>bcrypt($request->password),
        ]);
        return redirect()->route('admin.login.show')->with('success','your password is updated successfully!');

    }
}
