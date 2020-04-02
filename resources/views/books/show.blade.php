@extends('layouts.base')

@section('content')
    <div class="container">
        @if ($book)
            <h1>{{ $book->name }}</h1>
            <small>By {{ $book->author }}</small>
            @if ($book->cover_image)
                <p>Image:<br><img src="/storage/cover_images/{{ $book->cover_image }}"></p>    
            @endif
            @php
                if (Auth::check()) {
                    $usertype = Auth::user()->type;
                }
                else {
                    $usertype = null;
                }
            @endphp
            @if ($usertype == "ADMIN")
                <a href="/books/{{ $book->id }}/edit" class="btn btn-primary">Edit</a>
                <br><br>
                {!!Form::open(['action' => ['BooksController@destroy', $book->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                    {{Form::hidden('_method', 'DELETE')}}
                    {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                {!!Form::close()!!}
                <br><br>
            @endif
            <p>{!! $book->description !!}</p>
            <iframe src="/storage/main_files/{{ $book->main_file }}" width="100%" height="700"></iframe>
            <br>
        @else
            <h3>Book not found</h3>
        @endif
    </div>
@endsection