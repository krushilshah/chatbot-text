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
    public function dashboard()
    {
        $users = User::whereNotIn('id', [Auth::user()->id])->get();
        return view('dashboard',['users'=>$users]);
    }

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
        $textToTranslate = 'Mujhe sex karna hai';

        $translate = new GoogleTranslate();
        $translatedText = $translate->setSource('hi')->setTarget('ur')->translate($textToTranslate);
        dd($translatedText);

        return response()->json(['message' => $translatedText]);
    }

    // 
    public function getUserData(Request $request)
    {

        $user = User::find($request->user_id);
        $messages = message::orWhere('sender_id',Auth::user()->id)->orWhere('sender_id',$request->user_id)->orWhere('reciver_id',Auth::user()->id)->orWhere('reciver_id',$request->user_id)->get();
        return response()->json(['user'=>$user,'messages'=>$messages]);

    }
}
