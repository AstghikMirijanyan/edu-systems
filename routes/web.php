<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VideosController;
use App\Http\Controllers\TagsController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/tags', [TagsController::class, 'index'])->name('tags');

Route::get('/listingpage', [VideosController::class, 'index'])->name('listingpage');

Route::get('/videos', [VideosController::class, 'show'])->name('videos');
Route::post('tags', [ TagsController::class, 'index' ])->name('tags.videos');

