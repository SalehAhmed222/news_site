<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider as ProvidersRouteServiceProvider;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function __construct()
    {
        $this->middleware(['guest:admin'])->only(['showLoginForm','checkLogin']);
        $this->middleware(['auth:admin'])->only(['logout']);


    }
    public function showLoginForm()
    {

        return view('admin.auth.login');
    }

    public function checkLogin(Request $request)
    {
        $request->validate($this->filterData());

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {

            $permessions=Auth::guard('admin')->user()->authorization->permessions;
            $first_permession=$permessions[0];
            if(!in_array('home',$permessions)){
                return redirect()->intended('admin/'.$first_permession);
            }
            return redirect()->intended(RouteServiceProvider::AdminHome);
        }

        return redirect()->back()->withErrors(['email' => 'credintial dose not match!!']);
    }

    public function logout(Request $request){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login.show');
    }



    private function filterData(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8'],
            'remember' => ['in:on,off'],
        ];
    }


}
