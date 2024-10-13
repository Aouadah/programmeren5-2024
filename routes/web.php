<?php

use App\Http\Controllers\MovieController;
use App\Http\Middleware\AdminOnly;
use App\Models\Category;
use App\Models\Movie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('movies', [
        'movies' => Movie::all()
    ]);
});

Route::get('movies/{movie:slug}', function (Movie $movie) {
    return view('movie', [
        'movie' => $movie
    ]);
});

Route::get('categories/{category:slug}', function (Category $category) {
    return view('movies', [
        'movies' => $category->movies
    ]);
});

// Inlogpagina
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// CRUD
Route::get('admin/movies/create', [MovieController::class, 'create'])->middleware(AdminOnly::class);
Route::post('admin/movies', [MovieController::class, 'store'])->middleware(AdminOnly::class);
