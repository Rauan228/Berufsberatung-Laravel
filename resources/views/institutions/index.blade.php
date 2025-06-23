@extends('app')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<div class="container" style="margin:50px 0 0 50px">
    <div class="main-content">
        <h1 class="text-center mb-4">Список учреждений</h1>
        <a href="{{ route('institutions.create') }}" class="btn btn-primary mb-3">
            <i class="fas fa-plus"></i> Добавить учреждение
        </a>

        <!-- Search Form -->
        <div class="search-form mb-4">
            <form action="{{ route('institutions.index') }}" method="GET">
                <input type="text" 
                       name="search" 
                       placeholder="Поиск по названию учреждения..." 
                       value="{{ request('search') }}">
                <select name="type" class="form-select">
                        <option value="">Все типы</option>
                        <option value="university" {{ request('type') == 'university' ? 'selected' : '' }}>Университет</option>
                        <option value="college" {{ request('type') == 'college' ? 'selected' : '' }}>Колледж</option>
                    </select>
                <button type="submit" class="btn btn-primary">Поиск</button>
                <a href="{{ route('institutions.index') }}" class="btn btn-secondary" style="text-decoration: none; color: white; display: flex; justify-content: center; align-items: center;">Сброс</a>
            </form>
        </div>

        <div class="row" id="institution-list">
            @foreach($institutions as $institution)
            @if($institution->verified !== 'pending' && $institution->verified !== 'rejected')
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card institution-card shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="card-title text-primary fw-bold">{{ $institution->name }}</h5>
                            <p class="card-text text-muted"><strong>📍 Расположение:</strong> {{ $institution->location }}</p>
                            <p class="card-text text-muted">
                                {{ \Illuminate\Support\Str::limit($institution->description1, 100) }}
                            </p>

                            @if($institution->website)
                                <p><a href="{{ $institution->website }}" target="_blank" class="text-info"><i class="fas fa-globe"></i> Перейти на сайт</a></p>
                            @endif

                            <div class="d-flex justify-content-between button-group">
                                <a href="{{ route('institutions.show', $institution->id) }}">
                                    <button class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i> Детали
                                    </button>
                                </a>
                                <a href="{{ route('institutions.edit', $institution->id) }}">
                                    <button class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Редактировать
                                    </button>
                                </a>
                                <form action="{{ route('institutions.destroy', $institution->id) }}" method="POST" class="delete-form">
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
            @endif
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="pagination-container">
            @if ($institutions->total() > 0)
                <p class="pagination-info">
                    Показано с {{ $institutions->firstItem() }} по {{ $institutions->lastItem() }} из {{ $institutions->total() }} результатов
                </p>
            @endif
            
            <div class="pagination-buttons">
                @if ($institutions->onFirstPage())
                    <span class="page-btn disabled">←</span>
                @else
                    <a href="{{ $institutions->appends(['type' => request('type'), 'search' => request('search')])->previousPageUrl() }}" class="page-btn">←</a>
                @endif

                @if ($institutions->hasMorePages())
                    <a href="{{ $institutions->appends(['type' => request('type'), 'search' => request('search')])->nextPageUrl() }}" class="page-btn">→</a>
                @else
                    <span class="page-btn disabled">→</span>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
    :root { --sidebar-width: 300px; }

    .main-content {
        margin-left: var(--sidebar-width);
        width: calc(100% - var(--sidebar-width));
        padding: 20px 40px;
    }

    #institution-list {
        display: grid;
        grid-template-columns: repeat(4, 1fr); /* 3 карты в ряд по умолчанию */
        gap: 120px;
        padding: 20px;
        max-width: 2600px; /* ~8 cards per row */
        margin: 0 auto;
    }

    .institution-card {
        width: 400px;
        height: 300px;
        margin-top: 50px;
        border-radius: 12px;
        background: #fff;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        border: none;
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }

    .institution-card:hover {
        transform: translateY(-5px);
        box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
    }

    .institution-card .card-body {
        padding: 16px;
    }

    .institution-card .card-title {
        font-size: 1.2rem;
        font-weight: bold;
        color: #007bff;
    }

    .institution-card .card-text {
        font-size: 0.9rem;
        color: #6c757d;
    }

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

    .btn {
        flex: 1;
        font-size: 0.75rem;
        padding: 8px 12px;
        font-weight: bold;
        border-radius: 8px;
        transition: all 0.3s ease-in-out;
        text-transform: uppercase;
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

    /* Responsive tweaks */
    @media (max-width: 1800px) {
        #institution-list { grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); }
    }

    @media (max-width: 1400px) {
        #institution-list { grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); }
    }

    @media (max-width: 1024px) {
        .main-content { margin-left: 0; width: 100%; padding: 15px; }
        #institution-list { grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Client-side search filtering
        document.getElementById('search').addEventListener('keyup', function () {
            let filter = this.value.toLowerCase();
            let cards = document.querySelectorAll('.institution-card');

            cards.forEach(card => {
                let title = card.querySelector('.card-title').textContent.toLowerCase();
                card.closest('.col-lg-4').style.display = title.includes(filter) ? '' : 'none';
            });
        });

        // Confirmation for delete action
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function (e) {
                if (!confirm('Вы уверены, что хотите удалить этот институт?')) {
                    e.preventDefault();
                }
            });
        });
    });
</script>

@endsection