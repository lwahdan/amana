@extends('admin.layouts.app')

@section('content')
    <h1>Services</h1>
    <a href="{{ route('services.create') }}" class="btn btn-primary">Add Service</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Description</th>
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
                        <a href="{{ route('services.edit', $service->id) }}">Edit</a>
                        <form method="POST" action="{{ route('services.destroy', $service->id) }}" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                        <a href="{{ route('services.show', $service->id) }}" class="btn btn-info">
                            Providers
                        </a>
                        
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $services->links() }} <!-- Pagination -->
@endsection
