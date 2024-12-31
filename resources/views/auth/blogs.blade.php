@extends('dashboard')

@section('user-dashboard-content')
    <h1 class="user-secondary">My Blogs</h1>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Service</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Contetnt</th>
                    <th>Views</th>
                    <th>Likes</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($blogs as $blog)
                    <tr>
                        <td>{{ $blog->id }}</td>
                        <td>{{ $blog->service->name }}</td>
                        <td>{{ $blog->title }}</td>
                        <td>{{ Str::limit($blog->description, 100) }}</td>
                        <td>
                            <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}"
                                style="width: 100px; height: auto;">
                        </td>
                        <td>{{ Str::limit($blog->content, 100) }}</td>
                        <td>{{ $blog->views }}</td>
                        <td>{{ $blog->likes }}</td>
                        <td class="d-flex gap-2">
                        <a href="{{ route('blogs.show', $blog->id) }}" class="btn btn-info btn-sm"><i class="fa-regular fa-eye"></i></a>
                        <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-warning btn-sm"><i class="fa-regular fa-pen-to-square"></i></a>
                        <form method="POST" action="{{ route('blogs.destroy', $blog->id) }}" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">No blogs available.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
