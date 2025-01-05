@extends('provider.dashboard')

@section('dashboard-content')
<h1>Bookings</h1>

<div class="table-responsive">
    <table class="table table-striped table-provider">
        <thead>
            <tr>
                <th>ID</th>
                <th>Client</th>
                <th>Service</th>
                <th>City</th>
                <th>Booking Date</th>
                <th>Total Price</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($bookings as $booking)
                <tr>
                    <td>{{ $booking->id }}</td>
                    <td>{{ $booking->user->name }}</td>
                    <td>{{ $booking->service->name }}</td>
                    <td>{{ $booking->city->name }}</td>
                    <td>{{ $booking->booking_date->format('Y-m-d H:i') }}</td>
                    <td>{{ number_format($booking->total_price, 2) }}</td>
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
                        <form action="{{ route('update.provider.booking.status', $booking->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <select name="status" class="form-control" onchange="this.form.submit()">
                                <option value="pending" {{ $booking->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ $booking->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="completed" {{ $booking->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ $booking->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </form>
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
