<?php

namespace Database\Seeders;

use App\Models\Petugas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PetugasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Petugas::create([
            'nama_petugas' => 'Petugas1',
            'username' => 'petugas',
            'password' => Hash::make('petugas123'),
            'telp' => '081234567890',
            'level' => 'petugas'
        ]);
    }
}
