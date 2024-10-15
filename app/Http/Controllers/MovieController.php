<?php

namespace App\Http\Controllers;

use App\Http\Middleware\AdminOnly;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MovieController extends Controller
{
    // Middleware
    public function __construct()
    {
        $this->middleware(AdminOnly::class)->only('create');
    }

    // Index page
    public function index()
    {
        $movies = Movie::all();
        return view('movies.index', compact('movies'));
    }

    // Detail page
    public function show($id)
    {
        $movie = Movie::findOrFail($id);
        return view('movies.show', compact('movie'));
    }

    // Create a new movie
    public function create()
    {
        if (auth()->user()?->name!== 'test'){
            abort(403);
        }

        return view('movies.create');
    }

    // Store a movie
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'title' => 'required',
            'slug' => ['required', Rule::unique('movies', 'slug')],
            'genre' => 'required',
            'duration' => 'required',
            'year_of_release' => 'required',
            'rating' => 'required',
            'thumbnail' => 'required|image',
            'category_id' => ['required', Rule::exists('categories', 'id')],
        ]);

        $attributes['user_id'] = auth()->id();
        $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails', 'public');

        Movie::create($attributes);

        return redirect('admin/movies');
    }

    public function update(Request $request, $id){
        $movie = Movie::findOrFail($id);
        $movie->update($request->all());

        return redirect('admin/movies');
    }

    public function destroy($id){
        $movie = Movie::findOrFail($id);
        $movie->delete();

        return redirect('admin/movies');
    }
}
