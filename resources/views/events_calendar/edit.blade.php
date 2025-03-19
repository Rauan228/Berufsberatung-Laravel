<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit event</title>
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
            background: #ffc107;
            /* Желтый цвет */
            color: white;
        }

        button:hover {
            background: #e0a800;
            /* Темно-желтый при наведении */
            transform: scale(1.05);
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Edit event</h2>
        <form action="{{ route('events.update', $event->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label for="event_name">Event name:</label>
            <input type="text" name="event_name" value="{{ $event->event_name }}" required>

            <label for="event_date">Event date:</label>
            <input type="datetime-local" name="event_date" value="{{ $event->event_date }}" required>

            <label for="institution_id">Institution:</label>
            <select name="institution_id">
                @foreach ($institutions as $institution)
                    <option value="{{ $institution->id }}" 
                        {{ $event->institution_id == $institution->id ? 'selected' : '' }}>
                        {{ $institution->name }}
                    </option>
                @endforeach
            </select>

            <label for="description">Discription:</label>
            <textarea name="description" rows="3">{{ $event->description }}</textarea>

            <button type="submit">Update</button>
        </form>
    </div>
</body>

</html>
