<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактировать институт</title>
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

        button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
            background: #ffc107;
            color: white;
        }

        button:hover {
            background: #e0a800;
            transform: scale(1.05);
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Редактировать институт</h2>
        <form action="{{ route('institutions.update', $institution->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label for="name">Название:</label>
            <input type="text" name="name" value="{{ old('name', $institution->name) }}" required>

            <label for="description">Описание:</label>
            <textarea name="description" rows="3">{{ old('description', $institution->description) }}</textarea>

            <label for="location">Локация:</label>
            <input type="text" name="location" value="{{ old('location', $institution->location) }}">

            <label for="website">Сайт:</label>
            <input type="url" name="website" value="{{ old('website', $institution->website) }}">

            <button type="submit">Обновить</button>
        </form>
    </div>
</body>

</html>
