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

// Login page
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

// CRUD
Route::get('movies', [MovieController::class, 'index']);
Route::get('movies/create', [MovieController::class, 'create']);
Route::get('movies/{id}', [MovieController::class, 'show']);
Route::post('movies', [MovieController::class, 'store'])->middleware('auth');
Route::post('/movies/{id}', [MovieController::class, 'status']);
Route::put('movies/{id}', [MovieController::class, 'update']);
Route::get('movies/{id}/edit', [MovieController::class, 'edit'])->middleware('auth');//->can('edit-movie', 'movie');
Route::delete('movies/{id}', [MovieController::class, 'destroy']);

// Admin
// Routes to get to the admin page, where you have a table where you can edit, delete and change the status of movies,
// so that posts needs to be approved to appear on the index page (I think its called a dashboard)
