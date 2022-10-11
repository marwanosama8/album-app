
@extends('welcome')
@section('content')
@if ($errors->any()))
<div class="error-message">
    @foreach ($errors->all() as $error)
    <strong>{{ $error}}</strong>
    @endforeach
</div>
@endif

@if ($message = Session::get('success'))
<div class="success-message">
    <strong>{{ $message }}</strong>
</div>
@endif
<h1 class="store-photo-head">Add New Photo to {{$album->name}}</h1>
    <form class="store-photo" action="{{url('album/store-photo')}}" method="post" enctype="multipart/form-data">
@csrf
        <input required type="file" name="file" id="file">
        <input  placeholder="Photo Name .." required type="text" name="name" id="name">
        <input type="hidden" name="album_id" value="{{$album->id}}">
        <button type="submit">Upload Photo</button>
    </form>

@endsection