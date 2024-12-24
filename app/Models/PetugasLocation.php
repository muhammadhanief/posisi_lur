<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PetugasLocation extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'kode_kabkota',
        'kode_kegiatan',
        'kode_petugas',
        'nama_petugas',
        'timestamp',
        'latitude',
        'longitude',
    ];
}