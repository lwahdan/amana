<header>
    <div class="header-area ">
        <div id="sticky-header" class="main-header-area">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-3 col-lg-2">
                        <div class="logo">
                            <a href="index.html">
                                <img src="img/logo.png" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-7">
                        <div class="main-menu  d-none d-lg-block">
                            <nav>
                                <ul id="navigation" class="nav">
                                    <li><a class="text-decoration-none" href="/">home</a></li>
                                    <li><a class="text-decoration-none" href="/Department">Department</a></li>
                                    <li><a class="text-decoration-none" href="/blog">Blog</a></li>
                                    <li><a class="text-decoration-none" href="/about">About</a></li>
                                    <li><a class="text-decoration-none" href="/doctors">Doctors</a></li>
                                    <li><a class="text-decoration-none" href="/contact">Contact</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-3 d-none d-lg-block">
                        <div class="Appointment">
                            <div class="book_btn d-none d-lg-block">
                                @if (Route::has('login'))
                                    @auth
                                        <a class="text-decoration-none" href="{{ url('/dashboard') }}">Dashboard</a>
                                    @else
                                        <!-- Trigger Modal -->
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal"
                                            class="text-decoration-none">
                                            Log in
                                    </a> @endauth
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="loginModalLabel">Login Options</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-center">
                                    <p>Please select how you want to log in:</p>
                                    <div class="d-flex justify-content-center gap-3">
                                        <!-- Button: As a User -->
                                        <a href="{{ route('login') }}" class="btn btn-primary">As a User</a>

                                        <!-- Button: As a Provider -->
                                        <a href="{{ route('provider_login') }}" class="btn btn-provider">As a
                                            Provider</a>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mobile_menu d-block d-lg-none"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
