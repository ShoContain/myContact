@extends('layouts.admin')

@section('content')
<h1>メッセージ一覧</h1>

<p><a href="{{route('admin.message.create')}}">新規作成へ</a></p>

<table border="1">
  <tr class="trTitle">
    <td>編集</td>
    <td>To</td>
    <td>タイトル</td>
    <td>本文</td>
  </tr>
  @foreach($messages as $message)
  <tr>
    <td><a href="{{route('admin.message.edit',$message->id)}}">{{$message->id}}</a></td>
    <td class="messageContent">{{$message->user->name}}</td>
    <td class="messageContent">{{$message->title}}</td>
    <td class="messageContent">{{Str::limit($message->content,50)}}</td>
  </tr>
  @endforeach
</table>

@endsection
