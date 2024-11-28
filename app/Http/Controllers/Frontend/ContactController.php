<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\ContactRequest;
use App\Models\Admin;
use App\Models\Contact;
use App\Notifications\NewContactNotify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;

class ContactController extends Controller
{
    public function index()
    {
        return view('frontend.contact-us');
    }

    public function sendMessage(ContactRequest $request)
    {
        $request->validated();
        //this another ways for send data ,this ways best but i love first ways
        //bad thing for this waysvery important to write name="" in form for all input and should be same in database
        $request->merge([
            'ip_address'=>$request->ip(),
        ]);//for send ip_address in database
        //_token sended in data base for can't send data base use expect
        // $contact = Contact::created($request->all());
        $contact = Contact::create($request->except('_token'));

        $admins=Admin::get();
        Notification::send($admins,new NewContactNotify($contact));



        if(!$contact){
            Session::flash('error' ,' Sorry Try again!');

            return redirect()->back();
           }

           Session::flash('success' ,'Thanks for Contact us!');

           return redirect()->back();
    }
}
