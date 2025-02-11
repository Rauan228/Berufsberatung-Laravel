<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <h2>Редактировать событие</h2>
        <form action="{{ route('events.update', $event->id) }}" method="POST">
            @csrf
            @method('PUT')
    
            <div class="form-group">
                <label>Название события</label>
                <input type="text" name="event_name" class="form-control" value="{{ $event->event_name }}" required>
            </div>
    
            <div class="form-group">
                <label>Дата</label>
                <input type="datetime-local" name="event_date" class="form-control" value="{{ $event->event_date }}" required>
            </div>
    
            <div class="form-group">
                <label>Университет</label>
                <select name="institution_id" class="form-control" style="width: 100%; max-width: 500px;">
                    @foreach ($institutions as $institution)
                        <option value="{{ $institution->id }}" 
                            {{ $event->institution_id == $institution->id ? 'selected' : '' }}>
                            {{ $institution->name }}
                        </option>
                    @endforeach
                </select>
            </div>
    
            <div class="form-group">
                <label>Описание</label>
                <textarea name="description" class="form-control">{{ $event->description }}</textarea>
            </div>
    
            <button type="submit" class="btn btn-warning">Обновить</button>
        </form>
    </div>
</body>
</html>
