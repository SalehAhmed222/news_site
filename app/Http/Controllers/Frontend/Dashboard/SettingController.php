<?php

namespace App\Http\Controllers\Frontend\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\SettingRequest;
use App\Models\User;
use App\Utils\ImageManger;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

use function Laravel\Prompts\password;

class SettingController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('frontend.dashboard.setting', compact('user'));
    }

    public function settingUpdate(SettingRequest $request)
    {

        $request->validated();
        $user = User::findOrFail(auth()->user()->id);
        $user->update($request->except(['_token', 'image']));


        //update image for user
        ImageManger::uplaodImages($request,null,$user);





        return redirect()->back()->with('success', 'updated added succfully!!');
    }



    public function changePassword(Request $request){

        $request->validate($this->filtterPasswordRequest());

        if(!Hash::check($request->current_password,auth()->user()->password)){
            Session::flash('error','Password not match');
            return redirect()->back();

        }
        $user=User::findOrFail(auth()->user()->id);

        $user->update([
            'password'=>Hash::make($request->password)
        ]);
        Session::flash('success','Password  changed successfully!!');


        return redirect()->back();

    }

    //function valdiation

    private function filtterPasswordRequest():array{

        return [
            'current_password'=>['required'],
            'password'=>['required', 'confirmed'],
            'password_confirmation'=>['required']
        ];
    }
}
