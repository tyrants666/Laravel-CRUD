@extends('layouts.app')
@section('title','Create post')


@section('content')
  <div class="container create-post">
  <!-- Authentication Links -->
  @guest
    <h1>Please Login First</h1>
  @else
    @include('layouts.messages')
    <form action="{{url('/posts')}}" method="post" enctype="multipart/form-data">
      @csrf
        <fieldset>
        <legend>Legend</legend>
        <div class="form-group row">
          <div class="col-sm-10">
            <input type="text" name="title"  class=" border form-control-plaintext" placeholder="Post title">
            <input type="text" name="content"  class=" border form-control-plaintext" placeholder="Post content" style="height: 200px;">
            <input type="text" name="author"  class=" border form-control-plaintext" placeholder="Author">
            <input type="text" name="category"  class=" border form-control-plaintext" placeholder="Category">
            <div class="upload-img d-flex my-4 form-group">
              <img class="featured-img" src="" alt="">
              <div class="form-group">
                <label for="image" >Update Image</label><br>
                <input type="file" name="image" id="upload-img"/><br>
                <small>Max Size : 5MB</small><br>
                <button onclick="event.preventDefault();" disabled default class="btn btn-danger btn-round mt-4 del-img">Delete Image</button>
              </div>
            </div>
          </div>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
        </fieldset>
    </form>
  @endguest

  </div>

@endsection

@section('css')
    <style>
      .featured-img {
        display: none;
      }
    </style>
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
      });
      
      
      
    });
  </script>
@endsection