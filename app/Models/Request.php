<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    // กำหนดฟิลด์ที่อนุญาตให้ทำการ mass assignment
    protected $fillable = [
        'user_id',      // อนุญาตให้ระบุ user_id
        'name',         // อนุญาตให้ระบุชื่อ
        'address',      // อนุญาตให้ระบุที่อยู่
        'phone_number', // อนุญาตให้ระบุเบอร์โทร
        'status',       // อนุญาตให้ระบุสถานะ
        'description',  // อนุญาตให้ระบุรายละเอียด
    ];
}
