<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Model;

class QuestionsMultiple extends Model
{

    const TABLE = 'questions_multiple';
    protected $table = self::TABLE;

    protected $fillable = [
        'a',
        'b',
        'c',
        'd',
        'e',
        'created_at',
        'updated_at',
        'is_correct',
        'group_question',
        'short_description',
        'post_id'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }
}
