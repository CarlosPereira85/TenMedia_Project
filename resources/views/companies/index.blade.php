<!-- resources/views/companies/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>All Companies</h1>
    <a href="{{ route('companies.create') }}" class="btn btn-primary">Create New Company</a>
    <table class="table mt-3">
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
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('companies.destroy', $company->id) }}" method="POST" style="display:inline;">
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
    {{ $companies->links() }}
</div>
@endsection
