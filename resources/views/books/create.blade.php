@extends('layouts.base')

@section('content')
    <div class="container">
        <h1>Add a Book</h1>
        {!! Form::open(['action' => 'BooksController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
            <div class="form-group">
                {{Form::label('name', 'Name')}}
                {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Name'])}}
            </div>
            <div class="form-group">
                {{Form::label('author', 'Author')}}
                {{Form::text('author', '', ['class' => 'form-control', 'placeholder' => 'Author'])}}
            </div>
            <div class="form-group">
                {{Form::label('description', 'Description')}}
                {{Form::textarea('description', '', ['class' => 'form-control', 'placeholder' => 'Describe the book'])}}
                {{-- {{Form::textarea('description', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Describe the book'])}} --}}
            </div>
            <div class="form-group">
                {{Form::label('cover_image', 'Cover Image')}}
                {{Form::file('cover_image')}}
            </div>
            <div class="form-group">
                {{Form::label('main_file', 'Book File')}}
                {{Form::file('main_file')}}
            </div>
            {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
        {!! Form::close() !!}
    </div>
@endsection