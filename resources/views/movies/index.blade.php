<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movies Page</title>
</head>
<body>

<form action="/movies" method="GET">
    <input type="text" name="search" placeholder="Search for a movie..." value="{{ request('search') }}">
    <button type="submit">Search</button>
</form>

@foreach($movies as $movie)
    <article>
        <h1>
            <a href="/movies/{{ $movie -> id }}">
                {{ $movie -> title }}
            </a>
        </h1>

        <p>
            <a href="/categories/{{ $movie->category->id }}"> {{ $movie->category->name }} </a>
        </p>

        <div>
            {{ $movie -> year_of_release }}
        </div>

        <div>
            <img src="{{ asset('storage/' . $movie->thumbnail) }}" alt="Thumbnail for {{ $movie->title }}" style="max-width:300px; height:auto;">
        </div>

        <a href="/movies/{{ $movie->id }}/edit">Edit</a>

        <form method="POST" action="/movies/{{ $movie->id }}" id="delete-form" class="hidden">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('Are you sure you want to delete this movie?')">Delete</button>
        </form>
    </article>
@endforeach
</body>
</html>
