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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
