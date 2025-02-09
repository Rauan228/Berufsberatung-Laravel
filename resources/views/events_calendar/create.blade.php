
<div class="container">
    <h2>Создать событие</h2>
    <form action="{{ route('events.store') }}" method="POST">
        @csrf
        <label for="institution_id">Выберите университет:</label>
        <select id="institution_id" name="institution_id" class="form-control" style="width: 100%; max-width: 300px;">
            <option value="">-- Выберите университет --</option>
            @foreach ($institutions as $institution)
                <option value="{{ $institution->id }}">{{ $institution->name }}</option>
            @endforeach
        </select>
    
        <label for="event_name">Название события:</label>
        <input type="text" name="event_name" required>
    
        <label for="event_date">Дата события:</label>
        <input type="datetime-local" name="event_date" required>
    
        <label for="description">Описание:</label>
        <textarea name="description"></textarea>
    
        <button type="submit">Добавить событие</button>
    </form>
    
</div>
