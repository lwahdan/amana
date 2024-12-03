@extends('admin.layouts.app')

@section('content')
    <h1>Booking Details</h1>
    <table class="table">
        <tr>
            <th>ID:</th>
            <td>{{ $booking->id }}</td>
        </tr>
        <tr>
            <th>User:</th>
            <td>{{ $booking->user->name ?? 'N/A'}}</td>
        </tr>
        <tr>
            <th>Service:</th>
            <td>{{ $booking->service->name ?? 'N/A'}}</td>
        </tr>
        <tr>
            <th>Service Provider:</th>
            <td>{{ $booking->provider->name ?? 'Not Assigned' }}</td>
        </tr>
        <tr>
            <th>City:</th>
            <td>{{ $booking->city->name }}</td>
        </tr>
        <tr>
            <th>Booking Date:</th>
            <td>{{ $booking->booking_date->format('d-m-Y H:i') }}</td>
        </tr>
        <tr>
            <th>Total Price:</th>
            <td>${{ number_format($booking->total_price, 2) }}</td>
        </tr>
        <tr>
            <th>Status:</th>
            <td>{{ ucfirst($booking->status) }}</td>
        </tr>
        <tr>
            <th>Details:</th>
            <td>{{ $booking->details ?? 'No additional details' }}</td>
        </tr>
    </table>
    <a href="{{ route('bookings.index') }}" class="btn btn-primary">Back to Bookings</a>
@endsection
