@extends('admin.layouts.app')

@section('content')
    <div class="containe py-6 px-4">
        <div class="flex justify-between items-center mb-6">
            <a href="{{ route('admin.blogs') }}" class="back-button mb-2">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Blogs List
            </a>
            <h2 class="text-2xl font-semibold text-admin">Edit Blog</h2>
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

        <form class="my-blog-form" method="POST"  action="{{ route('admin.blogs.update', $blog->id) }}" enctype="multipart/form-data">
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
    
            <button type="submit" class="back-button mt-3">Update Blog</button>
        </form>

    </div>
@endsection