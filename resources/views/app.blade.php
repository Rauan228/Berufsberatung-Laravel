<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
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
