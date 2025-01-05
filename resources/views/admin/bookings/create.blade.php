@extends('admin.layouts.app')

@section('content')
    <div class="containe py-6 px-4">
        <div class="flex justify-between items-center mb-6">
            <a href="{{ route('bookings.index') }}" class="back-button mb-2">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Bookings List
            </a>
            <h2 class="text-2xl font-semibold text-admin">Add New Booking</h2>
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
        <form id="booking-form" method="POST" action="{{ route('bookings.store') }}" novalidate>
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

            <!-- Services Dropdown -->
            <div class="form-group">
                <label for="service_id">Service</label>
                <select class="form-control @error('service_id') is-invalid @enderror" id="service_id" name="service_id">
                    <option value="" selected disabled>Select a Service</option>
                    @foreach($services as $service)
                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                    @endforeach
                </select>
                @error('service_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Shift Dropdown -->
            <div class="form-group">
                <label for="shift">Shift</label>
                <select class="form-control @error('shift') is-invalid @enderror" id="shift" name="shift">
                    <option value="" selected disabled>Select a Shift</option>
                    <option value="morning">Morning</option>
                    <option value="night">Night</option>
                    <option value="stayin">Stay-In</option>
                </select>
                @error('shift')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Cities Dropdown -->
            <div class="form-group">
                <label for="city_id">City</label>
                <select class="form-control @error('city_id') is-invalid @enderror" id="city_id" name="city_id">
                    <option value="" selected disabled>Select a City</option>
                    @foreach($cities as $city)
                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                    @endforeach
                </select>
                @error('city_id')
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

            <!-- Booking Date -->
            <div class="form-group">
                <label for="booking_date">Booking Date & Time</label>
                <input type="datetime-local" class="form-control @error('booking_date') is-invalid @enderror" id="booking_date" name="booking_date">
                @error('booking_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="form-group mt-3">
                <button type="submit" class="back-button">Submit Booking</button>
            </div>
        </form>
    </div>
    <script>
        $(document).ready(function () {
          $('#service_id, #city_id, #shift').on('change', function () {
              // Get selected values
              let service_id = $('#service_id').val();
              let city_id = $('#city_id').val();
              let shift = $('#shift').val();
      
              // Check if all fields are selected
              if (service_id && city_id && shift) {
                  $.ajax({
                      url: '/get-providers', // Ensure this route exists
                      method: 'GET',
                      data: {
                          service_id: service_id,
                          city_id: city_id,
                          shift: shift,
                      },
                      success: function (response) {
                          let providerDropdown = $('#provider_id');
                          providerDropdown.empty(); // Clear previous options
                          providerDropdown.append('<option value="" selected disabled>Select a Provider</option>');
                          response.forEach(function (provider) {
                              providerDropdown.append(`<option value="${provider.id}">${provider.name}</option>`);
                          });
                      },
                      error: function (xhr, status, error) {
                          console.error('AJAX Error:', error); // Debug AJAX error
                          alert('Failed to fetch providers. Please try again.');
                      },
                  });
              } else {
                  // Clear provider dropdown if inputs are incomplete
                  $('#provider_id').empty().append('<option value="" selected disabled>Select a Provider</option>');
              }
          });
      });
      </script>
@endsection
