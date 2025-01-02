@extends('dashboard')

@section('user-dashboard-content')
<h1 class="user-secondary">Meetings</h1>

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Provider</th>
                <th>Meeting Link</th>
                <th>Meeting Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($meetings as $meeting)
                <tr>
                    <td>{{ $meeting->id }}</td>
                    <td>{{ $meeting->provider->name ?? 'N/A' }}</td>
                    <td>{{ $meeting->meeting_link ?? 'N/A' }}</td>
                    <td>{{ $meeting->meeting_date ? $meeting->meeting_date->format('Y-m-d H:i') : 'N/A' }}</td>
                    <td>
                        <span class="badge 
                            @if ($meeting->status == 'requested') bg-warning 
                            @elseif ($meeting->status == 'confirmed') bg-primary
                            @elseif ($meeting->status == 'completed') bg-success
                            @elseif ($meeting->status == 'cancelled') bg-danger 
                            @endif">
                            {{ ucfirst($meeting->status) }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">No meetings available.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
