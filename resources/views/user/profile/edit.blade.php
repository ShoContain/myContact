@extends('layouts.user')

@section('title','登録情報変更')

@section('content')

@if(session('status'))
  <p class="text-info">{{session('status')}}</p>
@elseif(session('noMessage'))
<p class="text-danger">{{session('noMessage')}}</p>
@endif

@if(!session()->has('status'))
<form  method="post">
  @csrf
  <div class="form-group w-25">
    <label>名前</label>
    <input type="text" name="name" class="form-control"  value="{{old('name',$user->name)}}">
    @error('name')
    <p class="text-danger">{{ $message }}</p>
    @enderror
  </div>
  <div class="form-group w-25">
    <label>メールアドレス</label>
    <input type="text" name='email' class="form-control"  value="{{old('email',$user->email)}}">
    @error('email')
    <p class="text-danger">{{ $message }}</p>
    @enderror
  </div>
  <button type="submit" class="btn btn-outline-dark">変更する</button>
</form>
@endif
@endsection
