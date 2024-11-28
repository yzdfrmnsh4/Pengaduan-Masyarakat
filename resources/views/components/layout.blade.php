<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Manajemen Pengaduan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/toast.css') }}">
    <style>
        @media (max-width: 768px) {
            .sidebar-collapsed {
                width: 0;
                overflow: hidden;
            }
        }
    </style>
</head>

<body class="bg-gray-50">
    @if (session('success'))
        <x-toastsucces>
            {{ session('success') }}
        </x-toastsucces>
        <script>
            // Function to close the toast
            function closeToast() {
                const toast = document.getElementById('toast-success');
                toast.classList.add('hidden');
            }
            // Auto close the toast after 5 seconds
            setTimeout(closeToast, 5000);
        </script>
    @endif
    <div class="flex min-h-screen z-0">
        <!-- Sidebar -->
        <x-sidebar></x-sidebar>
        <!-- Main Content -->
        <div class="flex-1 sm:ml-64 z-0">
            <!-- Header -->
            <header class="fixed top-0 right-0 left-0 sm:left-64 z-10 bg-white border-b border-gray-200">
                <div class="flex items-center justify-between px-4 py-3 sm:px-6">
                    <div class="flex items-center gap-4">
                        <button id="openSidebar" class="sm:hidden">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                        <h1 class="text-xl font-semibold">Halo, {{ Session::get('nama') }}</h1>
                        <span class="text-sm text-gray-500">{{ now()->isoFormat('dddd, D MMMM YYYY') }}</span>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="relative hidden sm:block">
                            <input type="text" placeholder="Cari pengaduan..."
                                class="w-64 pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <button class="p-2 text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                        </button>
                        <div class="relative" id="userMenu">
                            <button id="userMenuButton" class="flex items-center focus:outline-none">
                                <img class="w-8 h-8 rounded-full object-cover" src="{{ $yazid_profile->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode(Session::get('nama')) }}" alt="{{ Session::get('nama') }}">
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div id="userMenuDropdown"
                                class="absolute right-0 w-48 mt-2 py-2 bg-white rounded-md shadow-xl z-20 hidden">
                                <a href="{{ Route('profile') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Edit Profil</a>
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Pengaturan</a>
                                <div class="border-t border-gray-100"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <div class="p-4 sm:p-6 mt-16">
                {{ $slot }}
            </div>
        </div>
    </div>

    <script>
        // Sidebar toggle functionality
        const sidebar = document.getElementById('sidebar');
        const openSidebarBtn = document.getElementById('openSidebar');
        const closeSidebarBtn = document.getElementById('closeSidebar');

        openSidebarBtn.addEventListener('click', () => {
            sidebar.classList.remove('-translate-x-full');
        });

        closeSidebarBtn.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', (e) => {
            if (window.innerWidth < 640 && !sidebar.contains(e.target) && e.target !== openSidebarBtn) {
                sidebar.classList.add('-translate-x-full');
            }
        });

        // Adjust sidebar on window resize
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 640) {
                sidebar.classList.remove('-translate-x-full');
            } else {
                sidebar.classList.add('-translate-x-full');
            }
        });

        // User menu dropdown functionality
        const userMenuButton = document.getElementById('userMenuButton');
        const userMenuDropdown = document.getElementById('userMenuDropdown');

        userMenuButton.addEventListener('click', () => {
            userMenuDropdown.classList.toggle('hidden');
        });

        // Close user menu when clicking outside
        document.addEventListener('click', (e) => {
            if (!userMenuButton.contains(e.target) && !userMenuDropdown.contains(e.target)) {
                userMenuDropdown.classList.add('hidden');
            }
        });
    </script>
</body>

</html>
