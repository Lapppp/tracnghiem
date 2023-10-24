<?php

namespace App\Models\Notifications;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    const TABLE = 'notifications';
    protected $table = self::TABLE;
    protected $fillable = [
        'post_id',
        'messages',
        'status',
        'is_read',
        'type',
        'user_id',
    ];
}
