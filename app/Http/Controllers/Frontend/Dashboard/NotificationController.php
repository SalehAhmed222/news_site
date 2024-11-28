<?php

namespace App\Http\Controllers\Frontend\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class NotificationController extends Controller
{
    public function index(){
        auth()->user()->unreadNotifications->markAsRead();

        return view('frontend.dashboard.notification');
    }


    public function deleteAll(){
       $notification= auth()->user()->notifications()->delete();
       if(!$notification){
        return redirect()->back()->with('error' ,'no found notification to deleted');
       }


        return redirect()->back()->with('success' ,'All Notifications deleted successfully!');

    }

    public function delete(Request $request){
        $notification =auth()->user()->notifications()->where('id',$request->notify_id)->first();
        if(!$notification){

            return redirect()->back()->with('error','notification not found');
        }
        $notification->delete();
        return redirect()->back()->with('success','notification deleted doneee!');
    }

    public function readAll(){
        auth()->user()->unreadNotifications->markAsRead();
        return redirect()->back()->with('success' ,'read all notifications doneee!');
    }
}
