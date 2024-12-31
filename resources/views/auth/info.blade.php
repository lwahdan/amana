@extends('dashboard')

@section('user-dashboard-content')
<form class="container" action="{{ route('user.info.update') }}" method="POST" novalidate>
    @csrf
    @method('PUT')
    <div class="container section-1">
        <h4 class="user-primary">Personal Information</h4>
        <div class="row">
            <!-- Name -->
            <div class="form-group col-md-6">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control"
                    value="{{ old('name', $user->name) }}" required>
            </div>

            <!-- Email -->
            <div class="form-group col-md-6">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control"
                    value="{{ old('email', $user->email) }}" required>
            </div>
        </div>

        <div class="row">
            <!-- Phone -->
            <div class="form-group col-md-6">
                <label for="phone">Phone</label>
                <input type="text" name="phone" id="phone" class="form-control"
                    value="{{ old('phone', $user->phone) }}">
            </div>

            <!-- Address -->
            <div class="form-group col-md-6">
                <label for="address">Address</label>
                <textarea name="address" id="address" class="form-control">{{ old('address', $user->address) }}</textarea>
            </div>
        </div>

        <div class="row mb-3">
            {{-- current password --}}
            <div class="col-md-4">
                <label for="current_password" class="form-label">Current Password</label>
                <input id="current_password" type="password" name="current_password"
                    class="form-control @error('current_password') is-invalid @enderror" required>
                @error('current_password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <!-- Password -->
            <div class="col-md-4">
                <label for="password" class="form-label">Password</label>
                <input id="password" type="password" name="password"
                    class="form-control @error('password') is-invalid @enderror" required
                    pattern="(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}"
                    title="Password must be at least 8 characters long, include a letter, a number, and a special character.">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="col-md-4">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation"
                    class="form-control @error('password_confirmation') is-invalid @enderror"
                    required>
                @error('password_confirmation')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

{{-- move pp later --}}
        <div class="form-group col-md-6">
            <label for="profile_picture">Profile Picture</label>
            <input type="file" name="profile_picture" id="profile_picture" class="form-control">
        </div>

{{-- <a href="{{ route('logout') }}"
   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
   Log out
</a> --}}

        
    </div>
    <!-- Submit Button -->
    <button type="submit" class="btn-user">Update Info</button>
</form>
{{-- <form id="logout-form" action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit">user Logout</button>
</form>  --}}
@endsection