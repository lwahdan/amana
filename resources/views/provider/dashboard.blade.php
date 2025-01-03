@extends('layouts.app')
@section('title', 'Provider Dashboard')
@section('breadcrumb-title', 'Provider Dashboard')
@section('breadcrumb-subtitle', 'Provider Dashboard')
@section('content')
    <div class="container py-5">
        <div class="row">
          
            <!-- Sidebar -->
            <div class="col-md-3">
                <div class="dashboard-wrapper">
                    @include('provider.partials.sidebar')
                </div>
            </div>

            <!-- Content -->
            <div class="col-md-9">
                <div class="dashboard-content">
                    @yield('dashboard-content')
                </div>
            </div>

        </div>
    </div>
@endsection
