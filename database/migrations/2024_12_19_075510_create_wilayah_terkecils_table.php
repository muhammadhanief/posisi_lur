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
        Schema::create('wilayah_terkecils', function (Blueprint $table) {
            $table->id();
            $table->string('kd_provinsi');  // Kolom untuk menyimpan kode provinsi
            $table->string('kd_kabkot');  // Kolom untuk menyimpan kode kabupaten/kota
            $table->string('kd_kecamatan');  // Kolom untuk menyimpan kode kecamatan
            $table->string('kd_desa');  // Kolom untuk menyimpan kode desa
            $table->string('kd_wilayah_terkecil');  // Kolom untuk menyimpan kode wilayah terkecil
            $table->string('kd_full')->unique();
            $table->string('nm_wilayah_terkecil');  // Kolom untuk menyimpan nama wilayah terkecil
            $table->foreignId('wilayah_terkecil_type_id')->constrained('wilayah_terkecil_types')->onDelete('cascade'); // Kolom untuk menyimpan tipe wilayah terkecil
            $table->timestamps();
            // Gunakan nama pendek untuk indeks unik
            $table->unique(['kd_kecamatan', 'kd_desa', 'kd_wilayah_terkecil'], 'kd_wilayah_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wilayah_terkecils');
    }
};
