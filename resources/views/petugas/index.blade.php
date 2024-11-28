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
                    <h2 class="text-lg font-semibold text-gray-800">Grafik Pengaduan</h2>
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
