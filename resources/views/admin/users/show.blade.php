@extends('admin.layouts.app')

@section('content')
    <div class="containe py-6 px-4 admin-provider-show">
        <div class="flex justify-between items-center mb-6">
            <a href="{{ route('users.index') }}" class="back-button mb-2">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Users List
            </a>
        </div>

      
        <div class="provider-card p-6 mb-4 pb-4">
            <!-- Header Section -->
            <div class="provider-header">
                <h2 class="pt-4 pl-4">User Details - <span class="tag-primary">
                        <i class="fas fa-calendar-alt mr-1"></i>
                        Joined {{ $user->created_at->format('M d, Y') }}
                    </span>
                </h2>
            </div>
            <div class="container px-4">
                <div class="row">
                    <div class="col-md-6">
                        <strong>Name:</strong> {{ $user->name }}
                    </div>
                    <div class="col-md-6">
                        <strong>Email:</strong> {{ $user->email }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <strong>Phone:</strong> {{ $user->phone }}
                    </div>
                    <div class="col-md-6">
                        <strong>Address:</strong> {{ $user->address }}
                    </div>
                </div>
            </div>
        </div>

          
        <div class="provider-contact-messages table-responsive">
            <h2>Contact Messages</h2>
            @if ($user->contactMessages->isEmpty())
                <p>No contact messages found for this client.</p>
            @else
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Sent At</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user->contactMessages as $message)
                            <tr>
                                <td>{{ $message->subject }}</td>
                                <td>{{ Str::limit($message->message, 50) }}</td>
                                <td>{{ $message->created_at->format('d-m-Y H:i') }}</td>
                                <td>
                                    <span
                                        class="badge badge-color
                    @if ($message->status == 'pending') bg-warning 
                    @elseif ($message->status == 'resolved') bg-success @endif">
                                        {{ ucfirst($message->status) }}
                                    </span>
                                </td>
                                {{-- <td>
                                    <a href="{{ route('contact-messages.edit', $message->id) }}" class="btn btn-info btn-sm"><i
                                            class="fas fa-eye"></i></a>
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        <div class="provider-bookings table-responsive">
            <h2>Bookings</h2>
            @if ($user->bookings->isEmpty())
                <p>No bookings found for this client.</p>
            @else
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Service</th>
                            <th>Provider</th>
                            <th>City</th>
                            <th>Price</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $booking)
                            <tr>
                                <td>{{ $booking->service->name ?? 'N/A' }}</td>
                                <td>{{ $booking->provider->name ?? 'N/A' }}</td> <!-- Access provider directly -->
                                <td>{{ $booking->city->name ?? 'N/A' }}</td>
                                <td>{{ number_format($booking->total_price, 2) ?? 'N/A' }}</td>
                                <td>{{ $booking->booking_date->format('d-m-Y') }}</td>
                                <td>
                                    <span
                                        class="badge badge-color
                        @if ($booking->status == 'pending') bg-warning 
                        @elseif ($booking->status == 'confirmed') bg-primary 
                        @elseif ($booking->status == 'completed') bg-success 
                        @elseif ($booking->status == 'cancelled') bg-danger @endif">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </td>
                                <td>{{ $booking->created_at->format('d-m-Y H:i') }}</td>
                                <td>
                                    <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-warning btn-sm"><i
                                            class="fas fa-edit"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        <div class="provider-meetings table-responsive">
            <h2>Meetings</h2>
            @if ($user->meetings->isEmpty())
                <p>No meetings scheduled for this user.</p>
            @else
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Meeting Date</th>
                            <th>Meeting Time</th>
                            <th>Meeting Link</th>
                            <th>With</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user->meetings as $meeting)
                            <tr>
                                <td>{{ $meeting->meeting_date ? $meeting->meeting_date->format('d-m-Y') : 'N/A' }}</td>
                                <td>{{ $meeting->meeting_date ? $meeting->meeting_date->format('H:i') : 'N/A' }}</td>
                                <td>{{ $meeting->meeting_link ?? 'N/A' }}</td>
                                <td>{{ $meeting->provider->name }}</td>
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
                                {{-- <td>
                                    <a href="{{ route('meetings.edit', $meeting->id) }}" class="btn btn-info btn-sm"><i
                                            class="fas fa-eye"></i></a>
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        <div class="provider-blogs table-responsive">
            <h2>Blogs</h2>
            <table class="table table-striped table-provider">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Service</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Views</th>
                        <th>Likes</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($blogs as $blog)
                        <tr>
                            <td>{{ $blog->id }}</td>
                            <td>{{ $blog->service->name }}</td>
                            <td>{{ $blog->title }}</td>
                            <td>{{ Str::limit($blog->description, 100) }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}"
                                    style="width: 100px; height: auto;">
                            </td>
                            <td>{{ $blog->views }}</td>
                            <td>{{ $blog->likes }}</td>
                            <td class="d-flex justify-content-around">
                                <a href="{{ route('admin.blogs.show', $blog->id) }}" class="btn btn-info btn-sm"><i
                                        class="fa-regular fa-eye"></i></a>
                                <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="btn btn-warning btn-sm"><i
                                        class="fa-regular fa-pen-to-square"></i></a>
                                <form method="POST" action="{{ route('admin.blogs.destroy', $blog->id) }}"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"><i
                                            class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No blogs available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="admin_provider_pagination">
                {{ $blogs->links() }}
            </div>
        </div>
     
        <div class="provider-reviews table-responsive mt-3">
            <h2>Reviews</h2>
            @if ($reviews->isEmpty())
                <p>No reviews found for this user.</p>
            @else
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Service</th>
                            <th>Provider</th>
                            <th>Rating</th>
                            <th>Comment</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reviews as $review)
                            <tr>
                                <td>{{ $review->service->name ?? 'N/A' }}</td>
                                <td>{{ $review->provider->user->name ?? 'N/A' }}</td>
                                <td>{{ $review->rating }}</td>
                                <td>{{ $review->review }}</td>
                                <td>
                                    <span
                                        class="badge badge-color
                    @if ($review->status == 'pending') bg-warning 
                    @elseif ($review->status == 'approved') bg-primary 
                    @elseif ($review->status == 'disapproved') bg-danger @endif">
                                        {{ ucfirst($review->status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('reviews.index', $review->id) }}" class="btn btn-info btn-sm"><i
                                            class="fas fa-eye"></i></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

    </div>
@endsection
