<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - LaporMas</title>
    @vite('resources/css/app.css')
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen flex">
        @if (session('unverifvied'))
        <x-toastdanger>
            {{ session('unverifvied') }}
        </x-toastdanger>
        <script>
            // Function to close the toast
            function closeToast() {
                const toast = document.getElementById('toast-danger');
                toast.classList.add('hidden');
            }
            // Auto close the toast after 5 seconds
            setTimeout(closeToast, 5000);
        </script>
    @endif

    @if (session('error'))
        <x-toastdanger>
            {{ session('error') }}
        </x-toastdanger>
        <script>
            // Function to close the toast
            function closeToast() {
                const toast = document.getElementById('toast-danger');
                toast.classList.add('hidden');
            }
            // Auto close the toast after 5 seconds
            setTimeout(closeToast, 5000);
        </script>
    @endif

    
        <!-- Left Side - Blue Section -->
        <div class="hidden lg:flex lg:w-[40%] bg-blue-600 p-12 flex-col justify-between">
            <div>
                <div class="flex items-center gap-2 text-white">
                    <div class="w-8 h-8 bg-gradient-to-br from-blue-600 via-blue-700 to-blue-900 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <span class="text-xl font-bold">LaporMas</span>
                </div>

                <div class="mt-16">
                    <h1 class="text-4xl font-bold text-white mb-4">Selamat Datang Kembali</h1>
                    <p class="text-blue-100 text-lg">
                        Masuk ke akun Anda untuk melanjutkan pengaduan atau melihat status laporan Anda.
                    </p>
                </div>
            </div>

            <!-- Testimonial Card -->
            <div class="bg-blue-500/20 p-6 rounded-xl backdrop-blur-sm">
                <p class="text-blue-100 mb-4">
                    "LaporMas sangat membantu dalam menyelesaikan masalah di lingkungan kami. Terima kasih!"
                </p>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-blue-500/30 flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-white font-medium">Siti Nurhaliza</p>
                        <p class="text-blue-200 text-sm">Warga Kota Surabaya</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Form Section -->
        <div class="flex-1 flex items-center justify-center p-6 bg-gray-50">
            <div class="absolute top-5 right-4">
                <a href="/">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-left-from-line text-blue-600"><path d="m9 6-6 6 6 6"/><path d="M3 12h14"/><path d="M21 19V5"/></svg>
                </a>
            </div>
            <div class="w-full max-w-md">
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900">Masuk ke Akun Anda</h2>
                    <p class="text-gray-600 mt-2">Silakan masukkan username dan password Anda</p>
                </div>

                <form action="{{ route('login.post') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                        <input type="text" name="username" id="username" required placeholder="Masukan Username"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            @error('username')
                                <p class="text-red-500">{{ $message }}</p>
                            @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <div class="mt-1 relative">
                            <input type="password" name="password" id="password" required placeholder="Masukan Password"
                                class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <button type="button" onclick="togglePassword()" 
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-500">
                                <svg class="h-5 w-5" fill="none" id="eye-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input type="checkbox" name="remember" id="remember" 
                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="remember" class="ml-2 block text-sm text-gray-900">
                                Ingat saya
                            </label>
                        </div>

                        <div class="text-sm">
                            <a href="" class="font-medium text-blue-600 hover:text-blue-500">
                                Lupa password?
                            </a>
                        </div>
                    </div>

                    <button type="submit" 
                        class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Masuk
                    </button>
                </form>

                <p class="mt-6 text-center text-sm text-gray-600">
                    Belum punya akun? 
                    <a href="{{ route('register') }}" class="font-medium text-blue-600 hover:text-blue-500">
                        Daftar sekarang
                    </a>
                </p>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            var passwordInput = document.getElementById('password');
            var eyeIcon = document.getElementById('eye-icon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                `;
            } else {
                passwordInput.type = 'password';
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                `;
            }
        }
    </script>
</body>
</html>