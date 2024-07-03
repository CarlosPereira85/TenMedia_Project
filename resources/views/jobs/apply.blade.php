<!-- resources/views/jobs/apply.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Apply for {{ $job->title }}</div>

                <div class="card-body">
                    @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif

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
</div>
@endsection
