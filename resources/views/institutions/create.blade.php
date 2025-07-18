<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Создать институт</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #111;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f8f9fa;
            height: 100vh;
            margin: 0;
        }

        .container {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            padding: 20px;
            border-radius: 10px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            animation: fadeIn 0.5s ease-in-out;
            text-align: center;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        h2 {
            text-align: center;
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
            text-align: left;
        }

        input,
        textarea {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            outline: none;
            font-size: 16px;
            margin-bottom: 10px;
            transition: 0.3s;
            background-color: #dcdddf;
        }

        input:focus,
        textarea:focus {
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
            background: rgba(255, 255, 255, 0.1);
        }

        .button-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            margin-top: 10px;
        }

        button, 
        .cancel-button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        button {
            background: #28a745;
            color: white;
        }

        button:hover {
            background: #218838;
            transform: scale(1.05);
        }

        .cancel-button {
            background: #dc3545; /* Красный цвет */
            color: white;
        }

        .cancel-button:hover {
            background: #c82333;
            transform: scale(1.05);
        }

        .file-input-container {
            margin: 15px 0;
            text-align: left;
        }

        .file-input-label {
            display: inline-block;
            padding: 8px 12px;
            background: #4a90e2;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        .file-input-label:hover {
            background: #357abd;
        }

        .file-input {
            display: none;
        }

        .file-name {
            margin-left: 10px;
            font-size: 14px;
        }

        .preview-image {
            max-width: 200px;
            max-height: 200px;
            margin: 10px 0;
            border-radius: 5px;
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Создать новый институт</h2>
        <form action="{{ route('institutions.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="name">Название *</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required>

            <label for="email">Email *</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required>

            <label for="password">Пароль *</label>
            <input type="password" name="password" id="password" required>

            <label for="password_confirmation">Повторите пароль *</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required>

            <div class="file-input-container">
                <label class="file-input-label">
                    Выберите фото
                    <input type="file" name="photo" class="file-input" accept="image/*" onchange="previewImage(this, 'photoPreview')">
                </label>
                <span class="file-name" id="photoName"></span>
                <img id="photoPreview" class="preview-image">
            </div>

            <div class="file-input-container">
                <label class="file-input-label">
                    Выберите логотип
                    <input type="file" name="logo" class="file-input" accept="image/*" onchange="previewImage(this, 'logoPreview')">
                </label>
                <span class="file-name" id="logoName"></span>
                <img id="logoPreview" class="preview-image">
            </div>

            <label for="description">Описание</label>
            <textarea name="description" id="description" rows="3">{{ old('description') }}</textarea>

            <label for="location">Локация</label>
            <input type="text" name="location" id="location" value="{{ old('location') }}">

            <label for="website">Сайт</label>
            <input type="url" name="website" id="website" value="{{ old('website') }}">

            <div class="button-container">
                <button type="submit">Сохранить</button>
                <a href="{{ route('institutions.index') }}" class="cancel-button">Отмена</a>
            </div>
        </form>
    </div>

    <script>
        function previewImage(input, previewId) {
            const preview = document.getElementById(previewId);
            const fileName = input.files[0]?.name;
            const nameSpan = document.getElementById(input.name + 'Name');
            
            if (fileName) {
                nameSpan.textContent = fileName;
                
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                nameSpan.textContent = '';
                preview.style.display = 'none';
            }
        }
    </script>
</body>
</html>
