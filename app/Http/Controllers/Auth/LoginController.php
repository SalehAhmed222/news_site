<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    protected function validateLogin(Request $request)
    {
        
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
            'g-recaptcha-response' => 'required',
        ],[
            'g-recaptcha-response' =>[
                'required'=>'Please verify that you are not a robot.',
            ]
        ]);
    }
    //to apend alert to say success logout
    protected function loggedOut(Request $request)
    {
        Session::flash('success' ,'your logged out !!!');
        return redirect()->route('frontend.index');
    }

    //to apend alert to success logged
    protected function authenticated(Request $request, $user)
    {
        Session::flash('success' ,' your login successfully !!!');
        return redirect()->route('frontend.index');
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();


        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/');
    }
}
