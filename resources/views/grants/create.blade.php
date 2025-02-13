
<div class="main-content">
    <h1>Create Grant</h1>
    <form action="{{ route('grants.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="institution_id">Institution</label>
            <select name="institution_id" id="institution_id" class="form-control">
                @foreach($institutions as $institution)
                    <option value="{{ $institution->id }}">{{ $institution->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="specialty_id">Specialty</label>
            <select name="specialty_id" id="specialty_id" class="form-control">
                @foreach($specialties as $specialty)
                    <option value="{{ $specialty->id }}">{{ $specialty->specialty_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="grant_name">Grant Name</label>
            <input type="text" name="grant_name" id="grant_name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="amount">Amount</label>
            <input type="number" name="amount" id="amount" class="form-control" step="0.01" required>
        </div>

        <div class="form-group">
            <label for="application_deadline">Application Deadline</label>
            <input type="date" name="application_deadline" id="application_deadline" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Save Grant</button>
    </form>
</div>
