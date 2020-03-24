<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>管理者ログイン</title>
    <link rel="stylesheet" href="/css/styles.css">
  </head>
  <body>
    <form class=""  method="post">
      @csrf
      <ul>
        <li>
          <label>ログインID</label>
          <input type="text" name="username" value="{{old('username')}}">
          @if($errors->has('username'))<br><span class="error-box">{{$errors->first('username')}}</span> @endif
        </li>
        <li>
          <label>パスワード</label>
          <input type="password" name="password" >
          @if($errors->has('password'))<br><span class="error-box">{{$errors->first('password')}}</span> @endif
        </li>
      </ul>
    <input type="submit" name="" value="ログイン">
    </form>

    <div id='app'>
      <first-compo></first-compo>
    </div>
  </body>
</html>
