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
        $reciverLanguage = User::where('id',$request->user_id)->first();
        $senderLanguage = User::where('id',Auth::user()->id)->first();
        $textToTranslate =  $request->message;
        $translate = new GoogleTranslate();
        $translatedText = $translate->setSource($senderLanguage->getLanguage->code)->setTarget($reciverLanguage->getLanguage->code)->translate($textToTranslate);
        $message = new message();
        $message->sender_id = Auth::user()->id;
        $message->reciver_id = $request->user_id;
        $message->msg_send_lang = $request->message;
        $message->msg_recieve_lang = $translatedText;
        $message->save();

        return response()->json(['message' => $message->msg_send_lang]);
    }

    // 
    public function getUserData(Request $request)
    {

        $user = User::find($request->user_id);
        // $messages = message::Where('sender_id',Auth::user()->id)->where('reciver_id',$request->user_id)->get();

        $sender_id = Auth::user()->id;
        $receiver_id = $request->user_id;

        $messages = message::where(function($query) use ($sender_id, $receiver_id) {
            $query->where('sender_id', $sender_id)
                  ->where('reciver_id', $receiver_id);
        })->orWhere(function($query) use ($sender_id, $receiver_id) {
            $query->where('sender_id', $receiver_id)
                  ->where('reciver_id', $sender_id);
        })->get();

        return response()->json(['user'=>$user,'messages'=>$messages]);

    }
}
