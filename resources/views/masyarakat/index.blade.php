<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Pengaduan - LaporMas</title>
    @vite('resources/css/app.css')
    <style>
        .geometric-pattern {
            background-image: radial-gradient(circle at 1px 1px, rgb(59, 130, 246, 0.15) 1px, transparent 0);
            background-size: 40px 40px;
        }
    </style>
</head>

<body class="font-sans antialiased bg-gray-50">
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
                        class="text-blue-600 transition-colors">Buat Pengaduan</a>
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
        <div class="container mx-auto px-6">
            <div class="max-w-4xl mx-auto">
                <h1 class="text-4xl font-bold text-gray-900 mb-4 text-center">Selamat Datang,
                    <span class="text-blue-700">{{ Session::get('nama') }}</span></h1>
                <h1 class="text-4xl font-bold text-gray-900 mb-6 text-center">Sampaikan Pengaduan Anda</h1>
                <p class="text-xl text-gray-600 mb-10 text-center">
                    Isi formulir di bawah ini untuk menyampaikan pengaduan Anda. Kami akan menindaklanjuti setiap
                    laporan dengan serius.
                </p>

                <!-- Complaint Form Card -->
                <div class="bg-white rounded-2xl shadow-lg p-8 mb-12 border">
                    <form action="{{ Route('masyarakat.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="space-y-6">
                            <div>
                                <label for="tanggal_pengaduan" class="block text-sm font-medium text-gray-700">Tanggal
                                    Pengaduan</label>
                                {{-- <input type="date" name="tanggal_pengaduan" id="tanggal_pengaduan" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-3 border focus:border-blue-500 focus:ring-blue-500"
                                    readonly value="{{ old('tanggal_pengaduan', date('Y-m-d')) }}"> --}}
                                <input type="date" name="tanggal_pengaduan" id="tanggal_pengaduan" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-3 border focus:border-blue-500 focus:ring-blue-500"
                                    value="{{ old('tanggal_pengaduan', date('Y-m-d')) }}">
                            </div>

                            <div>
                                <label for="isi_laporan" class="block text-sm font-medium text-gray-700">Isi Laporan
                                    Pengaduan</label>
                                <textarea name="isi_laporan" id="isi_laporan" rows="5" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-3 focus:border-blue-500 focus:ring-blue-500 border"
                                    placeholder="Jelaskan detail pengaduan Anda..."></textarea>
                            </div>

                            <div>
                                <label for="photo" class="block text-sm font-medium text-gray-700 mb-2">Foto
                                    Pendukung</label>
                                <div class="flex items-center justify-center w-full">
                                    <label for="photo"
                                        class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 relative overflow-hidden">
                                        <div id="upload-icon"
                                            class="flex flex-col items-center justify-center pt-5 pb-6">
                                            <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 20 16">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                            </svg>
                                            <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Klik
                                                    untuk upload</span> atau drag and drop</p>
                                            <p class="text-xs text-gray-500">PNG, JPG atau GIF (Maks. 800x400px)</p>
                                        </div>
                                        <img id="image-preview"
                                            class="absolute inset-0 w-full h-full object-cover hidden" alt="Preview">
                                        <input id="photo" name="photo" type="file" class="hidden"
                                            accept="image/*" />
                                    </label>
                                </div>
                                <p class="mt-2 text-sm text-red-600 hidden" id="photo-error"></p>
                            </div>

                            @push('scripts')
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const photoInput = document.getElementById('photo');
                                        const imagePreview = document.getElementById('image-preview');
                                        const uploadIcon = document.getElementById('upload-icon');
                                        const photoError = document.getElementById('photo-error');

                                        photoInput.addEventListener('change', function(event) {
                                            const file = event.target.files[0];

                                            if (file) {
                                                const reader = new FileReader();
                                                reader.onload = function(e) {
                                                    imagePreview.src = e.target.result;
                                                    imagePreview.classList.remove('hidden');
                                                    uploadIcon.classList.add('hidden');
                                                }
                                                reader.readAsDataURL(file);
                                            } else {
                                                imagePreview.classList.add('hidden');
                                                uploadIcon.classList.remove('hidden');
                                            }

                                            // Validate file size and type
                                            if (file && file.size > 2 * 1024 * 1024) { // 2MB limit
                                                photoError.textContent = 'Ukuran file terlalu besar. Maksimum 2MB.';
                                                photoError.classList.remove('hidden');
                                                photoInput.value = '';
                                            } else if (file && !['image/png', 'image/jpeg', 'image/gif'].includes(file.type)) {
                                                photoError.textContent = 'Tipe file tidak didukung. Gunakan PNG, JPG, atau GIF.';
                                                photoError.classList.remove('hidden');
                                                photoInput.value = '';
                                            } else {
                                                photoError.classList.add('hidden');
                                            }
                                        });
                                    });
                                </script>
                            @endpush
                            <div>
                                <button type="submit"
                                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Kirim Pengaduan
                                </button>
                            </div>
                        </div>
                    </form>
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
    @stack('scripts')
</body>

</html>

