@extends('admin.layouts.app')

@section('content')
    <div class="containe py-6 px-4">
        <div class="flex justify-between items-center mb-6">
            <a href="{{ route('contacts.index') }}" class="back-button mb-2">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Contact Messages
            </a>
            <h2 class="text-2xl font-semibold text-admin">View & Update Message Status</h2>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-striped">
                <tr>
                    <th>ID:</th>
                    <td>{{ $contact->id }}</td>
                </tr>
                <tr>
                    <th>Service:</th>
                    <td>{{ $contact->name ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>User:</th>
                    <td>{{ $contact->email ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>User Email:</th>
                    <td>{{ $contact->phone ?? 'N/A' }}</td>
                </tr>

                <tr>
                    <th>Provider:</th>
                    <td>{{ $contact->subject ?? 'Not Assigned' }}</td>
                </tr>
                <tr>
                    <th>Provider Email:</th>
                    <td>{{ $contact->message ?? 'Not Assigned' }}</td>
                </tr>
                <tr>
                    <th>Submitted At:</th>
                    <td>{{ $contact->created_at->format('d-m-Y H:i') }}</td>
                </tr>
                <tr>
                    <th>Status:</th>
                    <td>
                        <form action="{{ route('contacts.update', $contact->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div>
                                <label for="status">Status:</label>
                                <select name="status" id="status">
                                    <option value="pending" {{ $contact->status == 'pending' ? 'selected' : '' }}>Pending
                                    </option>
                                    <option value="resolved" {{ $contact->status == 'resolved' ? 'selected' : '' }}>Resolved
                                    </option>
                                </select>
                            </div>
                            <button type="submit" class="back-button">Update Status</button>
                        </form>
                    </td>
                </tr>
            </table>
        </div>
    </div>
@endsection
