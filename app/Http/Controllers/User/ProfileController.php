<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit(){
      $user = auth()->user();
      return view('user.profile.edit',compact('user'));
    }

    public function update(Request $request){
      $message = [
        'email.unique'=>'既に登録されているメールアドレスです',
      ];

      $data = $request->validate([
        'name'=>'required|max:255',
        'email'=>'bail|required|max:255|email:filter|unique:users,email,'.auth()->id(),
      ],$message);
      auth()->user()->update($data);
      return redirect(route('user.top'))->with('status','プロフィールの変更が完了しました');
    }
}
