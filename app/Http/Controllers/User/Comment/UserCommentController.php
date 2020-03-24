<?php

namespace App\Http\Controllers\User\Comment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Comments;
use App\Message;
class UserCommentController extends Controller
{
  public function index(Request $request){
    $comments = Comments::all();
    return view('user.comment.index',compact('comments'));
  }
}
