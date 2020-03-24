@extends('layouts.user')

@section('title',$message->title)

@section('content')

<div class="card w-50">
  <div class="card-body pt-0">
    <span class="text-info border border-info ">メール内容</span>
    <h6 class="card-subtitle my-2 text-muted">(題名)</h6>
    <h4 class="card-title">{{$message->title}}</h4>
    <h6 class="card-subtitle py-2 text-muted">(本文)</h6>
    <p class="card-text">
      {{$message->content}}
    </p>
  </div>
</div>

@endsection
