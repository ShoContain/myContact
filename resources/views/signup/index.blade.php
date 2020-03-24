<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>登録画面</title>
    <link  href="/css/styles.css" rel="stylesheet">
  </head>
  <body>

    <form class=""  method="post">
      @csrf
      <ul>
        <li>
          <label>名前</label>
          <input type="text" name="name" value="{{$user->name}}">
          @if($errors->has('name'))<br><span class="error-box">{{$errors->first('name')}}</span> @endif
        </li>
        <li>
          <label>メールアドレス</label>
          <input type="text" name="email" value="{{$user->email}}">
          @if($errors->has('email'))<br><span class="error-box">{{$errors->first('email')}}</span> @endif
        </li>
        <li>
          <label>パスワード</label>
          <input type="password" name="password" >(8~30文字)
          @if($errors->has('password'))<br><span class="error-box">{{$errors->first('password')}}</span> @endif
        </li>
        <li>
          <label>パスワード(確認)</label>
          <input type="password" name="password_confirmation">
        </li>
        <li>
          <label>入会理由</label>
          <input type="text" name="reason" value="{{$user->reason}}">
          @if($errors->has('reason'))<br><span class="error-box">{{$errors->first('reason')}}</span> @endif
        </li>
      </ul>
    <input type="submit" name="" value="確認画面へ">
    </form>
  </body>
</html>
