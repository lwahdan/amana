@extends('admin.layouts.app')

@section('content')
    <div class="container py-6">

        <div class="d-flex justify-content-end align-items-center mb-4 ">
            <!-- Filter Form -->
            <form method="GET" action="{{ route('contacts.index') }}" class="d-flex align-items-center">
                <select name="status" id="status" class="custom-select me-3" onchange="this.form.submit()">
                    <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>All</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="resolved" {{ request('status') == 'resolved' ? 'selected' : '' }}>Resolved</option>
                </select>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Subject</th>
                        <th scope="col">Message</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contacts as $contact)
                        <tr>
                            <td>{{ $contact->name ?? 'N/A' }}</td>
                            <td>{{ $contact->email ?? 'N/A' }}</td>
                            <td>{{ $contact->phone ?? 'N/A' }}</td>
                            <td>{{ $contact->subject ?? 'N/A' }}</td>
                            <td>{{ $contact->message ?? 'N/A'}}</td>
                            <td>
                                @if ($contact->status == 'pending')
                                    <span class="badge badge-warning">Pending</span>
                                @elseif ($contact->status == 'resolved')
                                    <span class="badge badge-success">Resolved</span>
                                @endif
                            </td>
                            <td class="d-flex justify-content-between">
                                <a href="{{ route('contacts.edit', $contact->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                <a href="{{ route('contacts.edit', $contact->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="admin_provider_pagination">
            {{ $contacts->links() }}
        </div>
    </div>
@endsection
