@extends('layouts.admin')

@section('content')

      <h2>ユーザ一覧</h2>
      <delete-table :users="{{ $users }}"></delete-table>


@endsection
