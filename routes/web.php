<?php

use App\Http\Controllers\ActorsController;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\TvController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[MoviesController::class,'index'])->name('movies.index');
// Route::view('/','index');

Route::get('/movie/{id}',[MoviesController::class,'show'])->name('movies.show');
Route::get('/actors',[ActorsController::class,'index']);
Route::get('/actors/page/{page?}',[ActorsController::class,'index'])->name('actors.index');
Route::get('/actors/{actor}',[ActorsController::class,'show'])->name('actors.show');
Route::get('/tvshows', [TvController::class,'index'])->name('tvshows.index');
Route::get('/tvshows/{tv}', [TvController::class,'show'])->name('tvshows.show');