@extends('layouts.app')

@section('content')

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <h1 class="ml-6 mb-4">Reviews</h1>

    <!-- Search -->
    <form action="/movies" method="GET" class="p-6">
        <input type="text" name="search" placeholder="Search for a movie..." value="{{ request('search') }}" class="border border-gray-300 p-2 rounded mr-2">

        <!-- Category dropdown list -->
        <select name="category_id" class="border border-gray-300 p-2 rounded mr-2">
            <option value="">All Categories</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        <button type="submit" class="bg-blue-500 text-white p-2 rounded">Search</button>
    </form>

    <!-- Movies -->
    <div class="grid grid-cols-3 gap-6 p-6">
        @foreach($movies as $movie)
            <article class="bg-white p-6 rounded-lg shadow-md">
                <h1 class="text-2xl font-bold mb-4">
                    {{ $movie->title }}
                </h1>
                <p class="mb-4">
                    Category: {{ $movie->category->name }}
                </p>
                <p class="mb-4">
                    Released in: {{ $movie->year_of_release }}
                </p>
                <div class="mb-4">
                    <img src="{{ asset('storage/' . $movie->thumbnail) }}" alt="{{ $movie->title }}" class="w-full h-80 object-cover rounded">
                </div>
                <a href="/movies/{{ $movie->id }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                    View Details
                </a>
            </article>
        @endforeach
    </div>
@endsection
