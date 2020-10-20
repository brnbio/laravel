<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('_layouts.default._partials.head')
</head>
<body id="app">

    @include('_layouts.default._partials.header')

    <div class="content">
        <div class="container-fluid">
            @include('flash::message')
            @yield('content')
        </div>
    </div>

    @include('_layouts.default._partials.footer')
    @include('_layouts.default._partials.scripts')

</body>
</html>
