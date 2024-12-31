<div class="user-sidebar">
    <ul class="user-sidebar-menu">
        <li class="user-sidebar-item {{ request()->routeIs('user.info') ? 'active' : '' }}">
            <a href="{{ route('user.info') }}"> <i class="fa-solid fa-user"></i>User Info</a>
        </li>
        <li class="user-sidebar-item {{ request()->routeIs('user.bookings') ? 'active' : '' }}">
            <a href="{{ route('user.bookings') }}"><i class="fa-solid fa-calendar-check"></i>Bookings</a>
        </li>
        <li class="user-sidebar-item {{ request()->routeIs('user.meetings') ? 'active' : '' }}">
            <a href="{{ route('user.meetings') }}"><i class="fa-solid fa-video"></i>Meetings</a>
        </li>
        <li class="user-sidebar-item {{ request()->routeIs('user.reviews') ? 'active' : '' }}">
            <a href="{{ route('user.reviews') }}"><i class="fa-solid fa-star"></i>Reviews</a>
        </li>
        <li class="user-sidebar-item {{ request()->routeIs('user.favorites') ? 'active' : '' }}">
            <a href="{{ route('user.favorites') }}"><i class="fa-solid fa-heart"></i>Favorites</a>
        </li>
        <li class="user-sidebar-item {{ request()->routeIs('user.blogs') ? 'active' : '' }}">
            <a href="{{ route('user.blogs') }}"><i class="fa-brands fa-readme"></i>My Blogs</a>
        </li>

        <li class="user-sidebar-item {{ request()->routeIs('logout') ? 'active' : '' }}">
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa-solid fa-arrow-right-from-bracket"></i> Log out
            </a>
        </li>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>

    </ul>
</div>
<script>
    // Optional JS to highlight the active sidebar item dynamically
    document.addEventListener("DOMContentLoaded", () => {
        const sidebarLinks = document.querySelectorAll(".user-sidebar-item a");
        const currentUrl = window.location.href;

        sidebarLinks.forEach(link => {
            if (link.href === currentUrl) {
                link.parentElement.classList.add("active");
            }
        });
    });
</script>
