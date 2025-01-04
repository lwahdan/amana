@extends('admin.layouts.app')

@section('content')
    <div class="containe py-6 px-4">
        <div class="flex justify-between items-center mb-6">
            <a href="{{ route('admin.blogs') }}" class="back-button mb-2">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Blogs List
            </a>
            <h2 class="text-2xl font-semibold text-admin">View Blog</h2>
        </div>

        <div class="single-post mt-4">
            <div class="feature-img d-flex justify-content-center mb-4">
                <img src="{{ asset('storage/' . $blog->image) }}" class="single-blog-img" alt="{{ $blog->title }}">
            </div>
            <div class="blog_details">
                <ul class="d-flex justify-content-around blog-info-link">
                    <li><i class="fa fa-user"></i> By : {{ $blog->writer->name }} ({{ $blog->writer_type_name }})</li>
                    <li> <i class="fas fa-hands-helping"></i>{{ $blog->service->name }}</li>
                    <li><i class="fa fa-comments"></i> {{ $blog->comments_count }}Comments</li>
                    <li><i class="fa fa-eye"></i> {{ $blog->views }} Views</li>
                    <li><i class="fa-solid fa-thumbs-up"></i> {{ $blog->likes }} likes</li>
                    <li><i class="fa-solid fa-heart"></i> {{ $blog->favorites_count }}favorites</li>
                    <li><i class="fas fa-circle-info"></i> {{ $blog->status }}</li>
                </ul>
            </div>
            <div class="blog_content text-center">
                <h2>
                    {{ $blog->title }}
                </h2>
                <p class="excert">
                    {{ $blog->description }}
                </p>
                <p class="excert">
                    {{ $blog->content }}
                </p>
            </div>
        </div>

        <div class="comments-area">
            <h4>{{ $comments->total() }} Comments</h4>
            @foreach ($comments as $comment)
                @include('blogs.partials.comment', ['comment' => $comment])
            @endforeach
            <!-- Pagination for Top-Level Comments -->
            <div class="mt-4">
                {{ $comments->links() }}
            </div>
        </div>

    </div>
@endsection
