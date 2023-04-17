<?php

use App\Http\Admin\Controllers\TagsController;
use Illuminate\Support\Facades\Route;
use App\Http\Admin\Controllers\VideosController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/

Route::resource('/tags', TagsController::class);

Route::resource('/videos', VideosController::class);
Route::post('video-upload', [ VideosController::class, 'uploadVideo' ])->name('store.videos');
Route::get('video/fetch', 'VideosController@fetch')->name('videos.fetch');
Route::get('video/delete', 'VideosController@delete')->name('videos.delete');


