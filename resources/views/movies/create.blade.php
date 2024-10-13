<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Page</title>
</head>
<body>
<h1>Create Movie</h1>
<form method="POST" action="/admin/movies" enctype="multipart/form-data">
    @csrf
    <div>
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required>
    </div>

    <div>
        <label for="slug">Slug:</label>
        <input type="text" id="slug" name="slug" required>
    </div>

    <div>
        <label for="genre">Genre:</label>
        <input type="text" id="genre" name="genre" required>
    </div>

    <div>
        <label for="duration">Duration (minutes):</label>
        <input type="number" id="duration" name="duration" required>
    </div>

    <div>
        <label for="year_of_release">Year of Release:</label>
        <input type="number" id="year_of_release" name="year_of_release" min="1900" max="2024" required>
    </div>

    <div>
        <label for="rating">Rating:</label>
        <input type="number" id="rating" name="rating" min="1" max="10" required>
    </div>

    <div>
        <label for="thumbnail">Thumbnail:</label>
        <input type="file" id="thumbnail" name="thumbnail" required>
    </div>

    <div>
        <label for="category">Category</label>
        <select name="category_id">
            @php
                $categories = \App\Models\Category::all()
            @endphp

            @foreach ($categories as $category)
                <option value="{{ $category -> id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <button type="submit">Submit</button>
    </div>
</form>
</body>
</html>
