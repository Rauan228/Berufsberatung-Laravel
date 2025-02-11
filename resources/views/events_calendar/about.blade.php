<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>More about the event</title>
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
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            padding: 20px;
            border-radius: 10px;
            width: 100%;
            max-width: 500px;
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

        h1 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        p {
            font-size: 16px;
            margin: 5px 0;
        }

        h3 {
            margin-top: 20px;
        }

        .list-group {
            list-style: none;
            padding: 0;
        }

        .list-group-item {
            background: rgba(255, 255, 255, 0.5);
            padding: 10px;
            border-radius: 5px;
            margin: 5px 0;
            font-size: 16px;
            font-weight: bold;
            transition: 0.3s;
        }

        .list-group-item:hover {
            background: rgba(255, 255, 255, 0.8);
            transform: scale(1.02);
        }

        .btn {
            display: inline-block;
            width: 100%;
            padding: 10px;
            margin-top: 15px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
            background: #007bff;
            color: white;
            text-decoration: none;
        }

        .btn:hover {
            background: #0056b3;
            transform: scale(1.05);
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>{{ $event->event_name }}</h1>
        <p><strong>Date:</strong> {{ $event->event_date }}</p>
        <p><strong>Description:</strong> {{ $event->description }}</p>
        <p><strong>Institution:</strong> {{ $event->institution->name ?? 'Не указан' }}</p>

        <h3>Applications for participation ({{ $applications->count() }})</h3>

        @if($applications->count() > 0)
            <ul class="list-group">
                @foreach($applications as $application)
                    <li class="list-group-item">
                        {{ $application->user->username ?? 'Unknown user' }} - 
                        <span style="color: {{ $application->status == 'Accepted' ? 'green' : 'red' }}">
                            {{ $application->status }}
                        </span>
                    </li>
                @endforeach
            </ul>
        @else
            <p>Заявок пока нет.</p>
        @endif

        <a href="{{ route('events.index') }}" class="btn">Назад</a>
    </div>
</body>

</html>
