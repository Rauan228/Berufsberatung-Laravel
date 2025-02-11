<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Specialty</title>
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
        }

        input,
        select {
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
        select:focus {
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
            background: rgba(255, 255, 255, 0.1);
        }

        button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
            background: #28a745;
            color: white;
        }

        button:hover {
            background: #218838;
            transform: scale(1.05);
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Add New Specialty</h2>
        <form action="{{ route('institution_specialties.store') }}" method="POST">
            @csrf
            <label for="institution_id">Select Institution:</label>
            <select id="institution_id" name="institution_id" required>
                <option value="">-- Select Institution --</option>
                @foreach ($institutions as $institution)
                    <option value="{{ $institution->id }}">{{ $institution->name }}</option>
                @endforeach
            </select>

            <label for="specialty_id">Select Specialty:</label>
            <select id="specialty_id" name="specialty_id" required>
                <option value="">-- Select Specialty --</option>
                @foreach ($globalSpecialties as $specialty)
                    <option value="{{ $specialty->id }}">{{ $specialty->specialty_name }}</option>
                @endforeach
            </select>

            <label for="specialty_name">Custom Specialty Name:</label>
            <input type="text" id="specialty_name" name="specialty_name" required>

            <button type="submit">Save</button>
        </form>
    </div>
</body>

</html>
