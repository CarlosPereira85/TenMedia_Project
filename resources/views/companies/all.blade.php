<!-- resources/views/companies/all.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>All Companies</h1>
    <table class="table">
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
</div>
@endsection
