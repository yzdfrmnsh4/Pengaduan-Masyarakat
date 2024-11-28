<x-layout>
    <div class="p-6 sm:p-8">
        <h1 class="text-2xl font-semibold text-gray-800 mb-6">Daftar Pengaduan Masyarakat</h1>
        <form action="{{ route('petugas.pengaduan') }}" method="GET">
            <div class="mb-6 flex flex-wrap items-center gap-4">
                <select name="urutan" id="sortOrder"
                    class="bg-white border border-gray-300 text-gray-700 rounded-lg focus:ring-blue-500 focus:border-blue-500 px-4 py-2">
                    <option value="terbaru" {{ request('urutan') == 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                    <option value="terlama" {{ request('urutan') == 'terlama' ? 'selected' : '' }}>Terlama</option>
                </select>

                <input type="date" name="tanggal" id="dateFilter" value="{{ request('tanggal') }}"
                    class="bg-white border border-gray-300 text-gray-700 rounded-lg focus:ring-blue-500 focus:border-blue-500 px-4 py-2">

                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                    Terapkan Filter
                </button>
            </div>
        </form>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @if ($yazid_pengaduan->count() > 0)
                @foreach ($yazid_pengaduan as $yazid_item)
                    <div
                        class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-lg hover:shadow-xl transition duration-300 transform hover:-translate-y-1">
                        <div class="relative h-56 overflow-hidden">
                            @if ($yazid_item->foto)
                                <img src="{{ asset('storage/' . $yazid_item->foto) }}" alt="Foto Pengaduan"
                                    class="w-full h-full object-cover transition duration-300 transform hover:scale-105">
                            @else
                                <div
                                    class="w-full h-full bg-gradient-to-br from-blue-100 to-blue-200 flex items-center justify-center">
                                    <svg class="w-20 h-20 text-blue-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                            @endif
                            <div
                                class="absolute top-0 left-0 right-0 p-4 bg-gradient-to-b from-black/50 to-transparent">
                                <div class="flex items-center justify-between">
                                    <span
                                        class="px-3 py-1 text-xs font-semibold rounded-full shadow-md
                                @if ($yazid_item->status == '0') bg-yellow-500 text-white
                                @elseif($yazid_item->status == 'proses')
                                    bg-blue-500 text-white
                                @else
                                    bg-green-500 text-white @endif">
                                        @if ($yazid_item->status == '0')
                                            Baru
                                        @elseif($yazid_item->status == 'proses')
                                            Proses
                                        @else
                                            Selesai
                                        @endif
                                    </span>
                                    <span class="text-white text-sm font-medium">
                                        #{{ $loop->iteration }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold text-lg shadow-md">
                                        {{ strtoupper(substr($yazid_item->masyarakat->nama, 0, 1)) }}
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-800 text-lg">{{ $yazid_item->masyarakat->nama }}
                                        </h3>
                                        <p class="text-sm text-gray-500">
                                            {{ \Carbon\Carbon::parse($yazid_item->tgl_pengaduan)->format('d M Y') }}</p>
                                    </div>
                                </div>
                            </div>
                            <p class="text-gray-700 mb-4 line-clamp-3">{{ $yazid_item->isi_laporan }}</p>

                            <div class="mt-6 space-y-4">
                                <div class="flex items-center justify-between">
                                    <button onclick="openDetailModal('{{ $yazid_item->id_pengaduan }}')"
                                        class="text-blue-600 hover:text-blue-700 text-xs font-medium flex items-center transition duration-300 hover:translate-x-1">
                                        <span>Lihat Detail</span>
                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </button>
                                    @if ($yazid_item->status == 'proses')
                                        <span class="text-blue-500 text-sm font-medium">Sedang Diproses</span>
                                    @elseif($yazid_item->status == 'selesai')
                                        <span class="text-green-500 text-sm font-medium">Selesai</span>
                                    @endif
                                </div>

                                @if ($yazid_item->status == '0')
                                    <div class="flex justify-between items-center space-x-2">
                                        <form action="/petugas/pengaduan/{{ $yazid_item->id_pengaduan }}/terima" method="POST"
                                            class="w-1/2">
                                            @csrf
                                            <button type="submit"
                                                class="w-full px-4 py-2 bg-green-500 text-white text-sm font-medium rounded-lg hover:bg-green-600 transition duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                                                Terima
                                            </button>
                                        </form>
                                        <button onclick="showAlert('tolak', {{ $yazid_item->id_pengaduan }})"
                                            class="w-1/2 px-4 py-2 bg-red-500 text-white text-sm font-medium rounded-lg hover:bg-red-600 transition duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                                            Tolak
                                        </button>
                                    </div>
                                @endif

                                @if ($yazid_item->status != 'selesai')
                                    <button onclick="showResponseForm({{ $yazid_item->id_pengaduan }})"
                                        class="w-full px-4 py-2 bg-blue-500 text-white text-sm font-medium rounded-lg hover:bg-blue-600 transition duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                                        Tanggapi
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
        </div>
    </div>
@else
    <div class="w-[320%] py-52  flex justify-center items-center   z-0">
        <div class="300">
            <h1 class="text-2xl text-gray-300 text-center font-semibold">Tidak Ada Pengaduan</h1>
        </div>
    </div>
    @endif



    <div class="my-5">
        {{ $yazid_pengaduan->links() }}
    </div>

    <x-alert-modal></x-alert-modal>
    <x-tanggapan-admin></x-tanggapan-admin>
    <x-detail-pengaduan-admin></x-detail-pengaduan-admin>



    <script>
        function openDetailModal(id_pengaduan) {
            const modal = document.getElementById('detailModal');
            const modalContent = modal.querySelector('.max-w-2xl');
            const detailContent = document.getElementById('detailContent');

            // Reset content and show loading spinner
            detailContent.innerHTML = `
            <div class="flex items-center justify-center h-32">
                <svg class="animate-spin h-8 w-8 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </div>
        `;

            // Open modal with fade-in effect
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            setTimeout(() => {
                modal.classList.add('opacity-100');
                modalContent.classList.remove('scale-95', 'opacity-0');
                modalContent.classList.add('scale-100', 'opacity-100');
            }, 50);

            // Fetch data pengaduan
            fetch(`/petugas/pengaduan/${id_pengaduan}`)
                .then(response => response.json())
                .then(data => {
                    if (data.message) {
                        detailContent.innerHTML = `<p class="text-red-500 text-center">${data.message}</p>`;
                    } else {
                        detailContent.innerHTML = `
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Nama Pelapor</p>
                                <p class="font-semibold text-gray-800">${data.masyarakat.nama}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 mb-1">NIK</p>
                                <p class="font-semibold text-gray-800">${data.masyarakat.nik}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Tanggal Pengaduan</p>
                                <p class="font-semibold text-gray-800">${formatDate(data.created_at)}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Status</p>
                                <span class="px-2 py-1 text-xs font-semibold rounded-full ${getStatusColor(data.status)}">
                                    ${getStatusText(data.status)}
                                </span>
                            </div>
                        </div>
                        <div class="mt-6">
                            <p class="text-sm text-gray-600 mb-2">Isi Laporan</p>
                            <p class="text-gray-800 bg-gray-50 p-4 rounded-lg">${data.isi_laporan}</p>
                        </div>
                        ${data.foto ? `
                                <div class="mt-6">
                                    <p class="text-sm text-gray-600 mb-2">Foto Pengaduan</p>
                                    <img src="/storage/${data.foto}" alt="Foto Pengaduan" class="w-full h-auto rounded-lg shadow-md">
                                </div>
                            ` : ''}
                    `;
                    }
                })
                .catch(error => {
                    detailContent.innerHTML = '<p class="text-red-500 text-center">Gagal memuat detail pengaduan.</p>';
                    console.error("Error fetching complaint details:", error);
                });
        }

        function closeDetailModal() {
            const modal = document.getElementById('detailModal');
            const modalContent = modal.querySelector('.max-w-2xl');

            modalContent.classList.remove('scale-100', 'opacity-100');
            modalContent.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                modal.classList.remove('opacity-100');
                modal.classList.add('hidden');
            }, 300);
        }

        function getStatusColor(status) {
            switch (status) {
                case '0':
                    return 'bg-yellow-100 text-yellow-800';
                case 'proses':
                    return 'bg-blue-100 text-blue-800';
                case 'selesai':
                    return 'bg-green-100 text-green-800';
                default:
                    return 'bg-gray-100 text-gray-800';
            }
        }

        function getStatusText(status) {
            switch (status) {
                case '0':
                    return 'Baru';
                case 'proses':
                    return 'Diproses';
                case 'selesai':
                    return 'Selesai';
                default:
                    return 'Tidak Diketahui';
            }
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('detailModal');
            if (event.target === modal) {
                closeDetailModal();
            }
        }

        // Close modal with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === "Escape") {
                closeDetailModal();
            }
        });

        function formatDate(isoDate) {
            const date = new Date(isoDate);
            const options = { year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit', timeZoneName: 'short' };
            return date.toLocaleDateString('id-ID', options);
        }

    </script>

    <script>
        function showResponseForm(id_pengaduan) {
            const modal = document.getElementById('responseModal');
            const modalContent = modal.querySelector('.max-w-2xl');
            const tanggapanList = document.getElementById('tanggapanList');

            document.getElementById('id_pengaduan').value = id_pengaduan;
            tanggapanList.innerHTML =
                '<div class="flex justify-center"><svg class="animate-spin h-8 w-8 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg></div>';

            modal.classList.remove('hidden');
            modal.classList.add('flex');
            setTimeout(() => {
                modal.classList.add('opacity-100');
                modalContent.classList.remove('scale-95', 'opacity-0');
                modalContent.classList.add('scale-100', 'opacity-100');
            }, 50);

            fetch(`/petugas/tanggapan/${id_pengaduan}`)
                .then(response => response.json())
                .then(data => {
                    tanggapanList.innerHTML = '';
                    if (data.length > 0) {
                        data.forEach(item => {
                            const isMasyarakat = item.pengirim === 'masyarakat';
                            tanggapanList.innerHTML += `
                            <div class="flex ${isMasyarakat ? 'justify-start' : 'justify-end'}">
                                <div class="max-w-3/4 ${isMasyarakat ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800'} rounded-lg p-3 shadow">
                                    <div class="flex items-center mb-1">
                                        <span class="text-sm font-medium ${isMasyarakat ? 'text-blue-600' : 'text-gray-600'}">${item.nama}</span>
                                        <span class="ml-2 text-xs text-gray-500">${formatDateTime(item.tgl_tanggapan)}</span>
                                    </div>
                                    <p class="text-sm">${item.tanggapan}</p>
                                </div>
                            </div>
                        `;
                        });
                        setTimeout(() => {
                            tanggapanList.scrollTop = tanggapanList.scrollHeight;
                        }, 100);
                    } else {
                        tanggapanList.innerHTML = '<p class="text-center text-gray-500">Belum ada tanggapan.</p>';
                    }
                })
                .catch(error => {
                    tanggapanList.innerHTML = '<p class="text-center text-red-500">Gagal memuat tanggapan.</p>';
                    console.error(error);
                });
        }

        function closeResponseModal() {
            const modal = document.getElementById('responseModal');
            const modalContent = modal.querySelector('.max-w-2xl');

            modalContent.classList.remove('scale-100', 'opacity-100');
            modalContent.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                modal.classList.remove('opacity-100');
                modal.classList.add('hidden');
            }, 300);
        }

        function submitResponse(event) {
            event.preventDefault();

            const form = document.getElementById('responseForm');
            const formData = new FormData(form);
            const id_pengaduan = formData.get('id_pengaduan');
            const tanggapanInput = document.getElementById('tanggapan');

            fetch(`/petugas/tanggapan`, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        tanggapanInput.value = '';
                        showResponseForm(id_pengaduan);
                    } else {
                        alert('Gagal mengirim tanggapan');
                    }
                })
                .catch(error => console.error(error));
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('responseModal');
            if (event.target === modal) {
                closeResponseModal();
            }
        }

        // Close modal with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === "Escape") {
                closeResponseModal();
            }
        });

        function formatDateTime(isoDate) {
            const date = new Date(isoDate);
            const options = {
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                hourCycle: 'h23', // Gunakan 24-jam format
                timeZone: 'Asia/Jakarta', // Atur timezone
            };
            return date.toLocaleString('id-ID', options);
        }

    </script>


    {{-- 
    <div id="responseModal" class="hidden">
        <div class="absolute inset-0 bg-gray-600 h-full bg-opacity-50 z-40"></div>
        <div class="fixed inset-0 z-50 overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen p-4 text-center sm:p-0">
                <div class="relative bg-white rounded-lg p-8 max-w-2xl w-full m-auto">
                    <h2 class="text-2xl font-semibold mb-4">Berikan Tanggapan</h2>

                </div>
            </div>
        </div>
    </div> --}}

    {{-- <script>
function showResponseForm(id_pengaduan) {
    // Set nilai input hidden untuk ID pengaduan
    document.getElementById('id_pengaduan').value = idPengaduan;

    // Bersihkan konten modal sebelumnya
    const responseContainer = document.getElementById('responseContainer');
    responseContainer.innerHTML = '<p class="text-gray-500 text-sm">Memuat tanggapan...</p>';

    // Fetch data tanggapan dari server
    fetch(`/pengaduan/${idPengaduan}/tanggapan`)
        .then(response => response.json())
        .then(data => {
            // Hapus placeholder
            responseContainer.innerHTML = '';

            if (data.length > 0) {
                // Tampilkan setiap tanggapan
                data.forEach(tanggapan => {
                    const tanggapanHTML = `
                        <div class="mb-4">
                            <p class="text-sm text-gray-600 mb-1"><strong>${tanggapan.petugas.nama_petugas}</strong></p>
                            <p class="text-sm text-gray-600 mb-1">${tanggapan.tanggapan}</p>
                            <p class="text-xs text-gray-400">${new Date(tanggapan.created_at).toLocaleString()}</p>
                        </div>
                    `;
                    responseContainer.insertAdjacentHTML('beforeend', tanggapanHTML);
                });
            } else {
                // Jika tidak ada tanggapan
                responseContainer.innerHTML = '<p class="text-gray-500 text-sm">Belum ada tanggapan untuk pengaduan ini.</p>';
            }
        })
        .catch(error => {
            console.error('Error fetching tanggapan:', error);
            responseContainer.innerHTML = '<p class="text-red-500 text-sm">Gagal memuat tanggapan. Silakan coba lagi.</p>';
        });

    // Tampilkan modal
    openModal('responseModal');
}

    </script> --}}
    {{-- <script>
        let scrollPosition;

        function showDetails(id) {
            fetch(`/pengaduan/${id}`)
                .then(response => response.json())
                .then(data => {
                    let imageHtml = data.foto 
                        ? `<img src="${data.foto}" alt="Foto Pengaduan" class="w-full h-64 object-cover mb-4 rounded-lg">`
                        : '<div class="w-full h-64 bg-gray-200 flex items-center justify-center mb-4 rounded-lg"><svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg></div>';
                    
                    document.getElementById('modalContent').innerHTML = `
                        ${imageHtml}
                        <p class="mb-2"><strong>Nama Pengirim:</strong> ${data.nama_pengirim}</p>
                        <p class="mb-2"><strong>NIK:</strong> ${data.nik}</p>
                        <p class="mb-2"><strong>Tanggal Pengaduan:</strong> ${new Date(data.tgl_pengaduan).toLocaleDateString()}</p>
                        <p class="mb-2"><strong>Isi Laporan:</strong> ${data.isi_laporan}</p>
                        <p class="mb-2"><strong>Status:</strong> ${data.status}</p>
                    `;
                    openModal('detailModal');
                });
        }

        function showResponseForm(id) {
            document.getElementById('id_pengaduan').value = id;
            openModal('responseModal');
        }

        function openModal(modalId) {
            scrollPosition = window.pageYOffset;
            document.body.style.position = 'fixed';
            document.body.style.top = `-${scrollPosition}px`;
            document.body.style.width = '100%';
            document.getElementById(modalId).classList.remove('hidden');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
            document.body.style.position = '';
            document.body.style.top = '';
            document.body.style.width = '';
            window.scrollTo(0, scrollPosition);
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            if (event.target.classList.contains('fixed') && event.target.classList.contains('inset-0')) {
                closeModal(event.target.parentElement.id);
            }
        }

        // Close modal with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === "Escape") {
                closeModal('detailModal');
                closeModal('responseModal');
            }
        });

        function closeChatModal() {
    const modal = document.getElementById('responseModal');
    modal.classList.add('hidden');
}
</script> --}}

    {{-- @push('scripts') --}}
    <script>
        let currentAction = '';
        let currentId = '';

        function showDetails(id) {
            // Existing showDetails function
        }

        function showAlert(action, id) {
            currentAction = action;
            currentId = id;
            const alertModal = document.getElementById('alertModal');
            const alertTitle = document.getElementById('alertTitle');
            const alertMessage = document.getElementById('alertMessage');
            const confirmButton = document.getElementById('confirmButton');

            if (action === 'terima') {
                alertTitle.textContent = 'Konfirmasi Penerimaan';
                alertMessage.textContent = 'Apakah Anda yakin ingin menerima pengaduan ini?';
                confirmButton.classList.remove('bg-red-500', 'hover:bg-red-600');
                confirmButton.classList.add('bg-green-500', 'hover:bg-green-600');
            } else {
                alertTitle.textContent = 'Konfirmasi Penolakan';
                alertMessage.textContent = 'Apakah Anda yakin ingin menolak pengaduan ini?';
                confirmButton.classList.remove('bg-green-500', 'hover:bg-green-600');
                confirmButton.classList.add('bg-red-500', 'hover:bg-red-600');
            }

            alertModal.classList.remove('hidden');
        }

        document.getElementById('confirmButton').addEventListener('click', function() {
            // Buat form secara dinamis
            const form = document.createElement('form');
            form.method = 'POST';
            form.action =
            `/petugas/${currentId}/${currentAction}`; // Pastikan endpoint ini sesuai dengan route untuk menghapus pengaduan

            // Tambahkan metode spoofing DELETE (digunakan dalam framework seperti Laravel)
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'DELETE';

            // Tambahkan CSRF token
            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = document.querySelector('meta[name="csrf-token"]')
            .content; // Pastikan ada meta tag CSRF di header

            // Tambahkan input ke form
            form.appendChild(methodInput);
            form.appendChild(csrfToken);

            // Tambahkan form ke body dan submit
            document.body.appendChild(form);
            form.submit();
        });


        document.getElementById('cancelButton').addEventListener('click', function() {
            document.getElementById('alertModal').classList.add('hidden');
        });

        // Close modal when clicking outside
        window.onclick = function(event) {
            const alertModal = document.getElementById('alertModal');
            if (event.target === alertModal) {
                alertModal.classList.add('hidden');
            }
        }

        // Close modal with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === "Escape") {
                document.getElementById('alertModal').classList.add('hidden');
            }
        });
    </script>
    {{-- @endpush --}}
</x-layout>