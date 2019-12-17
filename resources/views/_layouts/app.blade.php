<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body>

    <div id="app">

        @include('_layouts._partials.header')

        <div class="content">

            @breadcrumb('Home', '/')
            @breadcrumbs()

            @yield('content')
        </div>

        @include('_layouts._partials.footer')

    </div>

    <script src="{{ mix('js/app.js') }}"></script>

</body>
</html>
