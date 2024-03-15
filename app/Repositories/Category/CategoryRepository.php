<?php

namespace App\Repositories\Category;

use App\Models\Category\Category;
use Prettus\Repository\Eloquent\BaseRepository;

class CategoryRepository extends BaseRepository
{

    public function model()
    {
        return Category::class;
    }

    public function getAll($params = [], $limit = 20)
    {
        $params = array_merge([
            'category_id' => [],
            'module_id' => [],
            'parent_id' => [],
            'status' => [],
        ], $params);

        $result = Category::select(
            Category::TABLE . '.*'
        );

        if (!empty($params['status']) && is_array($params['status'])) {
            $params['status'] = implode(',', $params['status']);
            $result->whereRaw("FIND_IN_SET(" . Category::TABLE . ".status,'" . $params['status'] . "')");
        }

        if (!empty($params['category_id']) && is_array($params['category_id'])) {
            $result->whereIn(Category::TABLE . '.id', $params['category_id']);
        }

        if (!empty($params['parent_id']) && is_array($params['parent_id'])) {
            $result->whereIn(Category::TABLE . '.category_id', $params['parent_id']);
        }

        if (!empty($params['module_id']) && is_array($params['module_id'])) {
            $result->whereIn(Category::TABLE . '.module_id', $params['module_id']);
        }

        $result->orderBy(Category::TABLE . '.id', 'desc');

        return empty($limit) ? $result->get() : $result->paginate(config('pagination.per_page'));
    }

    public function getByID($id)
    {
        return Category::find($id);
    }

    public function getParentsActive($module_id)
    {
        return Category::with('categoriesParents')
            ->where('module_id', (int)$module_id)
            ->where('status', 1)
            ->get();
    }

    public function getSlug($slug)
    {
        return Category::where('slug', $slug)->first();
    }
}
