@extends('app')

@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f6f9;
        }

        h1 {
            font-size: 2rem;
            margin-bottom: 20px;
            color: #333;
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
        a {
            color: #3498db;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
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
        }

        .event-card .button-group {
            gap: 5px;
        }

        .event-card .btn {
            flex: 1;
            font-size: 0.6rem;
            padding: 8px 12px;
            font-weight: bold;
            border-radius: 8px;
            transition: all 0.3s ease-in-out;
            text-transform: uppercase;
        }

        .event-card .btn-warning:hover {
            background: linear-gradient(135deg, #d39e00, #c69500);
            box-shadow: 0 5px 10px rgba(255, 193, 7, 0.5);
            transform: scale(1.07);
        }

        .event-card .btn-danger:hover {
            background: linear-gradient(135deg, #c82333, #a71d2a);
            box-shadow: 0 5px 10px rgba(220, 53, 69, 0.5);
            transform: scale(1.07);
        }

        .event-card .btn:active {
            transform: scale(0.95);
        }

        .event-card .btn:hover {
            transform: scale(1.05);
        }

        form {
            display: inline;
        }

        .main-content {
            margin-left: 300px;
            padding: 20px;
            flex-grow: 1;
        }
    </style>
</head>

<body>
    <div class="main-content">
        <h1>Global Specialties</h1>
        <a href="{{ route('global_specialties.create') }}" class="btn btn-primary">Add New Global speciality</a>
        <ul>
            @foreach($globalSpecialties as $specialty)
                <li class="event-card">
                    <span style="font-size: 22px">{{ $specialty->specialty_name }}</span>
                    <div class="button-group">
                        <a href="{{ route('global_specialties.edit', $specialty->id) }}">
                            <button class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                        </a>
                        <form action="{{ route('global_specialties.destroy', $specialty->id) }}" method="POST" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Удалить специальность?')">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</body>
</html>
@endsection