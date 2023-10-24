<?php

namespace App\Models\Videos;

use App\Models\Images\Image;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    const TABLE = 'videos';
    protected $table = self::TABLE;
    protected $fillable = [
        'name',
        'status',
        'description',
        'url',
    ];

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function default()
    {
        return $this->morphOne(Image::class, 'imageable')->where('is_default', 1)->first();
    }
}
