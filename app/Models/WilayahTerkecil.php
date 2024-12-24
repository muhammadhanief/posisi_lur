<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WilayahTerkecil extends Model
{
    /** @use HasFactory<\Database\Factories\WilayahTerkecilFactory> */
    use HasFactory;
    protected $fillable = ['kd_provinsi', 'kd_kabkot', 'kd_kecamatan', 'kd_desa', 'kd_wilayah_terkecil', 'kd_full', 'nm_wilayah_terkecil', 'wilayah_terkecil_type_id'];
}
