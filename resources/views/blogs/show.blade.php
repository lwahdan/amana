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
                            <img class="img-fluid" src="{{ asset($blog->image) }}" alt="{{ $blog->name }}">
                        </div>
                        <div class="blog_details">
                            <h2>
                                {{ $blog->title }}
                            </h2>
                            <ul class="blog-info-link mt-3 mb-4">
                                <li><a href="#"><i class="fa fa-user"></i>{{ $blog->service->name }}</a></li>
                                <li><a href="#"><i class="fa fa-comments"></i> {{ $blog->comments_count }}
                                        Comments</a></li>
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
                                <span id="likes-count">{{ $blog->likes }}</span> people like this
                            </p>

                            <div class="col-sm-4 text-center my-2 my-sm-0">
                                <p class="like-info">
                                    <span class="align-middle" id="favorite-btn">
                                        <i class="fa-solid fa-heart {{ $isFavorited ? 'text-danger' : '' }}"></i>
                                    </span>
                                    <span id="favorites-count">{{ $blog->favorites_count }} people added to favorites</span>
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
                                    <div class="thumb">
                                        <a href="#">
                                            <img class="img-fluid" src="img/post/preview.png" alt="">
                                        </a>
                                    </div>
                                    <div class="arrow">
                                        <a href="#">
                                            <span class="lnr text-white ti-arrow-left"></span>
                                        </a>
                                    </div>
                                    <div class="detials">
                                        <p>Prev Post</p>
                                        <a href="#">
                                            <h4>Space The Final Frontier</h4>
                                        </a>
                                    </div>
                                </div>
                                <div
                                    class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">
                                    <div class="detials">
                                        <p>Next Post</p>
                                        <a href="#">
                                            <h4>Telescopes 101</h4>
                                        </a>
                                    </div>
                                    <div class="arrow">
                                        <a href="#">
                                            <span class="lnr text-white ti-arrow-right"></span>
                                        </a>
                                    </div>
                                    <div class="thumb">
                                        <a href="#">
                                            <img class="img-fluid" src="img/post/next.png" alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="blog-author">
                        <div class="media align-items-center">
                            <img src="{{ $blog->writer->profile_picture ?? asset('img/blog/author.png') }}"
                                alt="{{ $blog->writer->name }}">
                            {{-- <img src="{{ $blog->writer_type === 'App\Models\Provider' ? $blog->writer->profile_picture : asset('img/blog/author.png') }}" 
                    alt="{{ $blog->writer->name }}"> --}}
                            <div class="media-body">
                                <a href="#">
                                    <h4>{{ $blog->writer->name }}</h4>
                                </a>
                                <p>{{ $blog->writer->email }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="comments-area">
                        <h4>05 Comments</h4>
                        <div class="comment-list">
                            <div class="single-comment justify-content-between d-flex">
                                <div class="user justify-content-between d-flex">
                                    <div class="thumb">
                                        <img src="img/comment/comment_1.png" alt="">
                                    </div>
                                    <div class="desc">
                                        <p class="comment">
                                            Multiply sea night grass fourth day sea lesser rule open subdue female fill
                                            which them
                                            Blessed, give fill lesser bearing multiply sea night grass fourth day sea lesser
                                        </p>
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <h5>
                                                    <a href="#">Emilly Blunt</a>
                                                </h5>
                                                <p class="date">December 4, 2017 at 3:12 pm </p>
                                            </div>
                                            <div class="reply-btn">
                                                <a href="#" class="btn-reply text-uppercase">reply</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="comment-form">
                        <h4>Leave a Reply</h4>
                        <form class="form-contact comment_form" action="#" id="commentForm">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="9"
                                            placeholder="Write Comment"></textarea>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input class="form-control" name="name" id="name" type="text"
                                            placeholder="Name">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input class="form-control" name="email" id="email" type="email"
                                            placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <input class="form-control" name="website" id="website" type="text"
                                            placeholder="Website">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="button button-contactForm btn_1 boxed-btn">Send
                                    Message</button>
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
