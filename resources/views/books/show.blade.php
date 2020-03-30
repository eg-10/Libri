@extends('layouts.base')

@section('content')
    <header>
        @include('components.navbar')
    </header>
    <div class="container">
        @if ($book)
            <h1>{{ $book->name }}</h1>
            <small>By {{ $book->author }}</small>
            <p>{{ $book->description }}</p>
        @else
            <h3>Book not found</h3>
        @endif
    </div>
@endsection