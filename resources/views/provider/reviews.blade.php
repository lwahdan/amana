@extends('provider.dashboard')

@section('dashboard-content')
<h1>Reviews</h1>

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Service</th>
                <th>Review</th>
                <th>Rating</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($reviews as $review)
                <tr>
                    <td>{{ $review->id }}</td>
                    <td>{{ $review->service->name ?? 'N/A' }}</td>
                    <td>{{ $review->review ?? 'N/A' }}</td>
                    <td>{{ $review->rating ?? 'N/A' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">No reviews available.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
