@extends('layouts.app')

@section('title','blog-home')
@section('content')
<div class="container">
    <div class="row justify-content-center">

<div class="col-12">
  <ul>
    <a href="{{url('/posts/create')}}"> <li>Create Post</li> </a>
    <a href="{{url('/posts')}}"> <li>View Posts ({{\DB::table('posts')->where('user_id','=', auth()->user()->id)->count()}})</li> </a>
    <li>Total Posts : {{\DB::table('posts')->where('user_id','=', auth()->user()->id)->count()}} </li>
  </ul>
</div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                </div>
            </div>
        </div>



    </div>
</div>
@endsection
