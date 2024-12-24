<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desa extends Model
{
    /** @use HasFactory<\Database\Factories\DesaFactory> */
    use HasFactory;

    protected $fillable = ['kd_provinsi', 'kd_kabkot', 'kd_kecamatan', 'kd_desa', 'nm_desa'];
}