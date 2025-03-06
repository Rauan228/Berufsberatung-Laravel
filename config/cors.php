<?php

return [
    'paths' => ['api/*', 'sanctum/csrf-cookie'], // Пути, к которым применяется CORS
    'allowed_methods' => ['*'], // Разрешенные HTTP-методы (GET, POST, PUT, DELETE и т.д.)
    'allowed_origins' => ['*'], // Разрешенные домены (можно указать конкретные, например, ['http://frontend.com'])
    'allowed_origins_patterns' => [], // Регулярные выражения для разрешенных доменов
    'allowed_headers' => ['Authorization', 'Content-Type'], // Разрешенные заголовки
    'exposed_headers' => [], // Заголовки, которые будут доступны клиенту
    'max_age' => 0, // Время кэширования CORS-запросов (в секундах)
    'supports_credentials' => false, // Разрешить передачу учетных данных (например, cookies)
];