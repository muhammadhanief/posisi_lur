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
        Schema::create('users_kegiatans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('kegiatan_id')->constrained('kegiatans')->onDelete('cascade');
            $table->string('kd_full'); // Kolom untuk menyimpan kd_full
            $table->foreign('kd_full')->references('kd_full')->on('wilayah_terkecils')->onDelete('cascade'); // Tambahkan FK ke wilayah_terkecils
            $table->string('hp')->nullable();
            $table->string('petugas_id')->nullable(); //ini mau diisi 33020202SNLIK
            $table->year('tahun');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_kegiatans');
    }
};