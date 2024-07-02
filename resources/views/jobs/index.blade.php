@extends('layouts.app')

@section('content')
<div class="container">
    <h1>All Jobs</h1>
    @if(Auth::user()->role === 'admin')
        <a href="{{ route('jobs.create') }}" class="btn btn-primary">Create New Job</a>
    @endif
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Title</th>
                <th>Location</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jobs as $job)
            <tr>
                <td>{{ $job->title }}</td>
                <td>{{ $job->location }}</td>
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
    {{ $jobs->links() }}
</div>
@endsection
