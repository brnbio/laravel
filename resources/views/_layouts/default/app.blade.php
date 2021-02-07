<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('_layouts.default._partials.head')
</head>
<body class="with-custom-webkit-scrollbars with-custom-css-scrollbars"
      data-dm-shortcut-enabled="true"
      data-sidebar-shortcut-enabled="true"
      data-set-preferred-mode-onload="true">

    <div class="page-wrapper with-navbar with-sidebar"
         data-sidebar-type="full-height overlayed-sm-and-down">

        @include('_layouts.default._partials.flash')
        @include('_layouts.default._partials.navbar')
        @include('_layouts.default._partials.sidebar')

        <div class="content-wrapper">
            @yield('content')
        </div>

    </div>

    @include('_layouts.default._partials.footer')
    @include('_layouts.default._partials.scripts')

</body>
</html>
