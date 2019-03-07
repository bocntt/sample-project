@extends('layouts.master')

@section('title')
  <title>Edit a User</title>
@endsection

@section('content')
  
  @if(Auth::user()->isAdmin())
    <ol class="breadcrumb">
      <li><a href="/">Home</a></li>
      <li><a href="/user">Users</a></li>
      <li><a href="/user/{{ $user->id }}">
        {{ $user->name }}
      </a></li>
    </ol>

  @else

    <ol class="breadcrumb">
      <li><a href="/">Home</a></li>
      <li><a href="/user/{{ $user->id }}">
        {{ $user->name }}
      </a></li>
    </ol>

  @endif

  <h2>Edit Your Record</h2>
  <hr>
  <form action="{{ url('/user/' . $user->id ) }}"
        class="form"
        role="form"
        method="POST">
    <input type="hidden" name="_method" value="patch">
    {{ csrf_field() }}

    <div class="form-group{{ $errors->has('name') ? ' has-error' : ''}}">
      <label class="control-label">First Name</label>
      <input type="text"
            class="form-control"
            name="name"
            value="{{ $user->name }}">
      @if ($errors->has('name'))
        <span class="help-block">
          <strong>{{ $error->first('name') }}</strong>
        </span>
      @endif
    </div>

    <div class="form-group{{ $errors->has('email') ? ' has-error' : ''}}">
      <label class="control-label">Email</label>
      <input type="text"
            class="form-control"
            name="email"
            value="{{ $user->email }}">
      @if ($errors->has('email'))
        <span class="help-block">
          <strong>{{ $error->first('email') }}</strong>
        </span>
      @endif
    </div>

    <div class="form-group{{ $errors->has('is_admin') ? ' has-error' : ''}}">
      <label class="control-label">Is Admin?</label>
      <select name="is_admin" 
              id="is_admin"
              class="form-control">
        <option value="{{ $user->is_admin }}">
          {{ $user->showAdminStatusOf($user) }}
        </option>
        <option value="1">Yes</option>
        <option value="0">No</option>
      </select>
      @if ($errors->has('is_admin'))
        <span class="help-block">
          <strong>{{ $errors->first('is_admin' )}}</strong>
        </span>
      @endif
    </div>

    <div class="form-group{{ $errors->has('status_id') ? ' has-error' : ''}}">
      <label class="control-label">Status?</label>
      <select name="status_id" 
              id="status_id"
              class="form-control">
        <option value="{{ $user->status_id }}">
          {{ $user->showAdminStatusOf($user) }}
        </option>
        <option value="1">Yes</option>
        <option value="0">No</option>
      </select>
      @if ($errors->has('status_id'))
        <span class="help-block">
          <strong>{{ $errors->first('status_id' )}}</strong>
        </span>
      @endif
    </div>

    <div class="form-group">
      <button type="submit"
              class="btn btn-primary btn-lg">
        Update
      </button>
    </div>
  </form>

  @include('errors.list')

@endsection