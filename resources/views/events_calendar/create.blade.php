<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create event</title>
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
        select,
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
        select:focus,
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
            background: #28a745;
            /* Зеленый цвет */
            color: white;
        }

        button:hover {
            background: #218838;
            /* Темно-зеленый при наведении */
            transform: scale(1.05);
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Create an event</h2>
        <form action="{{ route('events.store') }}" method="POST">
            @csrf
            <label for="institution_id">Select institution:</label>
            <select id="institution_id" name="institution_id">
                <option value="">-- Select institution --</option>
                @foreach ($institutions as $institution)
                    <option value="{{ $institution->id }}">{{ $institution->name }}</option>
                @endforeach
            </select>

            <label for="event_name">Event name:</label>
            <input type="text" name="event_name" required>

            <label for="event_date">Event date:</label>
            <input type="datetime-local" name="event_date" required>

            <label for="description">Description:</label>
            <textarea name="description" rows="3"></textarea>

            <button type="submit">Add event</button>
        </form>
    </div>
</body>

</html>