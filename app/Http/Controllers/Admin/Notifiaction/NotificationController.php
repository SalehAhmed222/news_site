<?php

namespace App\Http\Controllers\Admin\Notifiaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{

    public function __construct()
    {
        $this->middleware(['can:notifications']);
    }
    public function index(){

        Auth::guard('admin')->user()->unreadNotifications->markAsRead();

        $notifications =Auth::guard('admin')->user()->notifications()->get();

        // return $notifications;




        return view('admin.notifications.index',compact('notifications'));
    }

    public function destroy($id){

        $notification =Auth::guard('admin')->user()->notifications()->where('id',$id);
        if(!$notification){

            return redirect()->back()->with('error','Try Again Later!');
        }
        $notification->delete();

        return redirect()->back()->with('success','Notification deleted successfully!!');



    }

    public function deleteAll(){

      Auth::guard('admin')->user()->notifications()->delete();
      return redirect()->back()->with('success','All Notifications  deleted successfully!!');


    }
}
