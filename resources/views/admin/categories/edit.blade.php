@extends('admin.layouts.app')

@section('content')
    <div class="container py-6">
        <div class="flex justify-between items-center mb-6">
            <a href="{{ route('categories.index') }}" class="back-button mb-2">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Categories List
            </a>
            <h2 class="text-2xl font-semibold text-admin">Edit Category</h2>
        </div>
        <form method="POST" action="{{ route('categories.update', $category->id) }}">
            @csrf
            @method('PUT')
            <div>
                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="{{ $category->name }}" required>
            </div>
            <div>
                <label for="description">Description</label>
                <textarea name="description" id="description">{{ $category->description }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
