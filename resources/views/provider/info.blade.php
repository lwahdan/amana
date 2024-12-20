@extends('provider.dashboard')

@section('dashboard-content')
<div>
<h1>Provider Info</h1>
<form>
    {{-- Form to display and edit provider information --}}
       <h1>Welcome, {{ Auth::guard('provider')->user()->name }}!</h1>
            <p>This is your provider dashboard.</p>
            <a href="{{route('provider_logout')}}">logout</a>
</form>
</div>
@endsection
