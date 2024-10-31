<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movies Page</title>
</head>
<body>
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
<a href="/movies/create">Create</a>

<!-- Search -->
<form action="/movies" method="GET">
    <input type="text" name="search" placeholder="Search for a movie..." value="{{ request('search') }}">

    <!-- Category dropdown list -->
    <select name="category_id">
        <option value="">All Categories</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>

    <button type="submit">Search</button>
</form>

<!-- Movies -->
@foreach($movies as $movie)
    <article>
        <h1>
            <a href="/movies/{{ $movie->id }}">{{ $movie->title }}</a>
        </h1>

        <p>
            <a href="/categories/{{ $movie->category->id }}">{{ $movie->category->name }}</a>
        </p>

        <div>{{ $movie->year_of_release }}</div>

        <div>
            <img src="{{ asset('storage/' . $movie->thumbnail) }}" alt="Thumbnail for {{ $movie->title }}" style="max-width:300px; height:auto;">
        </div>
    </article>
@endforeach
</body>
</html>
