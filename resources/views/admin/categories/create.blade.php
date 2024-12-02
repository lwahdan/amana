@extends('admin.layouts.app')

@section('content')
    <h1>Add Category</h1>
    <form method="POST" action="{{ route('categories.store') }}">
        @csrf
        <div>
            <label for="name">Name</label>
            <input type="text" name="name" id="name" required>
        </div>
        <div>
            <label for="description">Description</label>
            <textarea name="description" id="description"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Create</button>
    </form>
@endsection
