@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f6f9;
        }

        h1 {
            font-size: 2rem;
            margin-bottom: 20px;
            color: #333;
        }

        a {
            color: #3498db;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        /* Стили для списка уведомлений */
        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            background-color: #fff;
            margin: 10px 0;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        li a {
            color: #e67e22;
            margin-left: 10px;
            text-decoration: none;
        }

        li a:hover {
            text-decoration: underline;
        }

        /* Контейнер для кнопок */
        .event-card .button-group {
            gap: 5px;
        }

        /* Общий стиль для кнопок */
        .event-card .btn {
            flex: 1;
            font-size: 0.6rem;
            padding: 8px 12px;
            font-weight: bold;
            border-radius: 8px;
            transition: all 0.3s ease-in-out;
            text-transform: uppercase;
        }

        .event-card .btn-warning:hover {
            background: linear-gradient(135deg, #d39e00, #c69500);
            box-shadow: 0 5px 10px rgba(255, 193, 7, 0.5);
            transform: scale(1.07);
        }

        .event-card .btn-danger:hover {
            background: linear-gradient(135deg, #c82333, #a71d2a);
            box-shadow: 0 5px 10px rgba(220, 53, 69, 0.5);
            transform: scale(1.07);
        }

        /* Анимация нажатия */
        .event-card .btn:active {
            transform: scale(0.95);
        }

        .event-card .btn:hover {
            transform: scale(1.05);
        }

        /* Стили для формы удаления */
        form {
            display: inline;
        }

        /* Главный контент */
        .main-content {
            margin-left: 300px;
            padding: 20px;
            flex-grow: 1;
        }

        .delete {
            background-color: red;
        }

        .delete:hover {
            background-color: rgb(153, 12, 12);
            transition: 0.2s;
        }
    </style>
</head>

<body>


    <div class="main-content">
        <h1>Notifications</h1>
        <a href="{{ route('notifications.create') }}" class="btn btn-primary">Add new notification</a>
        <ul>
            @foreach($notifications as $notification)
                <li class="event-card">
                    <strong style="font-size: 22px">{{ $notification->user->username }}</strong>
                    <span style="font-size: 22px">- {{ $notification->event->event_name }}</span><br>
                    {{ $notification->message }}

                    <div class="button-group">
                        <!-- Кнопка "Редактировать" -->
                        <a href="{{ route('notifications.edit', $notification->id) }}">
                            <button class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i> Редактировать
                            </button>
                        </a>

                        <!-- Кнопка "Удалить" -->
                        <form action="{{ route('notifications.destroy', $notification->id) }}" method="POST"
                            class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i> Удалить
                            </button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>


</body>

</html>

@endsection