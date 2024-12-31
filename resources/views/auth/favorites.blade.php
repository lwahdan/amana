@extends('dashboard')

@section('user-dashboard-content')
<h1 class="user-secondary">My Favorite Blogs</h1>

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Blog Title</th>
                <th>Writer</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($favorites as $blog)
                <tr>
                    <td>{{ $blog->id }}</td>
                    <td>{{ $blog->title }}</td>
                    <td>{{ $blog->writer->name }}</td>
                    <td>{{ Str::limit($blog->description, 100) }}</td>
                    <td>
                        <a href="{{ route('blogs.show', $blog->id) }}" class="btn btn-info btn-sm">View</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">You haven't added any blogs to your favorites yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
