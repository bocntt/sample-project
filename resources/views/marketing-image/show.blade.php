@extends('layouts.master')

@section('title')
  <title>{{ $marketingImage->name }}</title>
@endsection

@section('content')

  <ol class="breadcrumb">
    <li><a href="/">Home</a></li>
    <li><a href="/marketing-image">Marketing Images</a></li>
    <li><a href="/marketing-image/{{ $marketingImage->id }}">
      {{ $marketingImage->image_name }}
    </a></li>
  </ol>

  <h1>{{ $marketingImage->image_name }} Marketing Image</h1>

  <div class="pull-left">
    <a href="/marketing-image/{{ $marketingImage->id }}/edit">
      <button type="button"
              class="btn btn-primary btn-lg">
        Edit image
      </button>
    </a>
  </div>
  <br>
  <br>  
  <hr>

  <div class="panel panel-default">
    <table class="table table-striped">
      <tr>
        <th>Thumbnail</th>
      </tr>
      <tr>
        <td>
          <img src="{{ $marketingImage->showImage($marketingImage, $thumbnailPath)  }}" alt="">
        </td>
      </tr>
      <tr>
        <th>Active?</th>
      </tr>
      <tr>
        <td>{{ $marketingImage->showActiveStatus($marketingImage->is_active) }}</td>
      </tr>
      <tr>
        <th>Featured?</th>
      </tr>
      <tr>
        <td>
          {{ $marketingImage->showFeaturedStatus($marketingImage->is_featured) }}
        </td>
      </tr>
      <tr>
        <th>Primary Image</th>
      </tr>
      <tr>
        <td>
          <img src="{{ $marketingImage->showImage($marketingImage, $imagePath) }}" alt=""
              style="max-width:600px">
        </td>
      </tr>
      <tr>
        <td>
          <div class="form-group pull-left">
            <form action="{{ url('/marketing-image/' . $marketingImage->id) }}"
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
      <tr>
        <th>Image Weight</th>
      </tr>
      <tr>
        <td>{{ $marketingImage->image_weight }}</td>
      </tr>
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