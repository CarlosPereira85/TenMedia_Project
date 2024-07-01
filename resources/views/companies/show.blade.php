@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $company->name }}</h1>
    <p>{{ $company->description }}</p>
    <p><strong>Location:</strong> {{ $company->location }}</p>
    <p><strong>Website:</strong> <a href="{{ $company->website }}">{{ $company->website }}</a></p>
    <a href="{{ route('companies.index') }}" class="btn btn-secondary">Back</a>
    <a href="{{ route('companies.edit', ['id' => $company->id]) }}" class="btn btn-warning">Edit</a>
    <form action="{{ route('companies.destroy', ['id' => $company->id]) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
</div>
@endsection
