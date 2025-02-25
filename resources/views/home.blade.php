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
            width: 85%;
            flex-grow: 1;
            padding: 20px;
            margin: 0 0 0 300px
        }

        

        .institutes-count,
        .latest_grade,
        .users-count,
        .events-count,
        .specialties-count
         {
            background: #f0f0f0;
            padding: 0 5% 0 5%;
            margin: 30px 10px 0 10px;
            text-align: center;
            border-radius: 8px;
            font-size: 18px;
            font-weight: bold;
        }

        .counts-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    max-width: 100%;
    margin: auto;
}

.counts {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 10px;
    width: 100%;
}



.latest_grade {
    background: #f0f0f0;
    padding: 20px;
    text-align: center;
    border-radius: 8px;
    font-size: 18px;
    font-weight: bold;
    margin-top: 20px;
    width: 50%;
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

        .calendar-controls {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin-bottom: 20px;
}

#event-title-overlay {
    position: absolute;
    top: 600px;
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
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 100%;
}

.fc-daygrid-day-number::after {
    content: "";
    position: absolute;
    top: 50%;
    left: 50%;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    transform: translate(-50%, -50%);
    pointer-events: none;
    z-index: 2;
}

#event-title-overlay {
    position: absolute;
    top: calc(100% + 10px);
    left: 50%;
    color: #fff;
    padding: 10px;
    border-radius: 6px;
    z-index: 1000;
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
}

.fc-view-container {
    width: 200% !important;
}

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

.fc-daygrid-event {
    background: rgba(0, 123, 255, 0.5) !important;
    border: none;
    border-radius: 50%;
    padding: 20px;
    z-index: 1;
    transition: all 0.3s ease-in-out;
    color: transparent !important;
    position: absolute;
    margin: -30px 0 0 -10px;
}

.fc .fc-daygrid-day {
    padding: 35px;
}

.btn {
    flex: 1;
    font-size: 0.75rem;
    padding: 8px 12px;
    font-weight: bold;
    border-radius: 8px;
    transition: all 0.3s ease-in-out;
    text-transform: uppercase;
}

.btn:active {
    transform: scale(0.95);
}

.btn:hover {
    transform: scale(1.05);
}

    </style>
</head>

<body>

    <div class="main-content">
        <h1>Welcome to Admin Panel</h1>

        <div class="counts-container">
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
                    <p>{{ $specializationsCount }}</p>
                </div>
                <div class="events-count">
                    <p>Events</p>
                    <p>{{ $eventsCount }}</p>
                </div>
            </div>
            <div class="latest_grade">
                @if ($latestReview && $latestReview->user)
                    <p><strong>{{ $latestReview->user->username }}</strong></p>
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
        locale: 'en', // Устанавливаем локаль на английский
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: '', // Убираем кнопки слева
            center: 'title', // Заголовок по центру
            right: '' // Убираем кнопки справа
        },
        events: events,
        eventContent: function () {
            return { html: '' }; // Скрываем заголовок события
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
            var todayButton = document.querySelector('.fc-today-button');

            if (!todayButton) return;

            var rect = todayButton.getBoundingClientRect();

            var eventTitle = document.createElement('div');
            eventTitle.id = 'event-title-overlay';
            eventTitle.style.position = 'absolute';
            eventTitle.style.top = `${rect.bottom + window.scrollY + 5}px`;
            eventTitle.style.left = `${rect.left + window.scrollX + 60}px`;
            eventTitle.style.width = `${rect.width}px`;
            eventTitle.style.textAlign = 'center';
            eventTitle.style.background = 'rgba(0, 123, 255, 0.8)';
            eventTitle.style.color = '#fff';
            eventTitle.style.padding = '10px';
            eventTitle.style.borderRadius = '6px';
            eventTitle.style.zIndex = '1000';
            eventTitle.innerText = info.event.title;

            document.querySelector('.calendar-controls').appendChild(eventTitle);
        },
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

    calendarEl.parentNode.insertBefore(controlsContainer, calendarEl);
});



    </script>
</body>

</html>
@endsection