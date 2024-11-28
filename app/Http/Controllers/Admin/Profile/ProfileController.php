<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:profile');
    }
    public function index(){
        return view('admin.profile.index');
    }

    public function update(Request $request){

      $request->validate($this->filterDate());
      $admin=Admin::findOrFail(auth('admin')->user()->id);
      if(!Hash::check($request->password, $admin->password)){
        return redirect()->back()->with('error','Sorry Can not Update Profile');
      }

      $admin->update($request->except(['_token','password']));
      return redirect()->back()->with('success','Update Profile Successfully!');



    }

    private function filterDate():array{
      return [
        'name'=>['required','min:3','max:10'],
        'username'=>['required','min:3','max:10','unique:admins,username,'.auth('admin')->user()->id],
        'email'=>['required','email','unique:admins,email,'.auth('admin')->user()->id],
        'password'=>['required'],

      ];
    }

}
