<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center">
                <!-- Sandwich (Hamburger) Icon -->
                <button type="button" class="btn btn-primary" id="sidebar-toggle" style="position: fixed; top: 20px; left: 10px; z-index: 1001;">
                    &#9776; <!-- Hamburger Icon -->
                </button>
            <!-- Company Logo and Name -->
            <div class="flex items-center ml-auto" style="position: absolute; right: 60px;"> 
                <img src="{{ Auth::user()->company ? Auth::user()->company->company_logo : 'No Logo' }}" alt=" Logo" style="width: 45px; height: 45px; margin-right: 10px;">
                <span class="text-lg font-semibold text-gray-800 dark:text-gray-200">    {{ Auth::user()->company ? Auth::user()->company->company_name : 'No Company' }}
                </span>
                </div>     
              <!-- resources/views/components/navbar.blade.php -->
<div id="sidebar" style="width: 250px; height: 100%; position: fixed; top: 0; left: 0; background-color: #f8f9fa; transition: margin-left 0.3s; padding-top: 80px; z-index: 1000; display: block;">
    <ul style="list-style-type: none; padding: 0;">
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4 flex items-center">
                <!-- Logo Image -->
                <img src="{{ asset('storage/img/logos/amahlelogo.png') }}" alt="Amahle Logo" style="width: 45px; height: 45px; margin-right: 10px;">

                <!-- User Information -->
                <div>
                    <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                    <div style="word-wrap: break-word; word-break: break-word;" class="font-medium text-sm text-gray-500">
    {{ Auth::user()->email }}
</div>
                </div>
            </div>
        </div>


        <div class="mt-3 space-y-1">
            <x-responsive-nav-link :href="route('profile.edit')" class="flex items-center">
                <!-- Inline SVG for Profile Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-4.42 0-8 2.24-8 5v1h16v-1c0-2.76-3.58-5-8-5z" />
                </svg>
                {{ __('Profile') }}
            </x-responsive-nav-link>
        </div>
        <div class="mt-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                </svg>
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <div class="mt-3 space-y-1">
            <x-responsive-nav-link :href="route('invoices')">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h10M7 12h10m-5 5h5" />
                </svg>
                {{ __('Invoices') }}
            </x-responsive-nav-link>
        </div>

       <div class="mt-2 space-y-1">
    <x-responsive-nav-link>
        <a href="#" class="nav-link d-flex align-items-center text-dark pl-3" data-bs-toggle="modal" data-bs-target="#contactUsModal" style="font-size: 1rem; font-weight: 500;">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 me-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="width: 20px; height: 20px; color: #343a40;">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V7M3 7l9 5 9-5" />
            </svg>
            {{ __('Contact Us') }}
        </a>
    </x-responsive-nav-link>
</div>


        <div class="mt-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 17h6M9 13h6m-7 4h6m2-8h-2a2 2 0 01-2-2V4a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2z" />
                </svg>
                {{ __('Reports') }}
            </x-responsive-nav-link>
        </div>

        <div class="mt-3 space-y-1">
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <x-responsive-nav-link :href="('logout')"
                    onclick="event.preventDefault();
                                        this.closest('form').submit();">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H3" />
                    </svg>
                    {{ __('Sign Out') }}
                </x-responsive-nav-link>
            </form>
        </div>
</div>
</ul>
</div>
            
        </div>
    </div>
</nav>
<script>
    const sidebar = document.getElementById('sidebar');
    const sidebarToggle = document.getElementById('sidebar-toggle');
    if (localStorage.getItem('sidebarState') === 'open') {
        sidebar.style.display = 'block';
    } else {
        sidebar.style.display = 'none'; 
    }
    sidebarToggle.addEventListener('click', function() {
        if (sidebar.style.display === 'block') {
            sidebar.style.display = 'none';
            localStorage.setItem('sidebarState', 'closed'); // Save closed state
        } else {
            sidebar.style.display = 'block';
            localStorage.setItem('sidebarState', 'open'); // Save open state
        }
    });
</script>