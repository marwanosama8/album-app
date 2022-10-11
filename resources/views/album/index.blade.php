@extends('welcome')
@section('content')
    <h1 class='head'>Welcome To Album App</h1>
    <div class="new-album">
        <a href="{{url('album/create')}}">Add New Album</a>
    </div>
    <div class="wrapper">

        <div class="table">

            <div class="row header">
                <div class="cell">
                    #
                </div>
                <div class="cell">
                    Album Name
                </div>
                <div class="cell cell-actions">
                    Actions
                </div>
            </div>
            @if (count($albums))
                @foreach ($albums as $key =>$data)
                    <div class="row">
                        <div class="cell" data-title="id">
                            {{$data->id}}
                        </div>
                        <div class="cell" data-title="Name">
                            {{$data->name}}
                        </div>
                        <div class="cell body-actions" data-title="Actions">
                            <a class="edit" href="{{url('album',$data->id.'/edit')}}">Edit</a>
                            <a class="show" href="{{url('album',$data->id)}}">Show</a>
                        </div>
                    </div>
                @endforeach

        </div>
        @else
        <div class="elseif">
            <p>There is no any albums</p>
        </div>
        <a href=""></a>
        @endif
    </div>
    <script>
        $('.delete').click(function(){
            
        })
    </script>
@endsection
