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
        Schema::create('petugas_locations', function (Blueprint $table) {
            $table->id();
            $table->string('kode_kabkota');
            $table->string('kode_kegiatan');
            $table->string('kode_petugas');
            $table->string('nama_petugas');
            $table->timestamp('timestamp');
            $table->decimal('latitude', 10, 6);  // 10 digits, 6 after the decimal point
            $table->decimal('longitude', 10, 6); // 10 digits, 6 after the decimal point
            $table->timestamps();  // created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('petugas_locations');
    }
};