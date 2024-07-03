@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Delete Account</div>
                <div class="card-body">
                    <p>Are you sure you want to delete your account? This action cannot be undone.</p>

                    <form method="POST" action="{{ route('delete.account') }}">
                        @csrf
                        <button type="submit" class="btn btn-danger">Delete Account</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
