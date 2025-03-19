<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="container">
        @include('layouts.sidebar') <!-- Подключаем сайдбар -->
        <div class="content" style="height: 80%">
            @yield('content') <!-- Здесь будет отображаться контент страницы -->
        </div>
    </div>
</body>
</html>
