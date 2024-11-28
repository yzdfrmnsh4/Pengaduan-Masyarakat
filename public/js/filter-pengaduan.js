document.addEventListener('DOMContentLoaded', function() {
    const filterForm = document.querySelector('form');
    const urutanPilihan = document.getElementById('sortOrder');
    const filterTanggal = document.getElementById('dateFilter');

    // Isi nilai filter dari URL saat halaman dimuat
    const params = new URLSearchParams(window.location.search);
    
    if (params.has('urutan')) {
        urutanPilihan.value = params.get('urutan');
    }
    
    if (params.has('tanggal')) {
        filterTanggal.value = params.get('tanggal');
    }
});