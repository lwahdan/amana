@extends('provider.dashboard')

@section('dashboard-content')
<div class="row mb-3">
    <h1 class="col-md-8">Meetings</h1>

    <!-- Filter by Status -->
    <div class="mb-4 col-md-4">
        <form method="GET" action="{{ route('provider.meetings') }}">
            <label for="status" class="form-label">Filter by Status:</label>
            <select name="status" id="status" class="form-control" onchange="this.form.submit()">
                <option value="">All</option>
                <option value="requested" {{ request('status') == 'requested' ? 'selected' : '' }}>Requested</option>
                <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
        </form>
    </div>
</div>
    <div class="table-responsive">
        <table class="table table-striped table-provider">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Client</th>
                    <th>Meeting Link</th>
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

                        <td colspan="2">
                            <form action="{{ route('provider.meetings.update', $meeting->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <!-- Meeting Link -->
                                <input type="text" name="meeting_link" class="form-control mb-2"
                                    value="{{ old('meeting_link', $meeting->meeting_link) }}"
                                    placeholder="Enter meeting link">

                                <!-- Meeting Date -->
                                <input type="datetime-local" name="meeting_date" class="form-control"
                                    value="{{ old('meeting_date', $meeting->meeting_date ? $meeting->meeting_date->format('Y-m-d\TH:i') : '') }}"
                                    placeholder="Enter meeting date">

                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-success btn-sm mt-2">Save & Confirm</button>
                            </form>
                        </td>

                        <td>
                            <span
                                class="badge 
                            @if ($meeting->status == 'requested') bg-warning 
                            @elseif ($meeting->status == 'confirmed') bg-primary 
                            @elseif ($meeting->status == 'completed') bg-success 
                            @elseif ($meeting->status == 'cancelled') bg-danger @endif">
                                {{ ucfirst($meeting->status) }}
                            </span>
                        </td>

                        <td>
                            <!-- Mark as Completed -->
                            <form action="{{ route('provider.meetings.complete', $meeting->id) }}" method="POST"
                                style="display: inline-block;">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-success btn-sm"><i
                                        class="fa-solid fa-check"></i></button>
                            </form>

                            <!-- Delete Meeting -->
                            <form action="{{ route('provider.meetings.delete', $meeting->id) }}" method="POST"
                                style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"><i
                                        class="fa-solid fa-trash"></i></button>
                            </form>
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
    {{ $meetings->links() }}
@endsection
