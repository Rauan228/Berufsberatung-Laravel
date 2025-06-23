@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $specialty->name }}</h1>
    <p class="description">{{ $specialty->description }}</p>

    <h2>Квалификации</h2>
    @if($specialty->collegeQualifications->count() > 0)
        @foreach($specialty->collegeQualifications as $qualification)
            <div class="qualification-card">
                <h3>{{ $qualification->qualification_name }}</h3>
                <p>{{ $qualification->description }}</p>

                @if($qualification->specializations->count() > 0)
                    <h4>Специализации:</h4>
                    <ul>
                        @foreach($qualification->specializations as $specialization)
                            <li>
                                <strong>{{ $specialization->name }}</strong>
                                <p>{{ $specialization->description }}</p>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        @endforeach
    @else
        <p>Нет доступных квалификаций</p>
    @endif

    <div class="actions">
        <a href="{{ route('college_specialties.edit', $specialty->id) }}" class="btn btn-warning">
            <i class="fas fa-edit"></i> Редактировать
        </a>
        <form action="{{ route('college_specialties.destroy', $specialty->id) }}" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Вы уверены, что хотите удалить эту специальность?')">
                <i class="fas fa-trash"></i> Удалить
            </button>
        </form>
        <a href="{{ route('college_specialties.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Назад к списку
        </a>
    </div>
</div>

<style>
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    .description {
        font-size: 1.1em;
        color: #666;
        margin-bottom: 30px;
    }

    .qualification-card {
        background: #fff;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .qualification-card h3 {
        color: #2c3e50;
        margin-bottom: 10px;
    }

    .qualification-card h4 {
        color: #34495e;
        margin: 15px 0 10px;
    }

    .qualification-card ul {
        list-style: none;
        padding-left: 0;
    }

    .qualification-card li {
        margin-bottom: 15px;
        padding-left: 15px;
        border-left: 3px solid #3498db;
    }

    .actions {
        margin-top: 30px;
    }

    .btn {
        display: inline-block;
        padding: 8px 15px;
        margin-right: 10px;
        border-radius: 4px;
        font-weight: 500;
    }

    .btn-warning {
        background-color: #f1c40f;
        color: #fff;
    }

    .btn-danger {
        background-color: #e74c3c;
        color: #fff;
    }

    .btn-secondary {
        background-color: #95a5a6;
        color: #fff;
    }

    .btn:hover {
        opacity: 0.9;
    }
</style>
@endsection 