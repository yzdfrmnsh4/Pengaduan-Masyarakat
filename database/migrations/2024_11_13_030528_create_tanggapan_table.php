<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
        public function up(): void
        {
            Schema::create('tanggapan', function (Blueprint $table) {
                $table->integer('id_tanggapan')->primary()->autoIncrement();
                $table->integer('id_pengaduan');
                $table->date('tgl_tanggapan');
                $table->text('tanggapan');
                $table->integer('id_petugas')->nullable();
                $table->char('nik', 16)->nullable();
                $table->enum('pengirim', ['petugas', 'masyarakat']); 
                $table->timestamps();
                $table->foreign('nik')->references('nik')->on('masyarakat')->onDelete('cascade');
                $table->foreign('id_pengaduan')->references('id_pengaduan')->on('pengaduan')->onDelete('cascade');
                $table->foreign('id_petugas')->references('id_petugas')->on('petugas')->onDelete('cascade');
            });
        }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tanggapan');
    }
};
