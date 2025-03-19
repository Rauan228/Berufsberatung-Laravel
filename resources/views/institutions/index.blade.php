@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<div class="container" style="margin:50px 0 0 50px">
    <div class="main-content">
        <h1 class="text-center mb-4">Institutions list</h1>
        <a href="{{ route('institutions.create') }}" class="btn btn-primary mb-3">
            <i class="fas fa-plus"></i> Add new institution
        </a>

        <input type="text" id="search" class="form-control w-50 mb-4" placeholder="🔍 Search by Institute...">

        <div class="row" id="institution-list">
            @foreach($institutions as $institution)
            @if($institution->verified !== 'pending' && $institution->verified !== 'rejected')
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card institution-card shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="card-title text-primary fw-bold">{{ $institution->name }}</h5>
                            <p class="card-text text-muted"><strong>📍 Location:</strong> {{ $institution->location }}</p>
                            <p class="card-text text-muted">
                                {{ \Illuminate\Support\Str::limit($institution->description, 100) }}
                            </p>

                            @if($institution->website)
                                <p><a href="{{ $institution->website }}" target="_blank" class="text-info"><i
                                            class="fas fa-globe"></i> Go to website</a></p>
                            @endif

                            <div class="d-flex justify-content-between button-group">
                                <a href="{{ route('institutions.show', $institution->id) }}">
                                    <button class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i> Detail
                                    </button>
                                </a>
                                <a href="{{ route('institutions.edit', $institution->id) }}">
                                    <button class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                </a>
                                <form action="{{ route('institutions.destroy', $institution->id) }}" method="POST"
                                    class="delete-form">
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

    @endif
            @endforeach
        </div>

        <!-- Пагинация -->
        <div class="pagination-container">
            @if ($institutions->total() > 0)
                <p class="pagination-info">
                    Showing {{ $institutions->firstItem() }} to {{ $institutions->lastItem() }} of {{ $institutions->total() }} results
                </p>
            @endif
            
            <div class="pagination-buttons">
                @if ($institutions->onFirstPage())
                    <span class="page-btn disabled">←</span>
                @else
                    <a href="{{ $institutions->previousPageUrl() }}" class="page-btn">←</a>
                @endif

                @if ($institutions->hasMorePages())
                    <a href="{{ $institutions->nextPageUrl() }}" class="page-btn">→</a>
                @else
                    <span class="page-btn disabled">→</span>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
    .main-content {
        margin-left: 300px
    }

    #institution-list {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
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

    /* Контейнер для кнопок */
    .button-group {
        display: flex;
        justify-content: space-between;
        gap: 5px;
    }

    /* Общий стиль для кнопок */
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

    /* Анимация нажатия */
    .button-group .btn:active {
        transform: scale(0.95);
    }

    .button-group .btn:hover {
        transform: scale(1.05);
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
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('search').addEventListener('keyup', function () {
            let filter = this.value.toLowerCase();
            let cards = document.querySelectorAll('.institution-card');

            cards.forEach(card => {
                let title = card.querySelector('.card-title').textContent.toLowerCase();
                card.closest('.col-lg-4').style.display = title.includes(filter) ? '' : 'none';
            });
        });

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