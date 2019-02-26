@extends('layouts.master')

@section('title')
  <title>The Admin Page</title>
@endsection

@section('content')
  <h1>I am Admin</h1>

  @include('admin.grid')
  
@endsection