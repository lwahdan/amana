{{-- <pre>{{ dd($provider->services) }}</pre> --}}

@extends('admin.layouts.app')
@section('content')
    <h1>Provider Details</h1>
    <p><strong>Name:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Phone:</strong> {{ $user->phone }}</p>

    <p><strong>Certifications:</strong> {{ $provider->certifications ?? 'N/A'}}</p>
    <p><strong>Skills:</strong> {{  $provider->skills ?? 'N/A' }}</p>
    <p><strong>Hourly Rate:</strong> {{  $provider->hourly_rate ?? 'N/A'}}</p>
    <p><strong>Work Locations:</strong> {{  $provider->work_locations ?? 'N/A' }}</p>


    {{-- <h2>Services Offered</h2>
     @if (!$provider)
    <p>Service provider record not found.</p>
     @elseif ($provider->services->isEmpty())
    <p>This provider does not offer any services.</p>
     @else
    <ul>
        @foreach ($provider->services as $service)
            <li>{{ $service->name ?? 'N/A' }}</li>
        @endforeach
    </ul>
     @endif --}}

     <h2>Services Offered</h2>

@if ($user->serviceProvider && $user->serviceProvider->services->isNotEmpty())
    <ul>
        @foreach ($user->serviceProvider->services as $service)
            <li>{{ $service->name ?? 'N/A' }}</li>
        @endforeach
    </ul>
@else
    <p>This provider does not offer any services.</p>
@endif


@endsection
