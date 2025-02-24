@extends('layouts.app')

@section('content')

<div class="main-content" style="margin: 0 0 0 300px">
    <h1>Institution Applications</h1>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Institution Name</th>
                <th>Email</th>
                <th>Verified</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($applications as $application)
                <tr>
                    <td>{{ $application->id }}</td>
                    <td>{{ $application->institution_name }}</td>
                    <td>{{ $application->email }}</td>
                    <td>{{ $application->verified ? 'Yes' : 'No' }}</td>
                    <td>
                        <form action="{{ route('applications.verify', $application->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-sm {{ $application->verified ? 'btn-danger' : 'btn-success' }}">
                                {{ $application->verified ? 'Unverify' : 'Verify' }}
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="pagination-container">
        {{ $applications->links() }}
    </div>
</div>

@endsection
