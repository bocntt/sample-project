<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\NoActiveAccountException;
use App\Http\AuthTraits\Social\ManagesSocialAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests;
use Socialite;
use Illuminate\Auth\Events\Registered;
use App\Mail\RegistrationEmail;
use App\Events\RegistrationCompleted;

class AuthController extends RegisterController
{
  use AuthenticatesUsers, ManagesSocialAuth;
  
  protected $redirectTo = '/';

  /**
  * Create a new controller instance.
  *
  * @return void
  */
  public function __construct()
  {
    $this->middleware('guest', ['except' => ['logout','redirectToProvider', 'handleProviderCallback']
    ]);
  }

  private function checkStatusLevel()
  {
    if ( ! Auth::user()->isActiveStatus()) {
      Auth::logout();
      throw new NoActiveAccountException;
    }
  }

  public function redirectPath()
  {
    if (Auth::user()->isAdmin()){
      return 'admin';
    }
    return property_exists($this, 'redirectTo') ? $this->redirectTo : '/';
  }

  public function login(Request $request)
  {
    $this->validateLogin($request); 
    if ($this->hasTooManyLoginAttempts($request)) {
      $this->fireLockoutEvent($request);
      return $this->sendLockoutResponse($request);
    }
    if ($this->attemptLogin($request)) {
      $this->checkStatusLevel();
      return $this->sendLoginResponse($request);
    }
    $this->incrementLoginAttempts($request);
    return $this->sendFailedLoginResponse($request);
  }

  public function register(Request $request) {
      $this->validator($request->all())->validate();

      event(new Registered($user = $this->create($request->all())));

      // $this->guard()->login($user);
      Auth::guard()->login($user);

      event(new RegistrationCompleted($user));

      return $this->registered($request, $user)
                      ?: redirect($this->redirectPath());
  }

  public function redirectToProvider($provider) {
    return Socialite::driver($provider)->redirect();
      //->scopes(['public_profile', 'email'])->redirect();
  }

  public function handleProviderCallback($provider) {
    // $user = Socialite::driver('github')->user();
    // // $user->token;

    $this->verifyProvider($this->provider = $provider);
    $socialUser = $this->getUserFromSocialite($provider);
    $providerEmail = $socialUser->getEmail();
    if ($this->socialUserHasNoEmail($providerEmail)) {
    throw new EmailNotProvidedException;
    }
    if ($this->socialUserAlreadyLoggedIn()) {
    $this->checkIfAccountSyncedOrSync($socialUser);
    }
    // set authUser from socialUser
    $authUser = $this->setAuthUser($socialUser);
    $this->loginAuthUser($authUser);
    $this->logoutIfUserNotActiveStatus();
    return $this->redirectUser();
  }
}
