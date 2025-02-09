@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.11.3/main.min.css">



    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
        }
        .main-content {
            flex-grow: 1;
            padding: 20px;
            margin: 0 0 0 300px
        }

        

        .institutes-count,
        .latest_grade,
        .users-count,
        .specialties-count {
            background: #f0f0f0;
            padding: 0 5% 0 5%;
            margin: 30px 10px 0 10px;
            text-align: center;
            border-radius: 8px;
            font-size: 18px;
            font-weight: bold;
        }

        .counts {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
            max-width: 100%;
            margin: auto;
        }

        .chart-btn {
            background: #34495e;
            color: white;
            font-size: 16px;
            border: none;
            padding: 10px;
            margin: 5px 0;
            text-align: left;
            cursor: pointer;
            transition: background 0.3s ease-in-out;
        }

        .chart-btn:hover {
            background: #2980b9;
        }

        .chart-btn.active {
            background-color: green;
            color: white;
        }

        .charts {
            margin: 50px 240px 0 0;
            width: 80%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .calendar-container {
            max-width: 900px;
            margin: 30px auto;
            padding: 50px;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        #calendar {
            font-family: Arial, sans-serif;
            background: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 40px;
            border-radius: 8px;
            width: 100%;
            min-height: 600px;
            /* Увеличиваем высоту */
        }

        /* Увеличение ширины календаря */
        .fc-view-container {
            width: 200% !important;
        }

        /* Стили для кнопок FullCalendar */
        .fc .fc-button {
            background: #007bff !important;
            color: #fff !important;
            border-radius: 6px !important;
            border: none !important;
            padding: 8px 12px !important;
            font-size: 14px !important;
            font-weight: bold;
            transition: all 0.3s ease-in-out;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.15);
            width: 80px;
            height: 50px;
        }

        .fc .fc-button:hover {
            background: #0056b3 !important;
            transform: scale(1.05);
        }

        /* Стилизация событий */
        .fc-daygrid-event {
            background: rgba(0, 123, 255, 0.5) !important;
            border: none;
            border-radius: 50%;
            padding: 20px;
            z-index: 1;
            transition: all 0.3s ease-in-out;
            color: transparent !important;
            /* Скрыть текст */
            position: absolute;
            margin: -30px 0 0 -10px;
        }

        .fc .fc-daygrid-day {
            padding: 35px;
            /* Больше расстояние между днями */
        }



        .calendar-controls {
            display: flex;
            justify-content: center;
            gap: 20px;
            /* Увеличиваем расстояние между кнопками */
            margin-bottom: 20px;
        }

        #event-title-overlay {
            position: absolute;
            top: 600px;
            /* Опускаем ниже */
            left: 50%;
            transform: translateX(-50%);
            text-align: center;
        }


        .fc-button {
            background: #007bff !important;
            color: #fff !important;
            border-radius: 6px !important;
            border: none !important;
            padding: 8px 12px !important;
            font-size: 14px !important;
            font-weight: bold;
            transition: all 0.3s ease-in-out;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.15);
            width: 120px;
            height: 50px;
        }

        .fc-button:hover {
            transform: scale(1.05);
        }

        .fc-daygrid-day-number {
            position: relative;
            z-index: 3;
        }

        .fc-daygrid-day-number::after {
            content: "";
            position: absolute;
            top: 50%;
            left: 50%;
            width: 30px;
            /* Размер круга */
            height: 30px;
            border-radius: 50%;
            transform: translate(-50%, -50%);
            pointer-events: none;
            z-index: 2;
        }

        #event-title-overlay {
            position: absolute;
            top: calc(100% + 10px);
            /* Под кнопкой "Сегодня" */
            left: 50%;
            color: #fff;
            padding: 10px;
            border-radius: 6px;
            z-index: 1000;
        }

        .fc-daygrid-day-number {
            position: relative;
            z-index: 3;
        }

        .fc-daygrid-day-number::before {
            content: "";
            position: absolute;
            top: 50%;
            left: 50%;
            width: 30px;
            /* Размер круга */
            height: 30px;
            border-radius: 50%;
            transform: translate(-50%, -50%);
            pointer-events: none;
        }
    </style>
</head>

