<?php

namespace App\Models\Products;

use App\Models\Category\Category;
use App\Models\Images\Image;
use App\Models\Post\Comment;
use App\Models\Units\Unit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsFavourite extends Model
{
    use HasFactory;

    const TABLE = 'products_favourite';
    protected $table = self::TABLE;
    protected $fillable = [
        'product_id',
        'user_id',
    ];
}
