@extends('layouts.app')

@section('title', 'home')

@section('content')

    {{-- @if (Route::has('login'))
        <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
            @auth
                <a href="{{ url('/dashboard') }}"
                    class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
            @else
                <a href="{{ route('login') }}"
                    class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log
                    in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                @endif
            @endauth
        </div>
    @endif --}}

    <!-- hero_slider_area_start -->
    <div class="slider_area">
        <div class="slider_active owl-carousel">
            <div class="single_slider d-flex align-items-center slider_bg_2">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="slider_text">
                                <h3> <span>Compassionate Care</span> <br>
                                    For Your Whole Family </h3>
                                <p>At Amanah, we provide trusted babysitting, nursing, and eldercare services <br>
                                    to ensure your loved ones receive the care they deserve.</p>
                                <div class="my_slider_btn">
                                    <a href="{{route('provider_register')}}" class="boxed-btn3">JOIN US</a>
                                    <a href="{{route('book')}}" class="boxed-btn3">BOOK NOW</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="single_slider d-flex align-items-center slider_bg_1">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="slider_text">
                                <h3> <span>Trusted Support</span> <br>
                                    Every Step of the Way </h3>
                                <p>Whether it’s babysitting, nursing, or eldercare, our skilled team ensures <br>
                                    a safe and nurturing environment for your loved ones.</p>
                                <div class="my_slider_btn">
                                    <a href="{{route('provider_register')}}" class="boxed-btn3">JOIN US</a>
                                    <a href="{{route('book')}}" class="boxed-btn3">BOOK NOW</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="single_slider d-flex align-items-center slider_bg_3">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="slider_text">
                                <h3> <span>Your Care</span> <br>
                                    Is Our Priority </h3>
                                <p>Experience professional care with a personal touch, <br>
                                    tailored to meet your family’s unique needs.</p>
                                <div class="my_slider_btn">
                                    <a href="{{route('provider_register')}}" class="boxed-btn3">JOIN US</a>
                                    <a href="{{route('book')}}" class="boxed-btn3">BOOK NOW</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- hero_slider_area_end -->

    <!-- welcome_docmed_area_start -->
    <div class="welcome_docmed_area">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6">
                    <div class="welcome_thumb">
                        <div class="thumb_1">
                            <img src="{{ asset('img/welcome/welcome2.png') }}" alt="">
                        </div>
                        <div class="thumb_2">
                            <img src="{{ asset('img/welcome/welcome1.png') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="welcome_docmed_info">
                        <h2>Welcome to Amanah</h2>
                        <h3>Your Trusted Partner for<br>
                            Quality Care</h3>
                        <p>At Amanah, we understand the importance of providing care you can rely on.
                            Our mission is to support families with professional babysitting, nursing, and eldercare
                            services, ensuring your loved ones receive the compassion and attention they deserve
                        </p>
                        <ul>
                            <li> <i class="flaticon-right"></i>Trusted caregivers for all your family needs</li>
                            <li> <i class="flaticon-right"></i>Tailored services to ensure comfort and well-being</li>
                            <li> <i class="flaticon-right"></i>Dedicated to delivering excellence in care</li>
                        </ul>
                        <a href="#" class="boxed-btn3-white-2 text-decoration-none">Learn More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- welcome_docmed_area_end -->

    <!-- services_area_start -->
    <div class="our_department_area">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="section_title text-center mb-55">
                        <h3>Our Services</h3>
                        <p>We are dedicated to providing top-notch services tailored to your needs<br>
                            our trusted team ensures your loved ones are in safe hands</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($services as $service)
                    <div class="col-xl-4 col-md-6 col-lg-4">
                        <div class="single_department">
                            <div class="department_thumb">
                                <img src="{{ asset($service->image) }}" alt="{{ $service->name }}">
                            </div>
                            <div class="department_content">
                                <h3><a href="#" class="text-decoration-none">{{ $service->name }}</a></h3>
                                <p>{{ $service->description }}</p>
                                <a href="#" class="learn_more text-decoration-none">Learn More</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- services_area_end -->

    <!-- testmonial_area_start -->
    <div class="testmonial_area">
        <div class="testmonial_active owl-carousel">
            <!-- Testimonial 1 -->
            <div class="single-testmonial testmonial_bg_1 overlay2">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-10 offset-xl-1">
                            <div class="testmonial_info text-center">
                                <div class="quote">
                                    <i class="flaticon-straight-quotes"></i>
                                </div>
                                <p>"The babysitting service was exceptional. The caregiver was professional, attentive, and
                                    made my child feel at ease immediately. I could work peacefully knowing my little one
                                    was in good hands."</p>
                                <div class="testmonial_author">
                                    <h4>Sara Al-Masri</h4>
                                    <span>Mother of Two</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Testimonial 2 -->
            <div class="single-testmonial testmonial_bg_2 overlay2">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-10 offset-xl-1">
                            <div class="testmonial_info text-center">
                                <div class="quote">
                                    <i class="flaticon-straight-quotes"></i>
                                </div>
                                <p>"Amanah's nursing care for my father was a lifesaver. The nurse was compassionate,
                                    skilled, and always on time. They treated him with dignity and respect, which means the
                                    world to us."</p>
                                <div class="testmonial_author">
                                    <h4>Khaled Ahmad</h4>
                                    <span>Son of a Patient</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Testimonial 3 -->
            <div class="single-testmonial testmonial_bg_3 overlay2">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-10 offset-xl-1">
                            <div class="testmonial_info text-center">
                                <div class="quote">
                                    <i class="flaticon-straight-quotes"></i>
                                </div>
                                <p>"The eldercare services provided by Amanah have been a blessing for our family. The
                                    caregivers are patient and understanding, providing my grandmother with the support and
                                    companionship she needs."</p>
                                <div class="testmonial_author">
                                    <h4>Laila Othman</h4>
                                    <span>Granddaughter</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- testmonial_area_end -->

    <!-- providers_area_start -->
    <div class="expert_doctors_area">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="mb-55 section_title">
                        <h3 class="user-secondary text-center">Our Talented Team</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($providers as $provider)
                    <div class="single_expert col-xl-3 col-lg-3 col-md-6 mb-30">
                        <div class="expert_thumb">
                            <img src="{{ asset($provider->profile_picture) }}" alt="{{ $provider->name }}">
                        </div>
                        <div class="experts_name text-center">
                            <h3>{{ $provider->name }}</h3>
                            @foreach ($provider->services as $service)
                                <span>{{ $service->name }}</span>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    {{ $providers->links() }}
    <!-- providers_area_end -->

    <!-- Emergency_contact start -->
    <div class="Emergency_contact">
        <div class="container-fluid p-0">
            <div class="row no-gutters">
                <!-- General Inquiries Contact -->
                <div class="col-xl-6">
                    <div
                        class="single_emergency d-flex align-items-center justify-content-center emergency_bg_1 overlay_skyblue">
                        <div class="info">
                            <h3>Contact Us for Assistance</h3>
                            <p>Have questions? Need help with our services? <br> We’re here to assist you 24/7.</p>
                        </div>
                        <div class="info_button">
                            <a href="tel:+96212345678" class="boxed-btn3-white emergency_button">+962 1234 5678</a>
                        </div>
                    </div>
                </div>
                <!-- Reservation Contact -->
                <div class="col-xl-6">
                    <div
                        class="single_emergency d-flex align-items-center justify-content-center emergency_bg_2 overlay_skyblue">
                        <div class="info">
                            <h3>Book Your Appointment</h3>
                            <p>Schedule caregiving services with ease. <br> Call us or book online today.</p>
                        </div>
                        <div class="info_button">
                            <a href="/reservation" class="boxed-btn3-white emergency_button">Make an Appointment</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Emergency_contact end -->
@endsection
