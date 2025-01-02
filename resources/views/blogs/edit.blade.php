@extends('layouts.app')

@section('title', 'Edit Blog')
@section('breadcrumb-title', 'Edit Blog')
@section('breadcrumb-subtitle', 'edit your blog')
@section('content')
<div class="container">
    <form class="my-blog-form" method="POST"  action="{{ auth('provider')->check() ? route('provider.blogs.update', $blog->id) : route('blogs.update', $blog->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" id="title" value="{{ $blog->title }}" required>
        </div>

        <div class="form-group">
            <label for="service_id">Service</label>
            <select name="service_id" class="form-control" required>
                @foreach ($services as $service)
                    <option value="{{ $service->id }}" {{ $blog->service_id == $service->id ? 'selected' : '' }}>
                        {{ $service->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" id="description" required>{{ $blog->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="content">Content</label>
            <textarea name="content" class="form-control" id="content" rows="5" required>{{ $blog->content }}</textarea>
        </div>

        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image" class="form-control-file">
            @if ($blog->image)
                <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" class="img-thumbnail mt-2" width="150">
            @endif
        </div>

        <button type="submit" class="btn btn-blog mt-3">Update Blog</button>
    </form>
</div>
@endsection
