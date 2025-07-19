@extends('layouts.app')

@section('content')
<div class="row justify-content-center mt-3">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <span>Author Information</span>
                <a href="{{ route('authors.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
            </div>
            <div class="card-body">

                <!-- Name -->
                <div class="row mb-2">
                    <label class="col-md-4 col-form-label text-md-end text-start"><strong>Name:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $author->name }}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection