<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaterReport extends Model
{
    use HasFactory;
    protected $fillable = [
        'location',
        'water_source_type',
        'water_source_name',
        'water_level',
        'description',
        'status',
    ];
}
