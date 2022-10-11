@extends('welcome')
@section('content')
    <h1 class="edit-head">{{ $album->name }} album</h1>
    <div class="container">
        @if (count($album->getMedia()))
            <ul class="image-gallery">
                @foreach ($album->getMedia() as $media)
                <li>
                        <div class="file-name">
                            <h4>{{$media->name}}</h4>
                        </div>
                        {{ $media }}
                    </li>
                @endforeach
            </ul>
            @else
            <h2 class="show-no-photos">There is no photos for this album</h2>
            <div class="add-photo">
                <a href="{{url('add-photo',$album->id)}}">Add new photo</a>
            </div>
            @endif
    </div>
@endsection
