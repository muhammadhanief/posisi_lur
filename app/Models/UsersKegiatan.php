<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersKegiatan extends Model
{
    /** @use HasFactory<\Database\Factories\UsersKegiatanFactory> */
    use HasFactory;
    protected $fillable = ['user_id', 'kegiatan_id', 'status', 'wilayah_terkecil_id', 'email_pml', 'petugas_id', 'tahun'];
}