@extends('layouts.app')

@section('content')
<div class="main-content">
    <h1>Подать заявку</h1>
    <form method="POST" action="{{ route('applications.store') }}">
        @csrf
        <label for="user_id">Пользователь:</label>
        <input type="text" name="user_id" required>

        <label for="event_id">Мероприятие:</label>
        <input type="text" name="event_id" required>

        <button type="submit">Подать заявку</button>
    </form>
</div>
@endsection
