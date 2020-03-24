<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Message;

class MessageController extends Controller
{
    public function index(Request $request){
      $LoggedInuser = auth()->user();
      if($LoggedInuser->messages_count==0){
        return back()->with('noMessage','メッセージが'.$LoggedInuser->name.'さんにはありません');
      }
      //$messages = Message::latest()->where('user_id',auth()->id())->get();
      $messages = $LoggedInuser->messages()->latest()->get();
      return view('user.message.index',compact('messages'));
    }

    public function show(Message $message){
      abort_unless(auth()->id()==$message->user_id,403);
      return view('user.message.show',compact('message'));
    }
}
