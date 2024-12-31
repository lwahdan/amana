@extends('layouts.app')

@section('title', 'Create Blog')
@section('breadcrumb-title', 'Create Blog')
@section('breadcrumb-subtitle', 'Share your experience or knowledge')
@section('content')
    <div class="container">
        <form class="my-blog-form" method="POST" action="{{ auth('provider')->check() ? route('provider.blogs.store') : route('blogs.store') }}" enctype="multipart/form-data">
            @csrf
            <!-- Blog Title -->
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title"
                       value="{{ old('title') }}" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Blog Service Dropdown -->
            <div class="form-group">
                <label for="service_id">Service</label>
                <select name="service_id" id="service_id" class="form-control @error('service_id') is-invalid @enderror" required>
                    <option value="" disabled selected>Select a Service</option>
                    @foreach ($services as $service)
                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                    @endforeach
                </select>
                @error('service_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Blog Description -->
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" rows="3"
                          required>{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Blog Content -->
            <div class="form-group">
                <label for="content">Content</label>
                <textarea name="content" class="form-control @error('content') is-invalid @enderror" id="content" rows="5"
                          required>{{ old('content') }}</textarea>
                @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Blog Image Upload -->
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" class="form-control-file @error('image') is-invalid @enderror" id="image" required>
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-blog mt-3">Submit Blog</button>
        </form>
    </div>
@endsection
