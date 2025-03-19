<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить уведомление</title>
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
            max-width: 400px;
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
            text-align: center;
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
            text-align: left;
        }

        input,
        textarea {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            outline: none;
            font-size: 16px;
            margin-bottom: 10px;
            transition: 0.3s;
            background-color: #dcdddf;
        }

        input:focus,
        textarea:focus {
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
            background: rgba(255, 255, 255, 0.1);
        }

        .button-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            margin-top: 10px;
        }

        button, 
        .cancel-button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        button {
            background: #28a745;
            color: white;
        }

        button:hover {
            background: #218838;
            transform: scale(1.05);
        }

        .cancel-button {
            background: #dc3545;
            color: white;
        }

        .cancel-button:hover {
            background: #c82333;
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Добавить уведомление</h2>
        <form action="{{ route('notifications.store') }}" method="POST">
            @csrf
            <label for="user_id">ID пользователя *</label>
            <input type="text" name="user_id" id="user_id" required>

            <label for="event_id">ID события (не обязательно)</label>
            <input type="text" name="event_id" id="event_id">

            <label for="message">Сообщение *</label>
            <textarea name="message" id="message" rows="3" required></textarea>

            <div class="button-container">
                <button type="submit">Сохранить</button>
                <a href="{{ route('notifications.index') }}" class="cancel-button">Отмена</a>
            </div>
        </form>
    </div>
</body>
</html>