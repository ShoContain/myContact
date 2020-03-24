@extends('layouts.admin')

@section('content')

<h1>メッセージ{{($message->exists)?'変更':'登録'}}</h1>


<!-- 成功時のメッセージ -->
@if(session('status'))
  <p class="info-box">{{session('status')}}</p>
@endif

@if(!session()->has('status'))
<form method="post">
  @csrf
  <ul class="list-unstyled">
    <li>
      <label>To</label>
      <select class="ml-5" name="user_id" v-on:change="changeMessage()">
        <option value="">選択してください</option>
        @foreach($userList as $key=>$val)
          <option value="{{$key}}" @if(old("user_id",$message->user_id)==$key) selected @endif>{{$val}}</option>
        @endforeach
      </select>
      @if($errors->has('user_id'))<span class="error-box ml-3">{{$errors->first('user_id')}}</span>@endif
    </li>

    <li>
      <label>タイトル</label>
      <input type="text" name="title" size="50" value="{{old('title',$message->title)}}">
      @if($errors->has('title'))<span class="error-box ml-3">{{$errors->first('title')}}</span>@endif
    </li>

    <li>
      <p>本文</p>
      <textarea name="content" rows="10" cols="60">{{old('content',$message->content)}}</textarea>
      @if($errors->has('content'))<span class="error-box ml-3">{{$errors->first('content')}}</span>@endif
    </li>
  </ul>


  <input type="submit" value="{{ ($message->exists)? '変更する':'登録する' }}">
</form>


@endif

@endsection
