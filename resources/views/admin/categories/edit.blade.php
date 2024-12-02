@extends('admin.layouts.app')

@section('content')
    <h1>Edit Category</h1>
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
@endsection
