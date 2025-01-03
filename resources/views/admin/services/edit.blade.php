@extends('admin.layouts.app')

@section('content')
<div class="container py-6">

    <div class="flex justify-between items-center mb-6">
        <a href="{{ route('services.index') }}" class="back-button mb-2">
            <i class="fas fa-arrow-left mr-2"></i>
            Back to Services List
        </a>
        <h2 class="text-2xl font-semibold text-admin">Add New Service</h2>
    </div>
    <form method="POST" action="{{ route('services.update', $service->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
        <div class="form-group col-md-6">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="{{ $service->name }}" required>
        </div>
        <div class="form-group col-md-6">
            <label for="category_id">Category</label>
            <select name="category_id" id="category_id">
                <option value="" disabled>Select a category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $service->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        </div>

        <div class="row">
        <div class="form-group col-md-6">
            <label for="description">Description</label>
            <textarea name="description" id="description">{{ $service->description }}</textarea>
        </div>
         <!-- Profile Picture -->
         <div class="form-group col-md-6">
            <label for="image" class="form-label">Service Image</label>
            <input id="image" type="file" name="image"
                class="form-control @error('image') is-invalid @enderror" accept="image/jpeg,image/png,image/jpg">
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
