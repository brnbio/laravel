@extends('_layouts.default.app')
@section('content')

    <h1 class="page-title">Profile</h1>

    <div class="row mb-5">
        <div class="col">
            <h3>Profile Information</h3>
            <p>Update your account's profile information and email address.</p>
        </div>
        <div class="col">
            {{ form()->create($user) }}
            {{ form()->control(\App\Models\User::ATTRIBUTE_NAME) }}
            {{ form()->control(\App\Models\User::ATTRIBUTE_EMAIL) }}
            {{ form()->submit(__('Save'), ['class' => 'btn btn-primary']) }}
            {{ form()->end() }}
        </div>
    </div>

    <div class="row">
        <div class="col">
            <h3>Update Password</h3>
            <p>Ensure your account is using a long, random password to stay secure.</p>
        </div>
        <div class="col">
            {{ form()->create($user, ['action' => route('profile.update-password')]) }}
            {{ form()->control(\App\Models\User::ATTRIBUTE_PASSWORD) }}
            {{ form()->control(\App\Models\User::ATTRIBUTE_NEW_PASSWORD, ['type' => 'password']) }}
            {{ form()->control(\App\Models\User::ATTRIBUTE_NEW_PASSWORD_CONFIRMATION, ['type' => 'password']) }}
            {{ form()->submit(__('Save'), ['class' => 'btn btn-primary']) }}
            {{ form()->end() }}
        </div>
    </div>

@endsection