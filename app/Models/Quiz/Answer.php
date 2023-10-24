<?php

namespace App\Models\Quiz;

use App\Models\Post\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    const TABLE = 'answers';
    protected $table = self::TABLE;
    protected $fillable = [
        'post_id',
        'is_correct',
        'description'
    ];

    public function post()
    {

        return $this->belongsTo(Post::class, 'post_id', 'id');
    }
}
