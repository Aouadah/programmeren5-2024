@php
    use App\Models\Category;
@endphp

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Page</title>
</head>
<body>
<h1>Edit Movie</h1>
<form method="POST" action="/movies/ {{ $movie->id }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div>
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="{{ old('title', $movie->title) }}">
        @error('title')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="genre">Genre:</label>
        <input type="text" id="genre" name="genre" value="{{ old('genre', $movie->genre) }}">
        @error('genre')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="duration">Duration (minutes):</label>
        <input type="number" id="duration" name="duration" value="{{ old('duration', $movie->duration) }}">
        @error('duration')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="year_of_release">Year of Release:</label>
        <input type="number" id="year_of_release" name="year_of_release" min="1900" max="2024" value="{{ old('year_of_release', $movie->year_of_release) }}">
        @error('year_of_release')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="rating">Rating:</label>
        <input type="number" id="rating" name="rating" min="1" max="10" value="{{ old('rating', $movie->rating) }}">
        @error('rating')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="thumbnail">Thumbnail:</label>
        <input type="file" id="thumbnail" name="thumbnail">
        @error('thumbnail')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="category">Category</label>
        <select name="category_id">
            @php
                $categories = Category::all()
            @endphp

            @foreach ($categories as $category)
                <option value="{{ $category -> id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        @error('category_id')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <button type="submit">Update</button>
    </div>
</form>
</body>
</html>
