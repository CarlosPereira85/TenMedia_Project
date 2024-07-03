@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Welcome, {{ $user->name }}</div>

                <div class="card-body">
                    <p>This is your personalized home page.</p>
                    <!-- Add personalized content here -->

                    <h1>My Job Applications</h1>

                    @if($applications->isEmpty())
                        <p>You have not applied for any jobs yet.</p>
                    @else
                        <ul>
                            @foreach($applications as $application)
                                <li>
                                    <strong>Job Title:</strong> {{ $application->job->title }} <br>
                                    <strong>Resume:</strong> <a href="{{ asset('storage/' . $application->resume) }}" target="_blank">View Resume</a> <br>
                                    <strong>Cover Letter:</strong> {{ $application->cover_letter }}
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    <hr>

                    
                </div>
            </div>
            
        </div>
    </div>
    <form method="POST" action="{{ route('delete.account') }}" onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.');">
                        @csrf
                        <button style="position: absolute; right: 3%; top: 7%;" type="submit" class="btn btn-danger">Delete Account</button>
                    </form>
</div>
@endsection