<body>

    {{-- <div class="sidebar">
        <div class="navbar"><svg width="40" height="40" style="margin: 0 20px 0 0" viewBox="0 0 65 40" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M0.512 36V3.36H10.448C12.88 3.36 14.8 3.712 16.208 4.416C17.648 5.12 18.672 6.112 19.28 7.392C19.92 8.672 20.24 10.176 20.24 11.904V13.248C20.24 15.776 19.152 17.712 16.976 19.056C18.512 19.664 19.68 20.544 20.48 21.696C21.28 22.848 21.68 24.224 21.68 25.824V27.168C21.68 28.928 21.36 30.48 20.72 31.824C20.08 33.136 19.024 34.16 17.552 34.896C16.08 35.632 14.112 36 11.648 36H0.512ZM10.448 8.64H6.272V16.8H10.448C11.728 16.8 12.688 16.512 13.328 15.936C14 15.328 14.336 14.512 14.336 13.488V11.904C14.336 10.88 14 10.08 13.328 9.504C12.688 8.928 11.728 8.64 10.448 8.64ZM11.648 22.08H6.272V30.72H11.648C12.992 30.72 14.016 30.4 14.72 29.76C15.424 29.12 15.776 28.256 15.776 27.168V25.584C15.776 24.496 15.424 23.648 14.72 23.04C14.016 22.4 12.992 22.08 11.648 22.08ZM28.5901 0.48H34.1101V46.224H28.5901V0.48ZM43.1214 36V3.36H53.0574C55.4894 3.36 57.4094 3.712 58.8174 4.416C60.2574 5.12 61.2814 6.112 61.8894 7.392C62.5294 8.672 62.8494 10.176 62.8494 11.904V13.248C62.8494 15.776 61.7614 17.712 59.5854 19.056C61.1214 19.664 62.2894 20.544 63.0894 21.696C63.8894 22.848 64.2894 24.224 64.2894 25.824V27.168C64.2894 28.928 63.9694 30.48 63.3294 31.824C62.6894 33.136 61.6334 34.16 60.1614 34.896C58.6894 35.632 56.7214 36 54.2574 36H43.1214ZM53.0574 8.64H48.8814V16.8H53.0574C54.3374 16.8 55.2974 16.512 55.9374 15.936C56.6094 15.328 56.9454 14.512 56.9454 13.488V11.904C56.9454 10.88 56.6094 10.08 55.9374 9.504C55.2974 8.928 54.3374 8.64 53.0574 8.64ZM54.2574 22.08H48.8814V30.72H54.2574C55.6014 30.72 56.6254 30.4 57.3294 29.76C58.0334 29.12 58.3854 28.256 58.3854 27.168V25.584C58.3854 24.496 58.0334 23.648 57.3294 23.04C56.6254 22.4 55.6014 22.08 54.2574 22.08Z"
                    fill="#BC0404" />
            </svg>
            Berufsberatung
        </div>
        <p>Admin: {{ $admin->name }}</p> <!-- Выведет имя текущего админа -->

        <button class="sidebar-home-btn" onclick="window.location.href='{{ route('home') }}'">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house"
                viewBox="0 0 19 13">
                <path
                    d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z" />
            </svg>
            Home
        </button>
        <a href="{{ route('notifications.index') }}">
            <button>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bell"
                    viewBox="0 0 19 13">
                    <path
                        d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2M8 1.918l-.797.161A4 4 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4 4 0 0 0-3.203-3.92zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5 5 0 0 1 13 6c0 .88.32 4.2 1.22 6" />
                </svg>
                Notifications
            </button>
        </a>

        <a href="{{ route('applications.index') }}">
            <button>
                <svg width="16px" height="16px" viewBox="4 -3 19 20" version="1.1" xmlns="http://www.w3.org/2000/svg">
                    <g id="layer1">
                        <path
                            d="M 4 3 L 4 9 L 5 9 L 5 7 L 19 7 L 19 16 L 5 16 L 5 14 L 4 14 L 4 17 L 20 17 L 20 3 L 4 3 z M 5 4 L 19 4 L 19 6 L 5 6 L 5 4 z M 8 8 L 11 11 L 0 11 L 0 12 L 11 12 L 8 15 L 9.5 15 L 13 11.5 L 9.5 8 L 8 8 z"
                            style="fill:#fff; fill-opacity:1; stroke:none; stroke-width:0px; margin: 0 10 0 0;" />
                    </g>
                </svg>
                Applications
            </button>
        </a>

        <a href="{{ route('users.index') }}">
            <button>
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
            <button>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-calendar-event" viewBox="0 0 19 13">
                <path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z"
                    style="fill:#fff; fill-opacity:1; stroke:none; stroke-width:0px; margin: 0 10 0 0;" />
                <path
                    d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z" />
            </svg>
            Events Calendar</button>
        </a>
        
        <button>
            <img width="18" height="20" src="https://img.icons8.com/?size=100&id=463&format=png&color=FFFFFF"
                alt="Review">
            <span>Reviews</span>
        </button>
        <button>
            <img width="18" height="20" src="https://img.icons8.com/ios/50/FFFFFF/university.png" alt="university" />
            Institutions</button>
        <button>
            <img width="18" height="20" src="https://img.icons8.com/ios/50/FFFFFF/facebook-like--v1.png"
                alt="facebook-like--v1" />
            Likes</button>
        <button>
            <img width="21" height="20" src="https://img.icons8.com/quill/100/FFFFFF/education.png" alt="education" />
            Institution Specialties</button>
        <button>
            <i class="bi bi-briefcase"></i>
            Global specialties</button>
        <button style="display: flex">
            <img width="21" height="21"
                src="https://img.icons8.com/external-glyph-silhouettes-icons-papa-vector/50/FFFFFF/external-Scholarship-black-glyph-icon-bonuses.-glyph.-silhouette-glyph-silhouettes-icons-papa-vector.png"
                alt="external-Scholarship-black-glyph-icon-bonuses.-glyph.-silhouette-glyph-silhouettes-icons-papa-vector" />
            Grants</button>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="logout">
                <i class="bi bi-box-arrow-right"></i> Logout
            </button>
        </form>


    </div> --}}
    <div class="main-content">
        <h1>Welcome to Admin Panel</h1>

        <div class="counts">
            <div class="institutes-count">
                <p>Institutes</p>
                <p>{{ $institutesCount }}</p>
            </div>
            <div class="users-count">
                <p>Users</p>
                <p>{{ $usersCount }}</p>
            </div>
            <div class="specialties-count">
                <p>Specialties</p>
                <p>{{ $specialtiesCount }}</p>
            </div>
            <div class="latest_grade">
                <!-- Проверяем, есть ли отзыв и есть ли у него связанный пользователь -->
                @if ($latestReview && $latestReview->user)
                    <!-- Выводим username пользователя сверху -->
                    <p><strong>{{ $latestReview->user->username }}</strong></p>

                    <!-- Текст отзыва -->
                    <p>{{ $latestReview->comment }}</p>
                @else
                    <p>No reviews yet</p>
                @endif
            </div>
        </div>



        
        
        
        <div class="charts">
            <div style="width: calc(100% - 300px); margin-left: 300px; height: 400px;">
                <canvas id="visitChart"></canvas>
            </div>
            <div style="text-align: center; margin: 10px 0 0 320px;">
                <button onclick="loadChart('days')" id="daysBtn" class="chart-btn">Days</button>
                <button onclick="loadChart('weeks')" id="weeksBtn" class="chart-btn">Weeks</button>
                <button onclick="loadChart('months')" id="monthsBtn" class="chart-btn">Months</button>
            </div>
        </div>
        
        <div class="calendar-container">
            <div id="calendar">
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales-all.min.js"></script>

    <script>
        let visitChart;

        function loadChart(type, updateUrl = true) {
            fetch(`/chart-data?type=${type}`)
                .then(response => response.json())
                .then(data => {
                    const ctx = document.getElementById('visitChart').getContext('2d');

                    if (visitChart) {
                        visitChart.destroy();
                    }

                    visitChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: data.labels,
                            datasets: [{
                                label: 'Visits',
                                data: data.data,
                                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                y: { beginAtZero: true }
                            }
                        }
                    });

                    // Убираем активный класс со всех кнопок
                    document.querySelectorAll('.chart-btn').forEach(btn => btn.classList.remove('active'));

                    // Добавляем активный класс к текущей кнопке
                    document.getElementById(type + 'Btn').classList.add('active');

                    if (updateUrl) {
                        history.pushState(null, '', `?chart=${type}`);
                    }
                });
        }

        document.addEventListener('DOMContentLoaded', () => {
            const params = new URLSearchParams(window.location.search);
            const chartType = params.get('chart') || 'days';
            loadChart(chartType, false);
        });

        window.addEventListener('popstate', () => {
            const params = new URLSearchParams(window.location.search);
            const chartType = params.get('chart') || 'days';
            loadChart(chartType, false);
        });


        // скрипт для календаря
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof FullCalendar === "undefined") {
                console.error("FullCalendar is not loaded!");
                return;
            }

            var calendarEl = document.getElementById('calendar');
            if (!calendarEl) {
                console.error("Element #calendar not found!");
                return;
            }

            var events = {!! json_encode($events, JSON_UNESCAPED_UNICODE) !!};

            var calendar = new FullCalendar.Calendar(calendarEl, {
                locale: 'en', // Set locale to English
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: '', // Убираем кнопки слева
                    center: 'title', // Заголовок по центру
                    right: '' // Убираем кнопки справа
                },
                events: events,
                eventContent: function () {
                    return { html: '' }; // Hide event title
                },
                eventDidMount: function (info) {
                    var eventDate = info.event.start.toISOString().split('T')[0];
                    var eventCell = document.querySelector(`[data-date="${eventDate}"] .fc-daygrid-day-number`);
                    if (eventCell) {
                        eventCell.style.position = 'relative';
                        eventCell.style.zIndex = '1';
                        eventCell.style.borderRadius = '50%';
                    }
                },
                eventMouseEnter: function (info) {
                    // Находим кнопку "Сегодня"
                    var todayButton = document.querySelector('.fc-today-button');

                    if (!todayButton) return; // Если кнопки нет, выходим

                    // Получаем координаты кнопки
                    var rect = todayButton.getBoundingClientRect();

                    // Создаём всплывающее окно
                    var eventTitle = document.createElement('div');
                    eventTitle.id = 'event-title-overlay';
                    eventTitle.style.position = 'absolute';
                    eventTitle.style.top = `${rect.bottom + window.scrollY + 5}px`; // Чуть ниже кнопки
                    eventTitle.style.left = `${rect.left + window.scrollX + 60}px`; // Выровнено с кнопкой
                    eventTitle.style.width = `${rect.width}px`; // Чтобы совпадало по ширине
                    eventTitle.style.textAlign = 'center';
                    eventTitle.style.background = 'rgba(0, 123, 255, 0.8)';
                    eventTitle.style.color = '#fff';
                    eventTitle.style.padding = '10px';
                    eventTitle.style.borderRadius = '6px';
                    eventTitle.style.zIndex = '1000';
                    eventTitle.innerText = info.event.title;

                    // Добавляем в .calendar-controls
                    document.querySelector('.calendar-controls').appendChild(eventTitle);
                },

                // Удаляем окно при уходе мыши
                eventMouseLeave: function () {
                    var eventTitle = document.getElementById('event-title-overlay');
                    if (eventTitle) {
                        eventTitle.remove();
                    }
                }

            });

            calendar.render();

            // Добавляем кастомные кнопки
            const controlsContainer = document.createElement('div');
            controlsContainer.classList.add('calendar-controls');

            const prevButton = document.createElement('button');
            prevButton.classList.add('fc-button', 'fc-prev-button');
            prevButton.innerText = '←';
            prevButton.addEventListener('click', function () {
                calendar.prev();
            });

            const todayButton = document.createElement('button');
            todayButton.classList.add('fc-button', 'fc-today-button');
            todayButton.innerText = 'Today';
            todayButton.addEventListener('click', function () {
                calendar.today();
            });

            const nextButton = document.createElement('button');
            nextButton.classList.add('fc-button', 'fc-next-button');
            nextButton.innerText = '→';
            nextButton.addEventListener('click', function () {
                calendar.next();
            });

            controlsContainer.appendChild(prevButton);
            controlsContainer.appendChild(todayButton);
            controlsContainer.appendChild(nextButton);

            // Вставляем контейнер с кнопками перед календарем
            calendarEl.parentNode.insertBefore(controlsContainer, calendarEl);


        });


    </script>
</body>

</html>
@endsection