<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/css/styles.css">
    <title>確認画面</title>
  </head>
  <body>
    <form class=""  method="post">
      @csrf
      <ul>
        <li>
          <label>名前</label>
          <span>{{$user->name}}</span>
        </li>

        <li>
          <label>メールアドレス</label>
          <span>{{$user->email}}</span>
        </li>
        <li>
          <label>入会理由</label>
          <span>{{$user->reason}}</span>
        </li>
      </ul>
      <a href="{{route('signup.index')}}">戻る</a>
      <input type="submit" name="" value="送信する">
    </form>
  </body>
</html>
