@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<div class="container" style="margin:50px 0 0 50px">
    <div class="main-content">
        <h1 class="text-center mb-4">Список институтов</h1>
        <a href="{{ route('institutions.create') }}" class="btn btn-primary mb-3">
            <i class="fas fa-plus"></i> Добавить новый институт
        </a>

        <input type="text" id="search" class="form-control w-50 mb-4" placeholder="🔍 Поиск по институтам...">

        <div class="row" id="institution-list">
            @foreach($institutions as $institution)
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card institution-card shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="card-title text-primary fw-bold">{{ $institution->name }}</h5>
                            <p class="card-text text-muted"><strong>📍 Локация:</strong> {{ $institution->location }}</p>
                            <p class="card-text text-muted">
                                {{ \Illuminate\Support\Str::limit($institution->description, 100) }}</p>

                            @if($institution->website)
                                <p><a href="{{ $institution->website }}" target="_blank" class="text-info"><i
                                            class="fas fa-globe"></i> Перейти на сайт</a></p>
                            @endif

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('institutions.show', $institution->id) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i> Подробнее
                                </a>
                                <a href="{{ route('institutions.edit', $institution->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> Редактировать
                                </a>
                                <form action="{{ route('institutions.destroy', $institution->id) }}" method="POST"
                                    class="delete-form">
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

    .institution-card .btn {
        font-size: 0.8rem;
        padding: 6px 10px;
        font-weight: bold;
        border-radius: 8px;
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