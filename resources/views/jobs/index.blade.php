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
                    <!-- Button to open apply modal -->
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#applyModal{{ $job->id }}">
                        Apply
                    </button>
                    <!-- Apply Modal -->
                    <div class="modal fade" id="applyModal{{ $job->id }}" tabindex="-1" role="dialog" aria-labelledby="applyModalLabel{{ $job->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="applyModalLabel{{ $job->id }}">Apply for {{ $job->title }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Apply form -->
                                    <form method="POST" action="{{ route('jobs.apply.submit', $job->id) }}" enctype="multipart/form-data">
                                        @csrf

                                        <div class="form-group">
                                            <label for="resume">Resume (PDF/DOC/DOCX)</label>
                                            <input id="resume" type="file" class="form-control @error('resume') is-invalid @enderror" name="resume" required>
                                            @error('resume')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cover_letter">Cover Letter</label>
                                            <textarea id="cover_letter" class="form-control @error('cover_letter') is-invalid @enderror" name="cover_letter" rows="5" required>{{ old('cover_letter') }}</textarea>
                                            @error('cover_letter')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <button type="submit" class="btn btn-primary">Submit Application</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
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
