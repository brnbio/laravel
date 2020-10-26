@extends('_layouts.default.app')
@section('content')

    <h1 class="page-title">Login</h1>

    {{ form()->create() }}
    {{ form()->control('email', ['required']) }}
    {{ form()->control('password', ['required']) }}
    {{ form()->control('remember', ['type' => 'checkbox', 'label' => __('Remember me')]) }}
    {{ form()->submit('Login', ['class' => 'btn btn-primary']) }}
    {{ html()->link(route('forgot-password'), 'Passwort vergessen', ['class' => 'btn btn-light']) }}
    {{ form()->end() }}

@endsection