<x-layout>
    <div class="bg-gray-100 min-h-screen">
        <div class="container mx-auto px-4 py-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-8">Profil Pengguna</h1>
    
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- User Info Card -->
                <div class="md:col-span-1">
                    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                        <div class="p-6">
                            <div class="flex justify-center mb-6">
                                <div class="relative">
                                    <img class="h-32 w-32 rounded-full object-cover border-4 border-white shadow-lg" src="{{ Auth::user()->profile_photo_url ?? asset('img/placeholder.jpg') }}" alt="Foto Profil">
                                    <button class="absolute bottom-0 right-0 bg-blue-500 rounded-full p-2 text-white hover:bg-blue-600 transition duration-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <h2 class="text-2xl font-semibold text-center text-gray-800 mb-2">{{ Session::get('nama') }}</h2>
                            <p class="text-gray-600 text-center mb-4">{{ Session::get('name') }}</p>
                            <div class="border-t border-gray-200 pt-4">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-gray-600">Peran</span>
                                    <span class="font-semibold text-gray-800">Pengguna</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Bergabung</span>
                                    <span class="font-semibold text-gray-800"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    
                <!-- Edit Profile and Change Password -->
                <div class="md:col-span-2">
                    <div class="bg-white shadow-lg rounded-lg overflow-hidden mb-8">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-800 mb-4">Informasi Pribadi</h3>
                            <form action="#" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                    <div>
                                        <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Depan</label>
                                        <input type="text" name="first_name" id="first_name" autocomplete="given-name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300">
                                    </div>
                                    <div>
                                        <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Belakang</label>
                                        <input type="text" name="last_name" id="last_name" autocomplete="family-name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300">
                                    </div>
                                    <div class="sm:col-span-2">
                                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Alamat Email</label>
                                        <input type="email" name="email" id="email" autocomplete="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300">
                                    </div>
                                </div>
                                <div class="mt-6">
                                    <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-300">
                                        Simpan Perubahan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
    
                    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-800 mb-4">Ganti Kata Sandi</h3>
                            <form action="#" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="space-y-4">
                                    <div>
                                        <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">Kata Sandi Saat Ini</label>
                                        <input type="password" name="current_password" id="current_password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300">
                                    </div>
                                    <div>
                                        <label for="new_password" class="block text-sm font-medium text-gray-700 mb-1">Kata Sandi Baru</label>
                                        <input type="password" name="new_password" id="new_password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300">
                                    </div>
                                    <div>
                                        <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Kata Sandi Baru</label>
                                        <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300">
                                    </div>
                                </div>
                                <div class="mt-6">
                                    <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-300">
                                        Ubah Kata Sandi
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    
            <!-- Account Activity -->
            <div class="mt-8">
                <h3 class="text-2xl font-semibold text-gray-800 mb-4">Aktivitas Akun</h3>
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <ul role="list" class="divide-y divide-gray-200">
                        <li>
                            <div class="px-6 py-4 flex items-center">
                                <div class="flex-shrink-0">
                                    <svg class="h-8 w-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="ml-4 flex-1">
                                    <p class="text-sm font-medium text-gray-900">Login Terakhir</p>
                                    <p class="text-sm text-gray-500">{{ now()->subDays(rand(0, 7))->format('d F Y') }} pada {{ now()->subDays(rand(0, 7))->format('H:i') }}</p>
                                </div>
                                <div class="ml-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Sukses
                                    </span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="px-6 py-4 flex items-center">
                                <div class="flex-shrink-0">
                                    <svg class="h-8 w-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <div class="ml-4 flex-1">
                                    <p class="text-sm font-medium text-gray-900">Perubahan Profil Terakhir</p>
                                    <p class="text-sm text-gray-500">{{ now()->subDays(rand(8, 30))->format('d F Y') }} pada {{ now()->subDays(rand(8, 30))->format('H:i') }}</p>
                                </div>
                                <div class="ml-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        Diperbarui
                                    </span>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-layout>