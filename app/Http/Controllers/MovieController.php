<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie; // Import the Movie model

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::all(); // Get all movies from the database

        return response()->json([
            "message" => "Movies retrieved successfully",
            "movies" => $movies,
        ]);
    }

    public function store(Request $request)
{
    $validator = $request->validate([
        'title' => 'required|string',
        'description' => 'nullable|string',
        'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Added validation for poster
    ]);

    // die($validator);

    // if ($validator->fails()) {
    //     return response()->json([
    //         "message" => "Validation failed",
    //         "errors" => $validator->errors()
    //     ], 422);
    // }

    // Handle poster upload (same logic from previous version)
    // if ($request->hasFile('poster')) {
    //     // ... (poster upload logic)
    // } else {
    //     $movieData = $request->all();
    // }

    $movie = Movie::create($movieData);

    return response()->json([
        "message" => "Movie created successfully",
        "movie" => $movie,
    ]);
}


}
