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

        h1, h3 {
            font-size: 2rem;
            margin-bottom: 20px;
            color: #333;
        }

        h3 {
            font-size: 1.5rem;
            margin-top: 30px;
        }

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
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }

        li:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .button-group {
            margin-top: 10px;
            gap: 5px;
            display: flex;
            align-items: center;
        }

        .btn {
            flex: 0 1 auto;
            font-size: 0.6rem;
            padding: 8px 12px;
            font-weight: bold;
            border-radius: 8px;
            transition: all 0.3s ease-in-out;
            text-transform: uppercase;
            margin-right: 5px;
        }

        .btn-warning:hover {
            background: linear-gradient(135deg, #d39e00, #c69500);
            box-shadow: 0 5px 10px rgba(255, 193, 7, 0.5);
            transform: scale(1.07);
        }

        .btn-danger:hover {
            background: linear-gradient(135deg, #c82333, #a71d2a);
            box-shadow: 0 5px 10px rgba(220, 53, 69, 0.5);
            transform: scale(1.07);
        }

        .btn:active {
            transform: scale(0.95);
        }

        .btn:hover {
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

        .specialty-name {
            font-size: 22px;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 5px;
            display: block;
        }

        .specialty-description {
            color: #34495e;
            margin-bottom: 10px;
        }
    </style>

    <div class="main-content">
        @php
            $type = request()->query('type', 'all');
            $title = match($type) {
                'university' => 'Университетские специальности',
                'college' => 'Специальности колледжей',
                default => 'Все специальности'
            };
        @endphp
        
        <h1>{{ $title }}</h1>
        <a href="{{ route('specialties.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Добавить специальность
        </a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($type === 'all' || $type === 'university')
        <!-- University Specialties -->
        <h3>Университетские специальности</h3>
        <ul>
            @foreach($universitySpecialties as $specialty)
                <li class="specialty-item">
                    <span class="specialty-name">{{ $specialty->name }}</span>
                    <p class="specialty-description">{{ $specialty->description }}</p>
                    <div class="button-group">
                        <a href="{{ route('specialties.show', ['id' => $specialty->id, 'type' => 'university']) }}" 
                           class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i> Просмотр
                        </a>
                        <a href="{{ route('specialties.edit', ['id' => $specialty->id, 'type' => 'university']) }}" 
                           class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Редактировать
                        </a>
                        <form action="{{ route('specialties.destroy', ['id' => $specialty->id]) }}" 
                              method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="type" value="university">
                            <button type="submit" class="btn btn-danger btn-sm" 
                                    onclick="return confirm('Удалить специальность?')">
                                <i class="fas fa-trash"></i> Удалить
                            </button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
        @endif

        @if($type === 'all' || $type === 'college')
        <!-- College Specialties -->
        <h3>Колледж специальности</h3>
        <ul>
            @foreach($collegeSpecialties as $specialty)
                <li class="specialty-item">
                    <span class="specialty-name">{{ $specialty->name }}</span>
                    <p class="specialty-description">{{ $specialty->description }}</p>
                    <div class="button-group">
                        <a href="{{ route('specialties.show', ['id' => $specialty->id, 'type' => 'college']) }}" 
                           class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i> Просмотр
                        </a>
                        <a href="{{ route('specialties.edit', ['id' => $specialty->id, 'type' => 'college']) }}" 
                           class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Редактировать
                        </a>
                        <form action="{{ route('specialties.destroy', ['id' => $specialty->id]) }}" 
                              method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="type" value="college">
                            <button type="submit" class="btn btn-danger btn-sm" 
                                    onclick="return confirm('Удалить специальность?')">
                                <i class="fas fa-trash"></i> Удалить
                            </button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
        @endif
    </div>
@endsection 