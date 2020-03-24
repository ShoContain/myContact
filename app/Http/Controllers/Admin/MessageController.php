<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use App\Message;
use Illuminate\Http\Request;
use App\Http\Requests\SaveMessage;

class MessageController extends Controller
{
    public function index(){
      $messages = Message::latest()->with('user')->get()->sortBy('user_id');
      return view('admin.message.index',compact('messages'));
    }

    public function create(Message $message){
      //ユーザ一覧を取得プルダウン用
      $userList = User::getUserList();
      return view('admin.message.create',compact('message','userList'));
    }

    public function store(SaveMessage $request,Message $message){
      //フォームリクエスト（validation）を呼び出す
      $data = $request->validated();
      $message->fill($data)->save();
      return redirect(route('admin.message.edit',$message))->with('status','登録完了しました');
    }

    public function edit(Message $message){
      $userList = User::getUserList();
      return view('admin.message.create',compact('userList','message'));
    }

    public function update(SaveMessage $request,Message $message){
      $data = $request->validated();
      $message->fill($data)->save();

      return redirect(route('admin.message.edit',$message))->with('status','編集が完了しました');
    }



}
