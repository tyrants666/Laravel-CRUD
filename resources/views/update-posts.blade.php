@extends('layouts.app')
@section('title','Edit post')

@section('content')

  <div class="container create-blog-wrapper update-post">
  <!-- Authentication Links -->
  @guest
    <h1>Please Login First</h1>
  @else
    @include('layouts.messages')
    <form action="{{url("/posts/$post->id")}}" method="post" enctype="multipart/form-data">
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
            
            <div class="upload-img d-flex my-2 form-group">
              <img class="featured-img" src="{{asset('storage/images/'.$post->post_img.'')}}" alt="">
              <div class="form-group">
                <label for="image" >Update Image</label><br>
                <input type="file" name="image" id="upload-img"/><br>
                <small>Max Size : 5MB</small><br>
                <button onclick="event.preventDefault();" disabled class="btn btn-danger btn-round mt-4 del-img">Delete Image</button>
              </div>
            </div>

          </div>
        </div>
        </fieldset>
        <button type="submit" id="update" class="btn btn-primary btn-round">Update Submit</button>

    </form>

    <form class="" action="{{url("/posts/$post->id")}}" method="post">
      @csrf
      <input type="hidden" name="_method" value="DELETE">
      <button class="btn-danger btn-round" type="submit" name="button">Delete</button>
    </form>

  @endguest


  </div>

@endsection

@section('script')
  <script>

    $(document).ready(function () {

      let upload = document.querySelector('#upload-img');
      let feature_img = document.querySelector('.featured-img');

      // Upload & display the image
      // --------------------------------------------------------

      upload.addEventListener('change', (e) => {
        if (e.target.files.length) {
            
            var reader = new FileReader();
            reader.onload = function (e) {
                if(e.target.result){
                    feature_img.src = e.target.result;
                    $('.featured-img').show();
                    $('.del-img').show();
                }
            };
            reader.readAsDataURL(e.target.files[0]);
        }
      })
      
      // Delete Image (Leave image field blank)
      // --------------------------------------------------------

      $('.del-img').click(function () { 
        feature_img.src = '';
        feature_img.style.display = "none";
        $('.del-img').hide();
        // $('#upload-img').val('');
      });
      
    });
  </script>
@endsection
