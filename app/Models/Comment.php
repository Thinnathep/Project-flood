<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    // ความสัมพันธ์กับ ForumPost
    public function forumPost()
    {
        return $this->belongsTo(ForumPost::class);
    }

    // ความสัมพันธ์กับ User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
