@extends('admin.layouts.app')

@section('content')
<h1>Service: {{ $service->name }}- <small>Providers Offering This Service</small> </h1>

@if ($service->providers->isEmpty())
    <p>No providers are currently offering this service.</p>
@else
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Provider Name</th>
                <th>Bio</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($service->providers as $provider)
                <tr>
                    <td>
                    {{ $provider->name }}                        
                    </td>
                    <td>{{ $provider->bio }}</td>
                    <td>
                        <a href="#" class="btn btn-info btn-sm">
                        {{-- <a href="{{ route('admin.users.show', $provider->id) }}" class="btn btn-info btn-sm"> --}}
                            View Details
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

@endsection
