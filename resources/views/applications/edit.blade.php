@extends('layouts.app')

@section('content')
<div class="main-content">
    <h1>Редактирование заявки</h1>
    <form method="POST" action="{{ route('applications.update', $application) }}">
        @csrf
        @method('PUT')
        <label for="status">Статус:</label>
        <select name="status">
            <option value="Pending" {{ $application->status == 'Pending' ? 'selected' : '' }}>Ожидание</option>
            <option value="Accepted" {{ $application->status == 'Accepted' ? 'selected' : '' }}>Принята</option>
            <option value="Rejected" {{ $application->status == 'Rejected' ? 'selected' : '' }}>Отклонена</option>
        </select>

        <button type="submit">Сохранить</button>
    </form>
</div>
@endsection
