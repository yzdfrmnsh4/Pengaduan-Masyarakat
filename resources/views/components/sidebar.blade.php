<aside id="sidebar" class="fixed top-0 left-0 z-0 w-64 h-screen transition-all duration-300 transform -translate-x-full sm:translate-x-0">
    <div class="h-full px-3 py-4 overflow-y-auto bg-white border-r border-gray-200">
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-gradient-to-br from-blue-600 via-blue-700 to-blue-900 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <span class="text-xl font-semibold">LaporMas</span>
            </div>
            <button id="closeSidebar" class="sm:hidden">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <nav class="space-y-2">
            <a href="{{ Session('level') == 'admin' ? route('admin.dashboard') : route('petugas.index') }}" class="flex items-center gap-3 px-4 py-3 {{ Session('level') == 'admin' && request()->routeIs('admin.dashboard') || Session('level') == 'petugas' && request()->routeIs('petugas.index') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:bg-gray-50' }} rounded-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                </svg>
                Dashboard
            </a>

            @if(Session('level') == 'admin' || Session('level') == 'petugas')
                {{-- <li> --}}
                    <button id="pengaduanDropdown" class="flex items-center justify-between w-full px-4 py-3 text-gray-600 rounded-lg hover:bg-gray-50 focus:outline-none transition-colors duration-200 {{ request()->routeIs('*.pengaduan*') ? 'bg-blue-50 text-blue-600' : '' }}">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                            <span>Pengaduan</span>
                        </div>
                        <div class="flex items-center">
                            {{-- <span id="newComplaintsCount" class="inline-flex items-center justify-center w-5 h-5 text-xs font-semibold text-white bg-red-500 rounded-full mr-2 hidden"></span> --}}
                            <svg id="pengaduanDropdownIcon" class="w-4 h-4 transition-transform duration-200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </button>
                    <ul id="pengaduanSubmenu" class="mt-2 space-y-1 px-4 {{ request()->routeIs('*.pengaduan*') ? '' : 'hidden' }}">
                        <li>
                            <a href="{{ Session('level') == 'admin' ? route('admin.pengaduan') : route('petugas.pengaduan') }}" class="flex items-center justify-between px-4 py-2 text-sm rounded-lg transition-colors duration-200 {{ request()->routeIs('*.pengaduan') && !request()->routeIs('*.pengaduan.proses') && !request()->routeIs('*.pengaduan.done') ? 'bg-blue-100 text-blue-700' : 'text-gray-600 hover:bg-gray-100' }}">
                                <span>Pengaduan Baru</span>
                                {{-- <span id="newComplaintsCountInMenu" class="inline-flex items-center justify-center w-5 h-5 text-xs font-semibold text-white bg-red-500 rounded-full hidden"></span> --}}
                            </a>
                        </li>
                        <li>
                            <a href="{{ Session('level') == 'admin' ? route('admin.pengaduan.proses') : route('petugas.pengaduan.proses') }}" class="block px-4 py-2 text-sm rounded-lg transition-colors duration-200 {{ request()->routeIs('*.pengaduan.proses') ? 'bg-blue-100 text-blue-700' : 'text-gray-600 hover:bg-gray-100' }}">
                                Pengaduan Di Proses
                            </a>
                        </li>
                        <li>
                            <a href="{{ Session('level') == 'admin' ? route('admin.pengaduan.done') : route('petugas.pengaduan.done') }}" class="block px-4 py-2 text-sm rounded-lg transition-colors duration-200 {{ request()->routeIs('*.pengaduan.done') ? 'bg-blue-100 text-blue-700' : 'text-gray-600 hover:bg-gray-100' }}">
                                Pengaduan Selesai
                            </a>
                        </li>
                    </ul>
                </li>
            @endif

            {{-- <a href="{{ Session('level') == 'admin' ? route('admin.pengaduan.proses') : route('petugas.pengaduan.proses') }}" class="flex items-center gap-3 px-4 py-3 {{ Session('level') == 'admin' && request()->routeIs('admin.pengaduan.proses') || Session('level') == 'petugas' && request()->routeIs('petugas.pengaduan.proses') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:bg-gray-50' }} rounded-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                Pengaduan Di Proses
            </a
            >
            <a href="{{ Session('level') == 'admin' ? route('admin.pengaduan.done') : route('petugas.pengaduan.done') }}" class="flex items-center gap-3 px-4 py-3 {{ Session('level') == 'admin' && request()->routeIs('admin.pengaduan.done') || Session('level') == 'petugas' && request()->routeIs('petugas.pengaduan.done') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:bg-gray-50' }} rounded-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                Pengaduan selesai
            </a> --}}

            {{-- <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Kasus Terselesaikan
            </a> --}}
            {{-- @if(Session('level') == 'admin')
            <a href="{{ Route('admin.akun.masyarakat') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.akun.masyarakat') || request()->routeIs('admin.masyarakat.create') || request()->routeIs('akun.masyarakat.edit') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:bg-gray-50' }} rounded-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                Masyarakat
            </a>
            @endif --}}

            @if(Session('level') == 'admin')
                {{-- <li> --}}
                    <button id="akunDropdown" class="flex items-center justify-between w-full px-4 py-3 text-gray-600 rounded-lg hover:bg-gray-50 focus:outline-none transition-colors duration-200 {{ request()->routeIs('admin.akun*') ? 'bg-blue-50 text-blue-600' : '' }}">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            <span>Akun</span>
                        </div>
                        <svg id="akunDropdownIcon" class="w-4 h-4 transition-transform duration-200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <ul id="akunSubmenu" class="mt-2 space-y-1 px-4 {{ request()->routeIs('admin.akun*') ? '' : 'hidden' }}">
                        <li>
                            <a href="{{ route('admin.akun.admin') }}" class="block px-4 py-2 text-sm rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.akun.admin') ? 'bg-blue-100 text-blue-700' : 'text-gray-600 hover:bg-gray-100' }}">
                                Akun Admin
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.akun.petugas') }}" class="block px-4 py-2 text-sm rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.akun.petugas') ? 'bg-blue-100 text-blue-700' : 'text-gray-600 hover:bg-gray-100' }}">
                                Akun Petugas
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.akun.masyarakat') }}" class="block px-4 py-2 text-sm rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.akun.masyarakat') ? 'bg-blue-100 text-blue-700' : 'text-gray-600 hover:bg-gray-100' }}">
                                Akun Masyarakat
                            </a>
                        </li>
                    </ul>
                </li>
 
            @endif
            

            @if(Session('level') == 'admin')
            <a href="{{ route('akun.masyarakat.verifikasi') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('akun.masyarakat.verifikasi') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:bg-gray-50' }} rounded-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                Verifikasi Akun
            </a>
            @endif
            @if(Session('level') == 'admin')
            <a href="{{ route('admin.laporan') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.laporan') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:bg-gray-50' }} rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/></svg>
                Laporan
            </a>
            @endif

            @if(Session('level') == 'admin')
            <a href="{{ route('admin.activity.log') }}" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-lg transition duration-150 ease-in-out">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-activity"><path d="M22 12h-2.48a2 2 0 0 0-1.93 1.46l-2.35 8.36a.25.25 0 0 1-.48 0L9.24 2.18a.25.25 0 0 0-.48 0l-2.35 8.36A2 2 0 0 1 4.49 12H2"/></svg>
                <span>Log Aktivitas</span>
            </a>
            @endif




        </nav>
        <div class="bottom-2 absolute">
            <p class="text-gray-400 text-sm">Created By : <span class="font-bold">Muhammad Yazid</span></p>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const pengaduanDropdown = document.getElementById('pengaduanDropdown');
            const pengaduanSubmenu = document.getElementById('pengaduanSubmenu');
            const pengaduanDropdownIcon = document.getElementById('pengaduanDropdownIcon');
            const newComplaintsCount = document.getElementById('newComplaintsCount');
            const newComplaintsCountInMenu = document.getElementById('newComplaintsCountInMenu');
    
            const akunDropdown = document.getElementById('akunDropdown');
            const akunSubmenu = document.getElementById('akunSubmenu');
            const akunDropdownIcon = document.getElementById('akunDropdownIcon');
    
            function toggleDropdown(dropdown, submenu, icon) {
                submenu.classList.toggle('hidden');
                icon.classList.toggle('rotate-180');
            }
    
            pengaduanDropdown.addEventListener('click', () => toggleDropdown(pengaduanDropdown, pengaduanSubmenu, pengaduanDropdownIcon));
            akunDropdown.addEventListener('click', () => toggleDropdown(akunDropdown, akunSubmenu, akunDropdownIcon));
    
            // Check if we're on a Pengaduan-related page and open the dropdown if so
            if (pengaduanSubmenu.classList.contains('hidden') && 
                (window.location.href.includes('pengaduan') || 
                 pengaduanSubmenu.querySelector('a.bg-blue-100'))) {
                toggleDropdown(pengaduanDropdown, pengaduanSubmenu, pengaduanDropdownIcon);
            }
    
            // Check if we're on an Akun-related page and open the dropdown if so
            if (akunSubmenu.classList.contains('hidden') && 
                (window.location.href.includes('admin/akun') || 
                 akunSubmenu.querySelector('a.bg-blue-100'))) {
                toggleDropdown(akunDropdown, akunSubmenu, akunDropdownIcon);
            }
    
            // Function to update new complaints count
            function updateNewComplaintsCount(count) {
                if (count > 0) {
                    newComplaintsCount.textContent = count;
                    newComplaintsCount.classList.remove('hidden');
                    newComplaintsCountInMenu.textContent = count;
                    newComplaintsCountInMenu.classList.remove('hidden');
                } else {
                    newComplaintsCount.classList.add('hidden');
                    newComplaintsCountInMenu.classList.add('hidden');
                }
            }
    
            // Simulating new complaints (replace this with your actual data fetching logic)
            function fetchNewComplaints() {
                // This is a placeholder. Replace with your actual API call or data fetching method
                return new Promise((resolve) => {
                    setTimeout(() => {
                        resolve(Math.floor(Math.random() * 5)); // Random number between 0 and 4
                    }, 2000);
                });
            }
    
            // Update new complaints count every 30 seconds
            setInterval(() => {
                fetchNewComplaints().then(updateNewComplaintsCount);
            }, 30000);
    
            // Initial fetch
            fetchNewComplaints().then(updateNewComplaintsCount);
        });
    </script>
    
</aside>