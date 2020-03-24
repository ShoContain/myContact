@extends('layouts.user')

@section('title','ユーザーTOP')
@section('menu','ユーザーTOP')

@section('content')

@if(session('noMessage'))
<p class="text-danger">{{session('noMessage')}}</p>
@endif

@if(session('status'))
<p class="text-danger">{{session('status')}}</p>
@endif
@endsection
