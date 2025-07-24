<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AuthorApiController extends Controller
{
    /**
     * Display a listing of the authors.
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'authors' => Author::latest()->paginate(4)
        ]);
    }

    /**
     * Store a newly created author in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            // Add more validation rules as per your schema
        ]);

        $author = Author::create($validated);

        return response()->json([
            'message' => 'New author is added successfully.',
            'author' => $author
        ], 201);
    }

    /**
     * Display the specified author.
     */
    public function show(Author $author): JsonResponse
    {
        return response()->json($author);
    }

    /**
     * Update the specified author in storage.
     */
    public function update(Request $request, Author $author): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            // Add more rules as needed
        ]);

        $author->update($validated);

        return response()->json([
            'message' => 'Author is updated successfully.',
            'author' => $author
        ]);
    }

    /**
     * Remove the specified author from storage.
     */
    public function destroy(Author $author): JsonResponse
    {
        $author->delete();

        return response()->json([
            'message' => 'Author is deleted successfully.'
        ]);
    }

    /**
     * Optional: endpoints for create/edit not used in APIs.
     */
    public function create(): JsonResponse
    {
        return response()->json(['message' => 'Form endpoint not available in API.']);
    }

    public function edit(Author $author): JsonResponse
    {
        return response()->json(['message' => 'Form endpoint not available in API.']);
    }
}
