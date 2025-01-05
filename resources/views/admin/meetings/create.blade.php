@extends('admin.layouts.app')

@section('content')
    <div class="containe py-6 px-4">
        <div class="flex justify-between items-center mb-6">
            <a href="{{ route('meetings.index') }}" class="back-button mb-2">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Bookings List
            </a>
            <h2 class="text-2xl font-semibold text-admin">Add New Meeting</h2>
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
        <form method="POST" action="{{ route('meetings.store') }}" novalidate>
            @csrf

            <!-- User Dropdown -->
            <div class="form-group">
                <label for="user_id">User</label>
                <select class="form-control @error('user_id') is-invalid @enderror" id="user_id" name="user_id">
                    <option value="" selected disabled>Select a User</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
                @error('user_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Providers Dropdown -->
            <div class="form-group">
                <label for="provider_id">Provider</label>
                <select class="form-control @error('provider_id') is-invalid @enderror" id="provider_id" name="provider_id">
                    <option value="" selected disabled>Select a Provider</option>
                    @foreach($providers as $provider)
                        <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                    @endforeach
                </select>
                @error('provider_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- meeting Date -->
            <div class="form-group">
                <label for="meeting_date">Meeting Date & Time</label>
                <input type="datetime-local" class="form-control @error('meeting_date') is-invalid @enderror" id="meeting_date" name="meeting_date">
                @error('meeting_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- meeting link --}}
            <div class="form-group">
                <label for="meeting_link">Meeting Link</label>
                <input type="text" class="form-control @error('meeting_link') is-invalid @enderror" id="meeting_link" name="meeting_link">
                @error('meeting_link')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="form-group mt-3">
                <button type="submit" class="back-button">Submit Meeting</button>
            </div>
        </form>
    </div>
@endsection
