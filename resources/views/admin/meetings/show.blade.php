@extends('admin.layouts.app')

@section('content')
<div class="containe py-6 px-4">
    <div class="flex justify-between items-center mb-6">
        <a href="{{ route('meetings.index') }}" class="back-button mb-2">
            <i class="fas fa-arrow-left mr-2"></i>
            Back to Meetings List
        </a>
        <h2 class="text-2xl font-semibold text-admin">View Meeting</h2>
    </div>
    <table class="table table-striped">
        <tr>
            <th>ID:</th>
            <td>{{ $meeting->id }}</td>
        </tr>
        <tr>
            <th>User:</th>
            <td>{{ $meeting->user->name ?? 'N/A'}}</td>
        </tr>
        <tr>
            <th>Provider:</th>
            <td>{{ $meeting->provider->name ?? 'Not Assigned' }}</td>
        </tr>
        <tr>
            <th>Meeting Date:</th>
            <td>{{ $meeting->meeting_date ? $meeting->meeting_date->format('d-m-Y') : 'N/A'}}</td>
        </tr>
        <tr>
            <th>meeting link:</th>
            <td>{{ $meeting->meeting_link ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Status:</th>
            <td> <span class="badge badge-color
                @if ( $meeting->status == 'requested' ) bg-warning
                @elseif ($meeting->status == 'confirmed') bg-primary
                @elseif ($meeting->status == 'completed') bg-success
                @elseif ($meeting->status == 'cancelled') bg-danger @endif">
                {{ ucfirst($meeting->status) }}</span>
            </td>
        </tr>
        <tr>
            <th>Created At:</th>
            <td>{{ $meeting->created_at->format('d-m-Y H:i') }}</td>
        </tr> 
    </table>
</div>
@endsection
