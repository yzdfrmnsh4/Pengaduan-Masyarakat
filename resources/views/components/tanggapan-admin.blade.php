<div id="responseModal"
class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden items-center justify-center z-50 transition-opacity duration-300">
<div
    class="bg-white rounded-lg shadow-xl max-w-2xl w-full mx-4 h-3/4 flex flex-col transform transition-all duration-300 scale-95 opacity-0">
    <div class="flex items-center justify-between p-4 border-b">
        <h3 class="text-xl font-semibold text-gray-800">Tanggapan Pengaduan</h3>
        <button onclick="closeResponseModal()"
            class="text-gray-400 hover:text-gray-600 transition duration-150">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                </path>
            </svg>
        </button>
    </div>
    <div id="tanggapanList" class="flex-grow overflow-y-auto p-4 space-y-4">
        <!-- Tanggapan akan dimasukkan di sini -->
    </div>
    <form id="responseForm" class="p-4 border-t" onsubmit="submitResponse(event)">
        @csrf
        <input type="hidden" id="id_pengaduan" name="id_pengaduan">
        <div class="flex items-center space-x-2">
            <textarea id="tanggapan" name="tanggapan"
                class="flex-grow border rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" rows="2"
                placeholder="Tulis tanggapan..." required></textarea>
            <button type="submit"
                class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300 flex-shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                </svg>
            </button>
        </div>
    </form>
</div>
</div>