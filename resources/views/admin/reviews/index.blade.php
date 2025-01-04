@extends('admin.layouts.app')

@section('content')
<div class="container py-6">

    <div class="d-flex justify-content-end align-items-center mb-4 ">
        <!-- Filter Form -->
        <form method="GET" action="{{ route('reviews.index') }}" class="d-flex align-items-center">
            <select name="status" id="status" class="custom-select me-3" onchange="this.form.submit()">
                <option value="">All</option>
                <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                <option value="disapproved" {{ request('status') == 'disapproved' ? 'selected' : '' }}>Disapproved</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>pending</option>
            </select>
        </form>

        <a href="{{ route('reviews.create') }}" class="btn btn-primary me-3 users_index">
            <i class="fas fa-plus"></i> Add a Review
        </a>
    </div>
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Provider</th>
                <th>Service</th>
                <th>Rating</th>
                <th>Review</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reviews as $review)
                <tr>
                    <td>{{ $review->id }}</td>
                    <td>{{ $review->user->name ?? 'N/A'}}</td>
                    <td>{{ $review->provider->name ?? 'N/A'}}</td>
                    <td>{{ $review->service->name ?? 'N/A'}}</td>
                    <td>{{ $review->rating }}</td>
                    <td>{{ $review->review}}</td>
                    <td> 
                        <span
                            class="badge badge-color
                            @if ($review->status == 'pending') bg-warning 
                            @elseif ($review->status == 'approved') bg-primary 
                            @elseif ($review->status == 'disapproved') bg-danger @endif">
                            {{ ucfirst($review->status) }}
                        </span>
                    </td>
                    <td class="d-flex gap-2">
                        @if (!$review->trashed())
                            <a href="{{ route('reviews.show', $review->id) }}" class="btn btn-info btn-sm"><i
                                    class="fas fa-eye"></i></a>
                            <a href="{{ route('reviews.edit', $review->id) }}" class="btn btn-warning btn-sm"><i
                                    class="fas fa-edit"></i></a>
                            <form method="POST" action="{{ route('reviews.destroy', $review->id) }}"
                                style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"> <i
                                        class="fas fa-trash-alt"></i></button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('reviews.restore', $review->id) }}"
                                style="display: inline;">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-success btn-sm"> <i
                                        class="fas fa-undo"></i></button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="admin_provider_pagination">
    {{ $reviews->links() }} <!-- Pagination Links -->
</div>
</div>

@endsection
