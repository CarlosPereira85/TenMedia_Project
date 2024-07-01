@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Companies</h1>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <a href="{{ route('companies.create') }}" class="btn btn-primary">Create Company</a>
    <a href="{{ route('companies.all') }}" class="btn btn-secondary">Show All Companies</a>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Location</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($companies as $company)
                <tr>
                    <td>{{ $company->name }}</td>
                    <td>{{ $company->location }}</td>
                    <td>
                        <a href="{{ route('companies.show', $company->id) }}" class="btn btn-info">View</a>
                        <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('companies.destroy', $company->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $companies->links() }}
</div>
@endsection
