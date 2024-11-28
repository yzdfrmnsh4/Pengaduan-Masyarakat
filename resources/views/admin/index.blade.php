<x-layout>
    <!-- Stats -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-6">
        <div class="bg-white p-6 rounded-xl border border-gray-200">
            <div class="flex justify-between items-start">
                <div>
                    <h3 class="text-gray-500 text-sm">Total Pengaduan</h3>
                    <p class="text-2xl font-semibold mt-1">{{ $yazid_total_pengaduan }}</p>
                </div>
                <span class="text-green-500 text-sm">+12%</span>
            </div>
        </div>
        <div class="bg-white p-6 rounded-xl border border-gray-200">
            <div class="flex justify-between items-start">
                <div>
                    <h3 class="text-gray-500 text-sm">Pengaduan Baru</h3>
                    <p class="text-2xl font-semibold mt-1">{{ $yazid_pengaduan_baru }}</p>
                </div>
                <span class="text-green-500 text-sm">+8%</span>
            </div>
        </div>
        <div class="bg-white p-6 rounded-xl border border-gray-200">
            <div class="flex justify-between items-start">
                <div>
                    <h3 class="text-gray-500 text-sm">Pengaduan Proses</h3>
                    <p class="text-2xl font-semibold mt-1">{{ $yazid_pengaduan_proses }}</p>
                </div>
                <span class="text-green-500 text-sm">+22%</span>
            </div>
        </div>
        <div class="bg-white p-6 rounded-xl border border-gray-200">
            <div class="flex justify-between items-start">
                <div>
                    <h3 class="text-gray-500 text-sm">Pengaduan Selesai</h3>
                    <p class="text-2xl font-semibold mt-1">{{ $yazid_pengaduan_selesai }}</p>
                </div>
                <span class="text-green-500 text-sm">+5%</span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Pengaduan Aktif -->
        <div class="bg-white rounded-xl border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h2 class="text-lg font-semibold">Pengaduan Terbaru</h2>
                    <button class="text-blue-600 hover:text-blue-700 text-sm font-medium">Lihat Semua</button>
                </div>
            </div>
            <div class="p-6">
                @foreach ($yazid_pengaduan as $yazid_item)
                    <div class="flex items-center justify-between py-3">
                        <div class="flex items-center gap-4">
                            <div
                                class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-600">
                                #{{ $loop->iteration }}
                            </div>
                            <div>
                                <h3 class="font-medium">{{ Str::limit($yazid_item->isi_laporan, 30, '...') }}</h3>
                                <p class="text-sm text-gray-500">{{ $yazid_item->created_at->diffForhumans() }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs rounded-full">
                                @if ($yazid_item->status == 0)
                                    Menunggu
                                @elseif ($yazid_item->status == 'proses')
                                    proses
                                @else
                                    selesai
                                @endif
                            </span>
                            <button class="text-gray-400 hover:text-gray-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Analitik Respon -->
        <div class="bg-white rounded-xl border overflow-hidden">
            <div class="p-6 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h2 class="text-lg font-semibold text-gray-800">Analitik Respon</h2>
                    <select id="timeRange"
                        class="text-sm border-gray-300 rounded-lg shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option>7 hari terakhir</option>
                        <option>30 hari terakhir</option>
                        <option>90 hari terakhir</option>
                    </select>
                </div>
            </div>
            <div class="p-6">
                <canvas id="reportChart" class="w-full h-64"></canvas>
            </div>
        </div>
    </div>

    <!-- Petugas Terbaik -->
    <div class="mt-6">
        <div class="bg-white rounded-xl border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h2 class="text-lg font-semibold">Petugas Terbaik</h2>
                    <select class="text-sm border-gray-200 rounded-lg">
                        <option>Bulan Ini</option>
                        <option>Bulan Lalu</option>
                        <option>Tahun Ini</option>
                    </select>
                </div>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-6">
                    @foreach (range(1, 4) as $index)
                        <div class="text-center">
                            <img src="{{ asset('img/placeholder.jpg') }}" alt="Petugas {{ $index }}"
                                class="w-20 h-20 rounded-full mx-auto mb-3">
                            <h3 class="font-medium">Budi Santoso</h3>
                            <p class="text-sm text-gray-500">{{ rand(20, 50) }} kasus diselesaikan</p>
                            <div class="mt-2 flex justify-center gap-1">
                                @foreach (range(1, 5) as $star)
                                    <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('reportChart').getContext('2d');
            const chartData = @json($yazid_chartData);
            const labels = @json($yazid_labels);

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Jumlah Laporan',
                        data: chartData,
                        backgroundColor: 'rgba(59, 130, 246, 0.5)', // Tailwind blue-500 with opacity
                        borderColor: 'rgb(59, 130, 246)', // Tailwind blue-500
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(17, 24, 39, 0.8)', // Tailwind gray-900 with opacity
                            titleColor: 'white',
                            bodyColor: 'white',
                            cornerRadius: 6,
                            padding: 10
                        }
                    }
                }
            });
        });
    </script>
</x-layout>
