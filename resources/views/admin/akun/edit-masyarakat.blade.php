<x-layout>
    <div class=" min-h-screen p-8">
        <div class="max-w-7xl mx-auto">
            <h1 class="text-3xl font-bold text-gray-800 mb-8">Edit Akun Masyarakat</h1>
            <div class="bg-white shadow-lg rounded-lg overflow-hidden border">
                <div class="p-8">
                    <form action="/admin/akun/masyarakat/edit/{{ $yazid_masyarakat->nik }}" method="POST" enctype="multipart/form-data" novalidate>
                        @csrf
                        @method('put')
                        <div class="space-y-6 ">
                            <div class="grid grid-cols-2 gap-5">
                                <div>
                                    <label for="nik" class="block text-sm font-medium text-gray-700 mb-1">Nik</label>
                                    <input type="number"  minlength="16" name="nik" id="nik" value="{{ old('nik', $yazid_masyarakat->nik) }}" placeholder="Masukan Nik" required readonly class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300">
                                    @error('nik')
                                        <p class="text-red-400 mt-1 text-sm">{{ $message }}</p>
                                    @enderror
                                </div>
        
                                <!-- Username -->
                                <div>
                                    <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                                    <input type="text" name="nama" id="nama" value="{{ old('nama', $yazid_masyarakat->nama) }}" placeholder="Masukan nama" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300">
                                    @error('nama')
                                        <p class="text-red-400 mt-1 text-sm">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                                    <input type="text" name="username" id="username" value="{{ old('username',$yazid_masyarakat->username) }}" placeholder="Masukan Username" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300">
                                    @error('username')
                                        <p class="text-red-400 mt-1 text-sm">{{ $message }}</p>
                                    @enderror
                                </div>
        
                                <!-- Password -->
                                <div>
                                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                                    <input type="password" name="password" id="password" required placeholder="Masukan Password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300">
                                    @error('password')
                                        <p class="text-red-400 mt-1 text-sm">{{ $message }}</p>
                                    @enderror
                                </div>
        
                                <!-- Phone Number -->
                                <div>
                                    <label for="telp" class="block text-sm font-medium text-gray-700 mb-1">No. Telepon</label>
                                    <input type="number" oninput="this.value = this.value.replace(/[^0-9]/g, '');" name="telp" id="telp" value="{{ old('telp', $yazid_masyarakat->telp) }}" placeholder="Masukan No Telepon" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300">
                                    @error('telp')
                                        <p class="text-red-400 mt-1 text-sm">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
    
                            <!-- Submit Button -->
                            <div>
                                <button type="submit" class="w-full bg-blue-500 text-white py-3 px-4 rounded-lg hover:bg-blue-600 transition duration-300">
                                    Edit Akun Masyarakat
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>