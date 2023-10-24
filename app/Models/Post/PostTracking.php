<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostTracking extends Model
{
    use HasFactory;

    const TABLE = 'post_tracking';
    protected $table = self::TABLE;
    protected $fillable = [
        'post_id',
        'old_status_id',
        'old_status',
        'status_id',
        'status',
        'deadline',
        'messages',
        'created_by',
    ];
}
