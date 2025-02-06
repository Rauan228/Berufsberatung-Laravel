<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить уведомление</title>
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        .main-content {
            width: 30%;
            margin: 5% 0 5% 35%;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #f9f9f9;
        }

        h1 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
        }
    </style>
</head>

<body>

    <div class="main-content">
        <h1>Добавить новое уведомление</h1>
        <form action="{{ route('notifications.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="user_id">ID пользователя</label>
                <input type="text" id="user_id" name="user_id" required>
            </div>

            <div class="form-group">
                <label for="event_id">ID события (не обязательно)</label>
                <input type="text" id="event_id" name="event_id">
            </div>

            <div class="form-group">
                <label for="message">Сообщение</label>
                <textarea id="message" name="message" required></textarea>
            </div>

            <button type="submit">Сохранить уведомление</button>
        </form>
    </div>
    
</body>

</html>
