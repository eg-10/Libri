@extends('layouts.base')

@section('content')
    <header>
        @include('components.navbar')
    </header>
    <div class="container">
        {!! Form::open(['url' => 'foo/bar']) !!}
            
        {!! Form::close() !!}
    </div>

@endsection