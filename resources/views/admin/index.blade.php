@extends('layouts.admin')

@section('content')
<h1>管理者トップ</h1>
<span class="loggedInUser">({{Auth::user()->username}})</span>
@endsection
