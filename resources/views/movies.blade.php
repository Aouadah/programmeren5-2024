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
    @foreach($movies as $movie)
        <article>
            <h1>
                <a href="/movies/{{ $movie -> slug }}">
                    {{ $movie -> title }}
                </a>
            </h1>

            <p>
                <a href="/categories/{{ $movie->category->slug }}"> {{ $movie->category->name }} </a>
            </p>

            <div>
                {{ $movie -> year_of_release }}
            </div>
        </article>
    @endforeach
</body>
</html>
