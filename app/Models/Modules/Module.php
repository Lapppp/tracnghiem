<?php

namespace App\Models\Modules;

use App\Models\Post\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    const TABLE = 'modules';
    protected $table = self::TABLE;
    protected $fillable = [
        'name',
        'customize_name',
    ];

    public function post()
    {
        return $this->hasOne(Post::class, 'module_id');
    }
}
