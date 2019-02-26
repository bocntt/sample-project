@extends('layouts.master')

@section('title')
  <title>Users</title>
@endsection

@section('content')
  <ol class="breadcrumb">
    <li><a href="/">Home</a></li>
    <li class="active">Users</li>
  </ol>
  <h2>Users</h2>
  <hr>
  @if($users->count() > 0)

    <table class="table table-hover table-bordered table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Admin</th>
          <th>Status</th>
          <th>Newsletter</th>
          <th>Date created</th>
          <th>Edit</th>
          <th>Delete</th>
        </tr>
      </thead>
      @foreach($users as $user)
        <tr>
          <td>{{ $user->id }}</td>
          <td>
            <a href="/user/{{ $user->id }}">{{ $user->name }}</a>
          </td>
          <td>{{ $user->showAdminStatusOf($user)  }}</td>
          <td>{{ $user->showStatusOf($user) }}</td>
          <td>{{ $user->showNewsletterStatusOf($user) }}</td>
          <td>{{ $user->created_at }}</td>
          <td>
            <a href="/user/{{ $user->id }}/edit">
              <button type="button" class="btn btn-default">
                Edit
              </button>
            </a>
          </td>
          <td>
            <div class="form-group">
              <form action="{{ url('/user/' . $user->id)  }}"
                    class="form"
                    role="form"
                    method="POST">
                <input type="hidden" name="_method" value="delete">
                {{ csrf_field() }}
                <input type="submit"
                      class="btn btn-danger"
                      onclick="return ConfirmDelete();"
                      value="Delete">
              </form>
            </div>
          </td>
        </tr>
      @endforeach
    </table>

  @else
  
    Sorry, no users

  @endif

  {{ $users->links() }}


@endsection