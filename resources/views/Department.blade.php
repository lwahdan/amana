@extends('layouts.app')
@section('title', 'department')
@section('breadcrumb-title', 'services')
@section('breadcrumb-subtitle', ' services')
@section('content')

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
            <div class="single-testmonial testmonial_bg_1 overlay2">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-10 offset-xl-1">
                            <div class="testmonial_info text-center">
                                <div class="quote">
                                    <i class="flaticon-straight-quotes"></i>
                                </div>
                                <p>Donec imperdiet congue orci consequat mattis. Donec rutrum porttitor <br>
                                    sollicitudin. Pellentesque id dolor tempor sapien feugiat ultrices nec sed neque.
                                    <br>
                                    Fusce ac mattis nulla. Morbi eget ornare dui.
                                </p>
                                <div class="testmonial_author">
                                    <h4>Asana Korim</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="single-testmonial testmonial_bg_2 overlay2">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-10 offset-xl-1">
                            <div class="testmonial_info text-center">
                                <div class="quote">
                                    <i class="flaticon-straight-quotes"></i>
                                </div>
                                <p>Donec imperdiet congue orci consequat mattis. Donec rutrum porttitor <br>
                                    sollicitudin. Pellentesque id dolor tempor sapien feugiat ultrices nec sed neque.
                                    <br>
                                    Fusce ac mattis nulla. Morbi eget ornare dui.
                                </p>
                                <div class="testmonial_author">
                                    <h4>Asana Korim</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="single-testmonial testmonial_bg_1 overlay2">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-10 offset-xl-1">
                            <div class="testmonial_info text-center">
                                <div class="quote">
                                    <i class="flaticon-straight-quotes"></i>
                                </div>
                                <p>Donec imperdiet congue orci consequat mattis. Donec rutrum porttitor <br>
                                    sollicitudin. Pellentesque id dolor tempor sapien feugiat ultrices nec sed neque.
                                    <br>
                                    Fusce ac mattis nulla. Morbi eget ornare dui.
                                </p>
                                <div class="testmonial_author">
                                    <h4>Asana Korim</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- testmonial_area_end -->

    <!-- business_expert_area_start -->
    <div class="business_expert_area">
        <div class="business_tabs_area">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <ul class="nav" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="why-choose-tab" data-toggle="tab" href="#why-choose"
                                    role="tab" aria-controls="why-choose" aria-selected="true">Why Choose Amanah</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="certified-caregivers-tab" data-toggle="tab"
                                    href="#certified-caregivers" role="tab" aria-controls="certified-caregivers"
                                    aria-selected="false">Certified Caregivers</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="immediate-support-tab" data-toggle="tab" href="#immediate-support"
                                    role="tab" aria-controls="immediate-support" aria-selected="false">Immediate
                                    Support</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="border_bottom">
                <div class="tab-content" id="myTabContent">
                    <!-- Why Choose Amanah -->
                    <div class="tab-pane fade show active" id="why-choose" role="tabpanel" aria-labelledby="why-choose-tab">
                        <div class="row align-items-center">
                            <div class="col-xl-6 col-md-6">
                                <div class="business_info">
                                    <div class="icon">
                                        <i class="flaticon-family"></i>
                                    </div>
                                    <h3>Compassionate Care You Can Trust</h3>
                                    <p>At Amanah, we go above and beyond to provide reliable and personalized caregiving
                                        services.
                                        Whether it’s babysitting, nursing, or eldercare, we ensure your loved ones receive
                                        the utmost care and attention.</p>
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-6">
                                <div class="business_thumb">
                                    <img src="img/about/why-choose.png" alt="Why Choose Amanah">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Certified Caregivers -->
                    <div class="tab-pane fade" id="certified-caregivers" role="tabpanel"
                        aria-labelledby="certified-caregivers-tab">
                        <div class="row align-items-center">
                            <div class="col-xl-6 col-md-6">
                                <div class="business_info">
                                    <div class="icon">
                                        <i class="flaticon-care"></i>
                                    </div>
                                    <h3>Our Team of Trusted Experts</h3>
                                    <p>Each Amanah caregiver undergoes rigorous training to deliver the highest standard of
                                        care.
                                        Our skilled and compassionate team is dedicated to supporting families and
                                        individuals with professionalism and respect.</p>
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-6">
                                <div class="business_thumb">
                                    <img src="img/about/certified-caregivers.png" alt="Certified Caregivers">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Immediate Support -->
                    <div class="tab-pane fade" id="immediate-support" role="tabpanel"
                        aria-labelledby="immediate-support-tab">
                        <div class="row align-items-center">
                            <div class="col-xl-6 col-md-6">
                                <div class="business_info">
                                    <div class="icon">
                                        <i class="flaticon-support"></i>
                                    </div>
                                    <h3>Always Here When You Need Us</h3>
                                    <p>With Amanah, help is always just a call or click away. We offer 24/7 support to
                                        assist with urgent caregiving needs
                                        or to schedule appointments quickly and easily.</p>
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-6">
                                <div class="business_thumb">
                                    <img src="img/about/immediate-support.png" alt="Immediate Support">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- business_expert_area_end -->



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
                            <img src="img/experts/1.png" alt="">
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
        <div class="conatiner-fluid p-0">
            <div class="row no-gutters">
                <div class="col-xl-6">
                    <div
                        class="single_emergency d-flex align-items-center justify-content-center emergency_bg_1 overlay_skyblue">
                        <div class="info">
                            <h3>For Any Emergency Contact</h3>
                            <p>Esteem spirit temper too say adieus.</p>
                        </div>
                        <div class="info_button">
                            <a href="#" class="boxed-btn3-white">+10 378 4673 467</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div
                        class="single_emergency d-flex align-items-center justify-content-center emergency_bg_2 overlay_skyblue">
                        <div class="info">
                            <h3>Make an Online Appointment</h3>
                            <p>Esteem spirit temper too say adieus.</p>
                        </div>
                        <div class="info_button">
                            <a href="#" class="boxed-btn3-white">Make an Appointment</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Emergency_contact end -->
@endsection
