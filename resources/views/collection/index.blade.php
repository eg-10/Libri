@extends('layouts.base')

@section('content')
    <div class="container">
        <h1>Your Collection</h1>
        @if (isset($books) and count($books) > 0)
            @foreach ($books as $book)
                <a href="books/{{ $book->id }}">
                <div class="card m-2 p-4">
                    <h3 class="card-title">{{ $book->name }}</h3>
                    <small>By {{ $book->author }}</small>
                    <p class="card-body">{!! $book->description !!}</p>
                </div>
                </a>
            @endforeach
        @else
            <h3>Your collection is empty!</h3>
        @endif
    </div>
@endsection