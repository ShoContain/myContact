<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Topページ</title>
  </head>
  <body>
    <h2>各ページのリンク</h2>
    <ul>
      <li><a href="{{route('signup.index')}}">ユーザー新規登録</a></li>
      <li><a href="{{route('user.login')}}">ユーザーログイン</a></li>
      <li><a href="{{route('admin.login')}}">管理者ログイン</a></li>
    </ul>
  </body>
</html>
