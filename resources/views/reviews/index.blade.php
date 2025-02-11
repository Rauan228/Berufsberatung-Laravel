@extends('layouts.app')

@section('content')
<div class="main-content">
    <h1>Reviews</h1>

    @if ($reviews->isEmpty())
        <p>There are no reviews yet.</p>
    @else
        <ul>
            @foreach ($reviews as $review)
                <li class="event-card">
                    <strong style="font-size: 22px;">{{ $review->user->username }}</strong>
                    <br>
                    <span style="font-size: 18px;">{{ $review->comment }}</span>
                    <br>
                    <small class="text-muted">{{ $review->created_at->format('d.m.Y H:i') }}</small>
                    <br>

                    <!-- Вывод рейтинга в виде звезд -->
                    <div class="rating">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $review->rating)
                                <i class="fas fa-star filled"></i> <!-- Заполненная звезда -->
                            @else
                                <i class="far fa-star"></i> <!-- Пустая звезда -->
                            @endif
                        @endfor
                    </div>

                    <!-- Кнопка удаления -->
                    <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" class="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Вы уверены, что хотите удалить этот отзыв?');">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </form>
                </li>
            @endforeach
        </ul>
    @endif
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

<style>
    .main-content {
        margin-left: 300px;
        padding: 20px;
        flex-grow: 1;
        width: 80%;
    }

    ul {
        list-style-type: none;
        padding: 0;
    }

    li {
        background-color: #fff;
        margin: 10px 0;
        padding: 10px;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        width: 50%;
    }

    /* Стили для звездочек */
    .rating {
        font-size: 20px;
        color: #f39c12;
        margin-top: 10px;
    }

    .rating .filled {
        color: #f39c12;
    }

    /* Кнопка удаления */
    .btn-danger {
        background: #c82333;
        color: white;
        border: none;
        padding: 5px 10px;
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
        margin-top: 10px;
    }

    .btn-danger:hover {
        background: #a71d2a;
    }
</style>
@endsection