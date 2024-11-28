<?php

namespace App\Models;

use App\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class Petugas extends Model
{
    use LogsActivity;
    
    protected $table = 'Petugas';

    protected $fillable = [
        'nama_petugas',
        'username',
        'password',
        'telp',
        'level',
    ];

    protected $primaryKey = 'id_petugas';

    public function tanggapan()
    {
        return $this->hasMany(Tanggapan::class, 'id_petugas', 'id_petugas');
    }


}
