@extends('layouts.app')
@section('title', 'user login')
@section('breadcrumb-title', 'user login')
@section('breadcrumb-subtitle', 'user login')
@section('content')

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-user text-white text-center">
                        <h3>User Login</h3>
                    </div>
                    <div class="card-body">

                        <!-- Session Status -->
                        <x-auth-session-status class="mb-4" :status="session('status')" />

                        <form id="login-form" method="POST" action="{{ route('login') }}" novalidate>
                            @csrf
                            <!-- Email Address -->
                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('Email Address') }}</label>
                                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                                    autofocus class="form-control @error('email') is-invalid @enderror">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div id="email-error" class="text-danger mt-2" style="display: none;">Please enter a valid
                                    email address.</div>
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label">{{ __('Password') }}</label>
                                <input id="password" type="password" name="password" required
                                    class="form-control @error('password') is-invalid @enderror">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Actions -->
                            <div class="d-flex justify-content-between align-items-center">
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="text-decoration-none user-primary">
                                        {{ __('Forgot your password?') }}
                                    </a>
                                @endif
                                <button type="submit" class="btn my-btn-user">
                                    {{ __('Log in') }}
                                </button>
                            </div>

                            <!-- Register Option -->
                            <div class="text-center mt-4">
                                <p>Don't have an account?
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="text-decoration-none user-primary">
                                            Register here
                                        </a>
                                    @endif
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        //provider login validation
        const emailInput = document.getElementById('email');
        const emailError = document.getElementById('email-error');
        const loginform = document.getElementById('login-form');

        function isValidEmail(email) {
            return /\S+@\S+\.\S+/.test(email);
        }

        loginform.addEventListener('submit', function(e) {
            if (!isValidEmail(emailInput.value.trim())) {
                e.preventDefault();
                emailError.style.display = 'block';
            }
        });
    </script>
@endsection
