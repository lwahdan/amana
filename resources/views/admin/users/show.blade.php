@extends('admin.layouts.app')

@section('content')
<a href="{{ route('users.index') }}" class="btn btn-info btn-sm">Back to Users</a>
<h1>User Details</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone }}</td>
                <td>{{ $user->address }}</td>
                <td>{{ $user->created_at->format('d-m-Y H:i') }}</td>
            </tr>
        </tbody>
    </table>

    <h2>Bookings</h2>
@if ($user->bookings->isEmpty())
    <p>No bookings found for this client.</p>
@else
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Service</th>
                <th>Service Provider</th>
                <th>Service City</th>
                <th>Price</th>
                <th>Date</th>
                <th>Status</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($user->bookings as $booking)
            <tr>
                <td>{{ $booking->service->name ?? 'N/A' }}</td>
                <td>{{ $booking->provider->name ?? 'N/A' }}</td> <!-- Access provider directly -->
                <td>{{ $booking->city->name ?? 'N/A' }}</td>
                <td>{{ $booking->total_price ?? 'N/A' }}</td>
                <td>{{ $booking->booking_date->format('d-m-Y') }}</td>
                <td>{{ ucfirst($booking->status) }}</td>
                <td>{{ $booking->created_at->format('d-m-Y H:i') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif



    <h2>Reviews</h2>
@if ($user->reviews->isEmpty())
    <p>No reviews found for this user.</p>
@else
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Service</th>
                <th>Service Provider</th>
                <th>Rating</th>
                <th>Comment</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($user->reviews as $review)
                <tr>
                    <td>{{ $review->service->name ?? 'N/A' }}</td>
                    <td>{{ $review->provider->user->name ?? 'N/A' }}</td>
                    <td>{{ $review->rating }}</td>
                    <td>{{ $review->review }}</td>
                    <td>{{ ucfirst($review->status) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

  <h2>Contact Messages</h2>
@if ($user->contactMessages->isEmpty())
    <p>No contact messages found for this client.</p>
@else
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Subject</th>
                <th>Message</th>
                <th>Sent At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($user->contactMessages as $message)
                <tr>
                    <td>{{ $message->subject }}</td>
                    <td>{{ $message->message }}</td>
                    <td>{{ $message->created_at->format('d-m-Y H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

    <h2>Meetings</h2>
@if ($user->meetings->isEmpty())
    <p>No meetings scheduled for this user.</p>
@else
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Meeting Date</th>
                <th>Meeting Time</th>
                <th>With</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($user->meetings as $meeting)
                <tr>
                    <td>{{ $meeting->meeting_date->format('d-m-Y') }}</td>
                    <td>{{ $meeting->meeting_date->format('H:i') }}</td>
                    <td>{{ $meeting->provider->name }}</td>
                    <td>{{ ucfirst($meeting->status) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
@endsection
