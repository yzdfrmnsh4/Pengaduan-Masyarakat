<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Masyarakat extends Model
{
    protected $table = 'Masyarakat';
    protected $fillable = [
        'nik',
        'nama',
        'username',
        'password',
        'telp'
    ];

    protected $primaryKey = 'nik';
    protected $casts = [
        'nik' => 'string',
    ];


    public function pengaduan()
    {
        return $this->hasMany(Pengaduan::class, 'nik', 'nik');
    }

    public function tanggapan()
    {
        return $this->hasMany(Tanggapan::class, 'id_petugas', 'id_petugas');
    }

}
