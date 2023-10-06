<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stichoza\GoogleTranslate\GoogleTranslate;
use App\Models\language;
use App\Models\message;
use App\Models\User;
use Auth;

class translateController extends Controller
{
    public function selectLanguage()
    {
        $languages = language::all(); 

        return view('selectLanguage',['languages'=>$languages]);
    }
    public function storeLanguage(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,username',
            'language' => 'required',
    ]);
        $languages = language::all(); 
        $user = User::find(Auth::user()->id);
        $user->username = $request->username;
        $user->language = $request->language;
        $user->save();
        return redirect('/dashboard');

    }
    
    public function translate(Request $request)
    {
        $textToTranslate = 'Hey I am Vikas. I am from India to be specific Gujarat. I found you through TalktoSync. I am trying out this app which aims to minimize the language barrier on messages. I found this app is really amazing as it actually works and It has eliminated the two to three steps of copying the message and translating it and then responding it and vice versa. I really love the idea and working of this app';

        $translate = new GoogleTranslate();
        $translatedText = $translate->setSource('hi')->setTarget('en')->translate($textToTranslate);
        dd($translatedText);

        return response()->json(['message' => $translatedText]);
    }
}
