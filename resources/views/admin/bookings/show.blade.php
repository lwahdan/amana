@extends('admin.layouts.app')

@section('content')
<div class="containe py-6 px-4">
    <div class="flex justify-between items-center mb-6">
        <a href="{{ route('bookings.index') }}" class="back-button mb-2">
            <i class="fas fa-arrow-left mr-2"></i>
            Back to Bookings List
        </a>
        <h2 class="text-2xl font-semibold text-admin">View Booking</h2>
    </div>
    <table class="table table-striped">
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
            <th>Provider:</th>
            <td>{{ $booking->provider->name ?? 'Not Assigned' }}</td>
        </tr>
        <tr>
            <th>City:</th>
            <td>{{ $booking->city->name }}</td>
        </tr>
        <tr>
            <th>Shift:</th>
            <td>{{ $booking->shift }}</td>
        </tr>
        <tr>
            <th>Booking Date:</th>
            <td>{{ $booking->booking_date->format('d-m-Y') }}</td>
        </tr>
        <tr>
            <th>Booking Time:</th>
            <td>{{ $booking->booking_date->format('H:i') }}</td>
        </tr>
        <tr>
            <th>Total Price:</th>
            <td>${{ number_format($booking->total_price, 2) }}</td>
        </tr>
        <tr>
            <th>Status:</th>
            <td> <span class="badge badge-color
                @if ( $booking->status == 'pending' ) bg-warning
                @elseif ($booking->status == 'confirmed') bg-primary
                @elseif ($booking->status == 'completed') bg-success
                @elseif ($booking->status == 'cancelled') bg-danger @endif">
                {{ ucfirst($booking->status) }}</span>
            </td>
        </tr>
        <tr>
            <th>Created At:</th>
            <td>{{ $booking->created_at->format('d-m-Y H:i') }}</td>
        </tr> 
    </table>
</div>
@endsection
