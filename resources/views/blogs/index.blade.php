@extends('layouts.app')

@section('title', 'blog')

@section('breadcrumb-title', 'blog')
@section('breadcrumb-subtitle', ' blog')

@section('content')
<section class="blog_area section-padding">
    <div class="container">
        <h1>Our Blogs</h1>
        <div class="row">
            @forelse($blogs as $blog)
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                         {{-- <img src="{{ asset('storage/' . $blog->image) }}" class="card-img rounded-0"
                                        alt="{{ $blog->title }}"> --}}
                        <img class="card-img-top" src="{{ asset($blog->image) }}" alt="{{ $blog->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $blog->title }}</h5>
                            <p class="card-text">{{ Str::limit($blog->description, 100) }}</p>
                            <ul class="list-inline">
                                <li class="list-inline-item"><i class="fa fa-user"></i> {{ $blog->writer->name }}</li>
                                <li class="list-inline-item"><i class="fa fa-comments"></i> 03 Comments</li>
                            </ul>
                            <a href="{{ route('blogs.show', $blog->id) }}" class="btn btn-primary mt-2">Read More</a>
                        </div>
                        <div class="card-footer text-muted">
                            <span>{{ $blog->created_at->format('d M Y') }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p>No blogs available at the moment.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>


    <!-- Pagination -->
    <div class="mt-4">
        {{ $blogs->links() }}
    </div>
@endsection
