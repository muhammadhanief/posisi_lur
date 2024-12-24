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
        Schema::create('kabkots', function (Blueprint $table) {
            $table->id();
            $table->string('kd_provinsi'); // Foreign key
            $table->string('kd_kabkot');
            $table->string('nm_kabkot');
            $table->timestamps();
            $table->unique(['kd_provinsi', 'kd_kabkot']); // Kombinasi harus unik
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kabkots');
    }
};