@if ($errors->any())
  @foreach ($errors->all() as $error)

    <div class="alert alert-dismissible alert-danger">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <p>{{$error}}</p>
    </div>

  @endforeach
@endif


@if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif
