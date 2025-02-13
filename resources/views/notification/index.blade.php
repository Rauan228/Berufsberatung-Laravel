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
            height: 300px;
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

        .notifications-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .notification-item {
            background-color: #fff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .button-group {
            gap: 5px;
        }

        .btn {
            flex: 1;
            font-size: 0.6rem;
            padding: 8px 12px;
            font-weight: bold;
            border-radius: 8px;
            transition: all 0.3s ease-in-out;
            text-transform: uppercase;
        }

        .btn-warning:hover {
            background: linear-gradient(135deg, #d39e00, #c69500);
            box-shadow: 0 5px 10px rgba(255, 193, 7, 0.5);
            transform: scale(1.07);
        }

        .btn-danger:hover {
            background: linear-gradient(135deg, #c82333, #a71d2a);
            box-shadow: 0 5px 10px rgba(220, 53, 69, 0.5);
            transform: scale(1.07);
        }

        .btn:active {
            transform: scale(0.95);
        }

        .btn:hover {
            transform: scale(1.05);
        }

        form {
            display: inline;
        }

        .main-content {
            margin-left: 300px;
            padding: 20px;
            flex-grow: 1;
            height: 200px;
        }

        .delete {
            background-color: red;
        }

        .delete:hover {
            background-color: rgb(153, 12, 12);
            transition: 0.2s;
        }

        .pagination {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
        }

        .pagination .page-item {
            margin: 0 5px;
        }

        .pagination .page-link {
            padding: 8px 12px;
            border-radius: 5px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            transition: 0.3s;
        }

        .pagination .page-link:hover {
            background-color: #2980b9;
        }

        .pagination-info {
        font-size: 14px;
        color: #333;
        margin-bottom: 5px;
    }

    .pagination-buttons {
        display: flex;
        justify-content: center;
        gap: 10px;
    }

    .page-btn {
        display: inline-block;
        padding: 8px 12px;
        border-radius: 5px;
        background-color: #3498db;
        color: white;
        text-decoration: none;
        transition: 0.3s;
    }

    .pagination-container {
        text-align: center;
        margin-top: 20px;
    }

    .page-btn:hover {
        background-color: #2980b9;
    }

    .page-btn.disabled {
        background-color: #ccc;
        pointer-events: none;
    }
    </style>
</head>

<body>
    <div class="main-content">
        <h1>Notifications</h1>
        <a href="{{ route('notifications.create') }}"  class="btn btn-primary">Add new notification</a>
        
        <div class="notifications-grid" style="margin-top: 30px">
            @foreach($notifications as $notification)
                <div class="notification-item">
                    <strong style="font-size: 22px">{{ $notification->user->username }}</strong>
                    <span style="font-size: 22px">- {{ $notification->event->event_name }}</span><br>
                    {{ $notification->message }}

                    <div class="button-group">
                        <!-- Кнопка "Редактировать" -->
                        <a href="{{ route('notifications.edit', $notification->id) }}">
                            <button class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                        </a>

                        <!-- Кнопка "Удалить" -->
                        <form action="{{ route('notifications.destroy', $notification->id) }}" method="POST" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="pagination d-flex align-items-center justify-content-center mt-4">
            @if ($notifications->total() > 0)
            <p class="pagination-info">
                Showing {{ $notifications->firstItem() }} to {{ $notifications->lastItem() }} of {{ $notifications->total() }} results
            </p>
            @endif
            
            <div class="pagination-buttons">
            @if ($notifications->onFirstPage())
                <span class="page-btn disabled">←</span>
            @else
                <a href="{{ $notifications->previousPageUrl() }}" class="page-btn">←</a>
            @endif
    
            @if ($notifications->hasMorePages())
                <a href="{{ $notifications->nextPageUrl() }}" class="page-btn">→</a>
            @else
                <span class="page-btn disabled">→</span>
            @endif
        </div>
        </div>
    </div>
</body>

</html>
@endsection