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
        Schema::create('desas', function (Blueprint $table) {
            $table->id();
            $table->string('kd_provinsi');  // Kolom untuk menyimpan kode provinsi
            $table->string('kd_kabkot');  // Kolom untuk menyimpan kode kabupaten/kota
            $table->string('kd_kecamatan');  // Kolom untuk menyimpan kode kecamatan
            $table->string('kd_desa');  // Kolom untuk menyimpan kode desa
            $table->string('nm_desa');  // Kolom untuk menyimpan nama desa
            $table->timestamps();
            $table->unique(['kd_kecamatan', 'kd_desa']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('desas');
    }
};