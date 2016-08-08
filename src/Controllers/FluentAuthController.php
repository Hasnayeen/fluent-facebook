<?php

namespace Hasnayeen\Fluent\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class FluentAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback()
    {
        try {
            $user = Socialite::driver('facebook')->user();
            $authUser = $this->findOrCreateUser($user);
            Auth::login($authUser, true);
     
            return redirect('/home');
        } catch (Exception $e) {
            return $e->getMessage();
        }
        // dd($user);
    }

    /**
     * Return user if exists; create and return if doesn't
     *
     * @param $twitterUser
     * @return User
     */
    private function findOrCreateUser($fbUser)
    {
        $authUser = User::where('fb_id', $fbUser->id)->first();
 
        if ($authUser){
            return $authUser;
        }
        $user = new User;
        $user->name = $fbUser->name;
        $user->token = $fbUser->token;
        $user->refresh_token = $fbUser->refreshToken;
        $user->expires_in = $fbUser->expiresIn;
        $user->fb_id = $fbUser->id;
        $user->save();
 
        return $user;
    }
}
