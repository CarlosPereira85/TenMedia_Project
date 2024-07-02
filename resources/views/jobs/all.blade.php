<!-- resources/views/jobs/all.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>All Jobs</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jobs as $job)
            <tr>
                <td>{{ $job->title }}</td>
                <td>{{ $job->description }}</td>
                <td>{{ $job->category->name }}</td>
                <td>
                    <a href="{{ route('jobs.show', $job->id) }}" class="btn btn-info">View</a>
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('jobs.edit', $job->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('jobs.destroy', $job->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
