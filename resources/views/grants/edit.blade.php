<div class="main-content">
    <h1>Edit Grant</h1>
    <form action="{{ route('grants.update', $grant->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="institution_id">Institution</label>
            <select name="institution_id" id="institution_id" class="form-control">
                @foreach($institutions as $institution)
                    <option value="{{ $institution->id }}" {{ $grant->institution_id == $institution->id ? 'selected' : '' }}>
                        {{ $institution->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="grant_name">Grant Name</label>
            <input type="text" name="grant_name" id="grant_name" class="form-control" value="{{ $grant->grant_name }}" required>
        </div>

        <div class="form-group">
            <label for="amount">Amount</label>
            <input type="number" name="amount" id="amount" class="form-control" step="0.01" value="{{ $grant->amount }}" required>
        </div>

        <div class="form-group">
            <label for="application_deadline">Application Deadline</label>
            <input type="date" name="application_deadline" id="application_deadline" class="form-control" value="{{ $grant->application_deadline }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Grant</button>
    </form>
</div>