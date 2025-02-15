<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Подробнее об институте</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #111;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f8f9fa;
            height: 100vh;
            margin: 0;
        }

        .container {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            padding: 20px;
            border-radius: 10px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            animation: fadeIn 0.5s ease-in-out;
            text-align: center;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        h2 {
            margin-bottom: 15px;
        }

        p {
            font-size: 16px;
            margin-bottom: 10px;
        }

        a {
            display: inline-block;
            padding: 10px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            transition: 0.3s;
        }

        .btn-primary {
            background: #007bff;
            color: white;
        }

        .btn-primary:hover {
            background: #0056b3;
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
            margin-top: 10px;
        }

        .btn-secondary:hover {
            background: #5a6268;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>{{ $institution->name }}</h2>
        <p><strong>Описание:</strong> {{ $institution->description }}</p>
        <p><strong>Локация:</strong> {{ $institution->location }}</p>
        <p><strong>Сайт:</strong>
            @if($institution->website)
                <a href="{{ $institution->website }}" class="btn-primary" target="_blank">Перейти на сайт</a>
            @endif
        </p>
        <a href="{{ route('institutions.index') }}" class="btn-secondary">Вернуться к списку</a>
    </div>
</body>
</html>