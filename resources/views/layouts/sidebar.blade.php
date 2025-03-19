<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .sidebar {
            width: 250px;
            background-color: #2c3e50;
            color: white;
            padding: 20px;
            height: 100%;
            position: fixed;
        }

        .sidebar button {
            background: #34495e;
            color: white;
            font-size: 16px;
            border: none;
            padding: 10px;
            margin: 5px 0;
            width: 100%;
            text-align: left;
            cursor: pointer;
            display: flex;
            align-items: center;
        }

        .sidebar button:hover {
            background: #2980b9;
        }

        .sidebar button.active {
            background: #2980b9;
            font-weight: bold;
            border-left: 4px solid #bc0404;
        }

        .sidebar button svg {
            margin-right: 8px;
        }

        .sidebar a {
            text-decoration: none;
        }

        .sidebar button,
        .dropdown .btn-primary {
            margin: 20px 0;
            /* Увеличенный вертикальный отступ */
        }


        .dropdown {
            position: relative;
        }

        .dropdown .btn-primary {
            background: #34495e;
            color: white;
            font-size: 16px;
            border: none;
            padding: 10px;
            margin: 5px 0;
            width: 100%;
            text-align: left;
            cursor: pointer;
            display: flex;
            align-items: center;
        }

        .dropdown .btn-primary:hover {
            background: #34495e;
        }

        .dropdown .arrow {
            margin-left: auto;
            transition: transform 0.3s ease;
        }

        .dropdown.show .arrow {
            transform: rotate(90deg);
        }

        .dropdown-menu {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 8px 0;
            min-width: 200px;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease, transform 0.3s ease;
            transform: translateY(-10px);
            position: absolute;
            z-index: 1000;
            display: none;
            top: 100%;
            left: 0;
        }

        .dropdown.show .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
            display: block;
        }

        .dropdown-menu li {
            list-style: none;
            margin: 0;
        }

        .dropdown-menu .dropdown-item {
            color: #333;
            padding: 8px 16px;
            text-decoration: none;
            display: block;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .dropdown-menu .dropdown-item:hover {
            background-color: #f8f9fa;
            color: #007bff;
        }

        .dropdown-menu .dropdown-item.active {
            background-color: #2980b9;
            color: white;
        }

        /* Отдельный стиль для кнопки "Logout" */
        .sidebar .logout-button {
            background: #bc0404;
            color: white;
            font-weight: bold;
            border-radius: 5px;
            transition: background 0.3s ease, transform 0.3s ease;
            /* Добавил плавное увеличение */
        }

        .sidebar .logout-button:hover {
            background: #a00000;
            transform: scale(1.1);
            /* Увеличение кнопки */
        }

        .navbar {
            display: flex;
            flex-direction: row;
            align-items: center
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <div class="navbar">
            <img src="B_B.png" alt="logo" style="width: 30px">
            <span style="font-size:25px; font-weight: bold; color:#bc0404; margin-left:15px ">Berufsberatung</span>
        </div>
        {{-- <p style="font-size: 25px">Admin: {{ $admin->name }}</p> <!-- Выведет имя текущего админа --> --}}
        <a href="{{ route('home') }}">
            <button class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house"
                    viewBox="0 0 19 13">
                    <path
                        d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z" />
                </svg>
                Home
            </button>
        </a>

        <a href="{{ route('notifications.index') }}">
            <button class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bell"
                    viewBox="0 0 19 13">
                    <path
                        d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2M8 1.918l-.797.161A4 4 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4 4 0 0 0-3.203-3.92zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5 5 0 0 1 13 6c0 .88.32 4.2 1.22 6" />
                </svg>
                Notifications
            </button>
        </a>

        <div class="dropdown">
            <button class="btn btn-primary">
                <svg width="16px" height="16px" viewBox="4 -3 19 20" version="1.1" xmlns="http://www.w3.org/2000/svg">
                    <g id="layer1">
                        <path
                            d="M 4 3 L 4 9 L 5 9 L 5 7 L 19 7 L 19 16 L 5 16 L 5 14 L 4 14 L 4 17 L 20 17 L 20 3 L 4 3 z M 5 4 L 19 4 L 19 6 L 5 6 L 5 4 z M 8 8 L 11 11 L 0 11 L 0 12 L 11 12 L 8 15 L 9.5 15 L 13 11.5 L 9.5 8 L 8 8 z"
                            style="fill:#fff; fill-opacity:1; stroke:none; stroke-width:0px; margin: 0 10 0 0;" />
                    </g>
                </svg>
                Applications
                <span class="arrow">&#8250;</span>
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ route('applications.user_applications.index') }}">User
                        Applications</a></li>
                <li><a class="dropdown-item"
                        href="{{ route('applications.institution_applications.index') }}">Institution Applications</a>
                </li>
            </ul>
        </div>

        <a href="{{ route('users.index') }}">
            <button class="btn btn-primary">
                <svg width="16px" height="16px" viewBox="4 -3 19 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M13 20V18C13 15.2386 10.7614 13 8 13C5.23858 13 3 15.2386 3 18V20H13ZM13 20H21V19C21 16.0545 18.7614 14 16 14C14.5867 14 13.3103 14.6255 12.4009 15.6311M11 7C11 8.65685 9.65685 10 8 10C6.34315 10 5 8.65685 5 7C5 5.34315 6.34315 4 8 4C9.65685 4 11 5.34315 11 7ZM18 9C18 10.1046 17.1046 11 16 11C14.8954 11 14 10.1046 14 9C14 7.89543 14.8954 7 16 7C17.1046 7 18 7.89543 18 9Z"
                        style="fill:#fff; stroke:none; stroke-width:0px; margin: 0 10 0 0;" stroke="#000000"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                Users
            </button>
        </a>

        <a href="{{ url('/events') }}">
            <button class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-calendar-event" viewBox="0 0 19 13">
                    <path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z"
                        style="fill:#fff; fill-opacity:1; stroke:none; stroke-width:0px; margin: 0 10 0 0;" />
                    <path
                        d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z" />
                </svg>
                Events Calendar
            </button>
        </a>

        <a href="{{ route('reviews.index') }}">
            <button class="btn btn-primary">
                <img width="18" height="20" src="https://img.icons8.com/?size=100&id=463&format=png&color=FFFFFF"
                    alt="Review">
                <span>Reviews</span>
            </button>
        </a>

        <a href="{{ route('institutions.index') }}">
            <button class="btn btn-primary">
                <img width="18" height="20" src="https://img.icons8.com/ios/50/FFFFFF/university.png"
                    alt="university" />
                Institutions
            </button>
        </a>

        <a href="{{ route('likes.index') }}">
            <button class="btn btn-primary">
                <img width="18" height="20" src="https://img.icons8.com/ios/50/FFFFFF/facebook-like--v1.png"
                    alt="facebook-like--v1" />
                Likes
            </button>
        </a>

        <a href="{{ route('global_specialties.index') }}">
            <button class="btn btn-primary">
                <i class="bi bi-briefcase"></i>
                Global specialties
            </button>
        </a>

        <a href="{{ route('qualifications.index') }}">
            <button class="btn btn-primary">
                <i class="bi bi-award"></i>
                Qualifications
            </button>
        </a>

        <a href="{{ route('specializations.index') }}">
            <button class="btn btn-primary">
                <img width="21" height="20" src="https://img.icons8.com/quill/100/FFFFFF/education.png"
                    alt="education" />
                Speciality
            </button>
        </a>

        <a href="{{ route('grants.index') }}">
            <button class="btn btn-primary">
                <img width="21" height="21"
                    src="https://img.icons8.com/external-glyph-silhouettes-icons-papa-vector/50/FFFFFF/external-Scholarship-black-glyph-icon-bonuses.-glyph.-silhouette-glyph-silhouettes-icons-papa-vector.png"
                    alt="external-Scholarship-black-glyph-icon-bonuses.-glyph.-silhouette-glyph-silhouettes-icons-papa-vector" />
                Grants
            </button>
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>

        <button class="logout-button" onclick="document.getElementById('logout-form').submit();">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M10 15a1 1 0 0 1-1-1v-3H5a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h4V2a1 1 0 0 1 1.707-.707l5 5a1 1 0 0 1 0 1.414l-5 5A1 1 0 0 1 10 15zm1-6V7H5v2h6zm2-1a.5.5 0 0 0 0-1H5a.5.5 0 0 0 0 1h8z" />
            </svg>
            Logout
        </button>


    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Подсветка активной кнопки
            const currentUrl = window.location.href;
            const sidebarLinks = document.querySelectorAll('.sidebar a');

            sidebarLinks.forEach(link => {
                if (link.href === currentUrl) {
                    link.querySelector('button').classList.add('active');
                }
            });

            // Обработка выпадающего списка
            const dropdownButton = document.querySelector('.dropdown .btn-primary');
            const dropdownMenu = document.querySelector('.dropdown-menu');
            const dropdown = document.querySelector('.dropdown');

            dropdownButton.addEventListener('click', function (event) {
                event.stopPropagation();
                dropdown.classList.toggle('show');
            });

            document.addEventListener('click', function (event) {
                if (!dropdown.contains(event.target)) {
                    dropdown.classList.remove('show');
                }
            });

            // Подсветка активного элемента в выпадающем списке
            const dropdownLinks = document.querySelectorAll('.dropdown-menu a');
            dropdownLinks.forEach(link => {
                if (link.href === currentUrl) {
                    link.classList.add('active');
                }
            });
        });
    </script>
</body>

</html>