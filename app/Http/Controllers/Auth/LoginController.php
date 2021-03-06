<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Exceptions\NoActiveAccountException;
use Illuminate\Support\Facades\Auth;
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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    private function checkStatusLevel() {
        if (!Auth::user()->isActiveStatus()) {
            Auth::logout();
            throw new NoActiveAccountException;
        }
    }

    public function redirectPath() {
        if (Auth::user()->isAdmin()) {
            return 'admin';
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/';
    }

    public function login(Request $request) {
        $this->validateLogin($request);
        // If the class is using the ThrottlesLogins trait,
        // we can automatically throttle
        // the login attempts for this application. We'll key this
        // by the username and
        // the IP address of the client making these requests
        // into this application.

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            $this->checkStatusLevel();
            return $this->sendLoginResponse($request);
        }
        // If the login attempt was unsuccessful we will
        // increment the number of attempts
        // to login and redirect the user back to the login form.
        // Of course, when this
        // user surpasses their maximum number of attempts
        // they will get locked out.
        $this->incrementLoginAttempts($request);
        return $this->sendFailedLoginResponse($request);
    }
}
