@extends('layouts.app')

@section('title', 'blog')

@section('breadcrumb-title', 'blog')
@section('breadcrumb-subtitle', ' blog')

@section('content')
    <section class="blog_area section-padding">

        <div class="d-flex justify-content-between blog-filters">
            <ul class="d-flex">
                <li class="me-3">
                    <a href="{{ route('blogs.index') }}" class="{{ request()->routeIs('blogs.index') ? 'active' : '' }}">
                        All
                    </a>
                </li>
                @foreach ($services as $service)
                    <li class="me-3">
                        <a href="{{ route('blogs.filterByService', $service->id) }}"
                            class="{{ request()->is('blogs/service/' . $service->id) ? 'active' : '' }}">
                            {{ $service->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
            <a href="{{ auth('provider')->check() ? route('provider.blogs.create') : route('blogs.create') }}"
                class="btn btn-blog-create"><i class="fa-solid fa-plus"></i> Create Blog</a>
        </div>

        <div class="container">
            <div class="row">
                @forelse($blogs as $blog)
                    <div class="col-md-6 mb-4">
                        <div class="card h-100">
                            <img src="{{ asset('storage/' . $blog->image) }}" class="card-img-top my-blog-card-img"
                                alt="{{ $blog->title }}">
                            {{-- <img class="card-img-top" src="{{ asset($blog->image) }}" alt="{{ $blog->name }}"> --}}
                            <div class="card-body">
                                <h5 class="blog-card-title">{{ $blog->title }}</h5>
                                <p class="card-text mb-3">{{ Str::limit($blog->description, 100) }}</p>
                                <ul class="list-inline">
                                    <li class="list-inline-item"><i class="fa-solid fa-list"></i>
                                        {{ $blog->service->name }} |</li>
                                    <li class="list-inline-item"><i class="fa fa-comments"></i> {{ $blog->comments_count }}
                                        Comments</li>
                                </ul>
                                <a href="{{ route('blogs.show', $blog->id) }}" class="btn btn-blog mt-3">Read More</a>
                            </div>
                            <div class="card-footer text-muted">
                                <span><i
                                        class="fa-solid fa-calendar-check me-2"></i>{{ $blog->created_at->format('d M Y') }}</span>
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
    <div class="mt-4 mb-5 index-blog-pagination">
        {{ $blogs->links() }}
    </div>
@endsection
