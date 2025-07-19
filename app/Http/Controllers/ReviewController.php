<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('reviews.index', [
            'reviews' => Review::latest()->paginate(4)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
    $books = \App\Models\Book::all();
    return view('reviews.create', compact('books'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->all();
        Review::create($data);
        return redirect()->route('reviews.index')
            ->withSuccess('New review is added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review): View
    {
        return view('reviews.show', compact('review'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review): View
    {
    $books = \App\Models\Book::all();
    return view('reviews.edit', compact('review', 'books'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review): RedirectResponse
    {
        $data = $request->all();
        $review->update($data);
        return redirect()->back()->withSuccess('Review is updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review): RedirectResponse
    {
        $review->delete();
        return redirect()->route('reviews.index')
            ->withSuccess('Review is deleted successfully.');
    }
}