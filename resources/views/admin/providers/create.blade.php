@extends('admin.layouts.app')

@section('title', 'Add User')

@section('content')
<a href="{{ route('users.index') }}" class="btn btn-info btn-sm"> <i class="fas fa-arrow-left"></i>Back to Users</a>

    <h1>Add New User</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Namee</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="phone">Phone (Optional)</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
        </div>
        <button type="submit" class="btn btn-success">Create User</button>
    </form>
@endsection
