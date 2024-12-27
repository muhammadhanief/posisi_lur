<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WilayahTerkecil extends Model
{
    /** @use HasFactory<\Database\Factories\WilayahTerkecilFactory> */
    use HasFactory;
    protected $fillable = ['kd_provinsi', 'kd_kabkot', 'kd_kecamatan', 'kd_desa', 'kd_wilayah_terkecil', 'kd_full', 'nm_wilayah_terkecil', 'wilayah_terkecil_type_id'];


    // Definisikan relasi belongsTo ke Provinsi
    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'kd_provinsi', 'kd_provinsi');
    }

    // Definisikan relasi belongsTo ke Kabkot
    public function kabkot()
    {
        return $this->belongsTo(Kabkot::class, 'kd_kabkot', 'kd_kabkot');
    }

    // Definisikan relasi belongsTo ke Kecamatan
    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kd_kecamatan', 'kd_kecamatan');
    }

    // Definisikan relasi belongsTo ke Desa
    public function desa()
    {
        return $this->belongsTo(Desa::class, 'kd_desa', 'kd_desa');
    }

    // Definisikan relasi belongsTo ke WilayahTerkecil
    public function wilayahTerkecil()
    {
        return $this->belongsTo(WilayahTerkecil::class, 'kd_wilayah_terkecil', 'kd_wilayah_terkecil');
    }
}
