<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <title inertia>{{ config('app.name', 'Laravel') }}</title>
    @routes
    @vite(['resources/css/app.scss', 'resources/js/app.ts', "resources/js/views/{$page['component']}.vue"])
    @inertiaHead
</head>
<body>
@inertia
</body>
</html>
