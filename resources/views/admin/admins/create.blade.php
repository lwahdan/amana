@extends('admin.layouts.app')

@section('title', 'Add Admin')

@section('content')
    <div class="container py-6">

        <div class="flex justify-between items-center mb-6">
            <a href="{{ route('admins.index') }}" class="back-button mb-2">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Admins List
            </a>
            <h2 class="text-2xl font-semibold text-admin">Create Admin Profile</h2>
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

        <form action="{{ route('admins.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>

                <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="form-group col-md-6">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="phone">Phone (Optional)</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                </div>

                <!-- Profile Picture -->
                <div class="form-group col-md-6">
                    <label for="profile_picture" class="form-label">Profile Picture</label>
                    <input id="profile_picture" type="file" name="profile_picture"
                        class="form-control @error('profile_picture') is-invalid @enderror"
                        accept="image/jpeg,image/png,image/jpg">
                    @error('profile_picture')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <button type="submit" class="back-button">Create Admin</button>
        </form>
    </div>
@endsection
