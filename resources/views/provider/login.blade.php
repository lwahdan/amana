{{-- @extends('layouts.app')

@section('title', 'Admin Login')

@section('content') --}}

<div class="login-container">
    <h1>provider Loginn</h1>

    @if($errors->any())
    @foreach ($errors->all() as $error)
    <li>{{$error}}</li>
    @endforeach
    @endif

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

    <form method="POST" action="{{ route('provider_login_submit') }}">
        @csrf
        <div>
            <label>Email</label>
            <input type="email" name="email" required autofocus>
        </div>
        <div>
            <label>Password</label>
            <input type="password" name="password" required>
        </div>
        <div>
            <label>
                <input type="checkbox" name="remember"> Remember Me
            </label>
        </div>
        <button type="submit">Login</button>
    </form>
</div>

{{-- @endsection --}}
