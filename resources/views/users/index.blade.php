@extends('app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-4" style="margin-left: 300px !important;">Управление пользователями</h1>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="main-content">
            <!-- Search Form -->
            <div class="search-form">
                <form action="{{ route('users.index') }}" method="GET">
                    <input type="text" 
                           name="search" 
                           placeholder="Поиск по имени пользователя..." 
                           value="{{ request('search') }}">
                    <input type="hidden" name="tab" value="{{ $tab }}">
                    <button type="submit" class="btn btn-primary">Поиск</button>
                    <a href="{{ route('users.index', ['tab' => $tab]) }}" class="btn btn-secondary" style="text-decoration: none; color: white;">Сброс</a>
                </form>
            </div>

            <!-- Tab Control for active and deleted users -->
            <div class="tabs">
                <ul class="tab-titles">
                    <li class="active-tab" data-tab="active-users">Активные</li>
                    <li data-tab="deleted-users">Удалённые</li>
                </ul>

                <div class="tab-content">
                    <!-- Active Users Tab -->
                    <div id="active-users" class="tab-panel active">
                        <div class="users-grid">
                            @foreach ($activeUsers as $user)
                                <div class="user-card">
                                    <div class="user-info">
                                        <strong class="username">{{ $user->username }}</strong>
                                        <p class="date-added">
                                            <i class="fas fa-calendar-alt"></i>
                                            Зарегистрирован: {{ $user->created_at->format('d.m.Y') }}
                                        </p>
                                        <p class="email">
                                            <i class="fas fa-envelope"></i>
                                            {{ $user->email }}
                                        </p>
                                    </div>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fas fa-trash"></i> Удалить
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination for Active Users -->
                        <div class="pagination-container">
                            @if ($activeUsers->total() > 0)
                                <p class="pagination-info">
                                    Показано с {{ $activeUsers->firstItem() }} по {{ $activeUsers->lastItem() }} из
                                    {{ $activeUsers->total() }} результатов
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

                    <!-- Deleted Users Tab -->
                    <div id="deleted-users" class="tab-panel">
                        <div class="users-grid">
                            @forelse($deletedUsers as $user)
                                <div class="user-card">
                                    <div class="user-info">
                                        <strong class="username">{{ $user->username }}</strong>
                                        <p class="date-added">
                                            <i class="fas fa-calendar-alt"></i>
                                            Зарегистрирован: {{ $user->created_at->format('d.m.Y') }}
                                        </p>
                                        <p class="email">
                                            <i class="fas fa-envelope"></i>
                                            {{ $user->email }}
                                        </p>
                                        <p class="deleted-at">
                                            <i class="fas fa-trash-alt"></i>
                                            Удалён: {{ $user->deleted_at->format('d.m.Y') }}
                                        </p>
                                    </div>
                                    <form action="{{ route('users.restore', $user->id) }}" method="POST" class="restore-form">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-success">
                                            <i class="fas fa-undo"></i> Восстановить
                                        </button>
                                    </form>
                                </div>
                            @empty
                                <div class="user-card">
                                    <div class="user-info">
                                        <strong class="username">Удалённые пользователи не найдены</strong>
                                    </div>
                                </div>
                            @endforelse
                        </div>

                        <!-- Pagination for Deleted Users -->
                        <div class="pagination-container">
                            @if ($deletedUsers->total() > 0)
                                <p class="pagination-info">
                                    Показано с {{ $deletedUsers->firstItem() }} по {{ $deletedUsers->lastItem() }} из
                                    {{ $deletedUsers->total() }} результатов
                                </p>
                            @endif
                            <div class="pagination-buttons">
                                @if ($deletedUsers->onFirstPage())
                                    <span class="page-btn disabled">←</span>
                                @else
                                    <a href="{{ $deletedUsers->appends(['tab' => 'deleted-users'])->previousPageUrl() }}" class="page-btn">←</a>
                                @endif

                                @if ($deletedUsers->hasMorePages())
                                    <a href="{{ $deletedUsers->appends(['tab' => 'deleted-users'])->nextPageUrl() }}" class="page-btn">→</a>
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
        :root { --sidebar-width: 300px; }

        .main-content {
            margin-left: var(--sidebar-width);
            padding: 20px 40px;
            width: calc(100% - var(--sidebar-width));
            max-width: 100%;
        }

        /* Стили для формы поиска */
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
            min-width: 00px;
        }

        .search-form input[type="text"]:focus {
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

        .tabs {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            width: 120%;
            max-width: 2400px;
            margin-left: auto;
            margin-right: auto;
            transition: all 0.3s ease;
        }

        /* При отдалении (маленький zoom) - широкий контейнер */
        @media (min-width: 2200px) {
            .tabs {
                width: 95%;
                max-width: 3000px;
            }
        }

        /* При среднем отдалении */
        @media (min-width: 2000px) and (max-width: 2399px) {
            .tabs {
                width: 90%;
                max-width: 2400px;
            }
        }

        /* При небольшом отдалении */
        @media (min-width: 1600px) and (max-width: 1999px) {
            .tabs {
                width: 85%;
                max-width: 2000px;
            }
        }

        /* При нормальном зуме */
        @media (min-width: 1200px) and (max-width: 1599px) {
            .tabs {
                width: 80%;
                max-width: 1600px;
            }
        }

        /* При небольшом приближении */
        @media (min-width: 992px) and (max-width: 1199px) {
            .tabs {
                width: 75%;
                max-width: 1200px;
            }
        }

        /* При среднем приближении */
        @media (min-width: 768px) and (max-width: 991px) {
            .tabs {
                width: 70%;
                max-width: 900px;
            }
        }

        /* При сильном приближении */
        @media (max-width: 767px) {
            .tabs {
                width: 65%;
                min-width: 320px;
                margin: 10px auto;
            }
        }

        .tab-titles {
            display: flex;
            list-style: none;
            margin: 0;
            padding: 0;
            border-bottom: 2px solid #f0f0f0;
            position: sticky;
            top: 0;
            background: #fff;
            z-index: 10;
        }

        .tab-titles li {
            padding: 15px 30px;
            cursor: pointer;
            font-weight: 600;
            color: #666;
            transition: all 0.3s ease;
        }

        .tab-titles li:hover {
            color: #2980b9;
        }

        .tab-titles li.active-tab {
            color: #2980b9;
            border-bottom: 2px solid #2980b9;
        }

        .users-grid {
            display: grid;
            gap: 20px;
            padding: 20px;
            width: 100%;
            max-width: 2300px; /* 8 cards of ~270px + gaps */
            margin: 0 auto;   /* center the grid */
            grid-template-columns: repeat(auto-fill, minmax(270px, 1fr));
        }

        /* Responsive tweaks to keep 6–8 cards per row */
        @media (max-width: 1800px) {
            .users-grid { grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); }
        }
        @media (max-width: 1400px) {
            .users-grid { grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); }
        }
        @media (max-width: 1024px) {
            .users-grid { grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); }
        }

        .user-card {
            background: #fff;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 30%;
            min-height: 150px;
        }

        .user-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .user-info {
            margin-bottom: 20px;
        }

        .username {
            font-size: 1.25rem;
            color: #2c3e50;
            display: block;
            margin-bottom: 12px;
            font-weight: 600;
        }

        .date-added, .email, .deleted-at {
            color: #666;
            font-size: 0.95rem;
            margin: 8px 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .date-added i, .email i, .deleted-at i {
            width: 16px;
            color: #2980b9;
        }

        .btn {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-size: 0.95rem;
        }

        .btn i {
            font-size: 1rem;
        }

        .btn-danger {
            background-color: #e74c3c;
            color: white;
        }

        .btn-danger:hover {
            background-color: #c0392b;
        }

        .btn-success {
            background-color: #2ecc71;
            color: white;
        }

        .btn-success:hover {
            background-color: #27ae60;
        }

        .pagination-container {
            margin-top: 30px;
            text-align: center;
        }

        .pagination-info {
            color: #666;
            margin-bottom: 15px;
            font-size: 0.95rem;
        }

        .pagination-buttons {
            display: flex;
            justify-content: center;
            gap: 12px;
        }

        .page-btn {
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            border-radius: 6px;
            text-decoration: none;
            transition: background-color 0.3s ease;
            font-weight: 600;
        }

        .page-btn:hover {
            background-color: #2980b9;
        }

        .page-btn.disabled {
            background-color: #bdc3c7;
            cursor: not-allowed;
        }

        .tab-panel {
            display: none;
        }

        .tab-panel.active {
            display: block;
            animation: fadeIn 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Мобильная адаптация */
        @media (max-width: 1024px) {
            .main-content {
                margin-left: 0;
                width: 100%;
                padding: 15px;
            }

            .users-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                padding: 15px;
                gap: 15px;
            }

            .user-card {
                padding: 20px;
            }
        }

        @media (max-width: 640px) {
            .users-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .tab-titles li {
                padding: 12px 20px;
                font-size: 0.9rem;
            }

            .username {
                font-size: 1.1rem;
            }

            .date-added, .email, .deleted-at {
                font-size: 0.9rem;
            }

            .btn {
                padding: 10px;
                font-size: 0.9rem;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tab switching functionality
            const tabs = document.querySelectorAll('.tab-titles li');
            const panels = document.querySelectorAll('.tab-panel');

            // Function to switch tabs
            function switchTab(tabId) {
                // Remove active class from all tabs and panels
                tabs.forEach(t => t.classList.remove('active-tab'));
                panels.forEach(p => p.classList.remove('active'));

                // Add active class to selected tab and panel
                const selectedTab = document.querySelector(`[data-tab="${tabId}"]`);
                const selectedPanel = document.getElementById(tabId);
                
                if (selectedTab && selectedPanel) {
                    selectedTab.classList.add('active-tab');
                    selectedPanel.classList.add('active');
                    
                    // Update URL with the current tab
                    const url = new URL(window.location);
                    url.searchParams.set('tab', tabId);
                    window.history.pushState({}, '', url);
                }
            }

            // Handle tab clicks
            tabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    switchTab(tab.dataset.tab);
                });
            });

            // Set initial active tab from URL or default to 'active-users'
            const urlParams = new URLSearchParams(window.location.search);
            const initialTab = urlParams.get('tab') || 'active-users';
            switchTab(initialTab);

            // Handle browser back/forward buttons
            window.addEventListener('popstate', () => {
                const urlParams = new URLSearchParams(window.location.search);
                const currentTab = urlParams.get('tab') || 'active-users';
                switchTab(currentTab);
            });

            // Delete confirmation
            document.querySelectorAll('.delete-form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    if (!confirm('Are you sure you want to delete this user account? This action cannot be undone.')) {
                        e.preventDefault();
                    }
                });
            });

            // Restore confirmation
            document.querySelectorAll('.restore-form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    if (!confirm('Are you sure you want to restore this user account?')) {
                        e.preventDefault();
                    }
                });
            });
        });
    </script>
@endsection