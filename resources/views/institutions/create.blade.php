<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Создать новый институт</h1>
    <form action="{{ route('institutions.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Название *</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
        </div>
        <div class="form-group">
            <label for="description">Описание</label>
            <textarea name="description" id="description" class="form-control" rows="3">{{ old('description') }}</textarea>
        </div>
        <div class="form-group">
            <label for="location">Локация</label>
            <input type="text" name="location" id="location" class="form-control" value="{{ old('location') }}">
        </div>
        <div class="form-group">
            <label for="website">Сайт</label>
            <input type="url" name="website" id="website" class="form-control" value="{{ old('website') }}">
        </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
        <a href="{{ route('institutions.index') }}" class="btn btn-secondary">Отмена</a>
    </form>
</body>
</html>