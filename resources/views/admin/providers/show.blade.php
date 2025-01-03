@extends('admin.layouts.app')

@section('content')
    <a href="{{ route('providers.index') }}" class="btn btn-dashboard btn-sm mb-4 ml-4">Back to Providers</a>
    <div class="container mx-auto mt-8 admin-provider-show">
        <div class="provider-card p-6 mb-4 pb-4">
            <!-- Header Section -->
            <div class="provider-header">
                <h2 class="pt-4 pl-4">Provider Details - <span class="tag-primary">
                        <i class="fas fa-calendar-alt mr-1"></i>
                        Joined {{ $provider->created_at->format('M d, Y') }}
                    </span>
                </h2>
            </div>

            <!-- Main Grid -->
            <div class="row col-md-12">
                <!-- Left Column - Profile -->
                <div class="col-md-4">
                    <div class="flex flex-col items-center text-center">
                        <img src="{{ asset('storage/' . $provider->profile_picture) }}" alt="{{ $provider->name }}"
                            class="profile-image">
                        <h2 class="mt-4 text-xl font-medium text-gray-800">{{ $provider->name }}</h2>
                        <p class="text-[#476dda] font-medium mt-1">
                            {{ number_format($provider->hourly_rate, 2) ?? 'N/A' }} JOD/hr
                        </p>

                        <!-- Contact Info Box -->
                        <div class="info-box w-full mt-4">
                            <h3 class="info-label mb-3">Contact Information</h3>
                            <div class="space-y-2">
                                <p class="flex items-center text-sm">
                                    <i class="fas fa-envelope info-icon"></i>
                                    <span class="info-value">{{ $provider->email }}</span>
                                </p>
                                <p class="flex items-center text-sm">
                                    <i class="fas fa-phone info-icon"></i>
                                    <span class="info-value">{{ $provider->phone }}</span>
                                </p>
                                <p class="flex items-center text-sm">
                                    <i class="fas fa-map-marker-alt info-icon"></i>
                                    <span class="info-value">{{ $provider->address }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Middle Column - Main Info -->
                <div class="col-md-4">
                    <!-- Personal Info -->
                    <div class="mb-6">
                        <h3 class="info-label mb-3">
                            <i class="fas fa-user mr-2"></i>Personal Information
                        </h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="info-box">
                                <span class="info-label block mb-1">Gender</span>
                                <span class="info-value">{{ $provider->gender }}</span>
                            </div>
                            <div class="info-box">
                                <span class="info-label block mb-1">Age</span>
                                <span class="info-value">{{ $provider->date_of_birth->age }} years</span>
                            </div>
                            <div class="info-box">
                                <span class="info-label block mb-1">Experience</span>
                                <span class="info-value">{{ $provider->years_of_experience ?? 'N/A' }} years</span>
                            </div>
                            <div class="info-box">
                                <span class="info-label block mb-1">Education</span>
                                <span class="info-value">{{ $provider->education }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Bio -->
                    <div class="mb-6">
                        <h3 class="info-label mb-3 mt-3">
                            <i class="fas fa-info-circle mr-2"></i>About
                        </h3>
                        <div class="info-box">
                            <p class="text-gray-700">{{ $provider->bio }}</p>
                        </div>
                    </div>

                    <!-- Certifications -->
                    <div>
                        <h3 class="info-label mb-3">
                            <i class="fas fa-certificate mr-2 mt-3"></i>Certifications
                        </h3>
                        <div class="tag-container">
                            @php
                                $certifications = array_filter(
                                    array_map('trim', explode(',', $provider->certifications ?? '')),
                                );
                            @endphp
                            @forelse ($certifications as $certification)
                                <span class="tag-primary">{{ $certification }}</span>
                            @empty
                                <p class="text-gray-500 text-sm">No certifications available</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Right Column - Skills & Availability -->
                <div class="col-md-4">
                    <!-- Skills -->
                    <div class="mb-6">
                        <h3 class="info-label mb-3">
                            <i class="fas fa-tools mr-2"></i>Skills
                        </h3>
                        <div class="tag-container">
                            @foreach (json_decode($provider->skills ?? '[]') as $skill)
                                <span class="tag-primary">{{ $skill }}</span>
                            @endforeach
                        </div>
                    </div>

                    <!-- Languages -->
                    <div class="mb-6">
                        <h3 class="info-label mb-3 mt-3">
                            <i class="fas fa-language mr-2"></i>Languages
                        </h3>
                        <div class="tag-container">
                            @foreach (json_decode($provider->languages_spoken ?? '[]') as $language)
                                <span class="tag-secondary">{{ $language }}</span>
                            @endforeach
                        </div>
                    </div>

                    <!-- Availability -->
                    <div class="mb-6">
                        <h3 class="info-label mb-3 mt-3">
                            <i class="fas fa-clock mr-2"></i>Availability
                        </h3>
                        <div class="tag-container">
                            @foreach (json_decode($provider->availability ?? '[]') as $time)
                                <span class="tag-secondary">{{ $time }}</span>
                            @endforeach
                        </div>
                    </div>

                    <!-- Work Shifts -->
                    <div class="mb-6">
                        <h3 class="info-label mb-3 mt-3">
                            <i class="fas fa-business-time mr-2"></i>Work Shifts
                        </h3>
                        <div class="tag-container">
                            @foreach (json_decode($provider->work_shifts ?? '[]') as $shift)
                                <span class="tag-secondary">{{ $shift }}</span>
                            @endforeach
                        </div>
                    </div>

                    <!-- Service Areas -->
                    <div class="mb-6">
                        <h3 class="info-label mb-3 mt-3">
                            <i class="fas fa-map mr-2"></i>Service Areas
                        </h3>
                        <div class="tag-container">
                            @foreach ($provider->cities as $city)
                                <span class="tag-primary">{{ $city->name }}</span>
                            @endforeach
                        </div>
                    </div>

                    <!-- Service provided -->
                    <div class="mb-6">
                        <h3 class="info-label mb-3 mt-3">
                            <i class="fas fa-hand-holding-medical mr-2"></i>Services Offered
                        </h3>
                        <div class="tag-container">
                            @foreach ($provider->services as $service)
                                <span class="tag-primary">{{ $service->name }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="provider-bookings table-responsive">
            <h2>Bookings</h2>
            @if ($bookings->isEmpty())
                <p>No bookings found for this provider.</p>
            @else
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Service</th>
                            <th>Client</th>
                            <th>City</th>
                            <th>Price</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $booking)
                            <tr>
                                <td>{{ $booking->service->name ?? 'N/A' }}</td>
                                <td>{{ $booking->user->name ?? 'N/A' }}</td>
                                <td>{{ $booking->city->name ?? 'N/A' }}</td>
                                <td>{{ number_format($booking->total_price, 2) }}</td>
                                <td>{{ $booking->booking_date->format('Y-m-d H:i') }}</td>
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
                                <td>{{ $booking->created_at->format('d-m-Y H:i') }}</td>
                                <td>
                                    <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-warning btn-sm"><i
                                            class="fas fa-edit"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
            <div class="admin_provider_pagination">
                {{ $bookings->links() }}
            </div>
        </div>

        <div class="provider-meetings table-responsive">
            <h2>Meetings</h2>
            @if ($meetings->isEmpty())
                <p>No meetings scheduled for this provider.</p>
            @else
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Meeting Date</th>
                            <th>Meeting Time</th>
                            <th>Meeting Link</th>
                            <th>With</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($meetings as $meeting)
                            <tr>
                                <td>{{ $meeting->meeting_date ? $meeting->meeting_date->format('d-m-Y') : 'N/A' }}</td>
                                <td>{{ $meeting->meeting_date ? $meeting->meeting_date->format('H:i') : 'N/A' }}</td>
                                <td>{{ $meeting->meeting_link ?? 'N/A' }}</td>
                                <td>{{ $meeting->user->name ?? 'N/A' }}</td>
                                <td>
                                    <span
                                        class="badge badge-color
                        @if ($meeting->status == 'requested') bg-warning 
                        @elseif ($meeting->status == 'confirmed') bg-primary 
                        @elseif ($meeting->status == 'completed') bg-success 
                        @elseif ($meeting->status == 'cancelled') bg-danger @endif">
                                        {{ ucfirst($meeting->status) }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
            <div class="admin_provider_pagination">
                {{ $meetings->links() }}
            </div>
        </div>

        <div class="provider-blogs table-responsive">
            <h2 class="mt-4">Blogs</h2>
            <table class="table table-striped table-provider">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Service</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Views</th>
                        <th>Likes</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($blogs as $blog)
                        <tr>
                            <td>{{ $blog->id }}</td>
                            <td>{{ $blog->service->name }}</td>
                            <td>{{ $blog->title }}</td>
                            <td>{{ Str::limit($blog->description, 100) }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}"
                                    style="width: 100px; height: auto;">
                            </td>
                            <td>{{ $blog->views }}</td>
                            <td>{{ $blog->likes }}</td>
                            <td class="d-flex justify-content-around">
                                <a href="{{ route('admin.blogs.show', $blog->id) }}" class="btn btn-info btn-sm"><i
                                        class="fa-regular fa-eye"></i></a>
                                <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="btn btn-warning btn-sm"><i
                                        class="fa-regular fa-pen-to-square"></i></a>
                                <form method="POST" action="{{ route('admin.blogs.destroy', $blog->id) }}"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"><i
                                            class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No blogs available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="admin_provider_pagination">
                {{ $blogs->links() }}
            </div>
        </div>

        <div class="provider-reviews table-responsive">
            <h2>Reviews</h2>
            @if ($reviews->isEmpty())
                <p>No reviews found for this provider.</p>
            @else
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Service</th>
                            <th>Client</th>
                            <th>Rating</th>
                            <th>Comment</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reviews as $review)
                            <tr>
                                <td>{{ $review->service->name ?? 'N/A' }}</td>
                                <td>{{ $review->user->name ?? 'N/A' }}</td>
                                <td>{{ $review->rating }}</td>
                                <td>{{ $review->review }}</td>
                                <td>
                                    <span
                                        class="badge badge-color
                    @if ($review->status == 'pending') bg-warning 
                    @elseif ($review->status == 'approved') bg-primary 
                    @elseif ($review->status == 'disapproved') bg-danger @endif">
                                        {{ ucfirst($review->status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('reviews.index', $review->id) }}" class="btn btn-info btn-sm"><i
                                            class="fas fa-eye"></i></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
            <div class="admin_provider_pagination">
                {{ $reviews->links() }}
            </div>
        </div>
    </div>
@endsection
