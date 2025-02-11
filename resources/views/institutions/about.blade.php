<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>{{ $institution->name }}</h1>
    <p><strong>Описание:</strong> {{ $institution->description }}</p>
    <p><strong>Локация:</strong> {{ $institution->location }}</p>
    <p><strong>Сайт:</strong>
        @if($institution->website)
            <a href="{{ $institution->website }}" target="_blank">{{ $institution->website }}</a>
        @endif
    </p>
    <a href="{{ route('institutions.index') }}" class="btn btn-secondary">Вернуться к списку</a>
</body>
</html>
   

