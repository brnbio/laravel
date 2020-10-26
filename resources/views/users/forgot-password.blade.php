@extends('_layouts.default.app')
@section('content')

    <h1 class="page-title">Passwort vergessen</h1>

    {{ form()->create() }}
    {{ form()->control('email', ['required']) }}
    {{ form()->submit('Senden', ['class' => 'btn btn-primary']) }}
    {{ html()->link(route('home'), 'Abbrechen', ['class' => 'btn btn-light']) }}
    {{ form()->end() }}

@endsection