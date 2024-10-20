<?php

namespace App\Http\Controllers;

use App\Http\Middleware\AdminOnly;
use App\Models\Category;
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
    public function index(Request $request)
    {
        // Get all categories for the filter
        $categories = Category::all();

        $movies = Movie::query();

        // Search by movie title or year of release
        $search = $request->query('search');
        if ($search) {
            $movies->where('title', 'LIKE', '%' . $search . '%')
                ->orWhere('year_of_release', 'LIKE', '%' . $search . '%')->get();
        }

        // Filter by category
        $categoryId = $request->query('category_id');
        if ($categoryId) {
            $movies->where('category_id', $categoryId)->get();
        }

        $movies = $movies->get();

        return view('movies.index', compact('movies', 'categories'));
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

        return redirect('movies');
    }

    // Update a movie
    public function update(Request $request, $id)
    {
        $movie = Movie::findOrFail($id);

        $attributes = $request->validate([
            'title' => 'required',
            'slug' => ['required', Rule::unique('movies', 'slug')->ignore($movie->id)],
            'genre' => 'required',
            'duration' => 'required',
            'year_of_release' => 'required',
            'rating' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')],
        ]);

        if ($request->hasFile('thumbnail')) {
            $attributes['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        $movie->update($attributes);

        return redirect('movies');
    }

    // Edit a movie
    public function edit($id)
    {
        $movie = Movie::findOrFail($id);
        return view('movies.edit', compact('movie'));
    }

    // Delete a movie
    public function destroy($id){
        $movie = Movie::findOrFail($id);
        $movie->delete();

        return redirect('movies');
    }
}
