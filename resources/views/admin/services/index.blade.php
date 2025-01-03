@extends('admin.layouts.app')

@section('content')
<div class="container py-6">

    <div class="d-flex justify-content-end align-items-center mb-4 ">
        <a href="{{ route('services.create') }}" class="btn btn-primary me-3 users_index">
            <i class="fas fa-plus"></i> Add a Service
        </a>
    </div>
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Description</th>
                <th>Image</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($services as $service)
                <tr>
                    <td>{{ $service->id }}</td>
                    <td>{{ $service->name }}</td>
                    <td>{{ $service->category->name ?? 'No Category' }}</td>
                    <td>{{ $service->description }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->name }}"
                            style="width: 100px; height: auto;">
                    </td>
                    <td>
                        @if ($service->deleted_at)
                            <span class="badge bg-danger badge-color">Inactive</span>
                        @else
                            <span class="badge bg-success badge-color">Active</span>
                        @endif
                    </td>
                    <td class="d-flex gap-2">
                        @if (!$service->trashed())
                            <a href="{{ route('services.show', $service->id) }}" class="btn btn-info btn-sm"><i class="fas fa-hand-holding-heart"></i></a>
                            <a href="{{ route('services.edit', $service->id) }}" class="btn btn-warning btn-sm"><i
                                    class="fas fa-edit"></i></a>
                            <form method="POST" action="{{ route('services.destroy', $service->id) }}"
                                style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"> <i
                                        class="fas fa-trash-alt"></i></button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('services.restore', $service->id) }}"
                                style="display: inline;">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-success btn-sm"> <i
                                        class="fas fa-undo"></i></button>
                            </form>
                        @endif
                    </td>
                    {{-- @if ($service->deleted_at)
                    <form method="POST" action="{{ route('services.restore', $service->id) }}"
                        style="display: inline;">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-success btn-sm"> <i
                                class="fas fa-undo"></i></button>
                    </form>
                    @else
                    <td class="d-flex gap-2">
                        <a href="{{ route('services.edit', $service->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                        <form method="POST" action="{{ route('services.destroy', $service->id) }}" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                        </form>
                        <a href="{{ route('services.show', $service->id) }}" class="btn btn-info btn-sm">
                            <i class="fas fa-hand-holding-heart"></i>
                        </a> 
                    </td>
                    @endif --}}
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
    {{ $services->links() }} <!-- Pagination -->

</div>
@endsection
