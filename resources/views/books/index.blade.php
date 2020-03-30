@extends('layouts.base')

@section('content')
    <div class="container">
        <h1>Books</h1>
        @if (count($allBooks) > 1)
            @foreach ($allBooks as $book)
                <a href="books/{{ $book->id }}">
                <div class="card m-2 p-4">
                    <h3 class="card-title">{{ $book->name }}</h3>
                    <small>By {{ $book->author }}</small>
                    <p class="card-body">{!! $book->description !!}</p>
                </div>
                </a>
            @endforeach
        @else
            <h3>No Books found</h3>
        @endif
    </div>

@endsection