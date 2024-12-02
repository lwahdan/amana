@extends('admin.layouts.app')

@section('content')
    <h1>Manage Reviews</h1>

    <!-- Filter Dropdown -->
    <form method="GET" action="{{ route('reviews.index') }}" class="mb-3">
        <select name="status" onchange="this.form.submit()" class="form-control w-25">
            <option value="">All</option>
            <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
            <option value="disapproved" {{ request('status') == 'disapproved' ? 'selected' : '' }}>Disapproved</option>
        </select>
    </form>

    <!-- Reviews Table -->
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
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
                    <td>{{ $review->user->name }}</td>
                    <td>{{ $review->service->name }}</td>
                    <td>{{ $review->rating }}</td>
                    <td>{{ $review->review}}</td>
                    <td>{{ ucfirst($review->status) }}</td>
                    <td>
                        @if ($review->status !== 'approved')
                            <form method="POST" action="{{ route('reviews.updateStatus', $review->id) }}" class="d-inline">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="approved">
                                <button type="submit" class="btn btn-success btn-sm">Approve</button>
                            </form>
                        @endif
                        @if ($review->status !== 'disapproved')
                            <form method="POST" action="{{ route('reviews.updateStatus', $review->id) }}" class="d-inline">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="disapproved">
                                <button type="submit" class="btn btn-danger btn-sm">Disapprove</button>
                            </form>
                        @endif
                        <a href="{{ route('reviews.show', $review->id) }}" class="btn btn-info btn-sm">View</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $reviews->links() }} <!-- Pagination Links -->
@endsection
