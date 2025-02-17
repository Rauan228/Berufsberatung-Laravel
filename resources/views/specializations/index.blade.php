@extends('layouts.app')

@section('content')
<div class="main-content" style="margin: 0 0 0 300px">
    <h1>Список специализаций</h1>
    <a href="{{ route('specializations.create') }}" class="btn btn-primary">Добавить</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <ul>
        @foreach($specializations as $specialization)
            <li>
                {{ $specialization->name }} ({{ $specialization->qualification->name }})
                <a href="{{ route('specializations.edit', $specialization) }}">Редактировать</a>
                <form action="{{ route('specializations.destroy', $specialization) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Удалить?')">Удалить</button>
                </form>
            </li>
        @endforeach
    </ul>
</div>
@endsection
