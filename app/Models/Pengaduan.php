<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{

    protected $primaryKey = 'id_pengaduan';

    // Jika kolom 'id_pengaduan' adalah integer, Anda juga bisa mengonfigurasi tipe kolomnya
    protected $keyType = 'int';
    protected $table = 'Pengaduan';
    protected $casts = [
        'tgl_pengaduan' => 'date',
    ];

    protected $fillable = [
        'tgl_pengaduan',
        'nik',
        'isi_laporan',
        'foto',
        'status'
    ];

    public function masyarakat()
    {
        return $this->belongsTo(Masyarakat::class, 'nik', 'nik');
    }

    public function tanggapan()
    {
        return $this->hasMany(Tanggapan::class, 'id_pengaduan', 'id_pengaduan');
    }

}
