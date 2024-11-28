<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\frontend\NewSubscribeMail;
use App\Models\NewSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class NewSubscriberController extends Controller
{
    public function store(Request $request){

        $request->validate([
            'email'=>['required' ,'email','unique:new_subscribers,email'],
        ]);

        $NewSubscriber=NewSubscriber::create([
            'email'=>$request->email,
        ]);
       if(!$NewSubscriber){
        Session::flash('error' ,' Sorry Try again!');

        return redirect()->back();
       }
       Mail::to($request->email)->send(new NewSubscribeMail());
       Session::flash('success' ,'Thanks for Subscribe!');

       return redirect()->back();
    }
}
