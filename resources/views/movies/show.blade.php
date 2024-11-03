@extends('layouts.app')

@section('content')
    <h1 class="mb-4 ml-6">Details</h1>
    <article class="flex flex-row justify-around">
        <div class="bg-white p-6 rounded-lg shadow-md w-5/12">
            <h2 class="mb-4">
                {{ $movie->title }}
            </h2>
            <p class="mb-4">
                Category: {{ $movie->category->name }}
            </p>
            <p class="mb-4">
                Duration: {{ $movie->duration }} minutes
            </p>
            <p class="mb-4">
                Year of release: {{ $movie->year_of_release }}
            </p>
            <p class="mb-4">
                Rating: {{ $movie->rating }}
            </p>
            <p class="mb-4">
                Review: {{ $movie->review }}
            </p>
        </div>
        <div>
            <div>
                <img src="{{ asset('storage/' . $movie->thumbnail) }}" alt="Thumbnail for {{ $movie->title }}" style="max-width:300px; height:auto;">
            </div>
        </div>
    </article>
@endsection
