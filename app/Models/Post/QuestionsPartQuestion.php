<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Model;

class QuestionsPartQuestion extends Model
{

    const TABLE = 'questions_part_question';
    protected $table = self::TABLE;
    protected $fillable = [
        'id',
        'part_id',
        'test_id',
        'post_id',
        'order',
        'created_at',
        'updated_at',
    ];
}
