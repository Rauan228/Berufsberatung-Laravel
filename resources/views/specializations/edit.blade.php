<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Редактировать специализацию</h1>

    <form action="{{ route('specializations.update', $specialization) }}" method="POST">
        @csrf
        @method('PUT')
        <label>Название:</label>
        <input type="text" name="name" value="{{ $specialization->name }}" required>

        <label>Квалификация:</label>
        <select name="qualification_id" required>
            @foreach($qualifications as $qualification)
                <option value="{{ $qualification->id }}" {{ $specialization->qualification_id == $qualification->id ? 'selected' : '' }}>
                    {{ $qualification->name }}
                </option>
            @endforeach
        </select>

        <button type="submit">Сохранить</button>
    </form>

    <a href="{{ route('specializations.index') }}">Назад</a>
</body>
</html>