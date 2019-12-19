@extends('_layouts.app')
@section('content')

    <div class="d-flex justify-content-center align-items-center full-height">
        <div>
            {{ form()->create() }}
            {{ form()->control('email', ['label' => false, 'placeholder' => 'E-Mail address']) }}
            {{ form()->control('password', ['label' => false, 'placeholder' => 'Password']) }}
            {{ form()->submit('Login', ['class' => 'btn btn-primary btn-block']) }}
            {{ form()->end() }}
        </div>
    </div>

@endsection