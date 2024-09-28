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
                <a href="/movies/{{ $movie -> id }}">
                    {{ $movie -> title }}
                </a>
            </h1>

            <div>
                {{ $movie -> year_of_release }}
            </div>
        </article>
    @endforeach
</body>
</html>
