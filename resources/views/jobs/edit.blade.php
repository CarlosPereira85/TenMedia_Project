<!-- resources/views/jobs/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Job</h1>
    <form action="{{ route('jobs.update', $job->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Job Title</label>
            <input type="text" name="title" class="form-control" value="{{ $job->title }}" required>
        </div>
        <div class="form-group">
            <label for="description">Job Description</label>
            <textarea name="description" class="form-control" required>{{ $job->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="requirements">Job Requirements</label>
            <textarea name="requirements" class="form-control" required>{{ $job->requirements }}</textarea>
        </div>
        <div class="form-group">
            <label for="salary">Salary</label>
            <input type="number" name="salary" class="form-control" value="{{ $job->salary }}" required>
        </div>
        <div class="form-group">
            <label for="location">Location</label>
            <input type="text" name="location" class="form-control" value="{{ $job->location }}" required>
        </div>
        <div class="form-group">
            <label for="company_id">Company</label>
            <select name="company_id" class="form-control" required>
                @foreach($companies as $company)
                    <option value="{{ $company->id }}" {{ $company->id == $job->company_id ? 'selected' : '' }}>{{ $company->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="category_id">Category</label>
            <select name="category_id" class="form-control" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id == $job->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update Job</button>
    </form>
</div>
@endsection
