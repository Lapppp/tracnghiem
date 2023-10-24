<?php

namespace App\Http\Controllers\Frontend\Posts;

use App\Enums\Modules\ModuleType;
use App\Helpers\PaginationHelper;
use App\Http\Controllers\FrontendController;
use App\Repositories\Post\PostRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class ReSearchController extends FrontendController
{

    protected $data = [];
    private $postRepository;
    public function __construct(
        PostRepository $postRepository
    )
    {
        parent::__construct();
        $this->postRepository = $postRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $params = $request->only(['page']);
        $post = $this->postRepository->getAll(['module_id'=>[ModuleType::Research]], 20);
        $this->data['newsSort'] = $this->postRepository->getAll(['module_id'=>[ModuleType::News],'sort'=>'views'], 5);
        $this->data['items'] = $post;
        $this->data['title'] = 'Mua bán - Trao đổi';
        $total = !empty($post->total()) ? $post->total() : 0;
        $perPage = !empty($post->perPage()) ? $post->perPage() : 2;

        $page = !empty($request->page) ? $request->page : 1;
        $url = route('frontend.news.index') . '?' . Arr::query($params);
        $this->data['pager'] = PaginationHelper::Pagination($total, $perPage, $page, $url);

        return view('components.frontend.news.index',$this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show($id)
    {
        $post = $this->postRepository->getByID($id);
        if(!$post) {
            return redirect()->route('frontend.home.index');
        }
        $this->data['post'] = $post;
        $this->data['newsSort'] = $this->postRepository->getAll(['module_id'=>[ModuleType::News],'sort'=>'views'], 5);
        return view('components.frontend.news.show',$this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @param Request $request
     */
    public function category(Request $request) {

    }
}
