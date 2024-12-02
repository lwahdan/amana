@extends('admin.layouts.app')

@section('content')
    <h1>Add Booking</h1>
    <form method="POST" action="{{ route('bookings.store') }}">
        @csrf
        <div>
            <label for="user_id">User</label>
            <select name="user_id" id="user_id" required>
                <option value="" disabled selected>Select a user</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="service_id">Service</label>
            <select name="service_id" id="service_id" required>
                <option value="" disabled selected>Select a service</option>
                @foreach ($services as $service)
                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="status">Status</label>
            <select name="status" id="status" required>
                <option value="pending">Pending</option>
                <option value="confirmed">Confirmed</option>
                <option value="completed">Completed</option>
            </select>
        </div>
        <div>
            <label for="details">Details</label>
            <textarea name="details" id="details"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Create</button>
    </form>
@endsection
