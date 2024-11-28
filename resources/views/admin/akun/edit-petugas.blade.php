<x-layout>
    <div class=" min-h-screen p-8">
        <div class="max-w-7xl mx-auto">
            <h1 class="text-3xl font-bold text-gray-800 mb-8">Edit Akun Petugas</h1>
            <div class="bg-white shadow-lg rounded-lg overflow-hidden border">
                <div class="p-8">
                    <form action="/admin/akun/petugas/{{ $yazid_petugas->id_petugas }}" method="POST" enctype="multipart/form-data" novalidate>
                        @csrf
                        @method('put')
                        <div class="space-y-6 ">

                            <div class="grid grid-cols-2 gap-5">
                                <div>
                                    <label for="nama_petugas" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                                    <input type="text" name="nama_petugas" id="nama_petugas" value="{{ old('nama_petugas', $yazid_petugas->nama_petugas) }}" placeholder="Masukan Nama Petugas" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300">
                                    @error('nama_petugas')
                                        <p class="text-red-400 mt-1 text-sm">{{ $message }}</p>
                                    @enderror
                                </div>
        
                                <!-- Username -->
                                <div>
                                    <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                                    <input type="text" name="username" id="username" value="{{ old('username', $yazid_petugas->username) }}" placeholder="Masukan Username Petugas" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300">
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
                                    <input type="number" oninput="this.value = this.value.replace(/[^0-9]/g, '');" name="telp" id="telp" value="{{ old('telp', $yazid_petugas->telp) }}" placeholder="Masukan No Telepon" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300">
                                    @error('telp')
                                        <p class="text-red-400 mt-1 text-sm">{{ $message }}</p>
                                    @enderror
                                </div>
        
                                <!-- Level -->
                                <div>
                                    <label for="level" class="block text-sm font-medium text-gray-700 mb-1">Level</label>
                                    <select name="level" id="level" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300">
                                        {{-- <option value="">Pilih Level</option> --}}
                                        <option value="admin" selected >Admin</option>
                                        {{-- <option value="petugas">Petugas</option> --}}
                                    </select>
                                    @error('level')
                                        <p class="text-red-400 mt-1 text-sm">{{ $message }}</p>
                                    @enderror
                                </div>

                            </div>
    
                            <!-- Submit Button -->
                            <div>
                                <button type="submit" class="w-full bg-blue-500 text-white py-3 px-4 rounded-lg hover:bg-blue-600 transition duration-300">
                                    Edit Akun admin
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>