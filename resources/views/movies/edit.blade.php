@php
    use App\Models\Category;
@endphp

@extends('layouts.app')

@section('content')

    <h1 class="ml-6 mb-4">Edit Movie</h1>
    <form method="POST" action="/movies/ {{ $movie->id }}" enctype="multipart/form-data" class="w-7/12 mx-auto">
        @csrf
        @method('PUT')

        <div class="flex justify-between">
            <div>
                <div class="flex flex-col mb-4 w-96">
                    <label for="title">Title:</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $movie->title) }}" class="border border-gray-300 p-2 rounded">
                    @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="flex flex-col mb-4 w-96">
                    <label for="genre">Genre:</label>
                    <input type="text" id="genre" name="genre" value="{{ old('genre', $movie->genre) }}" class="border border-gray-300 p-2 rounded">
                    @error('genre')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="flex flex-col mb-4 w-96">
                    <label for="duration">Duration (minutes):</label>
                    <input type="number" id="duration" name="duration" value="{{ old('duration', $movie->duration) }}" class="border border-gray-300 p-2 rounded">
                    @error('duration')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="flex flex-col mb-4 w-96">
                    <label for="year_of_release">Year of Release:</label>
                    <input type="number" id="year_of_release" name="year_of_release" min="1900" max="2024" value="{{ old('year_of_release', $movie->year_of_release) }}" class="border border-gray-300 p-2 rounded">
                    @error('year_of_release')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div>
                <div class="flex flex-col mb-4 w-96">
                    <label for="rating">Rating:</label>
                    <input type="number" id="rating" name="rating" min="1" max="10" value="{{ old('rating', $movie->rating) }}" class="border border-gray-300 p-2 rounded">
                    @error('rating')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="flex flex-col mb-4 w-96">
                    <label for="thumbnail">Thumbnail:</label>
                    <input type="file" id="thumbnail" name="thumbnail" class="border border-gray-300 p-2 rounded">
                    @error('thumbnail')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="flex flex-col mb-4 w-96">
                    <label for="category">Category</label>
                    <select name="category_id" class="border border-gray-300 p-2 rounded">
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
            </div>
        </div>
        <div class="flex flex-col mx-auto">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">Edit</button>
        </div>
    </form>
@endsection
