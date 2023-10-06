<?php

namespace App\Http\Controllers;

use Google_Client;
use Google_Service_PhotosLibrary;
use Illuminate\Http\Request;

class GoogleController extends Controller
{
    public function getImages(Request $request)
    {
        $client = new Google_Client();
        $client->setApplicationName('Your App Name');
        $client->setClientId(config('services.google.client_id'));
        $client->setClientSecret(config('services.google.client_secret'));
        $client->setRedirectUri(route('google.photos'));
        $client->setScopes(['https://www.googleapis.com/auth/photoslibrary.readonly']);

        if (!$request->session()->has('google_access_token')) {
            // Redirect to Google login
            $authUrl = $client->createAuthUrl();
            return redirect($authUrl);
        }

        // Fetch user's photos using the Photos Library API
        $client->setAccessToken($request->session()->get('google_access_token'));
        $service = new Google_Service_PhotosLibrary($client);

        $response = $service->mediaItems->listMediaItems([
            'pageSize' => 10, // Adjust as needed
        ]);
        $photos = $response->mediaItems;
        dd($photos);
        // Process and display photos
        return view('google.photos', compact('photos'));
    }
}