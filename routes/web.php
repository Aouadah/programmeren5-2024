<?php

use App\Models\Movie;
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

//Route::get('/movies', function () {
//    return view('movies');
//});
