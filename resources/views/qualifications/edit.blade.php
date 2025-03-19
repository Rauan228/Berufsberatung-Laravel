<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактировать квалификацию</title>
</head>
<body>
    <div class="container">
        <h2>Редактировать квалификацию</h2>
        <form action="{{ route('qualifications.update', $qualification) }}" method="POST">
            @csrf
            @method('PUT')

            <label for="qualification_name">Название квалификации:</label>
            <input type="text" id="qualification_name" name="qualification_name" value="{{ $qualification->qualification_name }}" required>

            <label for="global_specialty_id">Специальность:</label>
            <select id="global_specialty_id" name="global_specialty_id" required>
                @foreach($specialties as $specialty)
                    <option value="{{ $specialty->id }}" {{ $qualification->global_specialty_id == $specialty->id ? 'selected' : '' }}>
                        {{ $specialty->name }}
                    </option>
                @endforeach
            </select>

            <button type="submit">Сохранить</button>
        </form>
        <a href="{{ route('qualifications.index') }}" class="cancel-button">Отмена</a>
    </div>
</body>
</html>
