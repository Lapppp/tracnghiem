<?php

namespace App\Models\Banners;

use App\Models\Images\Image;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BGBanner extends Model
{
    use HasFactory;

    const TABLE = 'bg_banner';
    protected $table = self::TABLE;
    protected $fillable = [
        'name',
        'description',
        'url',
        'position',
        'type',
        'status',
        'position',
    ];

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function default()
    {
        return $this->morphOne(Image::class, 'imageable')
            ->where('is_default',1)
            ->where('device','Web')
            ->first();
    }

    public function mobile() {
        return $this->morphOne(Image::class, 'imageable')
            ->where('is_default',1)
            ->where('device','Mobile')
            ->first();
    }

}
