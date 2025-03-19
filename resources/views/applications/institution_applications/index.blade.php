@extends('layouts.app')

@section('content')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <div class="main-content">
        <h1>University Applications</h1>
        <form method="GET" action="{{ route('applications.institution_applications.index') }}" class="filter-form">
            <label for="status_filter">Filter by Status:</label>
            <select name="verified" id="status_filter" onchange="this.form.submit()">
                <option value="">All Statuses</option>
                <option value="pending" {{ request('verified') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="accepted" {{ request('verified') == 'accepted' ? 'selected' : '' }}>Accepted</option>
                <option value="rejected" {{ request('verified') == 'rejected' ? 'selected' : '' }}>Rejected</option>
            </select>
        </form>
        
        <div class="grid-container">
            @foreach($applications as $application)
                <div class="grid-item">
                    <strong style="font-size: 22px">{{ $application->institution_name }}</strong>
                    <span style="font-size: 18px">- {{ $application->email }}</span><br>
                    Status: {{ $application->verified }}

                    <!-- Кнопки для изменения статуса -->
                    <div class="status-buttons">
                        @if($application->verified === 'pending')
                            <form action="{{ route('institution-applications.update-verified-status', $application->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="verified" value="accepted">
                                <button type="submit" class="btn btn-accept">Accept</button>
                            </form>
                            <form action="{{ route('institution-applications.update-verified-status', $application->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="verified" value="rejected">
                                <button type="submit" class="btn btn-reject">Reject</button>
                            </form>
                        @else
                            <form action="{{ route('institution-applications.update-verified-status', $application->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="verified" value="pending">
                                <button type="submit" class="btn btn-cancel">Cancel</button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    
        <!-- Пагинация -->
        <div class="pagination-container">
            {{ $applications->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f6f9;
        }

        .main-content {
            flex-grow: 1;
            padding: 20px;
            margin: 0 0 0 300px;
        }

        h1 {
            font-size: 2rem;
            margin-bottom: 20px;
            color: #333;
        }

        .filter-form {
            margin-bottom: 20px;
        }

        .grid-container {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            padding: 20px;
        }

        .grid-item {
            background-color: #fff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .status-buttons {
            margin-top: 10px;
        }

        .btn {
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            margin: 5px;
            transition: background-color 0.3s ease;
        }

        .btn-accept {
            background-color: #28a745;
            color: white;
        }

        .btn-reject {
            background-color: #dc3545;
            color: white;
        }

        .btn-cancel {
            background-color: #ffc107;
            color: black;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .pagination-container nav {
            display: flex;
            justify-content: center;
        }

        .pagination {
            display: flex;
            list-style: none;
            padding: 0;
            gap: 8px;
        }

        .pagination li {
            display: inline;
        }

        .pagination li a,
        .pagination li span {
            display: block;
            padding: 8px 12px;
            text-decoration: none;
            border: 1px solid #ddd;
            background-color: #fff;
            color: #333;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .pagination li a:hover {
            background-color: #007bff;
            color: white;
        }

        .pagination .active span {
            background-color: #007bff;
            color: white;
            border-color: #007bff;
            font-weight: bold;
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
    </style>
@endsection