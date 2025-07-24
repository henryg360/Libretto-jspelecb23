<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class BookApiController extends Controller
{
    /**
     * Display a listing of the books.
     */
    public function index(): JsonResponse
    {
        $books = Book::with(['author', 'genres', 'reviews'])->latest()->paginate(4);
        return response()->json(['books' => $books]);
    }

    /**
     * Store a newly created book in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'genres' => 'required|array',
            'genres.*' => 'exists:genres,id',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['imageurl'] = $request->file('image')->store('images', 'public');
        }

        $book = Book::create([
            'title' => $data['title'],
            'author_id' => $data['author_id'],
            'imageurl' => $data['imageurl'] ?? null,
        ]);

        $book->genres()->attach($data['genres']);

        return response()->json([
            'message' => 'New book is added successfully.',
            'book' => $book->load(['author', 'genres', 'reviews']),
        ], 201);
    }

    /**
     * Display the specified book.
     */
    public function show(Book $book): JsonResponse
    {
        return response()->json($book->load(['author', 'genres', 'reviews']));
    }

    /**
     * Update the specified book in storage.
     */
    public function update(Request $request, Book $book): JsonResponse
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'genres' => 'required|array',
            'genres.*' => 'exists:genres,id',
        ]);

        if ($request->hasFile('image')) {
            $data['imageurl'] = $request->file('image')->store('images', 'public');
        }

        $book->update([
            'title' => $data['title'],
            'author_id' => $data['author_id'],
            'imageurl' => $data['imageurl'] ?? $book->imageurl,
        ]);

        $book->genres()->sync($data['genres']);

        return response()->json([
            'message' => 'Book is updated successfully.',
            'book' => $book->load(['author', 'genres', 'reviews']),
        ]);
    }

    /**
     * Remove the specified book from storage.
     */
    public function destroy(Book $book): JsonResponse
    {
        $book->delete();

        return response()->json([
            'message' => 'Book is deleted successfully.'
        ]);
    }

    /**
     * Return only the reviews of a specific book.
     */
    public function reviews(Book $book): JsonResponse
    {
        return response()->json([
            'book_id' => $book->id,
            'reviews' => $book->reviews()->latest()->get(),
        ]);
    }

    /**
     * Return only the genres of a specific book.
     */
    public function genres(Book $book): JsonResponse
    {
        return response()->json([
            'book_id' => $book->id,
            'genres' => $book->genres()->get(),
        ]);
    }
}
