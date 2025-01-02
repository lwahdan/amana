<div class="sidebar">
    <ul class="sidebar-menu">
        <li class="sidebar-item {{ request()->routeIs('provider.info') ? 'active' : '' }}">
            <a href="{{ route('provider.info') }}"><i class="fa-solid fa-user"></i>Provider Info</a>
        </li>
        <li class="sidebar-item {{ request()->routeIs('provider.bookings') ? 'active' : '' }}">
            <a href="{{ route('provider.bookings') }}"> <i class="fa-solid fa-calendar-check"></i>Bookings</a>
        </li>
        <li class="sidebar-item {{ request()->routeIs('provider.meetings') ? 'active' : '' }}">
            <a href="{{ route('provider.meetings') }}"><i class="fa-solid fa-video"></i>Meetings</a>
        </li>
        <li class="sidebar-item {{ request()->routeIs('provider.reviews') ? 'active' : '' }}">
            <a href="{{ route('provider.reviews') }}"><i class="fa-solid fa-star"></i>Reviews</a>
        </li>
        <li class="sidebar-item {{ request()->routeIs('provider.blogs') ? 'active' : '' }}">
            <a href="{{ route('provider.blogs') }}"><i class="fa-brands fa-readme"></i>My Blogs</a>
        </li>
        <li class="sidebar-item {{ request()->routeIs('logout') ? 'active' : '' }}">
            <a href="#" onclick="event.preventDefault(); document.getElementById('provider-logout-form').submit();">
                <i class="fa-solid fa-arrow-right-from-bracket"></i> Log out
            </a>
        </li>

        <form id="provider-logout-form" action="{{ route('provider_logout') }}" method="POST"  style="display: none;">
            @csrf
        </form>
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