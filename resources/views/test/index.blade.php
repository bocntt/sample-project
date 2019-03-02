@extends('layouts.master')

@section('title')
  <title>Test Page</title>
@endsection

@section('content')

<h1>Make it here</h1>

  @if(session()->has('status'))
    {{ session('status') }}
  @endif

  @if (isset($beatles) && count($beatles) > 0)
    @foreach ($beatles as $beatle)
      {{ $beatle }} <br />
    @endforeach
  @else
    <h1>Sorry, nothing to show...</h1>
  @endif

  <div>
    <parent v-bind:items="items"></parent>
    <add-item v-on:itemcreated="addItem"></add-item>
  </div>

@endsection