@extends('admin.layouts.app')

@section('content')
    <div class="containe py-6 px-4">
        <div class="flex justify-between items-center mb-6">
            <a href="{{ route('comments.index') }}" class="back-button mb-2">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Blog Comments
            </a>
            <h3 class="text-2xl font-semibold text-admin">View & Update Comment Status</h3>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-striped">
                <tr>
                    <th>ID:</th>
                    <td>{{ $comment->id }}</td>
                </tr>
                <tr>
                    <th>Blog:</th>
                    <td>{{ $comment->blog->title ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>User:</th>
                    <td>{{ $comment->user->name ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>User Email:</th>
                    <td>{{ $comment->user->email ?? 'N/A' }}</td>
                </tr>

                <tr>
                    <th>Comment:</th>
                    <td>{{ $comment->comment ?? 'Not Assigned' }}</td>
                </tr>
                <tr>
                    <th>Submitted At:</th>
                    <td>{{ $comment->created_at->format('d-m-Y H:i') }}</td>
                </tr>
                <tr>
                    <th>Status:</th>
                    <td>
                        <form action="{{ route('comments.update', $comment->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div>
                                <label for="status">Status:</label>
                                <select name="status" id="status">
                                    <option value="pending" {{ $comment->status == 'pending' ? 'selected' : '' }}>Pending
                                    </option>
                                    <option value="approved" {{ $comment->status == 'approved' ? 'selected' : '' }}>Approved
                                    </option>
                                    <option value="rejected" {{ $comment->status == 'rejected' ? 'selected' : '' }}>Rejected
                                    </option>
                                </select>
                            </div>
                            <button type="submit" class="back-button">Update Status</button>
                        </form>
                    </td>
                </tr>
            </table>
        </div>
    </div>
@endsection
