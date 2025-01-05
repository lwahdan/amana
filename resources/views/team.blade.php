@extends('layouts.app')
@section('title', 'Our Team')
@section('breadcrumb-title', 'our team')
@section('breadcrumb-subtitle', 'our team')
@section('content')

    <div class="team-section">
        <div class="team-header">
            <h4 class="team-title">Explore Your Trusted Partners in Care</h4>
            <div class="filter-container">
                <form method="GET" action="{{ route('team') }}" class="filter-form">
                    <div class="filter-controls">
                        <!-- Service Filter -->
                        <div class="filter-group">
                            <label for="service_id" class="filter-label">Service</label>
                            <select name="service_id" id="service_id" class="filter-select">
                                <option value="">All Services</option>
                                @foreach ($services as $service)
                                    <option value="{{ $service->id }}"
                                        {{ request('service_id') == $service->id ? 'selected' : '' }}>
                                        {{ $service->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Gender Filter -->
                        <div class="filter-group">
                            <label for="gender" class="filter-label">Gender</label>
                            <select name="gender" id="gender" class="filter-select">
                                <option value="">All Genders</option>
                                @foreach ($genderOptions as $gender)
                                    <option value="{{ $gender }}"
                                        {{ request('gender') == $gender ? 'selected' : '' }}>
                                        {{ ucfirst($gender) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Filter Button -->
                        <div class="filter-group">
                            <button type="submit" class="filter-button">Apply Filters</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- providers_area_start -->
    <div class="expert_doctors_area">
        <div class="container">
            <div class="row">
                @foreach ($providers as $provider)
                    <div class="single_expert col-xl-3 col-lg-3 col-md-6 mb-30">
                        <div class="expert_thumb">
                            <img src="{{ asset('storage/' . $provider->profile_picture) }}" alt="{{ $provider->name }}" class="provider_image">
                        </div>
                        <div class="experts_name text-center">
                            <h3><a href="{{ route('show.provider.info', $provider->id) }}">{{ $provider->name }}</a></h3>
                            @foreach ($provider->services as $service)
                                <span>{{ $service->name }}</span>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="team_pagination">
        {{ $providers->links() }}
    </div>
    <!-- providers_area_end -->
    @include('shared.emergency')

@endsection
