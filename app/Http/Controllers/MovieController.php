<?php

namespace App\Http\Controllers;

use App\Http\Middleware\AdminOnly;
use App\Models\Category;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\UserLogin;
use Carbon\Carbon;

class MovieController extends Controller
{
    // Middleware
    public function __construct()
    {
        $this->middleware('auth')->only(['create', 'store', 'edit', 'update', 'destroy']);
        $this->middleware(AdminOnly::class)->only('admin');
    }

    // Index page
    public function index(Request $request)
    {
        // Get all categories for the filter
        $categories = Category::all();

        $movies = Movie::query()->where('status', 'active');

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
        // You need to be logged in on 5 different days before you can create a new movie
        $loginDays = UserLogin::where('user_id', auth()->id())->distinct('login_date')->count();

        if ($loginDays < 4) {
            return redirect()->back()->with('error', 'You need to have logged in on 5 different days to create a movie.');
        }

        return view('movies.create');
    }

    // Store a movie
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'title' => 'required',
            'genre' => 'required',
            'duration' => 'required',
            'year_of_release' => 'required',
            'rating' => 'required',
            'thumbnail' => 'required|image',
            'category_id' => ['required', Rule::exists('categories', 'id')],
        ]);

        $attributes['user_id'] = auth()->id();
        $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails', 'public');
        $attributes['status'] = 'inactive';

        Movie::create($attributes);

        return redirect('movies');
    }

    // Update a movie
    public function update(Request $request, $id)
    {
        $movie = Movie::findOrFail($id);

        if ($movie->user_id !== auth()->id()) {
            abort(403);
        }

        $attributes = $request->validate([
            'title' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'duration' => 'required|integer|min:1',
            'year_of_release' => 'required|integer|min:1900|max:2024',
            'rating' => 'required|numeric|min:1|max:10',
            'category_id' => ['required', Rule::exists('categories', 'id')],
        ]);

        if ($request->hasFile('thumbnail')) {
            $attributes['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        $movie->update($attributes);

        return redirect('profile');
    }

    // Edit a movie
    public function edit($id)
    {
        $movie = Movie::findOrFail($id);

        if ($movie->user_id !== auth()->id()) {
            abort(403);
        }

        return view('movies.edit', compact('movie'));
    }

    // Delete a movie
    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);

        if ($movie->user_id !== auth()->id()) {
            abort(403);
        }

        $movie->delete();

        return redirect('profile');
    }

    // Change the status of a movie
    public function status($id)
    {
        $movie = Movie::findOrFail($id);

        $movie->status = $movie->status === 'active' ? 'inactive' : 'active';
        $movie->save();

        return redirect()->back();
    }

    // Show a table of all movies
    public function admin()
    {

        $movies = Movie::with('category')->get();
        $categories = Category::all();

        return view('movies.admin', compact('movies', 'categories'));
    }
}
