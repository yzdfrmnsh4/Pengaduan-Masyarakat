<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - LaporMas</title>
    @vite('resources/css/app.css')
    <style>
        .geometric-pattern {
            background-image: radial-gradient(circle at 1px 1px, rgb(59, 130, 246, 0.15) 1px, transparent 0);
            background-size: 40px 40px;
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-100">
    <!-- Navigation -->
    <nav class="fixed w-full bg-white/80 backdrop-blur-md z-10">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    {{-- <div class="w-10 h-10 bg-blue-600 rounded-full"></div> --}}
                    <div class="w-8 h-8 bg-gradient-to-br from-blue-600 via-blue-700 to-blue-900 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <span class="text-xl font-bold text-gray-900">LaporMas</span>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('masyarakat.index') }}"
                        class="text-gray-600 hover:text-blue-600 transition-colors">Buat Pengaduan</a>
                    <a href="{{ route('masyarakat.pengaduan') }}"
                        class="text-gray-600 hover:text-blue-600 transition-colors">Pengaduan Saya</a>
                </div>
                <div class="hidden md:flex items-center space-x-4">
                    <div class="relative">
                        <button id="profileDropdown"
                            class="flex items-center space-x-2 text-gray-600 hover:text-blue-600 transition-colors focus:outline-none">
                            {{-- <img class="w-8 h-8 rounded-full" src="{{ Auth::user()->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->nama) }}" alt="{{ Auth::user()->nama }}"> --}}
                            <span>{{ Session::get('nama') }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div id="profileMenu"
                            class="absolute right-0 mt-2 w-48 bg-white rounded-md overflow-hidden shadow-xl z-10 hidden">
                            <a href="{{ route('masyarakat.profile') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profil Saya</a>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Keluar</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="md:hidden">
                    <button id="mobileMenuButton"
                        class="text-gray-600 hover:text-blue-600 transition-colors focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <!-- Mobile menu -->
        <div id="mobileMenu" class="md:hidden hidden">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href="{{ route('masyarakat.index') }}"
                    class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50">Beranda</a>
                <a href="{{ route('masyarakat.pengaduan') }}"
                    class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50">Pengaduan
                    Saya</a>
                <a href="#"
                    class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50">Statistik</a>
                <a href="{{ route('masyarakat.profile') }}"
                    class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50">Profil
                    Saya</a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="block w-full text-left px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50">Keluar</button>
                </form>
            </div>
        </div>
    </nav>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const profileDropdown = document.getElementById('profileDropdown');
            const profileMenu = document.getElementById('profileMenu');
            const mobileMenuButton = document.getElementById('mobileMenuButton');
            const mobileMenu = document.getElementById('mobileMenu');

            // Profile dropdown functionality
            profileDropdown.addEventListener('click', function(event) {
                event.stopPropagation();
                profileMenu.classList.toggle('hidden');
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function(event) {
                if (!profileDropdown.contains(event.target) && !profileMenu.contains(event.target)) {
                    profileMenu.classList.add('hidden');
                }
            });

            // Mobile menu functionality
            mobileMenuButton.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });
        });
    </script>

    <!-- Main Content -->
    <main class="pt-32 pb-20">
        <div class="max-w-7xl mx-auto sm:px-9 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl">
                <div class="p-6 sm:p-8">
                    <div class="flex flex-col sm:flex-row items-center sm:items-start space-y-4 sm:space-y-0 sm:space-x-6">
                        <img class="w-32 h-32 rounded-full object-cover border-4 border-gray-200" src="{{ $yazid_profile->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($yazid_profile->nama) }}" alt="{{ $yazid_profile->nama }}">
                        <div class="text-center sm:text-left">
                            <h1 class="text-3xl font-bold text-gray-900">{{ $yazid_profile->nama }}</h1>
                            <p class="text-lg text-gray-500">{{ $yazid_profile->username }}</p>
                            <div class="mt-2">
                                <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                    Masyarakat
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 border-t border-gray-200 pt-8">
                        <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">NIK</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $yazid_profile->nik }}</dd>
                            </div>
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">No. Telepon</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $yazid_profile->telp }}</dd>
                            </div>
                        </dl>
                    </div>

                    <div class="mt-8 border-t border-gray-200 pt-8">
                        <h2 class="text-lg font-medium text-gray-900">Statistik Pengaduan</h2>
                        <dl class="mt-4 grid grid-cols-1 gap-5 sm:grid-cols-3">
                            <div class="px-4 py-5 bg-white shadow rounded-lg overflow-hidden sm:p-6">
                                <dt class="text-sm font-medium text-gray-500 truncate">Total Pengaduan</dt>
                                <dd class="mt-1 text-3xl font-semibold text-gray-900">{{ $yazid_pengaduan }}</dd>
                            </div>
                            <div class="px-4 py-5 bg-white shadow rounded-lg overflow-hidden sm:p-6">
                                <dt class="text-sm font-medium text-gray-500 truncate">Pengaduan Selesai</dt>
                                <dd class="mt-1 text-3xl font-semibold text-gray-900">{{ $yazid_pengaduan_selesai }}</dd>
                            </div>
                            <div class="px-4 py-5 bg-white shadow rounded-lg overflow-hidden sm:p-6">
                                <dt class="text-sm font-medium text-gray-500 truncate">Pengaduan Dalam Proses</dt>
                                <dd class="mt-1 text-3xl font-semibold text-gray-900">{{ $yazid_pengaduan_proses }}</dd>
                            </div>
                        </dl>
                    </div>

                    <div class="mt-8 flex justify-end">
                        <a href="" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Edit Profil
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Footer -->
    <footer class="bg-gray-50 py-12">
        <div class="container mx-auto px-6">
            <div class="grid md:grid-cols-4 gap-8">
                <div class="space-y-4">
                    <div class="flex items-center space-x-2">
                        {{-- <div class="w-10 h-10 bg-blue-600 rounded-full"></div> --}}
                        <div class="w-8 h-8 bg-gradient-to-br from-blue-600 via-blue-700 to-blue-900 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <span class="text-xl font-bold text-gray-900">LaporMas</span>
                    </div>
                    <p class="text-gray-600">Platform pengaduan masyarakat modern untuk Indonesia yang lebih baik.</p>
                </div>

                @php
                    $footerLinks = [
                        'Layanan' => ['Pengaduan', 'Tracking', 'Statistik'],
                        'Perusahaan' => ['Tentang Kami', 'Karir', 'Kontak'],
                    ];
                @endphp

                @foreach ($footerLinks as $title => $links)
                    <div>
                        <h4 class="text-gray-900 font-semibold mb-4">{{ $title }}</h4>
                        <ul class="space-y-2">
                            @foreach ($links as $link)
                                <li><a href="#"
                                        class="text-gray-600 hover:text-blue-600 transition-colors">{{ $link }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach

                <div>
                    <h4 class="text-gray-900 font-semibold mb-4">Ikuti Kami</h4>
                    <div class="flex space-x-4">
                        @php
                            $socialLinks = [
                                'Facebook' =>
                                    '<path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>',
                                'Twitter' =>
                                    '<path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>',
                                'Instagram' =>
                                    '<path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/>',
                            ];
                        @endphp

                        @foreach ($socialLinks as $name => $path)
                            <a href="#" class="text-gray-600 hover:text-blue-600 transition-colors">
                                <span class="sr-only">{{ $name }}</span>
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    {!! $path !!}
                                </svg>
                            </a>
                        @endforeach

                    </div>
                    <div class="py-4">
                        <img src="{{ asset('img/logo_TIP.png') }}" alt="logo smk ti pembangunan" class="w-20">
                    </div> 
                </div>
            </div>

            <div class="border-t border-gray-200 mt-12 pt-8 text-center">
                <p class="text-gray-600">&copy; {{ date('Y') }} LaporMas. Hak Cipta Dilindungi.</p>
                <p class="text-gray-600 text-sm">Created By : <span class="font-bold">Muhammad Yazid</span></p>

            </div>
        </div>
    </footer>

</body>
</html>