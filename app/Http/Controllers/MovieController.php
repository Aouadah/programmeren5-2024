<?php

namespace App\Http\Controllers;

use http\Env\Response;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function __construct()
    {
        // Register middleware in Laravel 11
        $this->middleware(\App\Http\Middleware\AdminOnly::class)->only('create');
    }

    public function create()
    {
        if (auth()->user()?->name!== 'test'){
            abort(403);
        }

        return view('movies.create');
    }
}
