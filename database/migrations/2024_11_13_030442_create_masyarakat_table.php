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
        Schema::create('masyarakat', function (Blueprint $table) {
            // $table->id();
            $table->char('nik', 16)->primary();
            $table->string('nama', 35);
            $table->string('username', 25)->unique();
            $table->string('password', 255);
            $table->string('telp', 13);
            $table->enum('status', ['0', 'verifikasi'])->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('masyarakat');
    }
};
