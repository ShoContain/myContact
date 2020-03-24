<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
  use AuthenticatesUsers;

  //ログイン後のリダイレクト先
  public function redirectTo(){
    return route('user.top');
  }

  //ログイン画面のViewの設定
  public function showLoginForm(){
    return view('user.login');
  }

  //バリデーションを行う(AuthenticateUsersのloginメソッドの中でこのvalidateLoginメソッドが呼ばれる)
  protected function validateLogin(Request $request){
    $message = [
      $this->username().'.required'=>'メールは必須だよー', //デフォルトでemailが返る
      'password.required'=>'パスワード入れてー',
    ];

    $request->validate([
      $this->username()=>'required|string',
      'password'=>'required|passwordCheck',
    ],$message);
  }

  //ログアウト処理
  public function logout(Request $request){
    $partialLogin = auth('user')->guest() || auth('admin')->guest();
    $this->guard()->logout();

    //どちらか片方のみでログインしてる時のみinvalidateする
    if($partialLogin){
      $request->session()->invalidate();
    }
    return redirect(route('user.login'));
  }

  protected function guard(){
    return auth('user');
  }
}
