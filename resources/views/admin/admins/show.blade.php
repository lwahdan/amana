@extends('admin.layouts.app')

@section('content')
<div class="container py-6">
    <!-- Header Section -->
    <div class="flex justify-between items-center mb-6">
        <a href="{{ route('admins.index') }}" class="back-button mb-2">
            <i class="fas fa-arrow-left mr-2"></i>
            Back to Admins List
        </a>
        <h2 class="text-2xl font-semibold text-admin">Admin Profile</h2>
    </div>

    <!-- Profile Card -->
    <div class="admin-profile-card p-6">
        <div class="grid grid-cols-12 gap-6">
            <!-- Left Column - Profile Picture -->
            <div class="col-span-12 md:col-span-3">
                <div class="flex flex-col items-center text-center">
                    <img 
                        src="{{ $admin->profile_picture ? asset('storage/' . $admin->profile_picture) : asset('img/profile_pictures/default-profile.png') }}" 
                        alt="{{ $admin->name }}" 
                        class="profile-image"
                    >
                    <h2 class="mt-4 text-xl font-medium text-gray-800">{{ $admin->name }}</h2>
                    <span class="mt-1 px-3 py-1 text-sm rounded-full bg-[#476dda]/10 text-[#476dda]">
                        Administrator
                    </span>
                </div>
            </div>

            <!-- Right Column - Admin Information -->
            <div class="col-span-12 md:col-span-9">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Email -->
                    <div class="info-item">
                        <span class="info-label block mb-1">
                            <i class="fas fa-envelope mr-2 text-[#476dda]"></i>
                            Email Address :
                        </span>
                        <span class="text-gray-700">{{ $admin->email }}</span>
                    </div>

                    <!-- Phone -->
                    <div class="info-item">
                        <span class="info-label block mb-1">
                            <i class="fas fa-phone mr-2 text-[#476dda]"></i>
                            Phone Number :
                        </span>
                        <span class="text-gray-700">{{ $admin->phone }}</span>
                    </div>

                    <!-- Created At -->
                    <div class="info-item">
                        <span class="info-label block mb-1">
                            <i class="fas fa-calendar mr-2 text-[#476dda]"></i>
                            Member Since :
                        </span>
                        <span class="text-gray-700">{{ $admin->created_at->format('F d, Y') }}</span>
                    </div>
                </div>

                <!-- Activity Summary (optional section) -->
                <div class="mt-6">
                    <h3 class="text-lg font-medium text-gray-800 mb-4">Recent Activity</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="info-item text-center">
                            <span class="block text-2xl font-semibold text-[#476dda]">0</span>
                            <span class="info-label">Actions Today</span>
                        </div>
                        <div class="info-item text-center">
                            <span class="block text-2xl font-semibold text-[#476dda]">0</span>
                            <span class="info-label">Total Actions</span>
                        </div>
                        <div class="info-item text-center">
                            <span class="block text-2xl font-semibold text-[#476dda]">0</span>
                            <span class="info-label">Reports Generated</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection