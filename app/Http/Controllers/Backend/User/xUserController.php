<?php

namespace App\Http\Controllers\Backend\User;

use App\Helpers\PaginationHelper;
use App\Http\Controllers\BackendController;
use App\Models\Post\Post;
use App\Repositories\Post\PostRepository;
use App\Repositories\Users\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class xUserController extends BackendController
{
    protected $data = [];
    protected $userRepos,$postRepos;

    public function __construct( UserRepository $userRepos ,PostRepository $postRepos )
    {
        parent::__construct();
        $this->userRepos = $userRepos;
        $this->postRepos = $postRepos;
    }

    public function index(Request $request)
    {
        $params = $request->only(['username', 'password']);
        $post = $this->postRepos->getAll([],20);

        $this->data['title'] = 'Users';
        $this->data['items'] = $post;
        $total = !empty($post->total()) ? $post->total() : 0;
        $perPage = !empty($post->perPage()) ? $post->perPage() : 2;

        $page = !empty($request->page) ? $request->page :  1;
        $url = route('backend.users.index').'?'.Arr::query($params);
        //$url = route('backend.users.index').'?'.http_build_query($params);
        $this->data['pager'] = PaginationHelper::BackendPagination($total,$perPage,$page,$url);
        return view('components.backend.users.index', $this->data);

       // dd($post);
        //$user = Auth()->guard('backend')->user()->toArray();
        $users = $this->userRepos->getAll([]);
        $this->data['title'] = 'Users';
        $this->data['items'] = $users;
        $total = !empty($users->total) ? $users->total : 0;
        $perPage = !empty($users->perPage) ? $users->perPage : 20;
        $page = !empty($request->page) ? $request->page :  1;
        $url = '?';
        $this->data['pager'] = PaginationHelper::BackendPagination($total,$perPage,$page,$url);
        return view('components.backend.users.index', $this->data);
    }
}
