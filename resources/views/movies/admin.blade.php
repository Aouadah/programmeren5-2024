@extends('layouts.app')

@section('content')
    <h1 class="ml-6 mb-4">Movies Overview</h1>

    <div>
        <table class="table-auto w-5/6 mx-auto mt-8">
            <tr class="bg-gray-100 border border-gray-300">
                <th class="py-2 px-4 border border-gray-300">#</th>
                <th class="py-2 px-4 border border-gray-300">Title</th>
                <th class="py-2 px-4 border border-gray-300">User</th>
                <th class="py-2 px-4 border border-gray-300">Category</th>
                <th class="py-2 px-4 border border-gray-300">Genre</th>
                <th class="py-2 px-4 border border-gray-300">Duration</th>
                <th class="py-2 px-4 border border-gray-300">Year of Release</th>
                <th class="py-2 px-4 border border-gray-300">Rating</th>
                <th class="py-2 px-4 border border-gray-300">Status</th>
            </tr>
            @foreach($movies as $movie)
                <tr class="border-b border-gray-300">
                    <td class="py-2 px-4 border border-gray-300">{{$movie->id}}</td>
                    <td class="py-2 px-4 border border-gray-300">{{$movie->title}}</td>
                    <td class="py-2 px-4 border border-gray-300">{{$movie->user->name}}</td>
                    <td class="py-2 px-4 border border-gray-300">{{$movie->category->name}}</td>
                    <td class="py-2 px-4 border border-gray-300">{{$movie->genre}}</td>
                    <td class="py-2 px-4 border border-gray-300">{{$movie->duration}}</td>
                    <td class="py-2 px-4 border border-gray-300">{{$movie->year_of_release}}</td>
                    <td class="py-2 px-4 border border-gray-300">{{$movie->rating}}</td>
                    <td class="py-2 px-4 border border-gray-300 text-center">
                        <form method="POST" action="/movies/{{ $movie->id }}" style="display:inline;">
                            @csrf
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">
                                {{ $movie->status === 'inactive' ? 'Inactive' : 'Active' }}
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
