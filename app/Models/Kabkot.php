<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kabkot extends Model
{
    /** @use HasFactory<\Database\Factories\KabkotFactory> */
    use HasFactory;

    protected $fillable = ['kd_provinsi', 'kd_kabkot', 'nm_kabkot'];
}