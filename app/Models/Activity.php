<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    /** @use HasFactory<\Database\Factories\ActivityFactory> */
    use HasFactory;
    protected $fillable = ['users_kegiatan_id', 'lat', 'lng', 'is_in_area'];

    public function usersKegiatan()
    {
        return $this->belongsTo(UsersKegiatan::class, 'users_kegiatan_id');
    }

    // Relasi ke tabel User melalui UsersKegiatan
    public function user()
    {
        return $this->usersKegiatan->user();
    }
}
