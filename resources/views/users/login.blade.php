@extends('_layouts.default.app')
@section('content')

    <h1 class="page-title">Login</h1>

    {{ form()->create() }}
    {{ form()->control('email') }}
    {{ form()->control('password') }}
    {{ form()->submit('Login', ['class' => 'btn btn-primary']) }}
    {{ form()->end() }}

@endsection