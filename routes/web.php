<?php

use App\Models\Movie;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('movies', [
        'movies' => Movie::all()
    ]);
});

Route::get('movies/{movie}', function ($id) {
    return view('movie', [
        'movie' => Movie::findOrFail($id)
    ]);
});

//Route::get('/movies', function () {
//    return view('movies');
//});
