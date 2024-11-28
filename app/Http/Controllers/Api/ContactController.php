<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\ContactRequest;
use App\Models\Admin;
use App\Models\Contact;
use App\Notifications\NewContactNotify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class ContactController extends Controller
{
    public function storeContact(ContactRequest $request){

       
        $request->merge([
            'ip_address'=>$request->ip(),
        ]);//for send ip_address in database
        //_token sended in data base for can't send data base use expect
        // $contact = Contact::created($request->all());
        $contact = Contact::create($request->all());

                if(!$contact){
                    return apiResponse(400,'Try Again Latter!!');

                   }

        $admins=Admin::get();
        Notification::send($admins,new NewContactNotify($contact));


        return apiResponse(201,'Contact Created Successfully!!!! ');





    }
}
