<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use GuzzleHttp\Client;

class ProviderController extends Controller
{
    public function redirect($provider)
    {
        // dd(Socialite::driver($provider)->redirect());
        return Socialite::driver($provider)->redirect();
    }
    public function callback($provider)
    {
        $socialUser = Socialite::driver($provider)->user();
        // dd($socialUser);
        $user = User::updateOrCreate([
            'provider_id' => $socialUser->id,
            'provider' => $provider,
        ], [
            'name' => $socialUser->name,
            'email' => $socialUser->email,
            'username' => $socialUser->nickname,
            'provider_token' => $socialUser->token,

        ]);

        Auth::login($user);

        return redirect('/dashboard');
    }
   

}