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
    // public function callback()
    // {
    //     $googleUser = Socialite::driver('google')->user();
    //     $accessToken = $googleUser->token;
    //     dd($accessToken);
    //     // Fetch user data from Google People API using the access token
    //     $client = new Client();
    //     $response = $client->get('https://people.googleapis.com/v1/people/me', [
    //         'headers' => [
    //             'Authorization' => 'Bearer ' . $accessToken,
    //         ],
    //     ]);

    //     $userData = json_decode($response->getBody(), true);

    //     // Now you can access user data from $userData array
    //     $userEmail = $userData['emailAddresses'][0]['value'];
    //     $userName = $userData['names'][0]['displayName'];
    //     // ... and other user details

    //     // Perform necessary logic (e.g., login, registration) using retrieved details
    //     // ...

    //     return redirect('/'); // Redirect to the home page or desired URL
    // }

}