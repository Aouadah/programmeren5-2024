<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MovieController;
use App\Http\Middleware\AdminOnly;
use App\Models\Category;
use App\Models\Movie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('movies', [
//        'movies' => Movie::all()
//    ]);
//});

//Route::get('movies/{movie:id}', function (Movie $movie) {
//    return view('movie', [
//        'movie' => $movie
//    ]);
//});

Route::get('categories/{category:id}', function (Category $category) {
    return view('movies', [
        'movies' => $category->movies
    ]);
});

// Inlogpagina
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

// CRUD
Route::get('movies', [MovieController::class, 'index']);
Route::get('movies/{id}', [MovieController::class, 'show']);
Route::get('movies/create', [MovieController::class, 'create']);
Route::post('movies', [MovieController::class, 'store']);
Route::put('movies/{id}', [MovieController::class, 'update']);
Route::get('movies/{id}/edit', [MovieController::class, 'edit']);
Route::delete('movies/{id}', [MovieController::class, 'destroy']);

