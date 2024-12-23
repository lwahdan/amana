@extends('provider.dashboard')

@section('dashboard-content')
<h1>Meetings</h1>

<div class="table-responsive">
    <table class="table table-striped table-provider">
        <thead>
            <tr>
                <th>ID</th>
                <th>Client</th>
                <th>Service</th>
                <th>Meeting Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($meetings as $meeting)
                <tr>
                    <td>{{ $meeting->id }}</td>
                    <td>{{ $meeting->user->name ?? 'N/A' }}</td>
                    <td>{{ $meeting->service->name ?? 'N/A' }}</td>
                    <td>{{ $meeting->meeting_date->format('Y-m-d H:i') ?? 'N/A' }}</td>
                    <td>
                        <span class="badge 
                            @if ($meeting->status == 'requested') bg-warning 
                            @elseif ($meeting->status == 'confirmed') bg-primary 
                            @elseif ($meeting->status == 'cancelled') bg-danger 
                            @endif">
                            {{ ucfirst($meeting->status) }}
                        </span>
                    </td>
                    <td>
                        <!-- Mark as Done Button -->
                        @if ($meeting->status != 'confirmed' && $meeting->status != 'cancelled')
                            <form action="{{ route('provider.meetings.complete', $meeting->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-success btn-sm">Set as Complete</button>
                            </form>
                        @endif
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
