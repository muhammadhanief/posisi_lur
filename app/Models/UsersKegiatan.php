<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UsersKegiatan extends Model
{
    /** @use HasFactory<\Database\Factories\UsersKegiatanFactory> */
    use HasFactory;
    protected $fillable = ['user_id', 'kegiatan_id', 'kd_full', 'hp_pml', 'petugas_id', 'tahun', 'tahun'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class, 'kegiatan_id');
    }

    public function pml()
    {
        return $this->belongsTo(User::class, 'hp_pml', 'hp');
    }

    // Relasi ke tabel activities
    public function activities(): HasMany
    {
        return $this->hasMany(Activity::class, 'users_kegiatan_id');
    }
}
