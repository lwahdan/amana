@extends('admin.layouts.app')

@section('content')
<div class="containe py-6 px-4">
    <div class="flex justify-between items-center mb-6">
        <a href="{{ route('reviews.index') }}" class="back-button mb-2">
            <i class="fas fa-arrow-left mr-2"></i>
            Back to Reviews List
        </a>
        <h2 class="text-2xl font-semibold text-admin">Add New Review</h2>
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

    <form action="{{ route('reviews.store') }}" method="POST">
        @csrf
         <!-- User Dropdown -->
         <div class="form-group">
            <label for="user_id">User</label>
            <select class="form-control @error('user_id') is-invalid @enderror" id="user_id" name="user_id">
                <option value="" selected disabled>Select a User</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            @error('user_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Services Dropdown -->
        <div class="form-group">
            <label for="service_id">Service</label>
            <select class="form-control @error('service_id') is-invalid @enderror" id="service_id" name="service_id">
                <option value="" selected disabled>Select a Service</option>
                @foreach($services as $service)
                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                @endforeach
            </select>
            @error('service_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

         <!-- Providers Dropdown -->
         <div class="form-group">
            <label for="provider_id">Provider</label>
            <select class="form-control @error('provider_id') is-invalid @enderror" id="provider_id" name="provider_id">
                <option value="" selected disabled>Select a Provider</option>
                @foreach($providers as $provider)
                    <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                @endforeach
            </select>
            @error('provider_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

         <!-- rating -->
         <div class="form-group">
            <label for="rating">Rating</label>
            <select class="form-control @error('rating') is-invalid @enderror" id="rating" name="rating">
                <option value="" selected disabled>Select a Rating</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
            @error('rating')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Review -->
        <div class="form-group">
            <label for="review">Review</label>
            <textarea class="form-control @error('review') is-invalid @enderror" id="review" name="review" rows="4"></textarea>
            @error('review')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex justify-end">
            <button type="submit" class="back-button">
                Submit Review
            </button>
        </div>
    </form>

</div>
@endsection