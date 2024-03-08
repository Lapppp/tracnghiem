<?php

namespace App\Models\Quiz;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestUser extends Model
{
    use HasFactory;
    const TABLE = 'test_users';
    protected $table = self::TABLE;
    protected $fillable = [
        'user_id',
        'test_id',
        'question_id',
        'is_correct',
        'is_correct_temp',
        'test_id_test',
        'order_by',
        'is_reset',
    ];
}
