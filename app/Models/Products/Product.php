<?php

namespace App\Models\Products;

use App\Models\Category\Category;
use App\Models\Images\Image;
use App\Models\Post\Comment;
use App\Models\Units\Unit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    const TABLE = 'products';
    protected $table = self::TABLE;
    protected $fillable = [
        'name',
        'slug',
        'short_description',
        'description',
        'meta_title',
        'meta_description',
        'category_id',
        'brand_id',
        'unit_id',
        'price',
        'discount',
        'options',
        'status',
        'meta_keywords',
        'specifications',
        'service_policy',
        'warranty',
        'maintenance',
        'quantity_in_stock',
        'status_in_stock',
        'color',
        'delivery_time',
        'percent',
        'choose_kenji',
        'description_gift',
    ];

    public function unit(){
        return $this->belongsTo(Unit::class,'unit_id','id');
    }

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

    public function commentsActive()
    {
        return $this->morphMany(Comment::class, 'commentable')->where('status',1);
    }

    public function category() {
        return $this->belongsTo(Category::class, 'category_id','id');
    }
}
