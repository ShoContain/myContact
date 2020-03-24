<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('signup','SignupController@index')->name('signup.index');
Route::post('signup','SignupController@postIndex');
Route::get('signup/confirm','SignupController@confirm')->name('signup.confirm');
Route::post('signup/confirm','SignupController@postConfirm');
Route::get('signup/thanks','SignupController@thanks')->name('signup.thanks');

//管理者専用Route
Route::prefix('admin')->namespace('Admin')->as('admin.')->group(function(){
  Route::middleware('guest:admin')->group(function(){
    //ログイン画面(guest->認証してる時はアクセスできない)
    Route::get('login','LoginController@showLoginForm')->name('login');
    Route::post('login','LoginController@login');
  });

  Route::middleware('auth:admin')->group(function(){
    //(auth->認証してなきゃアクセスできない)

    //ユーザー管理
    Route::get('user','UserController@index')->name('user.index');
    //ユーザー削除
    Route::delete('user/destory/{user}','UserController@destroy')->name('user.destory');
    //ユーザ登録
    Route::put('user/update', 'UserController@update')->name('user.update');
    //ログアウト
    Route::get('logout','LoginController@logout')->name('logout');
    // 管理者画面top
    Route::get('','IndexController@index')->name('top');
    //メッセージ管理
    //一覧
    Route::get('message','MessageController@index')->name('message.index');
    //メッセージ作成
    Route::get('message/create','MessageController@create')->name('message.create');
    Route::post('message/create','MessageController@store');
    //メッセージ編集画面
    Route::get('message/edit/{message}','MessageController@edit')->name('message.edit');
    Route::post('message/edit/{message}','MessageController@update');
  });
});

//ユーザー専用Route
Route::prefix('user')->namespace('User')->as('user.')->group(function(){
  Route::middleware('guest:user')->group(function(){
    Route::get('login','LoginController@showLoginForm')->name('login');
    Route::post('login','LoginController@login');
  });
  //認証済みユーザー
  Route::middleware('auth:user')->group(function(){
    //ログイン後のRoute
    Route::get('','IndexController@index')->name('top');
    //ログアウト
    Route::get('logout','LoginController@logout')->name('logout');
    //登録情報変更
    Route::get('profile/edit','ProfileController@edit')->name('profile.edit');
    Route::post('profile/edit','ProfileController@update');
    //メッセージ閲覧
    Route::get('message','MessageController@index')->name('message.index');
    // 個別のメッセージを表示
    Route::get('message/show/{message}','MessageController@show')->name('message.show');
    //ユーザーのコメントセクション
    Route::prefix('comment')->namespace('Comment')->as('comment.')->group(function(){
      //コメント一覧
      Route::get('','UserCommentController@index')->name('index');
    });
  });
});

Auth::routes();

Route::get('/logout-manual',function(){
  request()->session()->invalidate();
});
Route::get('/{any}', 'AppController@index')->where('any','.*');
