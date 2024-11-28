<x-layout>
    <div class=" min-h-screen p-8">
        <div class="max-w-7xl mx-auto">
            <h1 class="text-3xl font-bold text-gray-800 mb-8">Buat Akun Baru</h1>
            <p class="text-gray-600 mb-8">Pilih jenis akun yang ingin Anda buat:</p>
    
            <div class="grid md:grid-cols-2 gap-8">
                <!-- Admin Card -->
                <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-md hover:shadow-lg transition-shadow duration-300">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-gray-500 text-sm font-medium mb-1">Akun Admin</h3>
                            <p class="text-2xl font-semibold text-gray-800">Buat Admin</p>
                            <p class="text-gray-500 text-sm mt-2">Akses penuh ke sistem manajemen</p>
                        </div>
                        <div class="bg-blue-100 rounded-full p-3">
                            <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                    </div>
                    <a href="{{ Route('admin.akun.admin') }}" class="mt-4 block w-full bg-blue-500 text-white text-center py-2 rounded-lg font-semibold hover:bg-blue-600 transition duration-300">
                        Buat Akun Admin
                    </a>
                </div>
    
                <!-- Staff Card -->
                <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-md hover:shadow-lg transition-shadow duration-300">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-gray-500 text-sm font-medium mb-1">Akun Petugas</h3>
                            <p class="text-2xl font-semibold text-gray-800">Buat Petugas</p>
                            <p class="text-gray-500 text-sm mt-2">Akses terbatas sesuai peran</p>
                        </div>
                        <div class="bg-green-100 rounded-full p-3">
                            <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <a href="{{ Route('admin.akun.petugas') }}" class="mt-4 block w-full bg-green-500 text-white text-center py-2 rounded-lg font-semibold hover:bg-green-600 transition duration-300">
                        Buat Akun Petugas
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layout>