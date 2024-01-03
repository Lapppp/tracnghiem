<?php

namespace App\Models\Post;

use App\Models\Quiz\Test;
use Illuminate\Database\Eloquent\Model;

class QuestionsPart extends Model
{

    const TABLE = 'questions_part';
    protected $table = self::TABLE;

    protected $fillable = [
        'test_id',
        'name',
        'description',
        'short_description',
        'order',
        'status',
        'type',
        'created_at',
        'updated_at',
    ];

    public function test()
    {
        return $this->belongsTo(Test::class, 'test_id', 'id');
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'questions_part_question', 'part_id', 'post_id')->withPivot([
            'order'
        ])->orderBy('order','asc');
    }
}
