@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">


    <div class="main-content">
        <h1>Applications</h1>
        <ul>
            @foreach($applications as $application)
            <li>
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
                
            </li>
            @endforeach
        </ul>
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

        /* Стили для списка заявок */
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

        /* Стили для кнопок */
        li form button {
            margin-left: 10px;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
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


    </style>
@endsection
