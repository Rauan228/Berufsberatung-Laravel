@extends('layouts.app')

@section('content')
<div class="main-content" style="margin: 0 0 0 300px">
    <h1>Grants</h1>
    <a href="{{ route('grants.create') }}" class="btn btn-primary">Add New Grant</a>
    <ul>
        @foreach($grants as $grant)
            <li class="event-card">
                <span style="font-size: 22px">{{ $grant->grant_name }}</span>
                <span style="font-size: 18px"> - {{ $grant->institution->name ?? 'Unknown Institution' }}</span><br>
                <strong style="font-size: 16px">Amount: {{ number_format($grant->amount) }}</strong><br>
                <strong style="font-size: 16px">Application Deadline: {{ $grant->application_deadline }}</strong>
                <div class="button-group">
                    <a href="{{ route('grants.edit', $grant->id) }}">
                        <button class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                    </a>
                    <form action="{{ route('grants.destroy', $grant->id) }}" method="POST" class="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
</div>
@endsection
