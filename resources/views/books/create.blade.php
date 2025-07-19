@extends('layouts.app')

@section('content')
<div class="row justify-content-center mt-3">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Add New Book</span>
                <a href="{{ route('books.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
            </div>
            <div class="card-body">
                <form action="{{ route('books.store') }}" method="POST">
                    @csrf

                    <div class="mb-3 row">
                        <label for="title" class="col-md-4 col-form-label text-md-end text-start">Title</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}">
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="author_id" class="col-md-4 col-form-label text-md-end text-start">Author</label>
                        <div class="col-md-6">
                            <select class="form-control @error('author_id') is-invalid @enderror" id="author_id" name="author_id">
    <option value="">Select Author</option>
    @foreach($authors as $author)
        <option value="{{ $author->id }}" {{ old('author_id', $book->author_id ?? '') == $author->id ? 'selected' : '' }}>
            {{ $author->name }}
        </option>
    @endforeach
</select>
                            @error('author_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="genres" class="col-md-4 col-form-label text-md-end text-start">Genres</label>
                        <div class="col-md-6">
                            <select multiple class="form-control @error('genres') is-invalid @enderror" id="genres" name="genres[]">
    @foreach($genres as $genre)
        <option value="{{ $genre->id }}"
            @if(isset($book) && $book->genres->contains($genre->id)) selected @endif
            @if(is_array(old('genres')) && in_array($genre->id, old('genres', []))) selected @endif
        >{{ $genre->name }}</option>
    @endforeach
</select>
                            @error('genres')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-md-6 offset-md-4">
                            <input type="submit" class="btn btn-primary" value="Add Book">
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div> 
</div>
@endsection