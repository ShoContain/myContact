<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="stylesheet" href="/css/styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Style -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>管理者</title>
  </head>
  <body>
    <div class="nav">
      <ul class="list-unstyled">
        <li><a href="/admin/user">ユーザー一覧</a> </li>
        <li><a href="{{route('admin.message.index')}}">個別のメッセージ</a></li>
        <li><a href="{{route('admin.logout')}}">ログアウト</a></li>
      </ul>
    </div>

    <div id="app">
      <div class="container">
        @yield('content')
      </div>
    </div>
  </body>
</html>
