<?php

namespace App\Models\Post;

use App\Models\Images\Image;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    const TABLE = 'comments';
    protected $table = self::TABLE;
    protected $primaryKey ='id';
    protected $fillable = [
        'user_id',
        'parent_id',
        'message',
        'commentable_type',
        'commentable_id',
        'email',
        'phone',
        'name',
        'status',
        'number_star',
    ];


    public function commentable()
    {
        return $this->morphTo();
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
