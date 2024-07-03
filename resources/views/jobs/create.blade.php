@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Job</h1>
    <form action="{{ route('jobs.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Job Title</label>
            <input type="text" id="title" name="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description">Job Description</label>
            <textarea id="description" name="description" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="requirements">Job Requirements</label>
            <textarea id="requirements" name="requirements" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="salary">Salary</label>
            <input type="number" id="salary" name="salary" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="location">Location</label>
            <input type="text" id="location" name="location" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="company_id">Company</label>
            <select id="company_id" name="company_id" class="form-control" required>
                @foreach($companies as $company)
                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="category_id">Category</label>
            <select id="category_id" name="category_id" class="form-control" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <!-- Add Apply button -->
        <button type="button" class="btn btn-success" onclick="openApplyWindow()">Apply</button>
        <button type="submit" class="btn btn-primary">Create Job</button>
    </form>
</div>

<!-- JavaScript function to open Apply window -->
<script>
function openApplyWindow() {
    let jobTitle = document.getElementById('title').value;
    let jobDescription = document.getElementById('description').value;
    let jobRequirements = document.getElementById('requirements').value;
    let jobSalary = document.getElementById('salary').value;
    let jobLocation = document.getElementById('location').value;
    let companyId = document.getElementById('company_id').value;
    let categoryId = document.getElementById('category_id').value;

    // Open new window with apply form
    let url = `{{ route("jobs.applyForm") }}?title=${jobTitle}&description=${jobDescription}&requirements=${jobRequirements}&salary=${jobSalary}&location=${jobLocation}&company_id=${companyId}&category_id=${categoryId}`;
    window.open(url, '_blank');
}
</script>
@endsection
