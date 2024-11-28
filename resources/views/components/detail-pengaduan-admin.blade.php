<div id="detailModal"
class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden items-center justify-center z-50 transition-opacity duration-300">
<div
    class="bg-white rounded-lg shadow-xl max-w-2xl w-full mx-4 transform transition-all duration-300 scale-95 opacity-0">
    <div class="flex items-center justify-between p-6 border-b">
        <h3 class="text-2xl font-semibold text-gray-800">Detail Pengaduan</h3>
        <button onclick="closeDetailModal()"
            class="text-gray-400 hover:text-gray-600 transition duration-150">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>
    <div id="detailContent" class="p-6 space-y-4 max-h-[calc(100vh-200px)] overflow-y-auto">
        <div class="flex items-center justify-center h-32">
            <svg class="animate-spin h-8 w-8 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                    stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor"
                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                </path>
            </svg>
        </div>
    </div>
</div>
</div>