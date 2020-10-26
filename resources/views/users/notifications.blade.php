@extends('_layouts.default.app')
@section('content')

    <h1 class="page-title">{{ __('Notifications') }}</h1>

    <p class="text-right">
        {{ html()->postlink(route('profile.notifications.mark-all-read'), __('Mark all as read'), ['class' => 'btn btn-light']) }}
    </p>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>{{ __('Description') }}</th>
                    <th>{{ __('Date') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($notifications as $notification)
                    <tr class="{{ !$notification->read() ? 'text-warning' : '' }}">
                        <td>{{ $notification->data['message'] }}</td>
                        <td>{{ $notification->created_at->format(config('i18n.datetime_format')) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $notifications->links() }}

@endsection