<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ReviewApiController extends Controller
{
    /**
     * Display a listing of the reviews.
     */
    public function index(): JsonResponse
    {
        $reviews = Review::with('book')->latest()->paginate(4);
        return response()->json(['reviews' => $reviews]);
    }

    /**
     * Store a newly created review in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'book_id' => 'required|exists:books,id',
            'rating' => 'required|numeric|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $review = Review::create($validated);

        return response()->json([
            'message' => 'New review is added successfully.',
            'review' => $review->load('book'),
        ], 201);
    }

    /**
     * Display the specified review.
     */
    public function show(Review $review): JsonResponse
    {
        return response()->json($review->load('book'));
    }

    /**
     * Update the specified review in storage.
     */
    public function update(Request $request, Review $review): JsonResponse
    {
        $validated = $request->validate([
            'book_id' => 'required|exists:books,id',
            'rating' => 'required|numeric|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $review->update($validated);

        return response()->json([
            'message' => 'Review is updated successfully.',
            'review' => $review->load('book'),
        ]);
    }

    /**
     * Remove the specified review from storage.
     */
    public function destroy(Review $review): JsonResponse
    {
        $review->delete();

        return response()->json([
            'message' => 'Review is deleted successfully.'
        ]);
    }

    /**
     * Optional: form endpoints not used in APIs.
     */
    public function create(): JsonResponse
    {
        return response()->json(['message' => 'Form endpoint not available in API.']);
    }

    public function edit(Review $review): JsonResponse
    {
        return response()->json(['message' => 'Form endpoint not available in API.']);
    }
}
