@extends('layouts.app')
@section('title','All Posts')

@section('content')




  <!-- Authentication Links -->
  @guest
    <h1>Please Login First</h1>
  @else
    @if ($posts)
      @include('layouts.messages')
      <div class=" row mx-auto container">
              @foreach ($posts as $post)
                <div class="col-4">
                <div class="card post-card text-dark bg-info mb-4 font-weight-bolder">
                  <div class="card-header">{{$post->title}}</div>
                  <div class="card-body">
                    <img src="{{asset('storage/images/'.$post->post_img.'')}}" alt="">
                    <p class="card-text my-4">{{$post->content}}</p>
                    <p class="card-title"><b>Author : &nbsp;</b>{{$post->author}}</p>
                    <p class="card-title"><b>Category : &nbsp;</b>{{$post->category}}</p>
                    <p class="card-title "><b>Created on: &nbsp;</b>{{$post->created_at->diffForHumans()}}</p>
                    <a href="{{url("/posts/$post->id")}}"> <button class="btn-warning btn-round" type="button" name="button">Edit</button> </a>

                    <form class="" action="{{url("/posts/$post->id")}}" method="post">
                      @csrf
                      <input type="hidden" name="_method" value="DELETE">
                      <button class="btn-danger btn-round" type="submit" name="button">Delete</button>
                    </form>

                  </div>
                </div>
              </div>
              @endforeach
        </div>

      @else
        <h1>No Post Found</h1>
    @endif

  @endguest


@endsection
