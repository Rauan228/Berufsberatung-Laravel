@extends('layouts.app')

@section('content')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <div class="main-content">
        <h1>Applications</h1>
        <form method="GET" action="{{ route('applications.index') }}" class="filter-form">
            <label for="event_filter">Filter by Event:</label>
            <select name="event_id" id="event_filter" onchange="this.form.submit()">
                <option value="">All Events</option>
                @foreach($events as $event)
                    <option value="{{ $event->id }}" {{ request('event_id') == $event->id ? 'selected' : '' }}>
                        {{ $event->event_name }}
                    </option>
                @endforeach
            </select>
        
            <label for="status_filter">Filter by Status:</label>
            <select name="status" id="status_filter" onchange="this.form.submit()">
                <option value="">All Statuses</option>
                <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Accepted" {{ request('status') == 'Accepted' ? 'selected' : '' }}>Accepted</option>
                <option value="Rejected" {{ request('status') == 'Rejected' ? 'selected' : '' }}>Rejected</option>
            </select>
        </form>
        
    
        <div class="grid-container">

            
            @foreach($applications as $application)
                <div class="grid-item">
                    <strong style="font-size: 22px">{{ $application->user->username }}</strong>
                    <span style="font-size: 22px">- {{ $application->event->event_name }}</span><br>
                    Status: {{ $application->status }}
                    <form action="{{ route('applications.updateStatus', $application) }}" method="POST" class="button-group">
                        @csrf
                        @method('PUT')
    
                        @if($application->status == 'Pending')
                            <button type="submit" name="status" value="Accepted" class="btn btn-sm btn-success">
                                <i class="fas fa-check"></i> Accept
                            </button>
                            <button type="submit" name="status" value="Rejected" class="btn btn-sm btn-danger">
                                <i class="fas fa-times"></i> Reject
                            </button>
                        @else
                            <button type="submit" name="status" value="Pending" class="btn btn-sm btn-warning">
                                <i class="fas fa-undo"></i> Cancel
                            </button>
                        @endif
                    </form>
                </div>
            @endforeach
        </div>
    
        <!-- Пагинация -->
        <div class="pagination-container">
            {{ $applications->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
        </div>
        
    </div>
    

    <style>
        /* Общие стили */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f6f9;
        }

        .main-content {
            flex-grow: 1;
            padding: 20px;
            margin: 0 0 0 300px;
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

        .filter-form {
        margin-bottom: 20px;
    }
    .grid-container {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        padding: 20px;
    }
    .grid-item {
        background-color: #fff;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

        .pagination-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        /* Контейнер для кнопок */
        .button-group {
            display: flex;
            gap: 5px;

            width: 30%;
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

        /* Стили для кнопки "Принять" */
        .btn-success {
            background-color: #28a745;
            color: white;
            border: none;
        }

        .btn-success:hover {
            background: linear-gradient(135deg, #218838, #1e7e34);
            box-shadow: 0 5px 10px rgba(40, 167, 69, 0.5);
            transform: scale(1.07);
        }

        /* Стили для кнопки "Отклонить" */
        .btn-danger {
            background-color: #dc3545;
            color: white;
            border: none;
        }

        .btn-danger:hover {
            background: linear-gradient(135deg, #c82333, #a71d2a);
            box-shadow: 0 5px 10px rgba(220, 53, 69, 0.5);
            transform: scale(1.07);
        }

        /* Стили для кнопки "Отменить" */
        .btn-warning {
            background-color: #ffc107;
            color: black;
            border: none;
        }

        .btn-warning:hover {
            background: linear-gradient(135deg, #d39e00, #c69500);
            box-shadow: 0 5px 10px rgba(255, 193, 7, 0.5);
            transform: scale(1.07);
        }

        /* Анимация нажатия */
        .btn:active {
            transform: scale(0.95);
        }

        .pagination-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination {
            display: flex;
            list-style: none;
            padding: 0;
        }

        .pagination li {
            margin: 0 5px;
        }

        .pagination a,
        .pagination span {
            display: block;
            padding: 8px 12px;
            background: #3498db;
            color: #fff;
            border-radius: 5px;
            text-decoration: none;
        }

        .pagination a:hover {
            background: #2980b9;
        }

        .pagination .active span {
            background: #2c3e50;
        }
    </style>
@endsection