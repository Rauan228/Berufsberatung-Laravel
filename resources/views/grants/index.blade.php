@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<div class="container">
    .main-content{}
    <h2>Список грантов</h2>
    <a href="{{ route('grants.create') }}" class="btn btn-primary mb-3">Добавить грант</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Название гранта</th>
                <th>Учреждение</th>
                <th>Специальность</th>
                <th>Сумма</th>
                <th>Дедлайн</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($grants as $grant)
                <tr>
                    <td>{{ $grant->id }}</td>
                    <td>{{ $grant->grant_name }}</td>
                    <td>{{ $grant->institution->name }}</td>
                    <td>{{ $grant->specialty->name }}</td>
                    <td>{{ $grant->amount }} руб.</td>
                    <td>{{ $grant->application_deadline }}</td>
                    <td>
                        <a href="{{ route('grants.show', $grant->id) }}" class="btn btn-info btn-sm">Просмотр</a>
                        <a href="{{ route('grants.edit', $grant->id) }}" class="btn btn-warning btn-sm">Редактировать</a>
                        <form action="{{ route('grants.destroy', $grant->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Вы уверены?')">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
