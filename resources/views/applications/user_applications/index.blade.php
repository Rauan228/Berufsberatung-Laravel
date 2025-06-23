@extends('app')

@section('content')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <div class="main-content">
        <h1>Заявки участников</h1>
        <form method="GET" action="{{ route('applications.user_applications.index') }}" class="filter-form">

            <label for="event_filter">Фильтр по событию:</label>
            <select name="event_id" id="event_filter" onchange="this.form.submit()">
                <option value="">Все события</option>
                @foreach($events as $event)
                    <option value="{{ $event->id }}" {{ request('event_id') == $event->id ? 'selected' : '' }}>
                        {{ $event->event_name }}
                    </option>
                @endforeach
            </select>
        
            <label for="status_filter">Фильтр по статусу:</label>
            <select name="status" id="status_filter" onchange="this.form.submit()">
                <option value="">Все статусы</option>
                <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>В ожидании</option>
                <option value="Accepted" {{ request('status') == 'Accepted' ? 'selected' : '' }}>Принято</option>
                <option value="Rejected" {{ request('status') == 'Rejected' ? 'selected' : '' }}>Отклонено</option>
            </select>
        </form>
        
        <div class="grid-container">
            @foreach($applications as $application)
                <div class="grid-item">
                    <strong style="font-size: 22px">{{ $application->user->username }}</strong>
                    <span style="font-size: 22px">- {{ $application->event->event_name }}</span><br>
                    Статус: {{ $application->status }}
                </div>
            @endforeach
        </div>
    
        <!-- Пагинация -->
        <div class="pagination-container">
            {{ $applications->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f6f9;
        }

        .main-content {
            flex-grow: 1;
            padding: 20px 40px;
            margin-left: 300px;
            width: calc(100% - 300px);
        }

        h1 {
            font-size: 2rem;
            margin-bottom: 20px;
            color: #333;
        }

        .filter-form {
            margin-bottom: 20px;
        }
        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
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
        .pagination-container nav {
    display: flex;
    justify-content: center;
}

.pagination {
    display: flex;
    list-style: none;
    padding: 0;
    gap: 8px;
}

.pagination li {
    display: inline;
}

.pagination li a,
.pagination li span {
    display: block;
    padding: 8px 12px;
    text-decoration: none;
    border: 1px solid #ddd;
    background-color: #fff;
    color: #333;
    border-radius: 5px;
    transition: all 0.3s ease;
}

.pagination li a:hover {
    background-color: #007bff;
    color: white;
}

.pagination .active span {
    background-color: #007bff;
    color: white;
    border-color: #007bff;
    font-weight: bold;
}      /* Общий стиль для кнопок */
      .btn {
            flex: 1;
            font-size: 0.75rem;
            padding: 8px 12px;
            font-weight: bold;
            border-radius: 8px;
            transition: all 0.3s ease-in-out;
            text-transform: uppercase;
        }

    </style>
@endsection
