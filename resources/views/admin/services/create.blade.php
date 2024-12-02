@extends('admin.layouts.app')

@section('content')
    <h1>Add Service</h1>
    <form method="POST" action="{{ route('services.store') }}">
        @csrf
        <div>
            <label for="name">Name</label>
            <input type="text" name="name" id="name" required>
        </div>
        <div>
            <label for="category_id">Category</label>
            <select name="category_id" id="category_id" required>
                <option value="" disabled selected>Select a category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="description">Description</label>
            <textarea name="description" id="description"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Create</button>
    </form>
@endsection
