<?php

namespace App\Models\Quiz;

use App\Models\Category\Category;
use App\Models\Images\Image;
use App\Models\Post\Post;
use App\Models\Users\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;
    const TABLE = 'test';
    protected $table = self::TABLE;
    protected $fillable = [
        'title',
        'description',
        'category_id',
        'subject_id',
        'status',
        'score_time',
        'start_date',
        'end_date',
        'created_at',
        'updated_at',
        'times',
        'questions',
        'position',
        'views',
    ];

    public function questions()
    {
        return $this->belongsToMany(Post::class, 'test_users', 'question_id', 'test_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'test_users', 'user_id', 'test_id');
    }

    public function testquestions()
    {
         return $this->hasMany(TestQuestions::class,'test_id','id');
    }

    public function testquestionSort($question_id = 0)
    {
        return $this->hasMany(TestQuestions::class,'test_id','id')
            ->where('post_id',$question_id);
    }

    public function testAllquestions()
    {
        return $this->belongsToMany(Post::class,'test_questions','test_id','post_id')
            ->withPivot(['id','order_by'])->orderBy('test_questions.order_by','asc');
    }

    public function nextTestAllquestions($id)
    {
        return $this->belongsToMany(Post::class,'test_questions','test_id','post_id')
            ->withPivot(['id','order_by'])
            ->where('test_questions.order_by', '>', $id)
            ->orderBy('test_questions.order_by','asc')
            ->first();
    }


    public function PreviousTestAllquestions($id)
    {
        return $this->belongsToMany(Post::class,'test_questions','test_id','post_id')
            ->withPivot(['id','order_by'])
            ->where('test_questions.order_by', '<', $id)
            ->orderBy('test_questions.order_by','desc')
            ->first();
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function default()
    {
        return $this->morphOne(Image::class, 'imageable')->where('is_default', 1)->first();
    }

    public function topic()
    {
        return $this->belongsTo(Subject::class,'subject_id','id')->withDefault(['title' =>'']);
    }

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id','id')->withDefault(['name' =>'']);
    }
}
