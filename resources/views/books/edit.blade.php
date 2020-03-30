@extends('layouts.base')

@section('content')
    <div class="container">
        <h1>Edit Book</h1>
        {!! Form::open(['action' => ['BooksController@update', $book->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
            <div class="form-group">
                {{Form::label('name', 'Name')}}
                {{Form::text('name', $book->name, ['class' => 'form-control', 'placeholder' => 'Name'])}}
            </div>
            <div class="form-group">
                {{Form::label('author', 'Author')}}
                {{Form::text('author', $book->author, ['class' => 'form-control', 'placeholder' => 'Author'])}}
            </div>
            <div class="form-group">
                {{Form::label('description', 'Description')}}
                {{Form::textarea('description', $book->description, ['class' => 'form-control', 'placeholder' => 'Describe the book'])}}
                {{-- {{Form::textarea('description', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Describe the book'])}} --}}
            </div>
            {{-- <div class="form-group">
                {{Form::file('cover_image')}}
            </div> --}}
            {{Form::hidden('_method','PUT')}}
            {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
        {!! Form::close() !!}
    </div>
@endsection