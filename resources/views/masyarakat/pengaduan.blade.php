<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaduan Saya - LaporMas</title>
    @vite('resources/css/app.css')
    <style>
        .geometric-pattern {
            background-image: radial-gradient(circle at 1px 1px, rgb(59, 130, 246, 0.15) 1px, transparent 0);
            background-size: 40px 40px;
        }
    </style>
</head>

<body class="font-sans antialiased bg-gray-50">
    <!-- Navigation -->
    @if (session('error'))
        <x-toastsucces>
            {{ session('erro') }}
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

    <nav class="fixed w-full bg-white/80 backdrop-blur-md z-0">
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
                        class="text-blue-600 transition-colors">Pengaduan Saya</a>
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
        <div class= "container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">
                <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-6">Pengaduan Saya</h1>
                <p class="text-lg sm:text-xl text-gray-600 mb-10">
                    Berikut adalah daftar pengaduan yang telah Anda sampaikan. Anda dapat melihat status dan detail dari
                    setiap pengaduan.
                </p>

                <!-- Filter Component -->
                <form method="GET" action="{{ route('masyarakat.pengaduan') }}">
                    <div class="mb-6">
                        <label for="status-filter" class="block text-sm font-medium text-gray-700 mb-1">Filter
                            berdasarkan status:</label>
                        <select id="status-filter" name="status"
                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md"
                            onchange="this.form.submit()">
                            <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>Semua</option>
                            <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Menunggu</option>
                            <option value="proses" {{ request('status') == 'proses' ? 'selected' : '' }}>Diproses
                            </option>
                            <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai
                            </option>
                        </select>
                    </div>
                </form>


                <!-- Complaints List -->
                <div class="space-y-6">
                    @forelse($yazid_pengaduan as $complaint)
                        <div class="bg-white shadow-md rounded-lg overflow-hidden mb-6">
                            <div class="p-6">
                                <div class="flex justify-between items-center mb-4">
                                    <h2 class="text-xl font-semibold text-gray-900">Pengaduan
                                        #{{ $complaint->id_pengaduan }}</h2>
                                    <span
                                        class="px-3 py-1 text-xs font-medium rounded-full 
                                    {{ $complaint->status == '0'
                                        ? 'bg-yellow-100 text-yellow-800'
                                        : ($complaint->status == 'proses'
                                            ? 'bg-blue-100 text-blue-800'
                                            : 'bg-green-100 text-green-800') }}">
                                        {{ $complaint->status == '0' ? 'Menunggu' : ($complaint->status == 'proses' ? 'Diproses' : 'Selesai') }}
                                    </span>
                                </div>

                                @if ($complaint->foto)
                                    <img src="{{ asset('storage/' . $complaint->foto) }}" alt="Foto Pengaduan"
                                        class="w-full h-48 object-cover rounded-lg mb-4 cursor-pointer"
                                        onclick="openModal('{{ asset('storage/' . $complaint->foto) }}')">
                                @endif

                                <p class="text-gray-600 mb-4">{{ Str::limit($complaint->isi_laporan, 100) }}</p>

                                <div class="flex items-center text-sm text-gray-500 mb-4">
                                    <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <span>{{ $complaint->tgl_pengaduan }}</span>
                                </div>

                                <button
                                    onclick="handleChatOpen({{ $complaint->id_pengaduan }}, '{{ $complaint->status }}')"
                                    class="mb-4 inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:border-blue-800 focus:ring ring-blue-300 transition ease-in-out duration-150 
                                {{ $complaint->status === '0' ? 'opacity-50 cursor-not-allowed' : '' }}"
                                    {{ $complaint->status === '0' ? 'disabled' : '' }}>
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z">
                                        </path>
                                    </svg>
                                    Buka Chat
                                </button>

                                <div class="mt-4 p-4 bg-gray-100 rounded-lg">
                                    <h4 class="font-semibold mb-2">Tanggapan Terakhir:</h4>
                                    @if ($complaint->tanggapan->count() > 0)
                                        @php
                                            $latestTanggapan = $complaint->tanggapan->last();
                                        @endphp
                                        <p class="text-gray-600">{{ Str::limit($latestTanggapan->tanggapan, 100) }}
                                        </p>
                                        <p class="text-sm text-gray-500 mt-2">Oleh: {{ $latestTanggapan->id_petugas }}
                                        </p>
                                    @else
                                        <p class="text-base text-gray-500 italic">Belum ada tanggapan</p>
                                    @endif
                                </div>
                            </div>
                            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                                {{-- <a href="/masyarakat/pengaduan/{{ $complaint->id_pengaduan }}">Hapus</a> --}}

                                @if ($complaint->status == '0')
                                <form action="/masyarakat/pengaduan/{{ $complaint->id_pengaduan }}" method="post">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="text-red-500">Hapus</button>
                                </form>
                                @endif
                                <a href=""
                                    class="text-blue-600 hover:text-blue-800 font-medium text-sm flex items-center justify-end">
                                    Lihat Detail
                                    <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="bg-white rounded-lg shadow-md p-6 text-center">
                            <p class="text-gray-600">Anda belum memiliki pengaduan. Klik tombol di bawah untuk membuat
                                pengaduan baru.</p>
                            <a href="{{ route('masyarakat.pengaduan') }}"
                                class="mt-4 inline-flex items-center justify-center px-6 py-2 border border-transparent text-base font-medium rounded-full text-white bg-blue-600 hover:bg-blue-700 transition-colors">
                                Buat Pengaduan Baru
                            </a>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $yazid_pengaduan->links() }}
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

    <!-- Chat Modal -->
    <!-- Modal untuk Masyarakat -->

    <div id="responseModal"
        class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden items-center justify-center z-50 transition-opacity duration-300">
        <div
            class="bg-white rounded-lg shadow-xl max-w-2xl w-full mx-4 h-3/4 flex flex-col transform transition-all duration-300 scale-95 opacity-0">
            <div class="flex items-center justify-between p-4 border-b">
                <h3 class="text-xl font-semibold text-gray-800">Tanggapan Pengaduan</h3>
                <button onclick="closeResponseModal()"
                    class="text-gray-400 hover:text-gray-600 transition duration-150">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div id="tanggapanList" class="flex-grow overflow-y-auto p-4 space-y-4">
                <!-- Tanggapan akan dimasukkan di sini -->
            </div>
            <form id="responseForm" class="p-4 border-t" onsubmit="submitResponse(event)">
                @csrf
                <input type="hidden" id="id_pengaduan" name="id_pengaduan">
                <div class="flex items-center space-x-2">
                    <textarea id="tanggapan" name="tanggapan"
                        class="flex-grow border rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" rows="2"
                        placeholder="Tulis tanggapan..." required></textarea>
                    <button type="submit"
                        class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300 flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal for image preview -->
    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
        <div class="max-w-3xl max-h-full p-4">
            <img id="modalImage" src="" alt="Foto Pengaduan" class="max-w-full max-h-full object-contain">
        </div>
    </div>

    <div id="alertModal"
        class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden items-center justify-center z-50 transition-opacity duration-300">
        <div
            class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4 transform transition-all duration-300 scale-95 opacity-0">
            <div class="p-6">
                <div class="flex items-center justify-center mb-4">
                    <svg class="w-16 h-16 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                        </path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 text-center mb-2">Pengaduan Belum Diproses</h3>
                <p class="text-gray-600 text-center mb-6">Anda hanya dapat memberikan tanggapan setelah pengaduan Anda
                    diproses oleh petugas.</p>
                <div class="flex justify-center">
                    <button onclick="closeAlertModal()"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-300">
                        Mengerti
                    </button>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const imageModal = document.getElementById('imageModal');
            const modalImage = document.getElementById('modalImage');

            window.openModal = function(imageSrc) {
                modalImage.src = imageSrc;
                imageModal.classList.remove('hidden');
            }

            imageModal.addEventListener('click', function() {
                this.classList.add('hidden');
            });

            // ... (existing code for status filter)
        });
    </script>

    <script>
        function handleChatOpen(id_pengaduan, status) {
            if (status === '0') {
                showAlertModal();
            } else {
                showResponseForm(id_pengaduan);
            }
        }

        function showAlertModal() {
            const modal = document.getElementById('alertModal');
            const modalContent = modal.querySelector('.max-w-md');

            modal.classList.remove('hidden');
            modal.classList.add('flex');
            setTimeout(() => {
                modal.classList.add('opacity-100');
                modalContent.classList.remove('scale-95', 'opacity-0');
                modalContent.classList.add('scale-100', 'opacity-100');
            }, 50);
        }

        function closeAlertModal() {
            const modal = document.getElementById('alertModal');
            const modalContent = modal.querySelector('.max-w-md');

            modalContent.classList.remove('scale-100', 'opacity-100');
            modalContent.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                modal.classList.remove('opacity-100');
                modal.classList.add('hidden');
            }, 300);
        }

        function showResponseForm(id_pengaduan) {
            const modal = document.getElementById('responseModal');
            const modalContent = modal.querySelector('.max-w-2xl');
            const tanggapanList = document.getElementById('tanggapanList');

            document.getElementById('id_pengaduan').value = id_pengaduan;
            tanggapanList.innerHTML =
                '<div class="flex justify-center"><svg class="animate-spin h-8 w-8 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg></div>';

            modal.classList.remove('hidden');
            modal.classList.add('flex');
            setTimeout(() => {
                modal.classList.add('opacity-100');
                modalContent.classList.remove('scale-95', 'opacity-0');
                modalContent.classList.add('scale-100', 'opacity-100');
            }, 50);

            fetch(`/masyarakat/tanggapan/${id_pengaduan}`)
                .then(response => response.json())
                .then(data => {
                    tanggapanList.innerHTML = '';
                    if (data.length > 0) {
                        data.forEach(item => {
                            const isMasyarakat = item.pengirim === 'masyarakat';
                            tanggapanList.innerHTML += `
                            <div class="flex ${isMasyarakat ? 'justify-end' : 'justify-start'}">
                                <div class="max-w-3/4 ${isMasyarakat ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800'} rounded-lg p-3 shadow">
                                    <div class="flex items-center mb-1">
                                        <span class="text-sm font-medium ${isMasyarakat ? 'text-blue-600' : 'text-gray-600'}">${item.nama}</span>
                                        <span class="ml-2 text-xs text-gray-500">${new Date(item.tgl_tanggapan).toLocaleString('id-ID')}</span>
                                    </div>
                                    <p class="text-sm">${item.tanggapan}</p>
                                </div>
                            </div>
                        `;
                        });
                        setTimeout(() => {
                            tanggapanList.scrollTop = tanggapanList.scrollHeight;
                        }, 100);
                    } else {
                        tanggapanList.innerHTML = '<p class="text-center text-gray-500">Belum ada tanggapan.</p>';
                    }
                })
                .catch(error => {
                    tanggapanList.innerHTML = '<p class="text-center text-red-500">Gagal memuat tanggapan.</p>';
                    console.error(error);
                });
        }

        function closeResponseModal() {
            const modal = document.getElementById('responseModal');
            const modalContent = modal.querySelector('.max-w-2xl');

            modalContent.classList.remove('scale-100', 'opacity-100');
            modalContent.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                modal.classList.remove('opacity-100');
                modal.classList.add('hidden');
            }, 300);
        }

        function submitResponse(event) {
            event.preventDefault();

            const form = document.getElementById('responseForm');
            const formData = new FormData(form);
            const id_pengaduan = formData.get('id_pengaduan');
            const tanggapanInput = document.getElementById('tanggapan');

            fetch(`/masyarakat/tanggapan`, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        tanggapanInput.value = '';
                        showResponseForm(id_pengaduan);
                    } else {
                        alert('Gagal mengirim tanggapan');
                    }
                })
                .catch(error => console.error(error));
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('responseModal');
            const alertModal = document.getElementById('alertModal');
            if (event.target === modal) {
                closeResponseModal();
            }
            if (event.target === alertModal) {
                closeAlertModal();
            }
        }

        // Close modal with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === "Escape") {
                closeResponseModal();
                closeAlertModal();
            }
        });
    </script>

</body>

</html>
