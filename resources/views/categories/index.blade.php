@extends('layouts.app')

@section('content')
<div class="container">
    <h1>All Categories</h1>
    @can('create', App\Models\Category::class)
        <a href="{{ route('categories.create') }}" class="btn btn-primary">Create New Category</a>
    @endcan
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td>{{ $category->name }}</td>
                <td>
                    <a href="{{ route('categories.show', $category->id) }}" class="btn btn-info">View</a>
                    @can('update', $category)
                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning">Edit</a>
                    @endcan
                    @can('delete', $category)
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    @endcan
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $categories->links() }}
</div>
@endsection
