<?php

namespace App\Http\Controllers\Api\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\SettingRequest;
use App\Models\User;
use App\Utils\ImageManger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    public function updateSetting(SettingRequest $request ,$user_id){

        $request->validated();
        $user = User::find($user_id);
        if(!$user){
            return apiResponse(404,'Oops Something wronge  ');
        }
        $user->update($request->except(['_method', 'image']));


        //update image for user
        ImageManger::uplaodImages($request,null,$user);





        return apiResponse(201,'Setting Updated Successfully!!');
    }



    public function changePassword(Request $request,$user_id){

        $request->validate($this->filtterPasswordRequest());

        $user=User::find($user_id);
        if(!$user){
            return apiResponse(404,'Oops Something wronge  ');
        }

        if(!Hash::check($request->current_password,$user->password)){

            return apiResponse(400,'Password dont match');

        }


        $user->update([
            'password'=>Hash::make($request->password)
        ]);



        return apiResponse(201,'Password updated Successfully!!!');

    }

    //function valdiation

    private function filtterPasswordRequest():array{

        return [
            'current_password'=>['required','max:20'],
            'password'=>['required', 'confirmed'],
            'password'=>['required']
        ];
    }
}
