<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WilayahTerkecilType extends Model
{
    /** @use HasFactory<\Database\Factories\WilayahTerkecilTypeFactory> */
    use HasFactory;

    protected $fillable = ['name'];
}