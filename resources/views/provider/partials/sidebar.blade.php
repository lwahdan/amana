<div class="sidebar">
    <ul class="sidebar-menu">
        <li class="sidebar-item {{ request()->routeIs('provider.info') ? 'active' : '' }}">
            <a href="{{ route('provider.info') }}">Provider Info</a>
        </li>
        <li class="sidebar-item {{ request()->routeIs('provider.bookings') ? 'active' : '' }}">
            <a href="{{ route('provider.bookings') }}">Bookings</a>
        </li>
        <li class="sidebar-item {{ request()->routeIs('provider.meetings') ? 'active' : '' }}">
            <a href="{{ route('provider.meetings') }}">Meetings</a>
        </li>
        <li class="sidebar-item {{ request()->routeIs('provider.reviews') ? 'active' : '' }}">
            <a href="{{ route('provider.reviews') }}">Reviews</a>
        </li>
    </ul>
</div>
<script>
    // Optional JS to highlight the active sidebar item dynamically
document.addEventListener("DOMContentLoaded", () => {
    const sidebarLinks = document.querySelectorAll(".sidebar-item a");
    const currentUrl = window.location.href;

    sidebarLinks.forEach(link => {
        if (link.href === currentUrl) {
            link.parentElement.classList.add("active");
        }
    });
});

</script>