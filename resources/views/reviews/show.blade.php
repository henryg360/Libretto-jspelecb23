@extends('layouts.app')

@section('content')
<div class="row justify-content-center mt-3">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <span>Review Information</span>
                <a href="{{ route('reviews.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
            </div>
            <div class="card-body">

                <!-- Book -->
                <div class="row mb-2">
                    <label class="col-md-4 col-form-label text-md-end text-start"><strong>Book:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $review->book->title ?? '-' }}
                    </div>
                </div>
                <!-- Content -->
                <div class="row mb-2">
                    <label class="col-md-4 col-form-label text-md-end text-start"><strong>Content:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $review->content }}
                    </div>
                </div>
                <!-- Rating -->
                <div class="row mb-2">
                    <label class="col-md-4 col-form-label text-md-end text-start"><strong>Rating:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $review->rating }}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>