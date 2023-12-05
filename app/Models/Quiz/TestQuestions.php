<?php

namespace App\Models\Quiz;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestQuestions extends Model
{
    use HasFactory;
    const TABLE = 'test_questions';
    protected $table = self::TABLE;
    protected $fillable = [
        'test_id',
        'post_id',
        'order_by',
    ];
}
