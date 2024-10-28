<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $movies = Movie::where('user_id', $user->id)->get();

        return view('profile.show', compact('user', 'movies'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $attributes = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed'
        ]);

        $user->update($attributes);
        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
}
