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
        Schema::create('kecamatans', function (Blueprint $table) {
            $table->id();
            $table->string('kd_provinsi');  // Kolom untuk menyimpan kode provinsi
            $table->string('kd_kabkot');  // Kolom untuk menyimpan kode kabupaten/kota
            $table->string('kd_kecamatan');  // Kolom untuk menyimpan kode kecamatan
            $table->string('nm_kecamatan');  // Kolom untuk menyimpan nama kecamatan
            $table->timestamps();
            $table->unique(['kd_kabkot', 'kd_kecamatan']); // Kombinasi harus unik
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kecamatans');
    }
};