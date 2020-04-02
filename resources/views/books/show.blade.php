@extends('layouts.base')

@section('content')
    <div class="container">
        @if ($book)
            <h1>{{ $book->name }}</h1>
            <small>By {{ $book->author }}</small>
            @if ($book->cover_image)
                <br><img src="/storage/cover_images/{{ $book->cover_image }}"><br><br>    
            @endif
            @php
                if (Auth::check()) {
                    $usertype = Auth::user()->type;
                }
                else {
                    $usertype = null;
                }
            @endphp
            @if (isset(Auth::user()->collection) and Auth::user()->collection->books->contains($book)) 
                {!!Form::open(['action' => ['CollectionsController@remove', $book->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                    {{Form::hidden('_method', 'PUT')}}
                    {{Form::submit('Remove from Collection', ['class' => 'btn btn-danger'])}}
                {!!Form::close()!!}
            @else
                {!!Form::open(['action' => ['CollectionsController@add', $book->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                    {{Form::hidden('_method', 'PUT')}}
                    {{Form::submit('Add  to Collection', ['class' => 'btn btn-success'])}}
                {!!Form::close()!!}
            @endif
            <br>
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