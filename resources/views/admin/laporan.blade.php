<x-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-4xl font-bold mb-8 text-gray-800">Laporan Pengaduan</h1>

        <!-- Filter Section -->
        <div class="bg-white  border rounded-lg p-6 mb-8 transition duration-300 ease-in-out transform hover:shadow-xl">
            <h2 class="text-2xl font-semibold mb-6 text-gray-700">Filter Laporan</h2>
            <form id="filterForm" class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="space-y-2">
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select id="status" name="status"
                        class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                        <option value="">Semua Status</option>
                        <option value="0">Baru</option>
                        <option value="proses">Proses</option>
                        <option value="selesai">Selesai</option>
                    </select>
                </div>
                <div class="space-y-2">
                    <label for="start_date" class="block text-sm font-medium text-gray-700">Tanggal Awal</label>
                    <input type="date" id="start_date" name="start_date"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
                <div class="space-y-2">
                    <label for="end_date" class="block text-sm font-medium text-gray-700">Tanggal Akhir</label>
                    <input type="date" id="end_date" name="end_date"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
            </form>
            <div class="mt-6">
                <button onclick="applyFilter()"
                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z">
                        </path>
                    </svg>
                    Terapkan Filter
                </button>
            </div>
        </div>

        <!-- Table Section -->
        <div
            class="bg-white shadow-lg border rounded-lg overflow-hidden transition duration-300 ease-in-out transform hover:shadow-xl">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                ID</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tanggal</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Pelapor</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Isi Laporan</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="reportTableBody">
                        @foreach ($yazid_laporan as $yazid)
                            <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $yazid->id_pengaduan }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{  \Carbon\Carbon::parse($yazid->tgl_pengaduan)->format('d M Y') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <span
                                                class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-500 font-semibold text-lg">
                                                {{ strtoupper(substr($yazid->masyarakat->nama, 0, 1)) }}
                                            </span>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $yazid->masyarakat->nama }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900 max-w-xs overflow-hidden overflow-ellipsis">
                                        {{ Str::limit($yazid->isi_laporan, 50) }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    @if ($yazid->status == '0') bg-yellow-100 text-yellow-800
                                    @elseif($yazid->status == 'proses') bg-blue-100 text-blue-800
                                    @else bg-green-100 text-green-800 @endif">
                                        {{ $yazid->status == '0' ? 'Baru' : ucfirst($yazid->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button onclick="printReport({{ $yazid->id_pengaduan }})"
                                        class="text-indigo-600 hover:text-indigo-900 transition duration-150 ease-in-out">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z">
                                            </path>
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Print All Button -->
        <div class="mt-8 flex justify-end">
            <button onclick="printAllReports()"
                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-150 ease-in-out">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z">
                    </path>
                </svg>
                Cetak Semua Laporan
            </button>
        </div>
    </div>

    {{-- @push('scripts') --}}
    <script>
        function applyFilter() {
            const status = document.getElementById('status').value;
            const startDate = document.getElementById('start_date').value;
            const endDate = document.getElementById('end_date').value;

            // Kirim request AJAX untuk filter
            fetch(`/admin/laporan/filter?status=${status}&start_date=${startDate}&end_date=${endDate}`)
                .then(response => response.json())
                .then(data => {
                    updateTable(data);
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat memfilter data');
                });
        }

        function updateTable(yazid_laporan) {
            const tableBody = document.getElementById('reportTableBody');
            tableBody.innerHTML = ''; // Kosongkan isi tabel

            if (yazid_laporan.length === 0) {
                // Tampilkan pesan jika tidak ada data
                tableBody.innerHTML = `
                    <tr>
                        <td colspan="6" class="text-center py-4 text-gray-500">
                            Tidak ada data laporan yang ditemukan
                        </td>
                    </tr>
                `;
                return;
            }

            // Buat ulang baris tabel dengan data yang difilter
            yazid_laporan.forEach(complaint => {
                // Gunakan template string untuk membuat baris tabel
                const row = `
                    <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${complaint.id_pengaduan}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${complaint.tgl_pengaduan}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <span class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-500 font-semibold text-lg">
                                        ${complaint.masyarakat.nama.charAt(0).toUpperCase()}
                                    </span>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">${complaint.masyarakat.nama}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900 max-w-xs overflow-hidden overflow-ellipsis">
                                ${complaint.isi_laporan.substring(0, 50)}...
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                ${complaint.status === '0' ? 'bg-yellow-100 text-yellow-800' : 
                                complaint.status === 'proses' ? 'bg-blue-100 text-blue-800' : 
                                'bg-green-100 text-green-800'}">
                                ${complaint.status === '0' ? 'Baru' : 
                                complaint.status.charAt(0).toUpperCase() + complaint.status.slice(1)}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <button onclick="printReport(${complaint.id_pengaduan})" class="text-indigo-600 hover:text-indigo-900 transition duration-150 ease-in-out">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                                </svg>
                            </button>
                        </td>
                    </tr>
                `;
                tableBody.innerHTML += row;
            });
        }

        function printReport(id) {
            // Buka halaman cetak untuk satu laporan di tab baru
            window.open(`/admin/laporan/print/${id}`, '_blank');
        }

        function printAllReports() {
            // Ambil nilai filter
            const status = document.getElementById('status').value;
            const startDate = document.getElementById('start_date').value;
            const endDate = document.getElementById('end_date').value;

            // Buka halaman cetak PDF dengan parameter filter
            window.open(`/admin/laporan/print-all?status=${status}&start_date=${startDate}&end_date=${endDate}`, '_blank');
        }
    </script>
</x-layout>
