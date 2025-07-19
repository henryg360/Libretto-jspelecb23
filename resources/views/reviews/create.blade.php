@extends('layouts.app')

@section('content')
<div class="row justify-content-center mt-3">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Add New Review</span>
                <a href="{{ route('reviews.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
            </div>
            <div class="card-body">
                <form action="{{ route('reviews.store') }}" method="POST">
                    @csrf

                    <div class="mb-3 row">
                        <label for="book_id" class="col-md-4 col-form-label text-md-end text-start">Book</label>
                        <div class="col-md-6">
                            <select class="form-control @error('book_id') is-invalid @enderror" id="book_id" name="book_id">
    <option value="">Select Book</option>
    @foreach($books as $book)
        <option value="{{ $book->id }}" {{ old('book_id', $review->book_id ?? '') == $book->id ? 'selected' : '' }}>
            {{ $book->title }}
        </option>
    @endforeach
</select>
                            @error('book_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="content" class="col-md-4 col-form-label text-md-end text-start">Review Content</label>
                        <div class="col-md-6">
                            <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content">{{ old('content') }}</textarea>
                            @error('content')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="rating" class="col-md-4 col-form-label text-md-end text-start">Rating</label>
                        <div class="col-md-6">
                            <input type="number" min="1" max="5" class="form-control @error('rating') is-invalid @enderror" id="rating" name="rating" value="{{ old('rating') }}">
                            @error('rating')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-md-6 offset-md-4">
                            <input type="submit" class="btn btn-primary" value="Add Review">
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div> 
</div>
@endsection