@extends('layouts.master')

@section('title')
  <title>Welcome Page</title>
@endsection

@section('content')

<h1>Make it here</h1>

@if(session()->has('status'))
  {{ session('status') }}
@endif

@if (count($beatles) > 0)
  @foreach ($beatles as $beatle)
    {{ $beatle }} <br />
  @endforeach
@else
  <h1>Sorry, nothing to show...</h1>
@endif