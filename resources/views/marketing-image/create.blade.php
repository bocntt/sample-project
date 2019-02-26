@extends('layouts.master')

@section('title')
  <title>Create a Marketing Image</title>
@endsection

@section('content')

  <ol class="breadcrumb">
    <li><a href="/">Home</a></li>
    <li><a href="/marketing-image">Marketing Images</a></li>
    <li class="active">Create</li>
  </ol>

  <h2>Create a New Marketing Image</h2>
  <hr>

  <form class="form"
        role="form"
        method="POST"
        action="{{ url('/marketing-image') }}"
        enctype="multipart/form-data">
    {{ csrf_field() }}

    <div class="form-group{{ $errors->has('image_name') ? ' has-error' : '' }}">
      <label for="" class="control-label">Image Name</label>
      <input type="text"
            class="form-control"
            name="image_name"
            value="{{ old('image_name') }}">
      @if ($errors->has('image_name'))
        <span class="help-block">
          <strong>{{ $errors->first('image_name') }}</strong>
        </span>
      @endif
    </div>

    <div class="form-group{{ $errors->has('is_active') ? ' has-error' : '' }}">
      <label for="" class="control-label">Is Active</label>
      <select class="form-control"
            id="is_active" 
            name="is_active">
        <option value="{{ old('is_active') }}">
          {{ ! is_null(old('is_active')) ? (old('is_active') == 1 ? 'Yes' : 'No') : 'Please choose one' }}
        </option>
        <option value="1">Yes</option>
        <option value="0">No</option>
      </select>
      @if ($errors->has('is_active'))
        <span class="help-block">
          <strong>{{ $errors->first('is_active') }}</strong>
        </span>
      @endif
    </div>

    <div class="form-group{{ $errors->has('is_featured') ? ' has-error' : '' }}">
      <label for="" class="control-label">Is Featured</label>
      <select class="form-control"
            id="is_featured" 
            name="is_featured">
        <option value="{{ old('is_featured') }}">
          {{ ! is_null(old('is_featured')) ? (old('is_featured') == 1 ? 'Yes' : 'No') : 'Please choose one' }}
        </option>
        <option value="1">Yes</option>
        <option value="0">No</option>
      </select>
      @if ($errors->has('is_featured'))
        <span class="help-block">
          <strong>{{ $errors->first('is_featured') }}</strong>
        </span>
      @endif
    </div>

    <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
      <label for="" class="control-label">Primary Image</label>
      <input type="file"
            name="image"
            id="image"> 
      @if ($errors->has('image'))
        <span class="help-block">
          <strong>{{ $errors->first('image') }}</strong>
        </span>
      @endif
    </div>

    <div class="form-group">
      <button type="submit"
              class="btn btn-primary btn-lg">
        Create
      </button>
    </div>

  </form>

@endsection