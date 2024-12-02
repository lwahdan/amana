document.addEventListener('DOMContentLoaded', () => {
    const navItems = document.querySelectorAll('.nav-item');
    const sections = document.querySelectorAll('.content-sections section');
    const themeSwitch = document.getElementById('theme-switch');

    // Navigation handling
    navItems.forEach(item => {
        item.addEventListener('click', (e) => {
            // Remove active class from all items
            navItems.forEach(nav => nav.classList.remove('active'));
            
            // Add active class to clicked item
            item.classList.add('active');

            // Get target section
            const targetSection = e.currentTarget.querySelector('a').dataset.section;
            
            // Hide all sections
            sections.forEach(section => {
                section.classList.remove('active-section');
                section.classList.add('hidden-section');
            });

            // Show target section
            const activeSection = document.getElementById(targetSection);
            activeSection.classList.remove('hidden-section');
            activeSection.classList.add('active-section');
        });
    });

    // Theme toggle
    themeSwitch.addEventListener('change', () => {
        document.body.classList.toggle('dark-theme');
        // Optional: Save theme preference to localStorage
        localStorage.setItem('theme', 
            document.body.classList.contains('dark-theme') ? 'dark' : 'light'
        );
    });

    // Check saved theme preference
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'dark') {
        document.body.classList.add('dark-theme');
        themeSwitch.checked = true;
    }

    // Logout functionality
    const logoutBtn = document.querySelector('.logout-btn');
    logoutBtn.addEventListener('click', () => {
        // Implement logout logic here
        alert('Logout functionality to be implemented');
    });

    // Mobile sidebar toggle
    const toggleSidebarBtn = document.querySelector('.toggle-sidebar');
    const sidebar = document.querySelector('.sidebar');
    
    toggleSidebarBtn.addEventListener('click', () => {
        sidebar.classList.toggle('active');
    });
});