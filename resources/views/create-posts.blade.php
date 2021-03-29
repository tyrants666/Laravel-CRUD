@extends('layouts.app')
@section('title','Create post')

@section('content')

  <div class="container create-blog-wrapper">
  <!-- Authentication Links -->
  @guest
    <h1>Please Login First</h1>
  @else
    @include('layouts.messages')
    <form action="{{url('/posts')}}" method="post" >
      @csrf
        <fieldset>
        <legend>Legend</legend>
        <div class="form-group row">
          <div class="col-sm-10">
            <input type="text" name="title"  class=" border form-control-plaintext" placeholder="Post title">
            <input type="text" name="content"  class=" border form-control-plaintext" placeholder="Post content" style="height: 200px;">
            <input type="text" name="author"  class=" border form-control-plaintext" placeholder="Author">
            <input type="text" name="category"  class=" border form-control-plaintext" placeholder="Category">
            <div class="upload-img my-2 form-group">
              <label for="image" >Upload Image</label>
              <input type="file" name="image" />
            </div>
          </div>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
        </fieldset>
    </form>
  @endguest

  </div>

@endsection
