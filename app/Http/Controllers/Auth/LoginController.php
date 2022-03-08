<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;


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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function reloadCaptcha()
    {
        return response()->json(['captcha'=> app('captcha')->img()]);
    }

    protected function validateLogin(Request $request)
    {
        $this->validate(
            $request,
            [
                $this->username() => 'required|email',
                'password' => 'required',
                'captcha' => 'required|captcha'
            ],
            [
                'captcha.captcha' => 'Please clear your lens while looking for captcha',
            ]
        );
    }

}
