<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('movies');
});

Route::get('/movies/{movie}', function ($slug) {
    $movie = file_get_contents(__DIR__ . "/../resources/movies/{$slug}.html");

    return view('movie', [
        'movie' => $movie
    ]);
});

//Route::get('/movies', function () {
//    return view('movies');
//});
