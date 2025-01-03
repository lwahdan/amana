@extends('admin.layouts.app')

@section('content')
    <div class="container py-6">

        <div class="d-flex justify-content-end align-items-center mb-4 ">
            <!-- Filter Form -->
            <form method="GET" action="{{ route('bookings.index') }}" class="d-flex align-items-center">
                <select name="status" id="status" class="custom-select me-3" onchange="this.form.submit()">
                    <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>All</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : ''}}>Cancelled</option>
                </select>
            </form>

            <a href="{{ route('bookings.create') }}" class="btn btn-primary me-3 users_index">
                <i class="fas fa-plus"></i> Add a Booking
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
                        <th>City</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Booking Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookings as $booking)
                        <tr>
                            <td>{{ $booking->id }}</td>
                            <td>{{ $booking->user->name ?? 'N/A' }}</td>
                            <td>{{ $booking->provider->name ?? 'N/A' }}</td>
                            <td>{{ $booking->service->name }}</td>
                            <td>{{ $booking->city->name ?? 'N/A' }}</td>
                            <td>{{ number_format($booking->total_price, 2) }}</td>    
                            <td>
                                <span
                                    class="badge badge-color
                                @if ($booking->status == 'pending') bg-warning 
                                @elseif ($booking->status == 'confirmed') bg-primary 
                                @elseif ($booking->status == 'completed') bg-success 
                                @elseif ($booking->status == 'cancelled') bg-danger @endif">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </td>
                            <td>{{ $booking->booking_date->format('d-m-Y H:i') }}</td>
                            <td>
                                <a href="{{ route('bookings.show', $booking->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                <a href="{{ route('bookings.edit', $booking->id) }}"
                                    class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                <form method="POST" action="{{ route('bookings.destroy', $booking->id) }}"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="admin_provider_pagination">
            {{ $bookings->links() }}
        </div>
    </div>
@endsection
