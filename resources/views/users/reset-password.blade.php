@extends('_layouts.default.app')
@section('content')

    <h1 class="page-title">Neues Passwort erstellen</h1>

    {{ form()->create() }}
    {{ form()->control(\App\Models\User::ATTRIBUTE_EMAIL, ['required']) }}
    {{ form()->control(\App\Models\User::ATTRIBUTE_PASSWORD, ['type' => 'password', 'required']) }}
    {{ form()->control(\App\Models\User::ATTRIBUTE_PASSWORD . '_confirmation', ['type' => 'password', 'required']) }}
    {{ form()->submit('Speichern', ['class' => 'btn btn-primary']) }}
    {{ html()->link(route('home'), 'Abbrechen', ['class' => 'btn btn-light']) }}
    {{ form()->end() }}

@endsection