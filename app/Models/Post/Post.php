<?php

namespace App\Models\Post;

use App\Models\Category\Category;
use App\Models\Images\Image;
use App\Models\Quiz\Answer;
use App\Models\Users\User;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    const TABLE = 'posts';
    protected $table = self::TABLE;

    protected $fillable = [
        'status',
        'options',
        'category_id',
        'module_id',
        'views',
        'created_at',
        'updated_at',
        'name',
        'slug',
        'short_description',
        'description',
        'code',
        'code_number',
        'date_of_filing',
        'received_date',
        'deadline',
        'user_id',
        'logo',
        'meta_keywords',
        'meta_description',
        'meta_title',
    ];


    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function default()
    {
        return $this->morphOne(Image::class, 'imageable')->where('is_default', 1)->first();
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function postsTracking()
    {
        return $this->$this->hasMany(PostTracking::class, 'post_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * get all post with a module
     * @param $module_id
     * @param int $limit
     * @return mixed
     */
    public static function getPostModules($module_id, $limit = 6)
    {
        return self::select('*')
            ->where('module_id', $module_id)
            ->limit($limit)
            ->get();
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id')->withDefault([
            'name'=>''
        ]);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class, 'post_id', 'id');
    }

    public function answerCorrect()
    {
        return $this->hasMany(Answer::class, 'post_id', 'id')
            ->where('is_correct',1);
    }
}
