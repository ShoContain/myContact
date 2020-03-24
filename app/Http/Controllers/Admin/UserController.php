<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index(Request $request){
      $users = User::orderBy('id')->with('messages')->get();
      return view('admin.user.index',compact('users'));
    }

    public function destroy(User $user,Request $request){
      $request->user->delete();
      return ['success'=>'通信OKです'];
    }

    public function update(Request $request){
      $users = User::all(); //DBからひっぱてくるusers
      foreach ($users as $user) {
        $user->timestamps=false;
        $email = $user->email;
        foreach ($request->users as $userFrontEnd) {  //フロントエンドからのusers
          if($userFrontEnd['email'] == $email){
            $user->update(['id'=>$userFrontEnd['id']]);
          }
        }
      }
      return response('update successfull',200);
    }
}
