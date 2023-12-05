<?php

namespace App\Models\Quiz;

use App\Models\Category\Category;
use App\Models\Images\Image;
use App\Models\Post\Post;
use App\Models\Users\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestUsersTests extends Model
{
    use HasFactory;

    const TABLE = 'test_users_tests';
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
        'test_id',
        'start_time',
        'end_time',
        'stop_time',
        'user_id',
    ];

    public function questions()
    {
        return $this->belongsToMany(Post::class, 'test_users', 'test_id_test', 'question_id')
            ->withPivot([
            'user_id',
            'is_correct',
            'is_correct_temp',
            'created_at',
            'updated_at',
            'order_by',
        ])->orderBy('test_users.order_by','asc');

    }


    public function questionsCorrect()
    {
        return $this->belongsToMany(Post::class, 'test_users', 'test_id_test', 'question_id')
            ->withPivot([
                'user_id',
                'is_correct',
                'is_correct_temp',
                'created_at',
                'updated_at',
                'order_by',
            ])->where('test_users.is_correct_temp',1);

    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'test_users', 'user_id', 'test_id_test');
    }

    public function testquestions()
    {
        return $this->hasMany(TestQuestions::class, 'test_id', 'id');
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
        return $this->belongsTo(Subject::class, 'subject_id', 'id')->withDefault(['title' => '']);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id')->withDefault(['name' => '']);
    }
}
