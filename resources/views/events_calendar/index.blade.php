@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<div class="container" style="margin:50px 0 0 50px">

    <div class="main-content">
        <h1 class="text-center mb-4">Events list</h1>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="{{ route('events.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add event
            </a>
            <input type="text" id="search" class="form-control w-50" style="margin-left: 20px"
                placeholder="🔍 Search by events...">
        </div>

        <div class="row" id="event-list" style="margin-top: 35px;">
            @foreach($events as $event)
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card event-card shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="card-title text-primary fw-bold">{{ $event->event_name }}</h5>
                            <p class="card-text text-muted"><strong>📅 Date:</strong>
                                {{ \Carbon\Carbon::parse($event->event_date)->format('d.m.Y H:i') }}</p>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('events.show', $event->id) }}"><button class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i> Detail
                                    </button></a>
                                <a href="{{ route('events.edit', $event->id) }}"><button
                                        href="{{ route('events.edit', $event->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Edit
                                    </button></a>
                                <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i> Delete
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
                    Showing {{ $events->firstItem() }} to {{ $events->lastItem() }} of {{ $events->total() }} results
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
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
    }

    /* Контейнер для карточек */
    #event-list {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
        /* Выравнивание по центру */
    }

    /* Карточка события */
    .event-card {
        width: 300px;
        /* Фиксированная ширина */
        height: 230px;
        /* Фиксированная высота */
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
    }

    .event-card .card-text {
        font-size: 0.9rem;
        color: #6c757d;
    }

    /* Контейнер для кнопок */
    .event-card .button-group {
        display: flex;
        justify-content: space-between;
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



    .event-card .btn-info:hover {
        background: linear-gradient(135deg, #138496, #117a8b);
        box-shadow: 0 5px 10px rgba(23, 162, 184, 0.5);
        transform: scale(1.07);
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

    .event-card .btn:hover {
        transform: scale(1.05);
    }

    .main-content{
        margin-left: 300px
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
</style>



<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Фильтрация событий по названию
        document.getElementById('search').addEventListener('keyup', function () {
            let filter = this.value.toLowerCase();
            let cards = document.querySelectorAll('.event-card');

            cards.forEach(card => {
                let title = card.querySelector('.card-title').textContent.toLowerCase();
                card.closest('.col-lg-4').style.display = title.includes(filter) ? '' : 'none';
            });
        });

        // Подтверждение удаления
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function (e) {
                if (!confirm('Вы уверены, что хотите удалить это событие?')) {
                    e.preventDefault();
                }
            });
        });

        
    });
</script>
@endsection