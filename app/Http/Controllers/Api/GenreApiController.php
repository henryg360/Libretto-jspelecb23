<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class GenreApiController extends Controller
{
    /**
     * Display a listing of the genres.
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'genres' => Genre::latest()->paginate(4)
        ]);
    }

    /**
     * Store a newly created genre in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            // Add more validation rules as per your schema
        ]);

        $genre = Genre::create($validated);

        return response()->json([
            'message' => 'New genre is added successfully.',
            'genre' => $genre
        ], 201);
    }

    /**
     * Display the specified genre.
     */
    public function show(Genre $genre): JsonResponse
    {
        return response()->json($genre);
    }

    /**
     * Update the specified genre in storage.
     */
    public function update(Request $request, Genre $genre): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            // Add more rules as needed
        ]);

        $genre->update($validated);

        return response()->json([
            'message' => 'Genre is updated successfully.',
            'genre' => $genre
        ]);
    }

    /**
     * Remove the specified genre from storage.
     */
    public function destroy(Genre $genre): JsonResponse
    {
        $genre->delete();

        return response()->json([
            'message' => 'Genre is deleted successfully.'
        ]);
    }

    /**
     * Optional: endpoints for create/edit not used in APIs.
     */
    public function create(): JsonResponse
    {
        return response()->json(['message' => 'Form endpoint not available in API.']);
    }

    public function edit(Genre $genre): JsonResponse
    {
        return response()->json(['message' => 'Form endpoint not available in API.']);
    }
}
