<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>ユーザーログイン</title>
  </head>
  <body>

  <form method="post">
    @csrf
    <div class="container">
      <h2>ユーザーログイン</h2>
      <div class="form-group w-50">
        <label>Email</label>
        <input type="text" class="form-control" value="{{old('email')}}" placeholder="メールアドレスを入力してください" name="email">
      </div>
      @if($errors->has('email')) <p class="text-danger">{{$errors->first('email')}}</p> @endif
      <div class="form-group w-50">
        <label>パスワード</label>
        <input type="password" class="form-control" placeholder="パスワードを入力してください" name="password">
      </div>
      @if($errors->has('password')) <p class="text-danger">{{$errors->first('password')}}</p> @endif
      <input type="submit" value="ログイン" class=" btn btn-primary">
    </div>
</form>
  </body>
</html>
