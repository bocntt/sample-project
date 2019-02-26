@extends('layouts.master')

@section('title')
  <title>{{ $widget->name }} Widget</title>
@endsection

@section('content')
  <ol class="breadcrumb">
    <li><a href="/">Home</a></li>
    <li><a href="/widget">Widgets</a></li>
    <li><a href="/widget/{{ $widget->id }}">{{ $widget->name }}</a></li>
  </ol>
  <h1>{{ $widget->name }}</h1>
  <hr>
  <div class="panel panel-default">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Date Created</th>
          @if (Auth::user()->adminOrCurrentUserOwns($widget))
            <th>Edit</th>
          @endif
          <th>Delete</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>{{ $widget->id }}</td>
          <td>
            <a href="/widget/{{ $widget->id }}/edit">
              {{ $widget->name }}
            </a>
          </td>
          <td>
            {{ $widget->created_at }}
          </td>
          @if (Auth::user()->adminOrCurrentUserOwns($widget))
          <td>
            <a href="/widget/{{ $widget->id }}/edit">
              <button type="button"
                      class="btn btn-default">
                        Edit
                      </button>
            </a>
          </td>
          @endif
          <td>
            <div class="form-group">
              <form 
                  action="{{ url('/widget/'. $widget->id )}}" 
                  class="form"
                  method="POST" 
                  role="form"
              >
                <input type="hidden"
                      name="_method" 
                      value="delete" 
                >
                {{ csrf_field() }}

                <input type="submit" 
                      class="btn btn-danger"
                      onclick="return ConfirmDelete();"
                      value="Delete">
              </form>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

@endsection

@section('scripts')
  <script>
    function ConfirmDelete() {
      var x = confirm('Are you sure you want to delete?');
      return x;
    }
  </script>
@endsection