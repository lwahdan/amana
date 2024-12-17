@extends('layouts.app')

@section('title', 'Provider Dashboard')
@section('breadcrumb-title', 'Provider Dashboard')
@section('breadcrumb-subtitle', 'Create Your Account')


@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-12 text-center">
            <!-- Success Message -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <h1>Welcome, {{ Auth::guard('provider')->user()->name }}!</h1>
            <p>This is your provider dashboard.</p>
            <a href="{{route('provider_logout')}}">logout</a>
        </div>
    </div>
</div>
@endsection
