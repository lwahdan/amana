@extends('dashboard')

@section('user-dashboard-content')
<h1 class="user-secondary">Bookings</h1>

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Provider</th>
                <th>Service</th>
                <th>Booking Date</th>
                <th>Total Price</th>
                <th>Status</th>
                {{-- <th>Actions</th> --}}
            </tr>
        </thead>
        <tbody>
            @forelse ($bookings as $booking)
                <tr>
                    <td>{{ $booking->id }}</td>
                    <td>{{ $booking->provider->name ?? 'N/A' }}</td>
                    <td>{{ $booking->service->name ?? 'N/A' }}</td>
                    <td>{{ $booking->booking_date->format('Y-m-d H:i') ?? 'N/A' }}</td>
                    <td>{{ number_format($booking->total_price, 2) ?? 'N/A' }}</td>
                    <td>
                        <span class="badge 
                            @if ($booking->status == 'pending') bg-warning 
                            @elseif ($booking->status == 'confirmed') bg-primary 
                            @elseif ($booking->status == 'completed') bg-success 
                            @elseif ($booking->status == 'cancelled') bg-danger 
                            @endif">
                            {{ ucfirst($booking->status) }}
                        </span>
                    </td>
                    <td>
                        <!-- View Button -->
                        {{-- <a href="{{ route('provider.bookings.show', $booking->id) }}" class="btn btn-info btn-sm">View</a> --}}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">No bookings available.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
