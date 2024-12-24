<?php

namespace App\Models;

use Faker\Core\File;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    /** @use HasFactory<\Database\Factories\ProvinsiFactory> */
    use HasFactory;

    protected $table = 'provinsis';
    protected $fillable = ['kd_provinsi', 'nm_provinsi'];
}