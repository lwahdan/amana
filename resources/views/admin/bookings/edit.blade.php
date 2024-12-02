@extends('admin.layouts.app')

@section('title', 'Edit Booking')

@section('content')
    <h1>Edit Booking</h1>
    <form method="POST" action="{{ route('bookings.update', $booking->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="user_id">User</label>
            <select name="user_id" id="user_id" class="form-control">
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ $booking->user_id == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="service_id">Service</label>
            <select name="service_id" id="service_id" class="form-control">
                @foreach ($services as $service)
                    <option value="{{ $service->id }}" {{ $booking->service_id == $service->id ? 'selected' : '' }}>
                        {{ $service->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="service_provider_id">Service Provider</label>
            <select name="service_provider_id" id="service_provider_id" class="form-control">
                <option value="">Not Assigned</option>
                @foreach ($serviceProviders as $provider)
                    <option value="{{ $provider->id }}" {{ $booking->service_provider_id == $provider->id ? 'selected' : '' }}>
                        {{ $provider->user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="city_id">City</label>
            <select name="city_id" id="city_id" class="form-control">
                @foreach ($cities as $city)
                    <option value="{{ $city->id }}" {{ $booking->city_id == $city->id ? 'selected' : '' }}>
                        {{ $city->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="booking_date">Booking Date</label>
            <input type="datetime-local" name="booking_date" id="booking_date" class="form-control"
                   value="{{ $booking->booking_date->format('Y-m-d\TH:i') }}">
        </div>

        <div class="form-group">
            <label for="total_price">Total Price</label>
            <input type="number" step="0.01" name="total_price" id="total_price" class="form-control"
                   value="{{ $booking->total_price }}">
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control">
                <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                <option value="completed" {{ $booking->status == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update Booking</button>
    </form>
@endsection
