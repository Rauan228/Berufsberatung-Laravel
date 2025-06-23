@extends('app')

@section('content')
<!DOCTYPE html>
<html lang="ru">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Панель администратора</title>
    
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
        .universities-count,
        .colleges-count,
        .users-count,
        .events-count,
        .specialties-count,
        .latest_grade {
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
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
    width: 100%;
}

        /* Add specific colors for each type */
        .institutes-count {
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: white;
        }

        .universities-count {
            background: linear-gradient(135deg, #2ecc71, #27ae60);
            color: white;
        }

        .colleges-count {
            background: linear-gradient(135deg, #e74c3c, #c0392b);
            color: white;
        }

        .users-count {
            background: linear-gradient(135deg, #9b59b6, #8e44ad);
            color: white;
        }

        .events-count {
            background: linear-gradient(135deg, #f1c40f, #f39c12);
            color: white;
        }

        .specialties-count {
            background: linear-gradient(135deg, #1abc9c, #16a085);
            color: white;
        }

        /* Add hover effects */
        .institutes-count,
        .universities-count,
        .colleges-count,
        .users-count,
        .events-count,
        .specialties-count {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .institutes-count:hover,
        .universities-count:hover,
        .colleges-count:hover,
        .users-count:hover,
        .events-count:hover,
        .specialties-count:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        /* Add padding and improve text styling */
        .institutes-count p,
        .universities-count p,
        .colleges-count p,
        .users-count p,
        .events-count p,
        .specialties-count p {
            margin: 15px 0;
        }

        .institutes-count p:first-child,
        .universities-count p:first-child,
        .colleges-count p:first-child,
        .users-count p:first-child,
        .events-count p:first-child,
        .specialties-count p:first-child {
            font-size: 16px;
            opacity: 0.9;
        }

        .institutes-count p:last-child,
        .universities-count p:last-child,
        .colleges-count p:last-child,
        .users-count p:last-child,
        .events-count p:last-child,
        .specialties-count p:last-child {
            font-size: 24px;
    font-weight: bold;
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
    width: 150px;
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
    padding: 90px;
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
    background: transparent !important;
    border: none !important;
    opacity: 0;
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: auto;
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

.fc-daygrid-day.has-event .fc-daygrid-day-number {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background: #007bff;
    color: #fff;
    margin: 0 auto;
}

.fc-daygrid-day.fc-day-other .fc-daygrid-day-number { color: #bbb; }
.fc-daygrid-day.fc-day-other.has-event .fc-daygrid-day-number { background:none; color:#bbb; }

.fc-daygrid-event-harness, .fc-daygrid-event { height: 100% !important; width: 100% !important; }

    </style>
</head>

<body>

    <div class="main-content">
        <h1>Панель администратора</h1>

        <div class="counts-container">
            <div class="counts">
                <div class="institutes-count">
                    <p>Институты</p>
                    <p>{{ $institutesCount }}</p>
                </div>
                <div class="universities-count">
                    <p>Университеты</p>
                    <p>{{ $universitiesCount }}</p>
                </div>
                <div class="colleges-count">
                    <p>Колледжи</p>
                    <p>{{ $collegesCount }}</p>
                </div>
                <div class="users-count">
                    <p>Пользователи</p>
                    <p>{{ $usersCount }}</p>
                </div>
                <div class="specialties-count">
                    <p>Специальности</p>
                    <p>{{ $specializationsCount }}</p>
                </div>
                <div class="events-count">
                    <p>События</p>
                    <p>{{ $eventsCount }}</p>
                </div>
            </div>
            <div class="latest_grade">
                @if ($latestReview && $latestReview->user)
                    <p><strong>{{ $latestReview->user->username }}</strong></p>
                    <p>{{ $latestReview->comment }}</p>
                @else
                    <p>Пока отзывов нет</p>
                @endif
            </div>
        </div>
        



        
        
        
        <div class="charts">
            <div style="width: calc(100% - 300px); margin-left: 300px; height: 400px;">
                <canvas id="visitChart"></canvas>
            </div>
            <div style="text-align: center; margin: 10px 0 0 320px;">
                <button onclick="loadChart('days')" id="daysBtn" class="chart-btn">Дни</button>
                <button onclick="loadChart('weeks')" id="weeksBtn" class="chart-btn">Недели</button>
                <button onclick="loadChart('months')" id="monthsBtn" class="chart-btn">Месяцы</button>
            </div>
        </div>
        
        <div class="calendar-container">
            <div id="calendar">
            </div>
        </div>

        <!-- Test Results Line Chart -->
        <div class="charts">
            <div style="width: calc(100% - 300px); margin-left: 300px; height: 400px;">
                <canvas id="testChart"></canvas>
            </div>
            <div style="text-align: center; margin: 10px 0 0 320px;">
                <button onclick="loadTestChart('days')" id="testDaysBtn" class="chart-btn">Дни</button>
                <button onclick="loadTestChart('weeks')" id="testWeeksBtn" class="chart-btn">Недели</button>
                <button onclick="loadTestChart('months')" id="testMonthsBtn" class="chart-btn">Месяцы</button>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales-all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>

    <script>
        let visitChart;
        let testChart;

        // Register Chart.js DataLabels plugin if it is loaded
        if (window.ChartDataLabels) {
            Chart.register(ChartDataLabels);
        }

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
                                label: 'Посещения',
                                data: data.data,
                                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                datalabels: {
                                    anchor: 'end',
                                    align: 'end',
                                    color: '#000',
                                    font: {
                                        weight: 'bold'
                                    },
                                    formatter: function(value) {
                                        return value;
                                    }
                                }
                            },
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

        function loadTestChart(type, updateUrl = true) {
            fetch(`/test-chart-data?type=${type}`)
                .then(response => response.json())
                .then(data => {
                    const ctx = document.getElementById('testChart').getContext('2d');

                    if (testChart) {
                        testChart.destroy();
                    }

                    testChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: data.labels,
                            datasets: [{
                                label: 'Пройдено тестов',
                                data: data.data,
                                borderColor: 'rgba(75, 192, 192, 1)',
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                tension: 0.3,
                                fill: true
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                datalabels: {
                                    anchor: 'end',
                                    align: 'top',
                                    color: '#000',
                                    formatter: function (value) {
                                        return value;
                                    }
                                }
                            },
                            scales: {
                                y: { beginAtZero: true }
                            }
                        }
                    });

                    // Reset active states for this chart's buttons only
                    document.querySelectorAll('#testDaysBtn, #testWeeksBtn, #testMonthsBtn').forEach(btn => btn.classList.remove('active'));
                    document.getElementById('test' + type.charAt(0).toUpperCase() + type.slice(1) + 'Btn').classList.add('active');

                    if (updateUrl) {
                        const url = new URL(window.location.href);
                        url.searchParams.set('testChart', type);
                        history.pushState(null, '', url);
                    }
                });
        }

        document.addEventListener('DOMContentLoaded', () => {
            const params = new URLSearchParams(window.location.search);
            const chartType = params.get('chart') || 'days';
            loadChart(chartType, false);
            const testChartType = params.get('testChart') || 'days';
            loadTestChart(testChartType, false);
        });

        window.addEventListener('popstate', () => {
            const params = new URLSearchParams(window.location.search);
            const chartType = params.get('chart') || 'days';
            loadChart(chartType, false);
            const testChartType = params.get('testChart') || 'days';
            loadTestChart(testChartType, false);
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
        locale: 'ru', // Устанавливаем локаль на русский
        initialView: 'dayGridMonth',
        showNonCurrentDates: true,
        fixedWeekCount: true,
        firstDay: 1,
        headerToolbar: {
            left: '', // Убираем кнопки слева
            center: 'title', // Заголовок по центру
            right: '' // Убираем кнопки справа
        },
        events: events,
        eventContent: function () { return { html: '' }; },
        eventDidMount: function(info) {
            const dateStr = info.event.startStr.split('T')[0];
            const cell = document.querySelector(`[data-date="${dateStr}"]`);
            if (!cell) return;
            cell.classList.add('has-event');

            // store titles array in dataset
            const cleanTitle = info.event.title.replace(/\s*#\d+$/, '');
            const titles = cell.dataset.titles ? JSON.parse(cell.dataset.titles) : [];
            titles.push(cleanTitle);
            cell.dataset.titles = JSON.stringify(titles);

            // attach hover listeners once per cell
            if (!cell.dataset.tooltipBound) {
                cell.dataset.tooltipBound = 'true';
                cell.addEventListener('mouseenter', function(){
                    const tooltip = document.createElement('div');
                    tooltip.id = 'event-title-overlay';
                    const rect = cell.getBoundingClientRect();
                    tooltip.style.position = 'absolute';
                    tooltip.style.top = `${rect.top + window.scrollY - 35}px`;
                    tooltip.style.left = `${rect.left + window.scrollX}px`;
                    tooltip.style.padding = '6px 10px';
                    tooltip.style.background = 'rgba(0, 123, 255, 0.85)';
                    tooltip.style.color = '#fff';
                    tooltip.style.borderRadius = '4px';
                    tooltip.style.fontSize = '12px';
                    tooltip.style.whiteSpace = 'nowrap';
                    tooltip.style.zIndex = '1000';
                    tooltip.innerText = JSON.parse(cell.dataset.titles).join(', ');
                    document.body.appendChild(tooltip);
                });
                cell.addEventListener('mouseleave', function(){
                    const t = document.getElementById('event-title-overlay');
                    if (t) t.remove();
                });
            }

            // hide underlying event element to prevent default display
            info.el.style.display = 'none';
        },
        eventMouseEnter: null,
        eventMouseLeave: null,
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
    todayButton.innerText = 'Сегодня';
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