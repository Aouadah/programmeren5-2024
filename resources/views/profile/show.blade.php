@extends('layouts.app')

@section('content')

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <h1 class="ml-6 mb-4">Profile</h1>
    <form method="POST" action="/profile" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="px-6">
            <div class="flex flex-col mb-4 w-96">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="border border-gray-300 p-2 rounded mr-2">
                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex flex-col mb-4 w-96">
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" value="{{ old('email', $user->email) }}" class="border border-gray-300 p-2 rounded mr-2">
                @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">Update Profile</button>
            </div>
        </div>
    </form>

    <h2 class="ml-6 mt-4">Your Movies</h2>
    <div class="grid grid-cols-3 gap-6 px-6">
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

                <div class="flex justify-between">
                    <a href="/movies/{{ $movie->id }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                        View Details
                    </a>
                    <a href="/movies/{{ $movie->id }}/edit" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded-lg">
                        Edit
                    </a>
                    <form method="POST" action="/movies/{{ $movie->id }}" id="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure you want to delete this movie?')" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg">
                            Delete
                        </button>
                    </form>
                </div>
            </article>
        @endforeach
    </div>
@endsection
