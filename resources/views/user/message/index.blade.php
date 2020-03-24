@extends('layouts.user')

@section('title',auth()->user()->name.'の詳細')

@section('content')
<table class="table">
  <thead class="thead-light">
    <tr>
      <th>詳細</th>
      <th>登録日</th>
      <th>タイトル</th>
      <th>本文</th>
    </tr>
  </thead>
  <tbody>
    @foreach($messages as $message)
    <tr>
      <th scope="row"><a href="{{route('user.message.show',$message->id)}}">詳細</a></th>
      <td>{{$message->created_at->format('Y年n月j日')}}</td>
      <td>{{ $message->title }}</td>
      <td>{{ Str::limit($message->content) }}</td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection
