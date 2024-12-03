@extends('admin.layouts.app')

@section('content')
    <h1>Bookings</h1>
    <form method="GET" action="{{ route('bookings.index') }}">
        <select name="status" onchange="this.form.submit()">
            <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>All</option>
            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
        </select>
    </form>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Service</th>
                <th>Status</th>
                <th>Booking Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bookings as $booking)
                <tr>
                    <td>{{ $booking->id }}</td>
                    <td>{{ $booking->user->name ?? 'N/A'}}</td>
                    <td>{{ $booking->service->name }}</td>
                    <td>{{ ucfirst($booking->status) }}</td>
                    <td>{{ $booking->booking_date->format('d-m-Y H:i') }}</td>
                    <td>
                        <a href="{{ route('bookings.show', $booking->id) }}">View</a>
                        <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form method="POST" action="{{ route('bookings.destroy', $booking->id) }}" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Cancel</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $bookings->links() }}
@endsection
