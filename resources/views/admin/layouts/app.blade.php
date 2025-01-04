@include('admin.partials.header')
@if (session('success'))
    <div class="alert alert-success mt-4 mr-4 ml-4" id="success-alert">
        {{ session('success') }}
    </div>

    <script>
        setTimeout(() => {
            const alert = document.getElementById('success-alert');
            if (alert) {
                alert.style.display = 'none'; // Hide the alert
            }
        }, 5000);
    </script>
@endif

<div class="content">
    @yield('content')
</div>
@include('admin.partials.footer')