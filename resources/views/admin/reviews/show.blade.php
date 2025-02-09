@extends('admin.layouts.app')

@section('content')
    <div class="containe py-6 px-4">
        <div class="flex justify-between items-center mb-6">
            <a href="{{ route('reviews.index') }}" class="back-button mb-2">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Reviews List
            </a>
            <h2 class="text-2xl font-semibold text-admin">View Review</h2>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <tr>
                    <th>ID:</th>
                    <td>{{ $review->id }}</td>
                </tr>
                <tr>
                    <th>Service:</th>
                    <td>{{ $review->service->name ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>User:</th>
                    <td>{{ $review->user->name ?? 'N/A'}}</td>
                </tr>
                <tr>
                    <th>User Email:</th>
                    <td>{{ $review->user->email ?? 'N/A' }}</td>
                </tr>

                <tr>
                    <th>Provider:</th>
                    <td>{{ $review->provider->name ?? 'Not Assigned' }}</td>
                </tr>
                <tr>
                    <th>Provider Email:</th>
                    <td>{{ $review->provider->email ?? 'Not Assigned' }}</td>
                </tr>
                <tr>
                    <th>Review Text:</th>
                    <td>{{ $review->review }}</td>
                </tr>
                <tr>
                    <th>Rating:</th>
                    <td>{{ $review->rating }} / 5</td>
                </tr>
                <tr>
                    <th>Status:</th>
                    <td>
                        <span
                            class="badge badge-color
                @if ($review->status == 'pending') bg-warning 
                @elseif ($review->status == 'approved') bg-primary 
                @elseif ($review->status == 'disapproved') bg-danger @endif">
                            {{ ucfirst($review->status) }}
                        </span>
                    </td>
                </tr>

                <tr>
                    <th>Submitted At:</th>
                    <td>{{ $review->created_at->format('d-m-Y H:i') }}</td>
                </tr>
                @isset($review->deleted_at)
                    <tr>
                        <th>Dissapproved At:</th>
                        <td>{{ $review->deleted_at->format('d-m-Y H:i') }}</td>
                    </tr>
                @endisset
            </table>
        </div>
    </div>
@endsection
