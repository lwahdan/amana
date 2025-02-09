@extends('layouts.app')
@section('title', 'providers')
@section('breadcrumb-title', 'providers')
@section('breadcrumb-subtitle', $provider->name . ' - Profile')
@section('content')
    <div class="container py-5">
        <div class="profile-container">
            <!-- Left Sidebar -->
            <div class="profile-sidebar">
                <div class="profile-header text-center">
                    <div class="profile-image-container">
                        <img src="{{ asset('storage/' . $provider->profile_picture) }}" alt="{{ $provider->name }}"
                            class="profile-image">
                    </div>
                    <h2 class="profile-name">{{ $provider->name }}</h2>
                    <div class="my-profile-services">
                        <ul>
                            @foreach ($provider->services as $service)
                                <li class="profile-badge">{{ $service->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <p class="profile-bio">{{ $provider->bio }}</p>
                    <div class="profile-contact">
                        <div class="contact-item">
                            <i class="fas fa-envelope"></i>
                            {{ $provider->email }}
                        </div>
                        <div class="contact-rate">
                            <span class="rate-label">Hourly Rate:</span>
                            <span class="rate-amount">{{ number_format($provider->hourly_rate, 2) }} JOD</span>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('meetings.request', $provider->id) }}" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn-request-meeting">Request a Meeting</button>
                    </form>
                    <a href="{{ route('book', ['provider_id' => $provider->id , 'service_id' => $provider->services->first()->id ]) }}" class="btn-request-meeting mt-4">Book Now</a>
                </div>
            </div>

            <!-- Main Content -->
            <div class="profile-main">
                <!-- Personal Information -->
                <div class="profile-section">
                    <h3 class="section-title">Personal Information</h3>
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="info-label">Gender</span>
                            <span class="info-value">{{ ucfirst($provider->gender) }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Age</span>
                            <span class="info-value">{{ $provider->date_of_birth ? $provider->date_of_birth->age : 'N/A' }}
                                years</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Experience</span>
                            <span class="info-value">{{ $provider->years_of_experience ?? 'N/A' }} years</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Education</span>
                            <span class="info-value">{{ $provider->education ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Skills & Qualifications -->
                <div class="profile-section">
                    <h3 class="section-title">Skills & Qualifications</h3>
                    <div class="tags-container">
                        @foreach (json_decode($provider->skills ?? '[]') as $skill)
                            <span class="tag">{{ $skill }}</span>
                        @endforeach
                    </div>

                    <h4 class="subsection-title mb-3">Certifications</h4>
                    <div class="certification-list">
                        @php
                            // Split certifications by comma and trim whitespace
                            $certifications = array_filter(
                                array_map('trim', explode(',', $provider->certifications ?? '')),
                            );
                        @endphp

                        @forelse ($certifications as $certification)
                            <div class="certification-item">
                                <i class="fas fa-certificate"></i>
                                <span>{{ $certification }}</span>
                            </div>
                        @empty
                            <p>No certifications available.</p>
                        @endforelse
                    </div>

                </div>

                <!-- Languages & Availability -->
                <div class="profile-section">
                    <h3 class="section-title">Languages & Availability</h3>
                    <div class="two-column-grid">
                        <div class="column">
                            <h4 class="subsection-title mb-3">Languages Spoken</h4>
                            <div class="tags-container">
                                @foreach (json_decode($provider->languages_spoken ?? '[]') as $language)
                                    <span class="tag">{{ $language }}</span>
                                @endforeach
                            </div>
                        </div>

                        <div class="column">
                            <h4 class="subsection-title mb-3">Working Days</h4>
                            <div class="availability-list">
                                @foreach (json_decode($provider->availability ?? '[]') as $time)
                                    <div class="availability-item">{{ $time }}</div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Added Working Shifts Section -->
                    <div class="shifts-section">
                        <h4 class="subsection-title">Working Shifts</h4>
                        <div class="shifts-grid">
                            @foreach (json_decode($provider->work_shifts ?? '[]') as $shift)
                                <div class="shift-item">
                                    <i class="far fa-clock"></i>
                                    <span>{{ $shift }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Locations -->
                <div class="profile-section">
                    <h3 class="section-title">Service Locations</h3>
                    <div class="locations-grid">
                        @foreach ($provider->cities as $city)
                            <div class="location-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>{{ $city->name }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- reviews section --}}
        @include('reviews', ['reviews' => $provider->reviews->where('status', 'approved')])

        <div class="related-providers mt-5">            
            @if($relatedProviders->count() > 0)
                <div class="providers-scroll">
                    <div class="providers-row">
                        @foreach ($relatedProviders as $relatedProvider)
                            <div class="provider-card">
                                <div class="provider-image">
                                    @if($relatedProvider->profile_picture)
                                        <img src="{{ asset('storage/' . $relatedProvider->profile_picture) }}" 
                                             alt="{{ $relatedProvider->name }}"
                                             class="profile-pic">
                                    @else
                                        <div class="profile-placeholder">
                                            {{ strtoupper(substr($relatedProvider->name, 0, 1)) }}
                                        </div>
                                    @endif
                                </div>
                                <div class="provider-info">
                                    <h4>{{ $relatedProvider->name }}</h4>
                                    <div class="services-list">
                                        @foreach ($relatedProvider->services->take(3) as $service)
                                            <span class="service-tag">{{ $service->name }}</span>
                                        @endforeach
                                        @if($relatedProvider->services->count() > 3)
                                            <span class="service-tag more">+{{ $relatedProvider->services->count() - 3 }}</span>
                                        @endif
                                    </div>
                                    <a href="{{ route('show.provider.info', $relatedProvider->id) }}" class="view-profile">
                                        View Profile
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <p class="no-providers">No related providers found.</p>
            @endif
        </div>
        
    </div>
@endsection
