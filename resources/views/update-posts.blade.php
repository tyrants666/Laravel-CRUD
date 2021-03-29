@extends('layouts.app')
@section('title','Edit post')

@section('content')

  <div class="container create-blog-wrapper">
  <!-- Authentication Links -->
  @guest
    <h1>Please Login First</h1>
  @else
    @include('layouts.messages')
    <form action="{{url("/posts/$post->id")}}" method="post">
      @csrf
      <input type="hidden" name="_method" value="PUT">
        <fieldset>
        <legend>Legend</legend>
        <div class="form-group row">
          <div class="col-sm-10">
            <input type="text" name="title"  class=" border form-control-plaintext" placeholder="Post title" value="{{$post->title}}">
            <input type="text" name="content"  class=" border form-control-plaintext" placeholder="Post content" style="height: 200px;" value="{{$post->content}}">
            <input type="text" name="author"  class=" border form-control-plaintext" placeholder="Author" value="{{$post->author}}">
            <input type="text" name="category"  class=" border form-control-plaintext" placeholder="Category" value="{{$post->category}}">
          </div>
        </div>
        </fieldset>
        <button type="submit" class="btn btn-primary btn-round">Update Submit</button>

    </form>

    <form class="" action="{{url("/posts/$post->id")}}" method="post">
      @csrf
      <input type="hidden" name="_method" value="DELETE">
      <button class="btn-danger btn-round" type="submit" name="button">Delete</button>
    </form>

  @endguest


  </div>

@endsection
