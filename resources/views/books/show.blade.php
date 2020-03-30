@extends('layouts.base')

@section('content')
    <div class="container">
        @if ($book)
            <h1>{{ $book->name }}</h1>
            <small>By {{ $book->author }}</small>
            <p>{!! $book->description !!}</p>
            <a href="/books/{{ $book->id }}/edit" class="btn btn-primary">Edit</a>
            <br><br>
            {!!Form::open(['action' => ['BooksController@destroy', $book->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
            {!!Form::close()!!}
        @else
            <h3>Book not found</h3>
        @endif
    </div>
@endsection