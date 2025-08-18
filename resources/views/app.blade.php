<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
    <link name="theme-color" content="#ffffff">
    <title>{{ config('app.name') }}</title>
    @viteReactRefresh
    @inertiaHead
    @vite(['resources/js/app.jsx'])
</head>
<body class="overflow-x-hidden">
    @routes
    @inertia
</body>
</html>
