<!DOCTYPE html> 
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> 
<head> 
 <meta charset="UTF-8"> 
 <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <title>Libretto_jspelecb23</title>
 <link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.
min.css">
 <link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrapicons@1.11.1/font/bootstrap-icons.css">
</head>
<body> 
 <div class="container">
    <h3 class="mt-3">Libretto_jspelecb23</h3>
    <div class="mb-3">
        <a href="{{ route('books.index') }}" class="btn btn-outline-primary btn-sm me-2">Books</a>
        <a href="{{ route('authors.index') }}" class="btn btn-outline-primary btn-sm me-2">Authors</a>
        <a href="{{ route('genres.index') }}" class="btn btn-outline-primary btn-sm me-2">Genres</a>
        <a href="{{ route('reviews.index') }}" class="btn btn-outline-primary btn-sm">Reviews</a>
    </div>
    <div class="d-flex justify-content-end mb-3">
        @auth
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm">Logout</button>
            </form>
        @endauth
    </div>
    @yield('content')
    <div class="row justify-content-center text-center mt-3">
        <div class="col-md-12">
            <p>
                Return to Website: <a href="https://www.usjr.edu.ph/"><strong>University of San Jose - Recoletos</strong></a>
            </p>
        </div>
    </div>
 </div>
<script 
src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bu
ndle.min.js"></script> 
</body> 
</html>