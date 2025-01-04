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
                        <a href="{{route('about')}}" class="boxed-btn3-white-2 text-decoration-none">Learn More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- welcome_docmed_area_end -->

    
    @include('shared.services')
    @include('shared.testimonials')
    @include('shared.providers')
    @include('shared.emergency')    
@endsection
