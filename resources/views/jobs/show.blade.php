<!-- resources/views/jobs/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $job->title }}</h1>
    <p>{{ $job->description }}</p>
    <p><strong>Requirements:</strong> {{ $job->requirements }}</p>
    <p><strong>Salary:</strong> ${{ $job->salary }}</p>
    <p><strong>Location:</strong> {{ $job->location }}</p>
    <p><strong>Company:</strong> {{ $job->company->name }}</p>
    <p><strong>Category:</strong> {{ $job->category->name }}</p>
    <a href="{{ route('jobs.index') }}" class="btn btn-secondary">Back</a>
    <a href="{{ route('jobs.edit', $job->id) }}" class="btn btn-warning">Edit</a>
    <form action="{{ route('jobs.destroy', $job->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
</div>
@endsection
