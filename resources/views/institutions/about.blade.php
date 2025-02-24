<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Подробнее об институте</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #111;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f8f9fa;
            height: 100vh;
            margin: 0;
        }

        .container {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            padding: 20px;
            border-radius: 10px;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            animation: fadeIn 0.5s ease-in-out;
            text-align: center;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        h2 {
            margin-bottom: 15px;
        }

        p {
            font-size: 16px;
            margin-bottom: 10px;
        }

        a {
            display: inline-block;
            padding: 10px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            transition: 0.3s;
        }

        .btn-primary {
            background: #007bff;
            color: white;
        }

        .btn-primary:hover {
            background: #0056b3;
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
            margin-top: 10px;
        }

        .btn-secondary:hover {
            background: #5a6268;
        }

        /* Прокручиваемый список специальностей */
        .specializations-container {
            max-height: 200px; 
            overflow-y: auto;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            background: white;
            text-align: left;
        }

        .qualification {
            font-weight: bold;
            margin-top: 10px;
            padding: 5px;
            background: #e9ecef;
            border-radius: 5px;
        }

        .specialization-item {
            padding: 5px 0;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
        }

        .specialization-item:last-child {
            border-bottom: none;
        }

        .details {
            font-size: 14px;
            color: #555;
        }
        .status {
        font-weight: bold;
        padding: 5px 10px;
        border-radius: 5px;
        display: inline-block;
    }

    .status-accepted {
        background-color: #28a745; /* Зеленый */
        color: white;
    }

    .status-pending {
        background-color: #ffc107; /* Желтый */
        color: black;
    }

    .status-rejected {
        background-color: #dc3545; /* Красный */
        color: white;
    }
    </style>
</head>
<body>
    <div class="container">
        <h2>{{ $institution->name }}</h2>
        <p><strong>Описание:</strong> {{ $institution->description1 }}</p>
        <p><strong>Локация:</strong> {{ $institution->location }}</p>
        <p><strong>Сайт:</strong>
            @if($institution->website)
                <a href="{{ $institution->website }}" class="btn-primary" target="_blank">Перейти на сайт</a>
            @endif
        </p>
        <p><strong>Статус:</strong> 
            <span class="status 
                @if($institution->verified == 'accepted') status-accepted 
                @elseif($institution->verified == 'pending') status-pending 
                @elseif($institution->verified == 'rejected') status-rejected 
                @endif">
                {{ ucfirst($institution->verified) }}
            </span>
        </p>

        <p><strong>Специальности:</strong></p>
        <div class="specializations-container">
            @foreach($institution->specializations->groupBy('qualification.name') as $qualification => $specializations)
                <div class="qualification">{{ $qualification }}</div>
                @foreach($specializations as $specialization)
                    <div class="specialization-item">
                        <span>{{ $specialization->name }}</span>
                        <span class="details">
                            {{ $specialization->pivot->cost }} тг / {{ $specialization->pivot->duration }} мес
                        </span>
                    </div>
                @endforeach
            @endforeach
        </div>

        <a href="{{ route('institutions.index') }}" class="btn-secondary">Вернуться к списку</a>
    </div>
</body>
</html>
