@extends('admin.layouts.app')

@section('content')
    <h1>Review Details</h1>
    <table class="table">
        <tr>
            <th>ID:</th>
            <td>{{ $review->id }}</td>
        </tr>
        <tr>
            <th>User:</th>
            <td>{{ $review->user->name}}</td>
        </tr>
        <tr>
            <th>User Email:</th>
            <td>{{ $review->user->email}}</td>
        </tr>
        <tr>
            <th>Service:</th>
            <td>{{ $review->service->name }}</td>
        </tr>
        <tr>
            <th>Service Provider:</th>
            <td>{{ $review->provider->name ?? 'Not Assigned' }}</td>
        </tr>
        <tr>
            <th>Rating:</th>
            <td>{{ $review->rating }} / 5</td>
        </tr>
        <tr>
            <th>Status:</th>
            <td>{{ ucfirst($review->status) }}</td>
        </tr>
        <tr>
            <th>Review Text:</th>
            <td>{{ $review->review }}</td>
        </tr>
        <tr>
            <th>Submitted At:</th>
            <td>{{ $review->created_at->format('d-m-Y H:i') }}</td>
        </tr>
        @isset($review->deleted_at)
        <tr>
            <th>Dissapproved At:</th>
            <td>{{ $review->deleted_at->format('d-m-Y H:i') }}</td>
        </tr>
        @endisset
    </table>
    <a href="{{ route('reviews.index') }}" class="btn btn-primary">Back to Reviews</a>
@endsection
