@extends('layouts.app')

@section('content')

    <div class="flex flex-col items-center text-center">
        <h1 class="text-5xl font-bold">
            Welcome to Moview!
        </h1>
        <h2 class="text-lg mb-8">
            Get it? It's like a combination of the words "movie" and "review"
        </h2>
        <div class="bg-white rounded-lg shadow-md mb-4 w-2/3">
            <p class="text-lg p-1 border border-1 bg-gray-200">
                What is Moview?
            </p>
            <p>
                Moview is your go-to platform for sharing and tracking the movies you’ve watched, whether they’re hits,
                misses, or hidden gems. Rate your favorites, share your thoughts, and let your voice be heard through
                engaging reviews. Join our community of movie lovers and discover what others think about the films
                that have made an impression!
            </p>
        </div>
        <div class="bg-white rounded-lg shadow-md mb-4 w-2/3">
            <p class="text-lg border border-1 bg-gray-200">
                When can I start creating movie reviews?
            </p>
            <p>
                To maintain a high-quality review environment, you will need to log in for five different days before
                being able to write a review. This helps us ensure that reviews come from engaged and committed users,
                leading to a more trustworthy and enjoyable community experience.
            </p>
        </div>
    </div>
@endsection
