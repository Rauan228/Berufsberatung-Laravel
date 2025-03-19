@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 style="margin: 40px 0 0 350px;">Users</h1>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="main-content" style="margin: 40px 0 50px 35%;">
            <!-- Tab Control for active and banned users -->
            <div class="tabs">
                <ul class="tab-titles">
                    <li class="active-tab" data-tab="active-users">Active Users</li>
                    <li data-tab="banned-users">Banned Users</li>
                </ul>

                <div class="tab-content">
                    <!-- Active Users Tab -->
                    <div id="active-users" class="tab-panel active">
                        <div class="users-grid">
                            @foreach ($activeUsers as $user)
                                <div class="user-card">
                                    <strong style="font-size: 22px">{{ $user->username }}</strong><br>
                                    <span>Date added: {{ $user->created_at->format('d.m.Y H:i') }}</span><br>
                                    <form action="{{ route('users.toggleBan', ['id' => $user->id]) }}" method="POST" class="toggle-ban-form">
                                        @csrf
                                        <input type="hidden" name="redirect_tab" value="active-users">
                                        <button type="submit" class="btn btn-danger">Ban</button>
                                    </form>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination for Active Users -->
                        <div class="pagination-container">
                            @if ($activeUsers->total() > 0)
                                <p class="pagination-info">
                                    Showing {{ $activeUsers->firstItem() }} to {{ $activeUsers->lastItem() }} of
                                    {{ $activeUsers->total() }} results
                                </p>
                            @endif
                            <div class="pagination-buttons">
                                @if ($activeUsers->onFirstPage())
                                    <span class="page-btn disabled">←</span>
                                @else
                                    <a href="{{ $activeUsers->appends(['tab' => 'active-users'])->previousPageUrl() }}" class="page-btn">←</a>
                                @endif

                                @if ($activeUsers->hasMorePages())
                                    <a href="{{ $activeUsers->appends(['tab' => 'active-users'])->nextPageUrl() }}" class="page-btn">→</a>
                                @else
                                    <span class="page-btn disabled">→</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Banned Users Tab -->
                    <div id="banned-users" class="tab-panel">
                        <div class="users-grid">
                            @foreach ($bannedUsers as $user)
                                <div class="user-card">
                                    <strong style="font-size: 22px">{{ $user->username }}</strong><br>
                                    <span>Date added: {{ $user->created_at->format('d.m.Y H:i') }}</span><br>
                                    <form action="{{ route('users.toggleBan', ['id' => $user->id]) }}" method="POST" class="toggle-ban-form">
                                        @csrf
                                        <input type="hidden" name="redirect_tab" value="active-users">
                                        <button type="submit" class="btn btn-success">Unban</button>
                                    </form>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination for Banned Users -->
                        <div class="pagination-container">
                            @if ($bannedUsers->total() > 0)
                                <p class="pagination-info">
                                    Showing {{ $bannedUsers->firstItem() }} to {{ $bannedUsers->lastItem() }} of
                                    {{ $bannedUsers->total() }} results
                                </p>
                            @endif
                            <div class="pagination-buttons">
                                @if ($bannedUsers->onFirstPage())
                                    <span class="page-btn disabled">←</span>
                                @else
                                    <a href="{{ $bannedUsers->appends(['tab' => 'banned-users'])->previousPageUrl() }}" class="page-btn">←</a>
                                @endif

                                @if ($bannedUsers->hasMorePages())
                                    <a href="{{ $bannedUsers->appends(['tab' => 'banned-users'])->nextPageUrl() }}" class="page-btn">→</a>
                                @else
                                    <span class="page-btn disabled">→</span>
                                @endif
                            </div>
                        </div>
                    </div>
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

        .main-content {
            display: flex;
            max-width: 11500px;
            width: 100%;
            margin: 0 0 100px 35%;
            align-items: center;
            align-content: center;
            justify-content: center;
        }

        .tabs {
            position: sticky;
            top: 0;
            z-index: 1000;
            background-color: #f4f6f9;
            width: 150%;
            margin-top: 20px;
            margin-left: 300px;
            animation: fadeIn 1s ease-in-out;
        }

        /* Tab styling */
        .tab-titles {
            display: flex;
            justify-content: space-around;
            list-style-type: none;
            padding: 0;
            border-bottom: 2px solid #ddd;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1001;
        }

        .tab-titles li {
            padding: 10px 20px;
            cursor: pointer;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .tab-titles li:hover {
            background-color: #f0f0f0;
            border-radius: 5px;
        }

        .active-tab {
            border-bottom: 2px solid #2980b9;
            color: #2980b9;
        }

        /* Убираем скачки при переключении вкладок */
        .tab-content {
            position: relative;
            min-height: 400px;
        }

        .tab-panel {
            display: none;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
        }

        .tab-panel.active {
            display: block;
            opacity: 1;
        }

        /* Остальные стили остаются без изменений */
        .users-grid {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 20px;
            margin-top: 20px;
        }

        .user-card {
            background-color: #fff;
            padding: 35px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
            text-align: center;
        }

        .user-card:hover {
            transform: scale(1.05);
        }

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

        .btn-danger {
            background-color: red;
            width: 120px;
        }

        .btn-danger:hover {
            background-color: darkred;
        }

        .btn-success {
            background-color: green;
            width: 120px;
        }

        .btn-success:hover {
            background-color: darkgreen;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }

        @keyframes slideIn {
            0% {
                opacity: 0;
                transform: translateX(-50px);
            }
            100% {
                opacity: 1;
                transform: translateX(0);
            }
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
    </style>

    <script>
        document.querySelectorAll('.tab-titles li').forEach(tab => {
            tab.addEventListener('click', () => {
                document.querySelectorAll('.tab-titles li').forEach(item => item.classList.remove('active-tab'));
                document.querySelectorAll('.tab-panel').forEach(panel => panel.classList.remove('active'));

                tab.classList.add('active-tab');
                document.getElementById(tab.dataset.tab).classList.add('active');

                const currentUrl = new URL(window.location);
                currentUrl.searchParams.set('tab', tab.dataset.tab);
                window.history.pushState({}, '', currentUrl);
            });
        });

        document.addEventListener('DOMContentLoaded', () => {
            const params = new URLSearchParams(window.location.search);
            const activeTab = params.get('tab') || 'active-users'; // По умолчанию "Active Users"

            document.querySelectorAll('.tab-titles li').forEach(tab => {
                if (tab.dataset.tab === activeTab) {
                    tab.classList.add('active-tab');
                    document.getElementById(activeTab).classList.add('active');
                }
            });
        });

        // Обработка отправки формы для бана/разбана
        document.querySelectorAll('.toggle-ban-form').forEach(form => {
            form.addEventListener('submit', (e) => {
                e.preventDefault(); // Предотвращаем стандартную отправку формы
                const formData = new FormData(form);

                fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
                    }
                })
                .then(response => {
                    if (response.ok) {
                        // После успешного запроса перенаправляем на вкладку Active Users
                        const currentUrl = new URL(window.location);
                        currentUrl.searchParams.set('tab', 'active-users');
                        window.location.href = currentUrl.toString();
                    }
                })
                .catch(error => console.error('Error:', error));
            });
        });
    </script>
@endsection