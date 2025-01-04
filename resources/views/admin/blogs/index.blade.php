@extends('admin.layouts.app')

@section('content')
    <div class="container py-6">

        <div class="d-flex justify-content-end align-items-center mb-4 ">
            <!-- Filter Form -->
            <form method="GET" action="{{ route('admin.blogs') }}" class="d-flex align-items-center">
                <select name="status" id="status" class="custom-select me-3" onchange="this.form.submit()">
                    <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>All</option>
                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
            </form>

            <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary me-3 users_index">
                <i class="fas fa-plus"></i> Add Blog
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Author</th>
                        <th>Service</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Views</th>
                        <th>Likes</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($blogs as $blog)
                        <tr>
                            <td>{{ $blog->id }}</td>
                            <td>{{ $blog->writer->name }}</td>
                            <td>{{ $blog->service->name }}</td>
                            <td>{{ Str::limit($blog->title, 10) }}{{ strlen($blog->title) > 10 ? '...' : '' }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}"
                                    style="width: 100px; height: auto;">
                            </td>
                            <td>{{ $blog->views }}</td>
                            <td>{{ $blog->likes }}</td>
                            <td>
                                @if ($blog->status == 'approved')
                                    <span class="badge badge-success">Approved</span>
                                @elseif ($blog->status == 'pending')
                                    <span class="badge badge-warning">Pending</span>
                                @elseif ($blog->status == 'rejected')
                                    <span class="badge badge-danger">Rejected</span>
                                @endif
                            </td>
                            <td class="d-flex gap-2">
                                @if (!$blog->Trashed())
                                <a href="{{ route('admin.blogs.show', $blog->id) }}" class="btn btn-info btn-sm"><i
                                        class="fa-regular fa-eye"></i></a>
                                <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="btn btn-warning btn-sm"><i
                                        class="fa-regular fa-pen-to-square"></i></a>
                                <form method="POST" action="{{ route('admin.blogs.destroy', $blog->id) }}"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"><i
                                            class="fa-solid fa-trash"></i></button>
                                </form>
                                @else
                                <form method="POST" action="{{ route('admin.blogs.restore', $blog->id) }}"
                                    style="display:inline;">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-undo"></i></button>
                                </form>
                                @endif
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
        <div class="admin_provider_pagination">
            {{ $blogs->links() }}
        </div>
    </div>
@endsection
