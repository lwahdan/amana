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
                            <img src="{{ asset($provider->profile_picture) }}" alt="{{ $provider->name }}">
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

    <!-- testmonial_area_start -->
    <div class="testmonial_area">
        <div class="testmonial_active owl-carousel">
            <div class="single-testmonial testmonial_bg_1 overlay2">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-10 offset-xl-1">
                            <div class="testmonial_info text-center">
                                <div class="quote">
                                    <i class="flaticon-straight-quotes"></i>
                                </div>
                                <p>Donec imperdiet congue orci consequat mattis. Donec rutrum porttitor <br>
                                    sollicitudin. Pellentesque id dolor tempor sapien feugiat ultrices nec sed neque.
                                    <br>
                                    Fusce ac mattis nulla. Morbi eget ornare dui.
                                </p>
                                <div class="testmonial_author">
                                    <h4>Asana Korim</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="single-testmonial testmonial_bg_2 overlay2">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-10 offset-xl-1">
                            <div class="testmonial_info text-center">
                                <div class="quote">
                                    <i class="flaticon-straight-quotes"></i>
                                </div>
                                <p>Donec imperdiet congue orci consequat mattis. Donec rutrum porttitor <br>
                                    sollicitudin. Pellentesque id dolor tempor sapien feugiat ultrices nec sed neque.
                                    <br>
                                    Fusce ac mattis nulla. Morbi eget ornare dui.
                                </p>
                                <div class="testmonial_author">
                                    <h4>Asana Korim</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="single-testmonial testmonial_bg_1 overlay2">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-10 offset-xl-1">
                            <div class="testmonial_info text-center">
                                <div class="quote">
                                    <i class="flaticon-straight-quotes"></i>
                                </div>
                                <p>Donec imperdiet congue orci consequat mattis. Donec rutrum porttitor <br>
                                    sollicitudin. Pellentesque id dolor tempor sapien feugiat ultrices nec sed neque.
                                    <br>
                                    Fusce ac mattis nulla. Morbi eget ornare dui.
                                </p>
                                <div class="testmonial_author">
                                    <h4>Asana Korim</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- testmonial_area_end -->

    <!-- Emergency_contact start -->
    <div class="Emergency_contact">
        <div class="conatiner-fluid p-0">
            <div class="row no-gutters">
                <div class="col-xl-6">
                    <div
                        class="single_emergency d-flex align-items-center justify-content-center emergency_bg_1 overlay_skyblue">
                        <div class="info">
                            <h3>For Any Emergency Contact</h3>
                            <p>Esteem spirit temper too say adieus.</p>
                        </div>
                        <div class="info_button">
                            <a href="#" class="boxed-btn3-white">+10 378 4673 467</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div
                        class="single_emergency d-flex align-items-center justify-content-center emergency_bg_2 overlay_skyblue">
                        <div class="info">
                            <h3>Make an Online Appointment</h3>
                            <p>Esteem spirit temper too say adieus.</p>
                        </div>
                        <div class="info_button">
                            <a href="#" class="boxed-btn3-white">Make an Appointment</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Emergency_contact end -->
@endsection
