@extends('admin.layouts.app')

@section('content')
    <div class="containe py-6 px-4">
        <div class="flex justify-between items-center mb-6">
            <a href="{{ route('meetings.index') }}" class="back-button mb-2">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Bookings List
            </a>
            <h2 class="text-2xl font-semibold text-admin">Edit Meeting</h2>
        </div>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <form method="POST" action="{{ route('meetings.update', $meeting->id) }}" novalidate>
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="user_id">User</label>
                <select name="user_id" id="user_id" class="form-control">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ $meeting->user_id == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="provider_id">Provider</label>
                <select name="provider_id" id="provider_id" class="form-control">
                    <option value="">Not Assigned</option>
                    @foreach ($providers as $provider)
                        <option value="{{ $provider->id }}" {{ $meeting->provider_id == $provider->id ? 'selected' : '' }}>
                            {{ $provider->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="meeting_date">Meeting Date</label>
                <input type="datetime-local" name="meeting_date" id="meeting_date" class="form-control"
                       value="{{ $meeting->meeting_date ? $meeting->meeting_date->format('Y-m-d\TH:i') : 'N/A' }}">
            </div>

            <div class="form-group">
                <label for="meeting_link">Meeting Link</label>
                <input type="text" name="meeting_link" id="meeting_link" class="form-control"
                       value="{{ $meeting->meeting_link ? $meeting->meeting_link : 'N/A' }}">
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="requested" {{ $meeting->status == 'requested' ? 'selected' : '' }}>Requested</option>
                    <option value="confirmed" {{ $meeting->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="completed" {{ $meeting->status == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ $meeting->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>

            <!-- Submit Button -->
            <div class="form-group mt-3">
                <button type="submit" class="back-button">Submit Meeting</button>
            </div>
        </form>
    </div>
@endsection
