@extends('admin.layouts.app')

@section('content')
    <div class="container py-6">

        <div class="d-flex justify-content-end align-items-center mb-4 ">
            <!-- Filter Form -->
            <form method="GET" action="{{ route('users.index') }}" class="d-flex align-items-center">
                <select name="status" id="status" class="custom-select me-3" onchange="this.form.submit()">
                    <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>All</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="deleted" {{ request('status') == 'deleted' ? 'selected' : '' }}>Inactive</option>
                </select>
            </form>

            <a href="{{ route('users.create') }}" class="btn btn-primary me-3 users_index">
                <i class="fas fa-plus"></i> Add User
            </a>
        </div>


        <!-- Users Table -->
        <table class="table text-center">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if ($user->trashed())
                                <span class="text-danger">Inactive</span>
                            @else
                                <span class="text-success">Active</span>
                            @endif
                        </td>
                        <td>
                            @if (!$user->trashed())
                                <a href="{{ route('users.show', $user->id) }}" class="btn btn-info btn-sm"><i
                                        class="fas fa-eye"></i></a>
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm"><i
                                        class="fas fa-edit"></i></a>
                                <form method="POST" action="{{ route('users.destroy', $user->id) }}"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"> <i
                                            class="fas fa-trash-alt"></i></button>
                                </form>
                            @else
                                <form method="POST" action="{{ route('users.restore', $user->id) }}"
                                    style="display: inline;">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success btn-sm"> <i
                                            class="fas fa-undo"></i></button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination Links -->
        <div class="admin_provider_pagination">
        {{ $users->appends(['status' => request('status')])->links() }}
        </div>
    </div>
@endsection
