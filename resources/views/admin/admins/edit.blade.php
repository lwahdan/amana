@extends('admin.layouts.app')

@section('content')
    <div class="container py-6">
        <div class="flex justify-between items-center mb-6">
            <a href="{{ route('admins.index') }}" class="back-button mb-2">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Admins List
            </a>
            <h2 class="text-2xl font-semibold text-admin">Edit Admin Profile</h2>
        </div>

        <form method="POST" action="{{ route('admins.update', $admin->id) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6 mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                        Name
                    </label>
                    <input type="text" name="name" value="{{ $admin->name }}" required
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="col-md-6 mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                        Email
                    </label>
                    <input type="email" name="email" value="{{ $admin->email }}" required
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="phone">
                        Phone
                    </label>
                    <input type="number" name="phone" value="{{ $admin->phone }}"
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="col-md-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="profile_picture">
                        Profile Picture
                    </label>
                    <input type="file" name="profile_picture" id="profile_picture"
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @if ($admin->profile_picture)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $admin->profile_picture) }}" alt="{{ $admin->name }}"
                                class="w-32 h-32 object-cover rounded-lg shadow">
                        </div>
                    @endif
                </div>
            </div>

            <div class="flex justify-end mt-3">
                <button type="submit"
                    class="back-button">
                    Update Profile
                </button>
            </div>
        </form>

    </div>
@endsection
