<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pengaduan Resmi</title>
    <style>
        @page {
            margin: 1.5cm; /* Reduced margin */
        }
        body {
            font-family: Arial, sans-serif;
            line-height: 1.4; /* Reduced line height */
            color: #333;
            margin: 0;
            padding: 0;
            font-size: 11px; /* Slightly reduced base font size */
        }
        .header {
            text-align: center;
            margin-bottom: 15px; /* Reduced margin */
        }
        .letterhead {
            position: relative;
            padding-bottom: 15px; /* Reduced padding */
            min-height: 100px; /* Reduced height */
        }
        .logo {
            position: absolute;
            left: 0;
            top: 0;
            width: 100px; /* Slightly reduced logo size */
            height: auto;
        }
        .letterhead-text {
            text-align: center;
            padding: 0 100px;
        }
        .letterhead-text h2 {
            margin: 0;
            font-size: 14px;
            font-weight: bold;
        }
        .letterhead-text h3 {
            margin: 3px 0;
            font-size: 12px;
            font-weight: bold;
        }
        .letterhead-text p {
            margin: 1px 0;
            font-size: 11px;
        }
        .double-border {
            margin-top: 15px;
            border-top: 2px double #000;
            border-bottom: 1px solid #000;
            height: 2px;
            margin-bottom: 15px;
        }
        .section {
            margin-bottom: 12px; /* Reduced margin */
        }
        .section-title {
            background-color: #f2f2f2;
            padding: 3px 8px;
            font-weight: bold;
            font-size: 11px;
        }
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 3px;
        }
        .info-table th, .info-table td {
            border: 1px solid #ddd;
            padding: 5px;
            font-size: 11px;
        }
        .info-table th {
            width: 25%; /* Reduced width */
            background-color: #f8f8f8;
        }
        .content-text {
            text-align: justify;
            padding: 0 15px;
        }
        .status-0 { color: #ff9800; }
        .status-proses { color: #2196F3; }
        .status-selesai { color: #4CAF50; }
        .footer {
            margin-top: 15px; /* Reduced margin */
            text-align: right;
        }
        .signature-line {
            display: inline-block;
            width: 140px;
            border-bottom: 1px solid #333;
            margin-top: 50px; /* Reduced margin */
        }
        .photo-evidence {
            text-align: center;
            margin-top: 8px;
        }
        .photo-frame {
            display: inline-block;
            padding: 5px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
        }
        .photo-caption {
            margin-top: 3px;
            font-style: italic;
            font-size: 9px;
            color: #666;
        }
        /* Compact footer style */
        .footer p {
            margin: 2px 0;
         
        }

        .footer{
            margin-top: 70px;
        }

        .page-break {
            margin-bottom: 150px;
        }
    </style>
</head>
<body>
    @foreach($yazid_laporan as $yazid)
    <div class="report-container">
        <div class="header">
            <div class="letterhead">
                <img src="{{ public_path('img/kab_bandung.png') }}" alt="Logo Kabupaten Bandung" class="logo">
                <div class="letterhead-text">
                    <h2>PEMERINTAH KABUPATEN BANDUNG</h2>
                    <h2>DINAS KOMUNIKASI, INFORMATIKA DAN STATISTIK</h2>
                    <h3>LAPOR MAS</h3>
                    <h3>LAYANAN PENGADUAN MASYARAKAT</h3>
                    <p>Jl. Raya Soreang KM.17, Pamekaran, Kec. Soreang, Kabupaten Bandung</p>
                    <p>Telepon: (022) 5897237 | Email: diskominfo@bandungkab.go.id</p>
                </div>
                <div class="double-border"></div>
            </div>
        </div>

        <div class="section">
            <div class="section-title">A. Profil Pelapor</div>
            <table class="info-table">
                <tr>
                    <th>Nama Pelapor</th>
                    <td>{{ $yazid->masyarakat->nama }}</td>
                </tr>
                <tr>
                    <th>NIK</th>
                    <td>{{ $yazid->masyarakat->nik }}</td>
                </tr>
                <tr>
                    <th>No Hp</th>
                    <td>{{ $yazid->masyarakat->telp }}</td>
                </tr>
            </table>
        </div>

        <div class="section">
            <div class="section-title">B. Informasi Pengaduan</div>
            <table class="info-table">
                <tr>
                    <th>Nomor Pengaduan</th>
                    <td>{{ $yazid->id_pengaduan }}</td>
                </tr>
                <tr>
                    <th>Tanggal Pengaduan</th>
                    <td>{{ \Carbon\Carbon::parse($yazid->tgl_pengaduan)->isoFormat('dddd, D MMMM Y') }}</td>
                </tr>
                <tr>
                    <th>Status Pengaduan</th>
                    <td class="status-{{ $yazid->status }}">
                        {{ $yazid->status == '0' ? 'Baru' : ucfirst($yazid->status) }}
                    </td>
                </tr>
            </table>
        </div>

        <div class="section">
            <div class="section-title">C. Isi Laporan</div>
            <div class="content-text">
                <p>{{ $yazid->isi_laporan }}</p>
            </div>
        </div>

        @if($yazid->foto)
        <div class="section">
            <div class="section-title">D. Bukti Laporan</div>
            <div class="photo-evidence">
                <div class="photo-frame">
                    <img src="{{ public_path('storage/'.$yazid->foto) }}" alt="Bukti Foto" style="max-width: 250px; max-height: 150px; object-fit: contain;">
                    <div class="photo-caption">
                        Bukti foto pengaduan - {{ \Carbon\Carbon::parse($yazid->tgl_pengaduan)->isoFormat('D MMMM Y') }}
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="footer">
            <p>Bandung, {{ \Carbon\Carbon::parse($yazid->tgl_pengaduan)->isoFormat('D MMMM Y') }}</p>
            <p>Pelapor,</p>
            <div class="signature-line"></div>
            <p>{{ $yazid->masyarakat->nama }}</p>
        </div>
    </div>
    @if(!$loop->last)
    <div class="page-break"></div>
    @endif
    @endforeach
</body>
</html>