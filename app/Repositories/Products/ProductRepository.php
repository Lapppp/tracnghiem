<?php

namespace App\Repositories\Products;

use App\Models\Brands\Brand;
use App\Models\Category\Category;
use App\Models\Products\Product;
use Prettus\Repository\Eloquent\BaseRepository;

class ProductRepository extends BaseRepository
{

    public function model()
    {
        return Product::class;
    }

    public function getAll($params = [], $limit = 20)
    {
        $params = array_merge([
            'status' => [],
            'ids' => [],
            'options' => [],
            'colors' => [],
            'category_id' => [],
            'brand_id' => [],
            'search' => null,
            'sort_id' => null,
            'between_price_from' => null,
            'between_price_to' => null,
            'notInId' => null,
            'not_in_category_id' => [],
            'inRandomOrder'=>null
        ], $params);

        $result = Product::select(
            Product::TABLE.'.*',
            Brand::TABLE.'.name AS brand_name',
            Category::TABLE.'.name AS category_name'
        );

        $result->leftJoin(Category::TABLE, Product::TABLE.'.category_id', '=', Category::TABLE.'.id');
        $result->leftJoin(Brand::TABLE, Product::TABLE.'.category_id', '=', Brand::TABLE.'.id');

        if ( !empty($params['search']) ) {
            $result->where(Product::TABLE.'.name', 'LIKE', '%'.$params['search'].'%');
        }

        if ( !empty($params['status']) && is_array($params['status']) ) {
            $result->whereIn(Product::TABLE.'.status', $params['status']);
        }

        if ( !empty($params['colors']) && is_array($params['colors']) ) {
            $result->whereIn(Product::TABLE.'.color', $params['colors']);
        }

        if(!empty($params['between_price_from']) && !empty($params['between_price_to']) ){
            $result->whereBetween(Product::TABLE.'.price', [(int)$params['between_price_from'], (int)$params['between_price_to']]);
        }

        if(!empty($params['between_price_from']) && empty($params['between_price_to']) ){
            $result->where(Product::TABLE.'.price', '>=', (int)$params['between_price_from']);
        }


        if(empty($params['between_price_from']) && !empty($params['between_price_to']) ){
            $result->where(Product::TABLE.'.price', '=', (int)$params['between_price_from']);
        }

        if ( !empty($params['category_id']) && is_array($params['category_id']) ) {
            $result->whereIn(Product::TABLE.'.category_id', $params['category_id']);
        }

        if ( !empty($params['not_in_category_id']) && is_array($params['not_in_category_id']) ) {
            $result->whereNotIn(Product::TABLE . '.category_id', $params['not_in_category_id']);
        }

        if ( !empty($params['brand_id']) && is_array($params['brand_id']) ) {
            $result->whereIn(Product::TABLE.'.brand_id', $params['brand_id']);
        }

        if ( !empty($params['options']) && is_array($params['options']) ) {
            $result->whereIn(Product::TABLE.'.options', $params['options']);
        }

        if ( !empty($params['notInId']) ) {
            $result->where(Product::TABLE . '.id', '!=', $params['notInId']);
        }

        if ( !empty($params['ids']) && is_array($params['ids']) ) {
            $result->whereIn(Product::TABLE.'.id', $params['ids']);
        }

        if(!empty($params['sort_id'])){
            $result->orderBy(Product::TABLE.'.id', 'asc');
        }else {
            if(!empty($params['inRandomOrder'])) {
                $result->inRandomOrder();
            }else {
                $result->orderBy(Product::TABLE.'.id', 'desc');
            }

        }

        return empty($limit) ? $result->get() : $result->paginate($limit);
    }

    public function getById($id)
    {
        return Product::find($id);
    }

    public function getBySlug($slug)
    {
        return Product::where('slug', $slug)->first();
    }
}
