@extends('welcome')
@section('content')
    <h1 class="edit-head">{{ $album->name }} album</h1>
    @if (count($album->getMedia()))
        <div class="delete-all" id="wrap">
            <a href="{{url('add-photo',$album->id)}}" class="new-btn">Add New Photo</a>
            <a class="delete-btn">Delete Album</a>
        </div>
        <button id="btn-update" class="asd">
            Update Album Name
        </button>
        {{-- poppup 1 --}}
        <div id="popup">
            <h2>Warning!</h2>
            <h4>Do you want <span>Delete</span> all photos, or u want to transfar them to another album</h4>
            <div>
                <button class="delete-modal" href="#"><span>Delete</span></button>
                <button class="trans" href="#">Transfer</button>
            </div>
            <a href="#">Close</a>
        </div>

        {{-- poppup 2  --}}
        <form class="form-inputs" method="post" action="{{ url('album/transfer') }}">
            @csrf
            <div id="popup2">
                <h2>Which album ?</h2>
                <select name="to" class="select">
                    @foreach ($allAlbums as $data)
                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                    @endforeach
                </select>
                <input type="hidden" value="{{ $album->id }}" name="from">
                <div>
                    <button type="submit" class="transReady" href="#">Transfer</button>
                </div>
                <a class="trans" href="#">Close</a>
            </div>
        </form>
                {{-- poppup 3  --}}

        <form class="form-inputs" id="update-name" method="post" action="{{ url('album/update-name') }}">
            @csrf
            <div id="asd">
                <h2>Update Album Name</h2>
                <input type="text" class="old-name" value="{{ $album->name }}" name="name">
                <input type="hidden" name="album_id" value="{{$album->id}}">
                <div>
                    <button type="submit" class="updatePhoto" href="#">Update Photo </button>
                </div>
                <div>
                    <button type="none" id="close-btn-update" class="asd">Close</button>
                </div>
            </div>
        </form>

        {{-- Photos --}}
        <div class="container">
            <ul id="items" class="image-gallery">
                @foreach ($album->getMedia() as $media)
                    <li>
                        <div class="file-name">
                            <h4>{{$media->name}}</h4>
                        </div>
                        <form method="post" action="{{ url('album/delete-photo') }}">
                            @csrf
                            <input type="hidden" value="{{ $media->id }}" name="photo_id">
                            {{ $media }}
                            <button type="submit">Delete</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @else
            <h2 class="show-no-photos">There is no photos for this album</h2>
            <div class="add-photo">
                <a href="">Add new photo</a>
                <a class="delete-album-all" href="{{ url('delete-album',$album->id)}}">Delete Album</a>
            </div>
    @endif
    </div>

    <script>
        $("a").click(function() {
            $("#popup").fadeToggle("slow");

        });
        $(".asd").click(function() {
            $("#asd").fadeToggle("slow");

        });

        $(".delete-modal").click(function() {
            $.get("delete-all/{{ $album->id }}")
                .done(function(data) {
                    location.reload(true);
                });
        });
        $(".trans").click(function() {
            $("#popup2").fadeToggle("slow");
            $('.transReady').click(function() {
                let val = $('.select').find(":selected").val();
                $.post("transfer", {
                        from: "{{ $album->id }}",
                        to: val
                    })
                    .done(function(data) {
                        alert("Data Loaded: " + data);
                        location.reload(true);

                    });
            })
        });
        $('#close-btn-update').click(function(event){
            event.preventDefault();

        })
    </script>
@endsection
