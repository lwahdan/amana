@extends('layouts.app')

@section('title', 'about')

@section('breadcrumb-title', 'About Us')
@section('breadcrumb-subtitle', 'about us')
@section('content')

    <!-- welcome_docmed_area_start -->
    <div class="welcome_docmed_area">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6">
                    <div class="welcome_thumb">
                        <div class="thumb_1">
                            <img src="{{ 'img/amanah/about.png' }}" alt="">
                        </div>
                        <div class="thumb_2">
                            <img src="{{ 'img/amanah/about2.png' }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="welcome_docmed_info">
                        <h2>Welcome to Amanah</h2>
                        <h3>Where Care Meets <br>
                            Compassion</h3>
                        <p> At Amanah, we believe that caregiving is not just a service but a trust. Our name, meaning
                            "trust" in Arabic, reflects our commitment to ensuring that every client and their loved ones
                            are treated with the utmost respect, dignity, and professionalism. </p>
                        <ul>
                            <li> <i class="flaticon-right"></i>Comprehensive caregiving services for babysitting, nursing,
                                and eldercare </li>
                            <li> <i class="flaticon-right"></i> Personalized care plans tailored to individual needs</li>
                            <li> <i class="flaticon-right"></i> Trustworthy and experienced caregivers dedicated to
                                enhancing your quality of life </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- welcome_docmed_area_end -->

    @include('shared.testimonials')
    @include('shared.value')
    @include('shared.emergency')

@endsection
