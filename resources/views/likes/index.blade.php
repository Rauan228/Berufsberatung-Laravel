@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Лайки</title>
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
        }

        h1 {
            font-size: 2rem;
            margin-bottom: 20px;
            color: #333;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }
  /* Общий стиль для кнопок */
  .btn {
            flex: 1;
            font-size: 0.75rem;
            padding: 8px 12px;
            font-weight: bold;
            border-radius: 8px;
            transition: all 0.3s ease-in-out;
            text-transform: uppercase;
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

        .event-card .button-group {
            gap: 5px;
        }

        .event-card .btn {
            flex: 1;
            font-size: 0.8rem;
            padding: 8px 12px;
            font-weight: bold;
            border-radius: 8px;
            transition: all 0.3s ease-in-out;
            text-transform: uppercase;
        }

        .event-card .btn-danger:hover {
            background: linear-gradient(135deg, #c82333, #a71d2a);
            box-shadow: 0 5px 10px rgba(220, 53, 69, 0.5);
            transform: scale(1.07);
        }

        .event-card .btn:active {
            transform: scale(0.95);
        }

        .event-card .btn:hover {
            transform: scale(1.05);
        }

        form {
            display: inline;
        }

        .main-content {
            padding: 20px;
            margin: 0 0 0 300px;
        }
    </style>
</head>

<body>

    <div class="main-content">
        <h1>Лайки</h1>
        <ul>
            @foreach($likes as $like)
                <li class="event-card">
                    <strong style="font-size: 20px">{{ $like->user->username }}</strong>
                    <span style="font-size: 18px">добавил <b>{{ $like->institution->name }} </b>в избранное</span>
                </li>
            @endforeach
        </ul>
    </div>

</body>

</html>
@endsection
