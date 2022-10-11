<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAlbumRequest;
use App\Http\Requests\StorePhotoRequest;
use App\Http\Requests\UpdateAlbumRequest;
use App\Models\Album;
use App\Models\Media;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Album::all();
        return view('album.index', ['albums' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('album.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAlbumRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAlbumRequest $request)
    {
        $data = $request->validated();
        $model = Album::create($data);
        return redirect('album');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function show(Album $album)
    {
        return view('album.show', ['album' => $album]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function edit(Album $album)
    {
        $allAlbums = Album::all();
        return view('album.edit', ['album' => $album, 'allAlbums' => $allAlbums]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function deleteAlbum($id)
    {
        try {
            Album::find($id)->delete();
            return redirect('album');
        } catch (\Exception $th) {
            return $th->getMessage();
        }
    }

    /**
     * Remove all resources from storage.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function deleteAll($id)
    {
        try {
            $data = Album::find($id);
            $data->clearMediaCollection();
            return true;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Transfer all photos to specific album.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function transfer(Request $request)
    {
        try {
            $from = $request->input('from');
            $to = $request->input('to');
            $fromModel = Album::find($from);
            $toModel = Album::find($to);
            $data = $fromModel->getMedia();
            foreach ($data as $value) {
                $movedMediaItem = $value->move($toModel);
            }
            return redirect('album');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Delete specific photo.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function deletePhoto(Request $request)
    {
        try {
            $media = Media::find($request->input('photo_id'));
            $model = Album::find($media->model_id);
            $model->deleteMedia($media->id);
            return redirect('album/' . $model->id . '/edit');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    /**
     * Add photo view.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function addPhoto($id)
    {
        $data = Album::find($id);
        return view('album.file', ['album' => $data]);
    }
    /**
     * store photo.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function storePhoto(StorePhotoRequest $request)
    {
        try {
            $data = $request->validated();
            $album = Album::find($data['album_id']);
            $album->addMediaFromRequest('file')->usingName($data['name'])->toMediaCollection();
            return redirect()->back()->with('success','Photo Add Successfully');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    /**
     * Update Photo Name.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function updatePhotoName(Request $request)
    {
        try {
            $album = Album::find($request->album_id);
            $album->update(['name' => $request->name]);
            return redirect()->back();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
