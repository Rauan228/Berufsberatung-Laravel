<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить квалификацию</title>
</head>
<body>
    <div class="container">
        <h2>Добавить квалификацию</h2>
        <form action="{{ route('qualifications.store') }}" method="POST">
            @csrf
            <label for="qualification_name">Название квалификации:</label>
            <input type="text" id="qualification_name" name="qualification_name" required>

            <label for="global_specialty_id">Специальность:</label>
            <select id="global_specialty_id" name="global_specialty_id" required>
                <option value="" disabled selected>Выберите специальность</option>
                @foreach($specialties as $specialty)
                    <option value="{{ $specialty->id }}">{{ $specialty->name }}</option>
                @endforeach
            </select>

            <button type="submit">Сохранить</button>
        </form>
        <a href="{{ route('qualifications.index') }}" class="cancel-button">Отмена</a>
    </div>
</body>
</html>
