<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>管理者</title>
    <title>@section('title') @show - サイト名</title>
  </head>
  <body>
    <div class="container">
      <p class="navbar-brand">@yield('menu')</p>
      @if(!session('status'))
      <span class="text-info mt-3">{{auth()->user()->name}}としてログイン中</span>
      @endif
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar nav-link" href="{{route('user.top')}}">HOME</a>
        <a class="navbar nav-link" href="{{route('user.profile.edit')}}">登録情報変更</a>
        <a class="navbar nav-link" href="{{route('user.message.index')}}">メッセージ一覧</a>
        <a class="navbar nav-link" href="{{route('user.logout')}}">ログアウト</a>
      </nav>


    </div>

    <div class="container">
        @yield('content')
    </div>
  </body>
</html>
