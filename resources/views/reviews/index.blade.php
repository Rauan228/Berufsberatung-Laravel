@extends('app')

@section('content')
    <div class="main-content">
        <h1>Отзывы</h1>

        @if ($reviews->isEmpty())
            <p>Отзывов пока нет.</p>
        @else
            <div class="grid-container">
                @foreach ($reviews as $review)
                    <div class="grid-item">
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
                                <i class="fas fa-trash"></i> Удалить
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>

            <div class="pagination d-flex align-items-center justify-content-center mt-4">
                @if ($reviews->total() > 0)
                    <p class="pagination-info">
                        Показано с {{ $reviews->firstItem() }} по {{ $reviews->lastItem() }} из {{ $reviews->total() }} результатов
                    </p>
                @endif

                <div class="pagination-buttons">
                    @if ($reviews->onFirstPage())
                        <span class="page-btn disabled">←</span>
                    @else
                        <a href="{{ $reviews->previousPageUrl() }}" class="page-btn">←</a>
                    @endif

                    @if ($reviews->hasMorePages())
                        <a href="{{ $reviews->nextPageUrl() }}" class="page-btn">→</a>
                    @else
                        <span class="page-btn disabled">→</span>
                    @endif
                </div>
            </div>
        @endif
    </div>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <style>
        :root { --sidebar-width: 300px; }

        .main-content {
            margin-left: var(--sidebar-width);
            padding: 20px 40px;
            flex-grow: 1;
            width: calc(100% - var(--sidebar-width));
        }

        .grid-container {
            display: grid;
            gap: 20px;
            padding: 20px;
            margin: 0 auto;
            grid-template-columns: repeat(5, 1fr);
        }

        /* 1200-1799px : 3 columns */
        @media (max-width: 1799px) {
            .grid-container { grid-template-columns: repeat(3, 1fr); }
        }

        /* 900-1199px : 2 columns */
        @media (max-width: 1199px) {
            .grid-container { grid-template-columns: repeat(2, 1fr); }
        }

        /* <600px : 1 column */
        @media (max-width: 599px) {
            .grid-container { grid-template-columns: 1fr; }
        }

        /* mobile adjustments - remove sidebar */
        @media (max-width: 1024px) {
            .main-content { margin-left: 0; width: 100%; padding: 15px; }
        }

        .grid-item {
            background-color: #fff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            height: 300px; /* uniform height */
            width: 350px;
            overflow: hidden;
        }

        .grid-item span {
            display: -webkit-box;
            -webkit-line-clamp: 4;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
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
  /* Общий стиль для кнопок */
  .btn {
            flex: 1;
            font-size: 0.75rem;
            padding: 8px 12px;
            font-weight: bold;
            border-radius: 8px;
            transition: all 0.3s ease-in-out;
            text-transform: uppercase;
        }
        /* Пагинация */
    .pagination {
        margin-top: 20px;
        text-align: center;
    }

        .pagination .page-btn {
            display: inline-block;
            padding: 8px 12px;
            border-radius: 5px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            transition: 0.3s;
        }

        .pagination .page-btn:hover {
            background-color: #2980b9;
        }

        .pagination-info {
            font-size: 14px;
            color: #333;
            margin-bottom: 5px;
        }

        .pagination-buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .page-btn.disabled {
            background-color: #ccc;
            pointer-events: none;
        }
    </style>
@endsection