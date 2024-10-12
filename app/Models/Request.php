<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    // กำหนดฟิลด์ที่อนุญาตให้ทำการ mass assignment
    protected $fillable = [
        'user_id',
        'name',
        'address', // เพิ่มที่อยู่
        'phone_number',
        'status',
        'description',
        'latitude',
        'longitude',
    ];

}
