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
                            <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->name }}">
                        </div>
                        <div class="department_content">
                            <h3><a href="{{ route('team', ['service_id' => $service->id, 'gender' => '']) }}" class="text-decoration-none">{{ $service->name }}</a></h3>
                            <p>{{ $service->description }}</p>
                            <a href="{{ route('team', ['service_id' => $service->id, 'gender' => '']) }}" class="learn_more text-decoration-none">Discover Trusted Providers</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>