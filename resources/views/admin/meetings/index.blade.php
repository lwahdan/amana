@extends('admin.layouts.app')

@section('content')
    <div class="container py-6">

        <div class="d-flex justify-content-end align-items-center mb-4 ">
            <!-- Filter Form -->
            <form method="GET" action="{{ route('meetings.index') }}" class="d-flex align-items-center">
                <select name="status" id="status" class="custom-select me-3" onchange="this.form.submit()">
                    <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>All</option>
                    <option value="requested" {{ request('status') == 'requested' ? 'selected' : '' }}>Requested</option>
                    <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : ''}}>Cancelled</option>
                </select>
            </form>

            <a href="{{ route('meetings.create') }}" class="btn btn-primary me-3 users_index">
                <i class="fas fa-plus"></i> Add a Meeting
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Provider</th>
                        <th>Meeting date</th>
                        <th>Meeting link</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($meetings as $meeting)
                        <tr>
                            <td>{{ $meeting->id }}</td>
                            <td>{{ $meeting->user->name ?? 'N/A' }}</td>
                            <td>{{ $meeting->provider->name ?? 'N/A' }}</td>
                            <td>{{ $meeting->meeting_date ? $meeting->meeting_date->format('d-m-Y H:i') : 'N/A' }}</td>
                            <td>{{ $meeting->meeting_link ?? 'N/A' }}</td>
                            <td>
                                <span
                                    class="badge badge-color
                                @if ($meeting->status == 'requested') bg-warning 
                                @elseif ($meeting->status == 'confirmed') bg-primary 
                                @elseif ($meeting->status == 'completed') bg-success 
                                @elseif ($meeting->status == 'cancelled') bg-danger @endif">
                                    {{ ucfirst($meeting->status) }}
                                </span>
                            </td>
                            <td>
                                @if ($meeting->trashed())
                                    <form method="POST" action="{{ route('meetings.restore', $meeting->id) }}"
                                        style="display:inline;">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-undo"></i></button>
                                    </form>
                                @else
                                <a href="{{ route('meetings.show', $meeting->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                <a href="{{ route('meetings.edit', $meeting->id) }}"
                                    class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                <form method="POST" action="{{ route('meetings.destroy', $meeting->id) }}"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="admin_provider_pagination">
            {{ $meetings->links() }}
        </div>
    </div>
@endsection
