<?php

namespace App\Repositories\Products;

use App\Models\Products\ProductsFavourite;
use Prettus\Repository\Eloquent\BaseRepository;

class ProductsFavouriteRepository extends BaseRepository
{

    public function model()
    {
        return ProductsFavourite::class;
    }

    public function checkUserFavourite($product_id = 0, $user_id = 0)
    {
        return ProductsFavourite::where('product_id', '=', (int) $product_id)
            ->where('user_id', (int) $user_id)
            ->first();
    }
}
