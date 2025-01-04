@extends('admin.layouts.app')

@section('content')
    <div class="container py-6">

        <div class="d-flex justify-content-end align-items-center mb-4 ">
            <!-- Filter Form -->
            <form method="GET" action="{{ route('comments.index') }}" class="d-flex align-items-center">
                <select name="status" id="status" class="custom-select me-3" onchange="this.form.submit()">
                    <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>All</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Blog</th>
                        <th scope="col">User</th>
                        <th scope="col">Comment</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($comments as $comment)
                        <tr>
                            <td>{{ $comment->id }}</td>
                            <td>{{ $comment->blog ? Str::limit($comment->blog->title, 20, '...') : 'N/A' }}</td>
                            <td>{{ $comment->user->name ?? 'N/A' }}</td>
                            <td>{{ Str::limit($comment->comment, 30, '...') ?? 'N/A' }}</td>
                            <td>
                                @if ($comment->status == 'pending')
                                    <span class="badge badge-warning">Pending</span>
                                @elseif ($comment->status == 'approved')
                                    <span class="badge badge-success">Approved</span>
                                @elseif ($comment->status == 'rejected')
                                    <span class="badge badge-danger">Rejected</span>
                                @endif
                            </td>
                            <td class="d-flex justify-content-around">
                                <a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                <a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="admin_provider_pagination">
            {{ $comments->links() }}
        </div>
    </div>
@endsection
