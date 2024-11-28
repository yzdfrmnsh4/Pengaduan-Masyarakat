<!DOCTYPE html>
<html>
<head>
    <title>Detail Laporan Pengaduan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }
        .detail {
            margin-bottom: 15px;
        }
        .detail label {
            font-weight: bold;
            display: inline-block;
            width: 150px;
        }
    </style>
</head>
<body>
    @foreach($yazid_laporan as $complaint)

    <table style="border: 1px black;">
        <thead>
            <th>
                <td>id</td>
                <td>Tanggal</td>
                <td>nama</td>
                <td>status</td>
                <td></td>
                <td></td>
            </th>
            <tbody>
                <tr>
                    <td>{{ $complaint->id_pengaduan }}</td>
                    <td>{{ $complaint->tanggal }}</td>
                    <td>{{ $complaint->nama }}</td>
                    <td>
                        <label>Status:</label>
                        @if($complaint->status == '0')
                            Baru
                        @elseif($complaint->status == 'proses')
                            Proses
                        @else
                            Selesai
                        @endif
                    </td>
                </tr>
            </tbody>
        </thead>
    </table>
    @endforeach 
    
    {{-- <div class="header">
        <h1>Detail Laporan Pengaduan</h1>
    </div>

    <div class="detail">
        <label>ID Pengaduan:</label>
        {{ $complaint->id_pengaduan }}
    </div>
    <div class="detail">
        <label>Tanggal Pengaduan:</label>
        {{ $complaint->tgl_pengaduan }}
    </div>
    <div class="detail">
        <label>Pelapor:</label>
        {{ $complaint->masyarakat->nama }}
    </div>
    <div class="detail">
        <label>Isi Laporan:</label>
        {{ $complaint->isi_laporan }}
    </div>
    <div class="detail">
        <label>Status:</label>
        @if($complaint->status == '0')
            Baru
        @elseif($complaint->status == 'proses')
            Proses
        @else
            Selesai
        @endif
    </div>
    
    {{-- @foreach($yazid_laporan as $complaint) --}}
    <div style="margin-top: 20px; text-align: right;">
        <p>Dicetak pada: {{ now()->format('d F Y H:i:s') }}</p>
    </div>
    {{-- @endforeach --}}
</body>
</html>