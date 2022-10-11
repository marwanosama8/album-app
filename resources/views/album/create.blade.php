@extends('welcome')
@section('content')
    <h1 class="add-album-head">Add New Album</h1>

    <form method="POST" action="{{ url('album') }}">
        @csrf
        <div class="inputs">
            <input placeholder="Add Name..." name='name' type="text">
            <button  type="submit">Add New Album</button>
        </div>
    </form>
@endsection
