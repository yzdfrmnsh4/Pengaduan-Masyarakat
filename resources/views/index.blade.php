<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaduan Masyarakat - Platform Aspirasi Modern</title>
    @vite('resources/css/app.css')
    <style>
        .geometric-pattern {
            background-image: radial-gradient(circle at 1px 1px, rgb(59, 130, 246, 0.15) 1px, transparent 0);
            background-size: 40px 40px;
        }

        .blob-animation {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .scroll-smooth {
            scroll-behavior: smooth;
        }

        /* Hide scrollbar but keep functionality */
        .overflow-x-auto {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .overflow-x-auto::-webkit-scrollbar {
            display: none;
        }
    </style>
</head>

<body class="font-sans antialiased bg-white">
    <!-- Navigation -->
    <nav class="fixed w-full bg-white/80 backdrop-blur-md z-50">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    {{-- <div class="w-10 h-10 bg-blue-600 rounded-full"></div> --}}
                    {{-- <div>
                        <img src="{{ asset('img/logo_TIP.png') }}" alt="" class="w-16">
                    </div> --}}
                    <div class="w-8 h-8 bg-gradient-to-br from-blue-600 via-blue-700 to-blue-900 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <span class="text-xl font-bold text-gray-900">LaporMas</span>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#" class="text-gray-600 hover:text-blue-600 transition-colors">Beranda</a>
                    <a href="#" class="text-gray-600 hover:text-blue-600 transition-colors">Fitur</a>
                    <a href="#" class="text-gray-600 hover:text-blue-600 transition-colors">Cara Kerja</a>
                    <a href="#" class="text-gray-600 hover:text-blue-600 transition-colors">Statistik</a>
                </div>
                <div class="hidden md:block md:gap-3">
                    <a href="/yazid_login"
                        class="inline-flex items-center justify-center px-6 py-2 border border-transparent text-base font-medium rounded-full text-white bg-blue-600 hover:bg-blue-700 transition-colors">
                        Masuk
                    </a>
                    <a href="/yazid_register"
                        class="inline-flex items-center justify-center px-6 py-2 border border-transparent text-base font-medium rounded-full text-blue-600  hover:bg-blue-600 hover:text-white transition-colors">
                        Daftar
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-32 pb-20 relative overflow-hidden">
        <div class="container mx-auto px-6">
            <div class="relative z-10 max-w-4xl mx-auto text-center">
                <h1 class="text-4xl md:text-6xl font-bold text-gray-900 mb-6">
                    Layanan Pengaduan Masyarakat
                </h1>
                <p class="text-xl text-gray-600 mb-10 max-w-2xl mx-auto">
                    Sampaikan aspirasi Anda dengan mudah dan transparan. Kami memastikan setiap suara didengar dan
                    ditindaklanjuti.
                </p>
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    <a href="#"
                        class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-full text-white bg-blue-600 hover:bg-blue-700 transition-colors">
                        Sampaikan Pengaduan
                    </a>
                </div>
            </div>

            <!-- Geometric Decorations -->
            <div class="absolute top-20 left-20 w-72 h-72 bg-yellow-400/20 rounded-full blur-3xl"></div>
            <div class="absolute top-40 right-20 w-72 h-72 bg-blue-400/20 rounded-full blur-3xl"></div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                @php
                    $stats = [
                        ['value' => '1.586', 'label' => 'Total Laporan'],
                        ['value' => '24/7', 'label' => 'Instansi Terhubung'],
                        ['value' => '10k+', 'label' => 'Pengguna Aktif'],
                        ['value' => '5.0', 'label' => 'Rating Kepuasan'],
                    ];
                @endphp

                @foreach ($stats as $stat)
                    <div class="text-center">
                        <div class="text-4xl font-bold text-blue-600 mb-2">{{ $stat['value'] }}</div>
                        <div class="text-gray-600">{{ $stat['label'] }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Layanan Section -->
    <section class="py-20">
        <div class="container mx-auto px-6">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Layanan Kami</h2>
                <p class="text-gray-600">Platform yang dirancang khusus untuk memudahkan proses pengaduan dan memastikan
                    tindak lanjut yang tepat.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                @php
                    $features = [
                        [
                            'icon' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"></path>',
                            'title' => 'Pelaporan Cepat',
                            'description' =>
                                'Laporkan masalah Anda dengan mudah melalui form yang simpel dan intuitif.',
                            'color' => 'blue-600',
                        ],
                        [
                            'icon' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>',
                            'title' => 'Tracking Realtime',
                            'description' => 'Pantau status pengaduan Anda secara realtime dengan mudah.',
                            'color' => 'yellow-500',
                        ],
                        [
                            'icon' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>',
                            'title' => 'Respon Cepat',
                            'description' => 'Dapatkan tanggapan cepat dari petugas yang berwenang.',
                            'color' => 'green-500',
                        ],
                    ];
                @endphp

                @foreach ($features as $feature)
                    <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-shadow">
                        <div
                            class="w-14 h-14 bg-{{ $feature['color'] }} rounded-full flex items-center justify-center mb-6">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                {!! $feature['icon'] !!}
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">{{ $feature['title'] }}</h3>
                        <p class="text-gray-600">{{ $feature['description'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Recent Complaints Section -->
    <section class="py-20 ">
        <div class="container mx-auto px-10 
        ">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Pengaduan Terbaru</h2>
                <p class="text-gray-600">Lihat pengaduan terbaru yang telah disampaikan oleh masyarakat</p>
            </div>

            <div class="relative w-full ">
                <div class="flex overflow-x-auto gap-6 snap-x snap-mandatory pb-6 -mx-6 px-6 scroll-smooth"
                    id="complaint-scroll">
                    @foreach ($yazid_pengaduan as $yazid_complaint)
                        <div class="flex-none w-full max-w-sm snap-start ">
                            <div
                                class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center justify-between mb-2">
                                            <div class="text-sm text-gray-600">NIK:
                                                {{ substr($yazid_complaint->nik, 0, 6) }}xxxx</div>
                                            <div class="text-sm text-gray-500">
                                                {{ \Carbon\Carbon::parse($yazid_complaint->tgl_pengaduan)->format('d M Y') }}
                                            </div>
                                        </div>
                                        <p class="text-gray-900 mb-3">{{ Str::limit($yazid_complaint->isi_laporan, 50) }}</p>
                                        <div class="flex gap-3">
                                            <a href=""
                                                class="inline-flex items-center text-sm text-blue-600 hover:text-blue-700">
                                                <span>Lihat selengkapnya</span>
                                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                </svg>
                                            </a>
                                            <span
                                                class="inline-flex items-center text-sm {{ $yazid_complaint->status === 'selesai' ? 'text-green-600' : ($yazid_complaint->status === 'proses' ? 'text-yellow-600' : 'text-gray-600') }}">
                                                <span>Status: {{ ucfirst($yazid_complaint->status) }}</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Navigation buttons -->
                <button onclick="document.getElementById('complaint-scroll').scrollBy({left: -300, behavior: 'smooth'})"
                    class="absolute left-0 top-1/2 -translate-y-1/2 bg-white/80 backdrop-blur-sm rounded-full p-2 shadow-md hover:bg-white transition-colors">
                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                        </path>
                    </svg>
                </button>
                <button onclick="document.getElementById('complaint-scroll').scrollBy({left: 300, behavior: 'smooth'})"
                    class="absolute right-0 top-1/2 -translate-y-1/2 bg-white/80 backdrop-blur-sm rounded-full p-2 shadow-md hover:bg-white transition-colors">
                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                        </path>
                    </svg>
                </button>
            </div>
        </div>
    </section>





    <!-- How It Works -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Cara Kerja</h2>
                <p class="text-gray-600">Proses sederhana untuk menyampaikan pengaduan Anda</p>
            </div>

            <div class="relative">
                <div class="hidden md:block absolute top-1/2 left-0 right-0 h-0.5 bg-blue-600 -translate-y-1/2"></div>
                <div class="grid md:grid-cols-3 gap-8">
                    @php
                        $steps = [
                            [
                                'title' => 'Buat Akun',
                                'description' => 'Daftar dengan mudah menggunakan email atau nomor telepon Anda',
                            ],
                            [
                                'title' => 'Tulis Laporan',
                                'description' => 'Jelaskan masalah Anda dengan detail yang diperlukan',
                            ],
                            [
                                'title' => 'Tindak Lanjut',
                                'description' => 'Dapatkan update regular tentang progress penanganan',
                            ],
                        ];
                    @endphp

                    @foreach ($steps as $index => $step)
                        <div class="relative bg-white p-8 rounded-2xl shadow-lg">
                            <div
                                class="absolute -top-6 left-1/2 -translate-x-1/2 w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold">
                                {{ $index + 1 }}</div>
                            <div class="pt-8">
                                <h3 class="text-xl font-semibold text-gray-900 mb-4 text-center">{{ $step['title'] }}
                                </h3>
                                <p class="text-gray-600 text-center">{{ $step['description'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20">
        <div class="container mx-auto px-6">
            <div class="bg-blue-600 rounded-3xl p-12 text-center relative overflow-hidden">
                <div class="relative z-10">
                    <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">Siap Menyampaikan Aspirasi Anda?</h2>
                    <p class="text-blue-100 mb-8 max-w-2xl mx-auto">Bergabunglah dengan ribuan warga yang telah
                        menggunakan platform kami untuk membuat perubahan.</p>
                    <a href="#"
                        class="inline-flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-full text-blue-600 bg-white hover:bg-blue-50 transition-colors">
                        Mulai Sekarang
                    </a>
                </div>
                <!-- Decorative elements -->
                <div
                    class="absolute top-0 left-0 w-72 h-72 bg-blue-500 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob">
                </div>
                <div
                    class="absolute top-0 right-0 w-72 h-72 bg-blue-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000">
                </div>
            </div>
        </div>
    </section>

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
