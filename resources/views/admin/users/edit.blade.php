@extends('admin.layouts.app')

@section('content')
<a href="{{ route('users.index') }}" class="btn btn-info btn-sm"> <i class="fas fa-arrow-left"></i>Back to Users</a>

<form method="POST" action="{{ route('users.update', $user->id) }}">
    @csrf
    @method('PUT')

    <label for="name">Name:</label>
    <input type="text" name="name" value="{{ $user->name }}" required>

    <label for="email">Email:</label>
    <input type="email" name="email" value="{{ $user->email }}" required>

    <label for="phone">Phone:</label>
    <input type="number" name="phone" value="{{ $user->phone }}">

    <label for="address">Address:</label>
    <input type="text" name="address" value="{{ $user->address }}">

    <button type="submit">Update</button>
</form>
@endsection
