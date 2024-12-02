@include('admin.partials.header')
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="content">
    @yield('content')
</div>
@include('admin.partials.footer')