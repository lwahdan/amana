@extends('layouts.app')
@section('title', 'provider login')
@section('breadcrumb-title', 'provider login')
@section('breadcrumb-subtitle', 'provider login')
@section('content')

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-provider text-white text-center">
                        <h3>Provider Login</h3>
                    </div>
                    <div class="card-body">

                        <!-- Session Status -->
                        <x-auth-session-status class="mb-4" :status="session('status')" />

                        <form method="POST" action="{{ route('provider_login_submit') }}">
                            @csrf
                            <!-- Email Address -->
                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('Email Address') }}</label>
                                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                                    autofocus class="form-control @error('email') is-invalid @enderror">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
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
                                    <a href="{{ route('password.request') }}" class="text-decoration-none text-provider">
                                        {{ __('Forgot your password?') }}
                                    </a>
                                @endif
                                <button type="submit" class="btn btn-provider">
                                    {{ __('Log in') }}
                                </button>
                            </div>

                            <!-- Register Option -->
                            <div class="text-center mt-4">
                                <p>Don't have an account?
                                    @if (Route::has('register'))
                                        <a href="{{ route('provider_register') }}" class="text-decoration-none text-provider">
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
@endsection

