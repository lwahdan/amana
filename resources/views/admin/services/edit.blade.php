@extends('admin.layouts.app')

@section('content')
    <h1>Edit Service</h1>
    <form method="POST" action="{{ route('services.update', $service->id) }}">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="{{ $service->name }}" required>
        </div>
        <div>
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
        <div>
            <label for="description">Description</label>
            <textarea name="description" id="description">{{ $service->description }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
