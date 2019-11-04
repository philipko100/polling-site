<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use App\SocialProvider;
use App\User;

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
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();
        } catch (Exception $e) {
            return redirect('/');
        }
        //check if we have logged provider
        $socialProvider = SocialProvider::where('provider_id', $socialUser->getId())->first();
        if($socialProvider == null) {
            //create a new user and provider
            if($socialUser->getEmail() == "") {
                $user = User::firstOrCreate(
                    ['email' => "fill in later"],
                    ['name' => $socialUser->getName()]
                );
            } else {
                $user = User::firstOrCreate(
                    ['email' => $socialUser->getEmail()],
                    ['name' => $socialUser->getName()]
                );
            }
            if($provider == "twitter") {
                $user->username = $socialUser->getNickname().rand();
            }
            if($user->username == "") {
                $user->username = "a $provider user ".$_SERVER['REQUEST_TIME'].rand();
                $user->political_position = "Don't know";
                $user->gender = "No info given";
                $user->current_city = "No info given";
                $user->current_province = "No info given";
                $user->current_country = "No info given";
            }
            if($user->email == "fill in later") {
                $user->email = "$user->username@$provider.com";
            }

            $user->save();

            $user->socialProviders()->create(
                ['provider_id' => $socialUser->getId(), 'provider' => $provider]
            );
        } else {
            $user = $socialProvider->user;
        }

        auth()->login($user);
        return redirect("/dashboard");

        // $user->token;
    }
}
