<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить специализацию</title>
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
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
            text-align: left;
        }
        input, select {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            outline: none;
            font-size: 16px;
            margin-bottom: 10px;
            background-color: #dcdddf;
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
            display: inline-block;
            width: 100%;
            text-align: center;
            padding: 10px;
            border-radius: 5px;
            font-size: 18px;
            font-weight: bold;
            text-decoration: none;
            transition: 0.3s;
            margin-top: 10px;
        }
        .cancel-button:hover {
            background: #c82333;
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Добавить специализацию</h2>
        <form action="{{ route('specializations.store') }}" method="POST">
            @csrf
            <label for="name">Название:</label>
            <input type="text" id="name" name="name" required>
            
            <label for="qualification_id">Квалификация:</label>
            <select id="qualification_id" name="qualification_id" required>
                <option value="" disabled selected>Выберите квалификацию</option>
                @foreach($qualifications as $qualification)
                    <option value="{{ $qualification->id }}">{{ $qualification->name }}</option>
                @endforeach
            </select>
            
            <button type="submit">Сохранить</button>
            <a href="{{ route('specializations.index') }}" class="cancel-button">Отмена</a>
        </form>
    </div>
</body>
</html>
