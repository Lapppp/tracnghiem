<?php

namespace App\Models\Category;

use App\Models\Images\Image;
use App\Models\Post\Post;
use App\Models\Products\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
    use HasFactory;

    const TABLE = 'categories';
    protected $table = self::TABLE;
    protected $fillable = [
        'category_id',
        'module_id',
        'status',
        'name',
        'description',
        'weight',
        'image_url',
        'slug',
        'position',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'contentCate',
    ];

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function default()
    {
        return $this->morphOne(Image::class, 'imageable')->where('is_default', 1)->first();
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class,'category_id','id');
    }
    public function childrenCategories()
    {
        return $this->hasMany(Category::class)->with('categories');
    }

    public function products()
    {
        return $this->hasMany(Product::class,'category_id','id');
    }

    public function productsActive()
    {
        return $this->hasMany(Product::class,'category_id','id')->where('status',1);
    }

    public function categoriesParents()
    {
        return $this->hasMany(Category::class)->where('category_id',0);
    }
}
