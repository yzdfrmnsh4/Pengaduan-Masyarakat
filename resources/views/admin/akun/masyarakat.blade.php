<x-layout>
    <div class=" min-h-screen p-8">
        <div class="max-w-7xl mx-auto">
            <div class="flex justify-between items-center w-full py-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800 ">Data Akun Masyarakat</h1>
                </div>

                <div>
                    <a href="{{ Route('admin.masyarakat.create') }}"
                        class="rounded-md border border-slate-300 py-2 px-4 text-center text-sm transition-all shadow-sm hover:shadow-lg text-slate-600 hover:text-white hover:bg-blue-600 hover:border-blue-500 focus:text-white focus:bg-blue-400 focus:border-blue-400 active:border-blue-400 active:text-white active:bg-blue-400 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                        type="button">
                        Tambah Akun
                    </a>
                </div>
            </div>
            <div class="mb-6">
                <form action="{{ Route('admin.akun.masyarakat') }}" method="GET" class="flex gap-4">
                    <input type="text" name="search" placeholder="Cari Nama atau username..." value="{{ request('search') }}" class="flex-grow px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-300">
                        Cari
                    </button>
                </form>
            </div>


            <!-- Account Table -->
            <div class="bg-white rounded-md shadow-md overflow-hidden border">
                <h3 class="text-lg font-semibold text-gray-800 p-6 border-b">Daftar Akun Terbaru</h3>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    No</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nik</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Username</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    No Telp</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">

                            @forelse ($yazid_masyarakat as $yazid_akun)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $yazid_akun->nik }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $yazid_akun->nama }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $yazid_akun->username }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $yazid_akun->telp }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap flex gap-2">
                                        <a href="/admin/akun/masyarakat/edit/{{ $yazid_akun->nik }}"
                                            class="text-red-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-user-round-pen text-green-500">
                                                <path d="M2 21a8 8 0 0 1 10.821-7.487" />
                                                <path
                                                    d="M21.378 16.626a1 1 0 0 0-3.004-3.004l-4.01 4.012a2 2 0 0 0-.506.854l-.837 2.87a.5.5 0 0 0 .62.62l2.87-.837a2 2 0 0 0 .854-.506z" />
                                                <circle cx="10" cy="8" r="5" />
                                            </svg>
                                        </a>
                                        <form action="/admin/akun/masyarakat/{{ $yazid_akun->nik }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="text-green-400">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-user-round-x text-red-600">
                                                    <path d="M2 21a8 8 0 0 1 11.873-7" />
                                                    <circle cx="10" cy="8" r="5" />
                                                    <path d="m17 17 5 5" />
                                                    <path d="m22 17-5 5" />
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">Tidak ada data Masyarakat yang ditemukan.</td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mt-6">
                {{ $yazid_masyarakat->links() }}
            </div>
        </div>
    </div>
</x-layout>
