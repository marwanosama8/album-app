<?php

use App\Http\Controllers\AlbumController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::resource('album', AlbumController::class);
Route::get('album/delete-all/{id}', [AlbumController::class,'deleteAll']);
Route::get('delete-album/{id}', [AlbumController::class,'deleteAlbum']);
Route::post('album/transfer', [AlbumController::class,'transfer']);
Route::post('album/delete-photo', [AlbumController::class,'deletePhoto']);
Route::get('add-photo/{id}',[AlbumController::class,'addPhoto']);
Route::post('album/store-photo', [AlbumController::class,'storePhoto']);
Route::post('album/update-name', [AlbumController::class,'updatePhotoName']);