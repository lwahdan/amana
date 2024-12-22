@extends('layouts.app')

@section('title','about')

@section('breadcrumb-title','User Dashboard')
@section('breadcrumb-subtitle','user dashboard')
@section('content')

{{-- <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                {{ __("You're logged in!") }}
                <div>              
                </div>

            </div>
        </div>
    </div>
</div>

user dashboard
<h1>Welcome, {{ Auth::user()->name }}</h1>

<a href="{{ route('profile.edit') }}">Edit Profile</a>
<a href="{{ route('logout') }}"
   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
   Log out
</a>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form> --}}
<div class="container py-5">
    <div class="row">
        <!-- Success Message -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Sidebar -->
        <div class="col-md-3">
            <div class="dashboard-wrapper">
                @include('auth.partials.sidebar')
            </div>
        </div>

        <!-- Content -->
        <div class="col-md-9">
            <div class="dashboard-content">
                @yield('user-dashboard-content')
            </div>
        </div>

    </div>
</div>

@endsection