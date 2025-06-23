@extends('app')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<div class="container" style="margin:50px 0 0 50px">

    <div class="main-content">
        <h1 class="text-center mb-4">Список событий</h1>

        <a href="{{ route('events.create') }}" class="btn btn-primary mb-3">
                <i class="fas fa-plus"></i> Добавить событие
            </a>

        <!-- Search Form -->
        <div class="search-form mb-4">
            <form action="{{ route('events.index') }}" method="GET">
                <input type="text" 
                       name="search" 
                       placeholder="Поиск по названию события..." 
                       value="{{ request('search') }}">
                <select name="type" class="form-select">
                    <option value="">Все типы</option>
                    <option value="university" {{ request('type') == 'university' ? 'selected' : '' }}>Университет</option>
                    <option value="college" {{ request('type') == 'college' ? 'selected' : '' }}>Колледж</option>
                </select>
                <button type="submit" class="btn btn-primary">Поиск</button>
                <a href="{{ route('events.index') }}" class="btn btn-secondary" style="text-decoration: none; color: white; display: flex; justify-content: center; align-items: center;">Сброс</a>
            </form>
        </div>

        <div class="row" id="event-list" style="margin-top: 35px;">
            @foreach($events as $event)
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card event-card shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="card-title text-primary fw-bold">{{ $event->event_name }}</h5>
                            <p class="card-text text-muted"><strong>📅 Дата:</strong>
                                {{ \Carbon\Carbon::parse($event->event_date)->format('d.m.Y H:i') }}</p>
                            <p class="card-text text-muted"><strong>📍 Место:</strong>
                                {{ $event->institution->name }}</p>
                            @if($event->institution->address)
                                <p class="card-text text-muted"><strong>🏢 Адрес:</strong>
                                    {{ $event->institution->address }}</p>
                            @endif

                            <div class="d-flex justify-content-between button-group">
                                <a href="{{ route('events.show', $event->id) }}">
                                    <button class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i> Детали
                                    </button>
                                </a>
                                <a href="{{ route('events.edit', $event->id) }}">
                                    <button class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Редактировать
                                    </button>
                                </a>
                                <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i> Удалить
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Пагинация -->
        <div class="pagination-container">
            @if ($events->total() > 0)
                <p class="pagination-info">
                    Показано с {{ $events->firstItem() }} по {{ $events->lastItem() }} из {{ $events->total() }} результатов
                </p>
            @endif
            
            <div class="pagination-buttons">
                @if ($events->onFirstPage())
                    <span class="page-btn disabled">←</span>
                @else
                    <a href="{{ $events->previousPageUrl() }}" class="page-btn">←</a>
                @endif

                @if ($events->hasMorePages())
                    <a href="{{ $events->nextPageUrl() }}" class="page-btn">→</a>
                @else
                    <span class="page-btn disabled">→</span>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
    :root { --sidebar-width: 300px; }

    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
    }

    /* Контейнер для карточек */
    #event-list {
        display: grid;
        gap: 40px;
        padding: 20px;
        margin: 0 auto;
    }

    /* ≥ 1500px — четыре колонки */
    @media (min-width: 1500px) {
        #event-list {
            grid-template-columns: repeat(4, 1fr);
            max-width: 1920px; /* 4 * 400 + gaps */
        }
    }

    /* 1000-1499px — три колонки */
    @media (min-width: 1000px) and (max-width: 1499px) {
        #event-list {
            grid-template-columns: repeat(3, 1fr);
            max-width: 1440px;
        }
    }

    /* 600-999px — две колонки */
    @media (min-width: 600px) and (max-width: 999px) {
        #event-list {
            grid-template-columns: repeat(2, 1fr);
            max-width: 960px;
            gap: 30px;
        }
    }

    /* <600px — одна колонка */
    @media (max-width: 599px) {
        #event-list {
            grid-template-columns: 1fr;
            max-width: 100%;
        gap: 20px;
        }
    }

    /* Карточка события */
    .event-card {
        width: 100%;
        height: 320px; /* uniform height */
        max-width: 100%;
        margin-top: 50px;
        border-radius: 12px;
        overflow: hidden;
        background: #fff;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        border: none;
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }

    .event-card:hover {
        transform: translateY(-5px);
        box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
    }

    /* Внутреннее содержимое карточки */
    .event-card .card-body {
        padding: 16px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 60%;
    }

    .event-card .card-title {
        font-size: 1.2rem;
        font-weight: bold;
        color: #007bff;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .event-card .card-text {
        font-size: 0.9rem;
        color: #6c757d;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow-wrap: anywhere;
    }

    /* Добавляем стили для кнопок как в institutions */
    .button-group {
        display: flex;
        justify-content: space-between;
        gap: 5px;
    }

    .button-group .btn {
        flex: 1;
        font-size: 0.6rem;
        padding: 8px 12px;
        font-weight: bold;
        border-radius: 8px;
        transition: all 0.3s ease-in-out;
        text-transform: uppercase;
    }

    .button-group .btn-info:hover {
        background: linear-gradient(135deg, #138496, #117a8b);
        box-shadow: 0 5px 10px rgba(23, 162, 184, 0.5);
        transform: scale(1.07);
    }

    .button-group .btn-warning:hover {
        background: linear-gradient(135deg, #d39e00, #c69500);
        box-shadow: 0 5px 10px rgba(255, 193, 7, 0.5);
        transform: scale(1.07);
    }

    .button-group .btn-danger:hover {
        background: linear-gradient(135deg, #c82333, #a71d2a);
        box-shadow: 0 5px 10px rgba(220, 53, 69, 0.5);
        transform: scale(1.07);
    }

    .button-group .btn:active {
        transform: scale(0.95);
    }

    .button-group .btn:hover {
        transform: scale(1.05);
    }

    .main-content{
        margin-left: var(--sidebar-width);
        width: calc(100% - var(--sidebar-width));
        padding: 20px 40px;
    }

     /* Пагинация */
     .pagination-container {
        text-align: center;
        margin-top: 20px;
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

    .page-btn:hover {
        background-color: #2980b9;
    }

    .page-btn.disabled {
        background-color: #ccc;
        pointer-events: none;
    }

    /* Search Form Styles */
    .search-form {
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        width: 60%;
        max-width: 2400px;
        margin-left: auto;
        margin-right: auto;
    }

    .search-form form {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .search-form input[type="text"] {
        flex: 1;
        height: 45px;
        font-size: 1rem;
        border: 1px solid #ddd;
        border-radius: 6px;
        padding: 0 15px;
        transition: border-color 0.3s ease;
        min-width: 200px;
    }

    .search-form .form-select {
        height: 45px;
        font-size: 1rem;
        border: 1px solid #ddd;
        border-radius: 6px;
        padding: 0 15px;
        transition: border-color 0.3s ease;
        width: auto;
    }

    .search-form input[type="text"]:focus,
    .search-form .form-select:focus {
        border-color: #3498db;
        box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.2);
        outline: none;
    }

    .search-form .btn {
        height: 45px;
        width: 100px;
        padding: 0 20px;
        font-weight: 400;
        white-space: nowrap;
    }

    .search-form .btn-secondary {
        background-color: #95a5a6;
        border: none;
    }

    .search-form .btn-secondary:hover {
        background-color: #7f8c8d;
    }

    /* grid for events list */
    #institution-list {
        display: grid;
        gap: 20px;
        padding: 20px;
        margin: 0 auto;
        grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
        max-width: 1600px; /* 4 columns max */
        justify-content: center;
    }

    /* 900-1199px: 3 columns */
    @media (max-width: 1099px) {
        #institution-list { grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); max-width: 1200px; }
    }

    /* 600-899px: 2 columns */
    @media (max-width: 899px) {
        #institution-list { grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); max-width: 800px; }
    }

    /* <600px: 1 column */
    @media (max-width: 599px) {
        #institution-list { grid-template-columns: 1fr; max-width: 100%; }
    }
</style>



<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Подтверждение удаления
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function (e) {
                if (!confirm('Are you sure you want to delete this event?')) {
                    e.preventDefault();
                }
            });
        });
    });
</script>
@endsection