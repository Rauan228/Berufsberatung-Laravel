<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Добавить специализацию</title>
</head>
<body>
    <h1>Добавить специализацию</h1>

    <form action="{{ route('specializations.store') }}" method="POST">
        @csrf
        <div>
            <label for="name">Название:</label>
            <input type="text" id="name" name="name" required>
        </div>

        <div>
            <label for="qualification_id">Квалификация:</label>
            <select id="qualification_id" name="qualification_id" required style="padding: 0 100px 0 100px"> 
                <option value="" disabled selected>Выберите квалификацию</option>
                @foreach($qualifications as $qualification)
                    <option style="padding: 0 100px 0 100px;" value="{{ $qualification->id }}">{{ $qualification->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit">Добавить</button>
    </form>

    <a href="{{ route('specializations.index') }}">Назад</a>
</body>
</html>
