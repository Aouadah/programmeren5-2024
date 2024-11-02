<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\AdminOnly;
use App\Models\Category;
use App\Models\Movie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('categories/{category:id}', function (Category $category) {
    return view('movies', [
        'movies' => $category->movies
    ]);
});

// Home page
Route::get('/', function () {
    return view('welcome');
});

// Login page
Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Profile
Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show')->middleware('auth');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');

// Movies
Route::get('movies', [MovieController::class, 'index'])->name('movies.index');
Route::get('movies/admin', [MovieController::class, 'admin'])->middleware('auth')->name('movies.admin');
Route::get('movies/create', [MovieController::class, 'create'])->name('movies.create');
Route::get('movies/{id}', [MovieController::class, 'show']);
Route::post('movies', [MovieController::class, 'store'])->middleware('auth');
Route::post('/movies/{id}', [MovieController::class, 'status']);
Route::put('movies/{id}', [MovieController::class, 'update']);
Route::get('movies/{id}/edit', [MovieController::class, 'edit'])->middleware('auth');
Route::delete('movies/{id}', [MovieController::class, 'destroy']);
