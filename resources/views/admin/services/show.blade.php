@extends('admin.layouts.app')

@section('content')
    <div class="container py-6">

        <div class="flex justify-between items-center mb-6">
            <a href="{{ route('services.index') }}" class="back-button mb-2">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Services List
            </a>
            <h2 class="text-2xl font-semibold text-admin">{{ $service->name }}- <small>Offered by</small> </h2>
        </div>

        @if ($providers->isEmpty())
            <p>No providers are currently offering this service.</p>
        @else
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Provider Name</th>
                            <th>Bio</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($providers as $provider)
                            <tr>
                                <td>
                                    {{ $provider->name }}
                                </td>
                                <td>{{ $provider->bio }}</td>
                                <td>
                                    <a href="{{ route('providers.show', $provider->id) }}" class="btn btn-info btn-sm">
                                        <i class="fa-solid fa-circle-info"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
        @endif
        <div class="admin_provider_pagination">
            {{ $providers->links() }}
        </div>
    </div>
    </div>
@endsection
