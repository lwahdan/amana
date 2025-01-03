@extends('admin.layouts.app')

@section('content')
<div class="container py-6">
<div class="d-flex justify-content-end align-items-center mb-4 ">
    <a href="{{ route('categories.create') }}" class="btn btn-primary me-3 users_index">
        <i class="fas fa-plus"></i> Add a Category
    </a>
</div>
    <div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->description }}</td>
                    <td>
                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                        <form method="POST" action="{{ route('categories.destroy', $category->id) }}" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    <div class="admin_provider_pagination">
    {{ $categories->links() }} 
    </div>
</div>
@endsection
