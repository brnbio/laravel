@push('scripts')
    <script>
        @foreach (session('flash_notification', collect())->toArray() as $message)

            @php
                if ($message['level'] === 'success') {
                    $message['message'] = '<strong>Erfolgreich!</strong><br>' . $message['message'];
                }
                if ($message['level'] === 'danger') {
                    $message['message'] = '<strong>Fehler!</strong><br>' . $message['message'];
                }
            @endphp

            halfmoon.initStickyAlert({
                content: '{!! $message['message'] !!}',
                alertType: 'alert-{{ $message['level'] }}',
                timeShown: 3000
            });

        @endforeach
    </script>
@endpush

@php
    session()->forget('flash_notification');
@endphp