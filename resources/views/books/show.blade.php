@extends('layouts.app')

@section('content')
<div class="row justify-content-center mt-3">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <span>Book Information</span>
                <a href="{{ route('books.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
            </div>
            <div class="card-body">

                <!-- Title -->
                <div class="row mb-2">
                    <label class="col-md-4 col-form-label text-md-end text-start"><strong>Title:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $book->title }}
                    </div>
                </div>
                <!-- Author -->
                <div class="row mb-2">
                    <label class="col-md-4 col-form-label text-md-end text-start"><strong>Author:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $book->author->name ?? '-' }}
                    </div>
                </div>
                <!-- Genres -->
                <div class="row mb-2">
                    <label class="col-md-4 col-form-label text-md-end text-start"><strong>Genres:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        @if($book->genres && $book->genres->count())
                            {{ $book->genres->pluck('name')->join(', ') }}
                        @else
                            -
                        @endif
                    </div>
                </div>

                <!-- Reviews -->
                <div class="row mb-2">
                    <label class="col-md-4 col-form-label text-md-end text-start"><strong>Reviews:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        @if($book->reviews && $book->reviews->count())
                            <ul class="list-group">
                                @foreach($book->reviews as $review)
                                    <li class="list-group-item mb-2">
                                        <strong>Rating:</strong> {{ $review->rating }}<br>
                                        <strong>Content:</strong> {{ $review->content }}
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <span>-</span>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection