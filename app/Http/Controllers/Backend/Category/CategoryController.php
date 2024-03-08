<?php

namespace App\Http\Controllers\Backend\Category;

use App\Helpers\PaginationHelper;
use App\Http\Controllers\BackendController;
use App\Http\Requests\Backend\Category\CategoryRequest;
use App\Repositories\Category\CategoryRepository;
use Illuminate\Http\Request;
use View;

class CategoryController extends BackendController
{
    protected $data = [];
    protected $categoryRepos;

    public function __construct(CategoryRepository $categoryRepos)
    {
        parent::__construct();
        $this->categoryRepos = $categoryRepos;
    }

    public function index(Request $request)
    {
        //$user = Auth()->guard('backend')->user()->toArray();
        $users = $this->categoryRepos->getAll([]);
        $this->data['title'] = 'Users';
        $this->data['items'] = $users;
        $total = !empty($users->total) ? $users->total : 0;
        $perPage = !empty($users->perPage) ? $users->perPage : 20;
        $page = !empty($request->page) ? $request->page :  1;
        $url = '?';
        $this->data['pager'] = PaginationHelper::BackendPagination($total, $perPage, $page, $url);
        View::share('title', $this->data['title']);
        return view('components.backend.category.index', $this->data);
    }

    public function create(Request $request)
    {
        return view('components.backend.category.create', $this->data);
    }

    public function store(CategoryRequest $request)
    {
    }
}
