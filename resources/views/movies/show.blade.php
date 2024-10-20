<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movie Page</title>
</head>
<body>
<article>
    <h1>{{ $movie->title }}</h1>

    <p>
        <a href="/categories/{{ $movie->category->id }}"> {{ $movie->category->name }} </a>
    </p>

    <div>
        <p>Genre: {{ $movie->genre }}</p>
    </div>
    <div>
        <p>Duration: {{ $movie->duration }}</p>
    </div>
    <div>
        <p>Year of release: {{ $movie->year_of_release }}</p>
    </div>
    <div>
        <p>Rating: {{ $movie->rating }}</p>
    </div>

    <div>
        <img src="{{ asset('storage/' . $movie->thumbnail) }}" alt="Thumbnail for {{ $movie->title }}" style="max-width:300px; height:auto;">
    </div>
</article>

<a href="/movies">Back to Home</a>
</body>
</html>
