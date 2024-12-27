@extends('layouts.app')

@section('title', 'Book Now')
@section('breadcrumb-title', 'Book Now')
@section('breadcrumb-subtitle', 'Book Your Service')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-user text-white text-center">
                    <h2>Book Now</h2>
                </div>
                <div class="card-body">
                    <form id="booking-form" method="POST" action="{{ route('book_submit') }}" novalidate>
                        @csrf

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
                            <button type="submit" class="btn my-btn-user btn-block">Submit Booking</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
