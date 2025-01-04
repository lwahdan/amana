@extends('layouts.app')
@section('title', 'single_blog')
@section('breadcrumb-title', 'Blog detials')
@section('breadcrumb-subtitle', ' Blog detials')
@section('content')
    <section class="blog_area single-post-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 posts-list">

                    <div class="single-post">
                        <div class="feature-img d-flex justify-content-center mb-4">
                            <img src="{{ asset('storage/' . $blog->image) }}" class="single-blog-img"
                                alt="{{ $blog->title }}">
                        </div>
                        <div class="blog_details">
                            <h2>
                                {{ $blog->title }}
                            </h2>
                            <ul class="blog-info-link mt-3 mb-4">
                                <li><a href="#"><i class="fa-solid fa-bars"></i>{{ $blog->service->name }}</a></li>
                                <li><a href="#"><i class="fa fa-comments"></i> {{ $blog->comments_count }}
                                        Comments</a></li>
                                <li><a href="#"><i class="fa fa-user"></i> By : {{ $blog->writer->name }}</a></li>
                            </ul>
                            <p class="excert">
                                {{ $blog->content }}
                            </p>
                        </div>
                    </div>

                    <div class="navigation-top">
                        <div class="d-sm-flex justify-content-between text-center">

                            <p class="like-info" id="like-info">
                                <span class="align-middle">
                                    <button id="like-btn">
                                        <i class="fa-solid fa-thumbs-up {{ $hasLiked ? 'text-primary' : '' }}"></i>
                                    </button>
                                </span>
                                <span id="likes-count">{{ $blog->likes }} people like this</span>
                            </p>

                            <div class="col-sm-4 text-center my-2 my-sm-0">
                                <p class="like-info">
                                    <span class="align-middle" id="favorite-btn">
                                        <i class="fa-solid fa-heart {{ $isFavorited ? 'text-danger' : '' }}"></i>
                                    </span>
                                    <span id="favorites-count">{{ $blog->favorites_count }} people added to
                                        favorites</span>
                                </p>
                            </div>

                            <ul class="social-icons">
                                <li><a href="#"><i class="fa-brands fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-whatsapp"></i></a></li>
                            </ul>
                        </div>

                        <div class="navigation-area">
                            <div class="row">
                                <div
                                    class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">
                                    @if ($prevBlog)
                                        <div class="thumb">
                                            <a href="{{ route('blogs.show', $prevBlog->id) }}">
                                                <img src="{{ asset('storage/' . $prevBlog->image) }}" class="blog-prev-img"
                                                    alt="{{ $prevBlog->title }}">
                                                {{-- <img class="img-fluid blog-prev-img" src="{{ asset($prevBlog->image) }}" alt="{{ $prevBlog->title }}"> --}}
                                            </a>
                                        </div>
                                        <div class="arrow">
                                            <a href="{{ route('blogs.show', $prevBlog->id) }}">
                                                <span class="lnr text-white ti-arrow-left"></span>
                                            </a>
                                        </div>
                                        <div class="detials">
                                            <p>Prev Blog</p>
                                            <a href="{{ route('blogs.show', $prevBlog->id) }}">
                                                <h4>{{ $prevBlog->title }}</h4>
                                            </a>
                                        </div>
                                    @else
                                        <p>No previous blog</p>
                                    @endif
                                </div>

                                <div
                                    class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">
                                    @if ($nxtBlog)
                                        <div class="detials">
                                            <p>Next Blog</p>
                                            <a href="{{ route('blogs.show', $nxtBlog->id) }}">
                                                <h4>{{ $nxtBlog->title }}</h4>
                                            </a>
                                        </div>
                                        <div class="arrow">
                                            <a href="{{ route('blogs.show', $nxtBlog->id) }}">
                                                <span class="lnr text-white ti-arrow-right"></span>
                                            </a>
                                        </div>
                                        <div class="thumb">
                                            <a href="{{ route('blogs.show', $nxtBlog->id) }}">
                                                <img src="{{ asset('storage/' . $nxtBlog->image) }}" class="blog-prev-img"
                                                    alt="{{ $nxtBlog->title }}">
                                                {{-- <img class="img-fluid blog-prev-img" src="{{ asset($nxtBlog->image) }}" alt="{{ $nxtBlog->title }}"> --}}
                                            </a>
                                        </div>
                                    @else
                                        <p>No next blog</p>
                                    @endif
                                </div>
                            </div>
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

                    <div class="comment-form">
                        <h4>Leave a Comment</h4>
                        <form class="form-contact comment_form" method="POST"
                            action="{{ route('blogs.comment', $blog->id) }}" id="commentForm">
                            @csrf
                            <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                            <div class="row">
                                <div class="col-11">
                                    <div class="form-group">
                                        <textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="1"
                                            placeholder="Write Comment"></textarea>
                                    </div>
                                </div>
                                <div class="form-group col-1">
                                    <button type="submit" class="button button-contactForm btn_1 boxed-btn"><i
                                            class="fa-solid fa-arrow-right"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <script>
        // add to favorites
        document.getElementById('favorite-btn').addEventListener('click', function() {
            fetch(`{{ route('blogs.toggleFavorite', $blog->id) }}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({}),
                })
                .then(response => {
                    if (response.redirected) {
                        // Redirect user to login if not authenticated
                        Swal.fire({
                            icon: 'info',
                            // title: 'Login Required',
                            text: 'You must log in to favorite a blog.',
                            timer: 3000, // 5 seconds in milliseconds
                            timerProgressBar: true, // Show a progress bar during the timer
                            showConfirmButton: false, // Remove the "OK" button
                        }).then(() => {
                            window.location.href = response.url; // Redirect to login after the alert
                        });
                        return;
                    }
                    if (response.status === 401) {
                        Swal.fire({
                            icon: 'info',
                            title: 'Login Required',
                            text: 'You must log in to favorite a blog.',
                            timer: 3000,
                            timerProgressBar: true,
                            showConfirmButton: false,
                        }).then(() => {
                            window.location.href = '{{ route('login') }}';
                        });
                        return;
                    }
                    if (!response.ok) {
                        throw new Error('An unexpected error occurred.');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data && data.favorites_count !== undefined) {
                        // Update the count only
                        document.getElementById('favorites-count').innerText =
                            `${data.favorites_count} people added to favorites`;

                        // Optional: Update the heart icon or style dynamically
                        const heartIcon = document.querySelector('#favorite-btn i');
                        if (data.message === 'Added to favorites') {
                            heartIcon.classList.add('text-danger'); // Highlight the heart
                        } else {
                            heartIcon.classList.remove('text-danger'); // Unhighlight the heart
                        }
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Something went wrong. Please try again.');
                });
        });

        // like a blog
        document.getElementById('like-btn').addEventListener('click', function() {
            fetch(`{{ route('blogs.like', $blog->id) }}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({}),
                })
                .then(response => {
                    if (response.redirected) {
                        // Redirect user to login if not authenticated
                        Swal.fire({
                            icon: 'info',
                            // title: 'Login Required',
                            text: 'You must log in to like a blog.',
                            timer: 3000, // 5 seconds in milliseconds
                            timerProgressBar: true, // Show a progress bar during the timer
                            showConfirmButton: false, // Remove the "OK" button
                        }).then(() => {
                            window.location.href = response.url; // Redirect to login after the alert
                        });
                        return;
                    }
                    if (response.status === 401) {
                        Swal.fire({
                            icon: 'info',
                            title: 'Login Required',
                            text: 'You must log in to like a blog.',
                            timer: 3000,
                            timerProgressBar: true,
                            showConfirmButton: false,
                        }).then(() => {
                            window.location.href = '{{ route('login') }}';
                        });
                        return;
                    }
                    if (!response.ok) {
                        throw new Error('An unexpected error occurred.');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.likes !== undefined) {
                        document.getElementById('likes-count').innerText = `${data.likes} people like this`;

                        // Optional: Update the like icon or style dynamically
                        const likeIcon = document.querySelector('#like-btn i');
                        if (data.message === 'You liked the blog') {
                            likeIcon.classList.add('text-primary'); // Highlight the heart
                        } else {
                            likeIcon.classList.remove('text-primary'); // Unhighlight the heart
                        }
                    }
                    // alert(data.message || 'Action performed.');
                })
                .catch(error => {
                    console.error('Error:', error);
                    // alert('Something went wrong. Please try again.');
                });
        });
    </script>
@endsection
