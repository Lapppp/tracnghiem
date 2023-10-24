<?php

namespace App\Repositories\Post;

use App\Models\Category\Category;
use App\Models\Modules\Module;
use App\Models\Post\Post;
use App\Models\Users\User;
use Carbon\Carbon;
use Prettus\Repository\Eloquent\BaseRepository;

class PostRepository extends BaseRepository
{

    public function model()
    {
        return Post::class;
    }

    public function getAll( $params = [], $limit = 20 )
    {
        $params = array_merge([
            'status' => [],
            'category_id' => [],
            'not_in_category_id' => [],
            'module_id' => [],
            'options' => [],
            'position' => [],
            'search' => null,
            'lang' => 'vi',
            'start_date' => null,
            'end_date' => null,
            'sevenDays' => null,
            'today' => null,
            'user_id' => [],
            'sort' => null,
            'notInId' => null,
        ], $params);

        $result = Post::select(
            Post::TABLE . '.*',
            Category::TABLE . '.name AS category_name',
            Module::TABLE . '.name AS module_name',
            User::TABLE . '.name AS full_name',
            User::TABLE . '.phone AS user_phone',
        );
        $result->leftJoin(Category::TABLE, Post::TABLE . '.category_id', '=', Category::TABLE . '.id');
        $result->leftJoin(Module::TABLE, Post::TABLE . '.module_id', '=', Module::TABLE . '.id');
        $result->leftJoin(User::TABLE, Post::TABLE . '.user_id', '=', User::TABLE . '.id');

        if ( !empty($params['search']) ) {
            $result->where(Post::TABLE . '.name', 'LIKE', '%' . $params['search'] . '%');
        }

        if ( !empty($params['status']) && is_array($params['status']) ) {
            $result->whereIn(Post::TABLE . '.status', $params['status']);
        }

        if ( !empty($params['options']) && is_array($params['options']) ) {
            $result->whereIn(Post::TABLE . '.options', $params['options']);
        }



        if ( !empty($params['module_id']) && is_array($params['module_id']) ) {
            $result->whereIn(Post::TABLE . '.module_id', $params['module_id']);
        }

        if ( !empty($params['start_date']) && empty($params['end_date']) ) {
            $startDate = date('Y-m-d', strtotime($params['start_date']));
            $result->whereDate(Post::TABLE . '.created_at', '>=', $startDate);
        }

        if ( empty($params['start_date']) && !empty($params['end_date']) ) {
            $endDate = date('Y-m-d', strtotime($params['end_date']));
            $result->whereDate(Post::TABLE . '.created_at', '=', $endDate);
        }

        if ( !empty($params['start_date']) && !empty($params['end_date']) ) {
            $startDate = date('Y-m-d', strtotime($params['start_date']));
            $endDate = date('Y-m-d', strtotime($params['end_date']));
            $result->whereDate(Post::TABLE . '.created_at', '>=', $startDate)->whereDate(Post::TABLE . '.created_at', '<=', $endDate);
        }


        if ( !empty($params['notInId']) ) {
            $result->where(Post::TABLE . '.id', '!=', $params['notInId']);
        }

        if ( !empty($params['not_in_category_id']) && is_array($params['not_in_category_id']) ) {
            $result->whereNotIn(Post::TABLE . '.category_id', $params['not_in_category_id']);
        }

        if ( !empty($params['category_id']) && is_array($params['category_id']) ) {
            $result->whereIn(Post::TABLE . '.category_id', $params['category_id']);
        }

        if ( !empty($params['sevenDays']) ) {

            $result->whereDate(Post::TABLE . '.created_at', '>=', Carbon::now()->subDays(7));
        }

        if ( !empty($params['today']) ) {

            $result->whereDate(Post::TABLE . '.created_at', '=', date('Y-m-d'));
        }

        if ( !empty($params['user_id']) && is_array($params['user_id']) ) {
            $result->whereIn(Post::TABLE . '.user_id', $params['user_id']);
        }

        if(!empty($params['sort'])){
            $result->orderBy(Post::TABLE . '.'.$params['sort'], 'desc');
        }else{
            $result->orderBy(Post::TABLE . '.id', 'desc');
        }

        return empty($limit) ? $result->get() : $result->paginate($limit);
    }

    public function getByID( $id )
    {
        return Post::find($id);
    }

    public function getTotal( $params = [] )
    {
        $params = array_merge([
            'status' => [],
            'category_id' => [],
            'module_id' => [],
            'options' => [],
            'search' => null,
            'lang' => 'vi',
        ], $params);

        $result = Post::select(
            Post::TABLE . '.*',
            Category::TABLE . '.name AS category_name',
            Module::TABLE . '.name AS module_name',
            User::TABLE . '.name AS full_name',
            User::TABLE . '.phone AS user_phone',
        );
        $result->leftJoin(Category::TABLE, Post::TABLE . '.category_id', '=', Category::TABLE . '.id');
        $result->leftJoin(Module::TABLE, Post::TABLE . '.module_id', '=', Module::TABLE . '.id');
        $result->leftJoin(User::TABLE, Post::TABLE . '.user_id', '=', User::TABLE . '.id');

        if ( !empty($params['search']) ) {
            $result->where(Post::TABLE . '.name', 'LIKE', '%' . $params['search'] . '%');
        }

        if ( !empty($params['status']) && is_array($params['status']) ) {
            $result->whereIn(Post::TABLE . '.status', $params['status']);
        }

        if ( !empty($params['options']) && is_array($params['options']) ) {
            $result->whereIn(Post::TABLE . '.options', $params['options']);
        }

        if ( !empty($params['module_id']) && is_array($params['module_id']) ) {
            $result->whereIn(Post::TABLE . '.module_id', $params['module_id']);
        }

        if ( !empty($params['category_id']) && is_array($params['category_id']) ) {
            $result->whereIn(Post::TABLE . '.category_id', $params['category_id']);
        }

        if ( !empty($params['sevenDays']) ) {
            $result->whereDate('created_at', '>=', Carbon::now()->subDays(7));
        }

        if ( !empty($params['today']) ) {
            $result->whereDate('created_at', '=', date('Y-m-d'));
        }


        return $result->get()->count();
    }

    public function lastItems() {
        return Post::latest('id')->first();
    }

    public function lastCategoryItems($category_id = 0, $options = 0) {
        return Post::where('category_id',$category_id)
            ->where('options',$options)
            ->latest('id')
            ->first();
    }

    public function getBySlug($slug)
    {
        return Post::where('slug', $slug)->first();
    }

}
