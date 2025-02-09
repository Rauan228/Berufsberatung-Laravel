@extends('layouts.app')

@section('content')
<div class="container">
   

    <h1>{{ $event->event_name }}</h1>
    <p>Дата: {{ $event->event_date }}</p>
    <p>Описание: {{ $event->description }}</p>
    <p>Университет: {{ $event->institution->name ?? 'Не указан' }}</p>
    
    <h3>Заявки на участие</h3>
    @if($applications->count() > 0)
        <ul class="list-group">
            @foreach($applications as $application)
                <li class="list-group-item">
                    {{ $application->user->username ?? 'Неизвестный пользователь' }} - Статус: {{ $application->status }}
                </li>
            @endforeach
        </ul>
    @else
        <p>Заявок пока нет.</p>
    @endif
    
    

    <a href="{{ route('events.index') }}" class="btn btn-primary mt-3">Назад</a>
</div>
@endsection
