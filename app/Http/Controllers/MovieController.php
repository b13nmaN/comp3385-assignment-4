<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie; 

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::all(); // Get all movies from the database
        // dd($movies);

        return response()->json([
            "message" => "Movies retrieved successfully",
            "movies" => $movies,
        ]);
    }

    public function store(Request $request)
    {
        // Validate incoming request
        $validatedData = $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Added validation for poster
        ]);

        // Retrieve validated data
        $title = $validatedData['title'];
        $description = $validatedData['description'];
        $poster = $request->file('poster');

        // If poster is uploaded, generate filename and store it
        if ($poster) {
            $posterFileName = $title . "_" . time() . '.' . $poster->getClientOriginalExtension();
            $poster->storeAs('posters', $posterFileName, 'public'); 
        } else {
            $posterFileName = null;
        }

        // Create a new Movie instance and assign properties
        $movie = new Movie();
        $movie->title = $title;
        $movie->description = $description;
        $movie->poster = $posterFileName;

        // Save the Movie instance to the database
        $movie->save();

        return response()->json([
            "message" => "Movie created successfully",
            "movie" => $movie,
        ]);
    }


    // delete a movie
    public function destroy($id)
    {
        $movie = Movie::find($id);
        $movie->delete();
        return response()->json([
            "message" => "Movie deleted successfully",
        ]);
    }



}
