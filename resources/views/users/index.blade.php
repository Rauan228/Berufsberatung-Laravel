@extends('layouts.app')

@section('content')

<div class="container">
    <h1 style="margin: 40px 0 0 350px;">Users</h1>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif


    <div class="main-content">
        <h1>Users</h1>
    
        <div class="users-container">
            <!-- Список активных пользователей -->
            <div class="users-list active-users">
                <h3 style="color: #3498db;">Active users</h3>
                <ul>
                    @foreach ($users->where('is_banned', false) as $user)
                        <li>
                            <strong style="font-size: 22px">{{ $user->username }}</strong><br>
                            <span>Date added: {{ $user->created_at->format('d.m.Y H:i') }}</span><br>
                            <form action="{{ route('users.toggleBan', ['id' => $user->id]) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-danger" style="margin: 5px 0 0 0">Ban</button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            </div>
    
            <!-- Список забаненных пользователей -->
            <div class="users-list banned-users">
                <h3 style="color: #e74c3c;">Banned users</h3>
                <ul>
                    @foreach ($users->where('is_banned', true) as $user)
                        <li>
                            <strong style="font-size: 22px">{{ $user->username }}</strong><br>
                            <span>Date added: {{ $user->created_at->format('d.m.Y H:i') }}</span><br>
                            <form action="{{ route('users.toggleBan', ['id' => $user->id]) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-success" style="margin: 5px 0 0 0">Unban</button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

<style>
    body {
        font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f6f9;
    }

    h2 {
        margin-left: 280px;
        /* Отступ заголовка от sidebar */
        margin-top: 20px;
        /* Отступ сверху */
    }

    /* Стили для контейнера пользователей */
    .users-container {
        display: flex;
        justify-content: space-between;
        gap: 20px;
        width: 100%;
        margin:0 0 50px 350px;
    }

    /* Стили для списков */
    .users-list {
        width: 48%;
        background-color: #fff;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    /* Стили заголовков */
    h3 {
        margin-bottom: 10px;
    }

    /* Стили списка пользователей */
    ul {
        list-style-type: none;
        padding: 0;
    }

    li {
        background-color: #f9f9f9;
        margin: 10px 0;
        padding: 10px;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    /* Стили кнопок */
    button {
        background-color: #2980b9;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease-in-out;
    }

    button:hover {
        background-color: #1f618d;
    }

    /* Красная кнопка */
    .btn-danger {
        background-color: red;
    }

    .btn-danger:hover {
        background-color: darkred;
    }

    /* Зелёная кнопка */
    .btn-success {
        background-color: green;
    }

    .btn-success:hover {
        background-color: darkgreen;
    }
</style>
@endsection