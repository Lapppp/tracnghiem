<?php

namespace App\Http\Controllers\Frontend\Posts;

use App\Enums\Modules\ModuleType;
use App\Helpers\PaginationHelper;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontendController;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Post\PostRepository;
use App\Repositories\Products\ProductRepository;
use App\Repositories\Provinces\ProvinceRepository;
use App\Repositories\ShowRooms\ShowRoomRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class NewsController extends FrontendController
{

    protected $data = [];
    private $postRepository,$categoryRepository,$productRepository,$provinceRepository,$showRoomRepository;
    public function __construct(
        PostRepository $postRepository,
        CategoryRepository $categoryRepository,
        ProductRepository $productRepository,
        ProvinceRepository $provinceRepository,
        ShowRoomRepository $showRoomRepository
    )
    {
        parent::__construct();
        $this->postRepository = $postRepository;
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
        $this->showRoomRepository = $showRoomRepository;
        $this->provinceRepository = $provinceRepository;
    }

    /**
     * Hiển thị tin tức.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $params = $request->only(['page']);
        $post = $this->postRepository->getAll(['module_id'=>[ModuleType::News],'status'=>[1]], 18);
        $this->data['news'] = $post;
        $this->data['title'] = 'Tin tức';
        $total = !empty($post->total()) ? $post->total() : 0;
        $perPage = !empty($post->perPage()) ? $post->perPage() : 2;

        $page = !empty($request->page) ? $request->page : 1;
        $url = route('frontend.news.index') . '?' . Arr::query($params);
        $this->data['pager'] = PaginationHelper::Pagination($total, $perPage, $page, $url);


        // Seo key word
        View::share('title', 'Tin tức về KenJi');
        View::share('description', 'Ghế massage KENJI – K8 tự hào là sản phẩm chất lượng được đài truyền hình VTC6 lựa chọn đưa tin trong mục cẩm nang sức khỏe.');
        View::share('keywords', 'Ghế massage KENJI');
        View::share('author', 'KenJi');
        View::share('imageSeo', '');

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
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show($id = 0)
    {
        $post = $this->postRepository->getByID($id);
        if(!$post) {
            return redirect()->route('frontend.home.index');
        }

        $this->data['post'] = $post;
        $this->data['category'] = $this->categoryRepository->getAll(['module_id'=>[ModuleType::News]]);
        $pOtherSameNews = [
            'module_id'=>[ModuleType::News],
            'category_id'=>[$post->category_id],
            'notInId'=>$post->id,
            'status'=>[1],
        ];
        $this->data['otherSameNews'] = $this->postRepository->getAll($pOtherSameNews);
        $this->data['otherNews'] = $this->postRepository->getAll(['module_id'=>[ModuleType::News],'status'=>[1]],5);

        // Seo key word
        $imageSeo ='';
        if($post->default() && $post->default()['url']){
            $imageSeo =  str_replace(Str::of($post->default()['url'])->basename(),Str::of($post->default()['url'])->basename(),asset('storage/products/'.$post->default()['url']));
        }
        View::share('title', $post->meta_title ?? $post->name);
        View::share('description', $post->meta_description ?? $post->name);
        View::share('keywords', $post->meta_keywords ?? $post->name);
        View::share('author', 'KenJi');
        View::share('imageSeo', $imageSeo);


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

        $params = $request->only(['page']);
        $category_id = $request->id;
        $category = $this->categoryRepository->getByID($category_id);
        if(!$category) {
            return redirect()->route('frontend.home.index');
        }

        $post = $this->postRepository->getAll(['category_id'=>[$category_id],'status'=>[1]], 18);
        $this->data['news'] = $post;
        $this->data['title'] = 'Tin tức';
        $this->data['category'] = $category;
        $total = !empty($post->total()) ? $post->total() : 0;
        $perPage = !empty($post->perPage()) ? $post->perPage() : 20;

        $page = !empty($request->page) ? $request->page : 1;
        $url = route('frontend.news.category',['id'=>$category->id,'name'=>Str::slug($category->name.'', '-').'.html']) . '?' . Arr::query($params);
        $this->data['pager'] = PaginationHelper::Pagination($total, $perPage, $page, $url);
        $this->data['showroom'] = $this->showRoomRepository->getAll([],3);
        $this->data['numberShowRoom'] = $this->showRoomRepository->getTotal();
        $this->data['province'] = $this->provinceRepository->getAll([],null);
        // Seo key word
        $imageSeo ='';
        if($category->default() && $category->default()['url']){
            $imageSeo =  str_replace(Str::of($category->default()['url'])->basename(),Str::of($category->default()['url'])->basename(),asset('storage/products/'.$category->default()['url']));
        }
        View::share('title', $category->name ?? '');
        View::share('description', 'Ghế massage KENJI – K8 tự hào là sản phẩm chất lượng được đài truyền hình VTC6 lựa chọn đưa tin trong mục cẩm nang sức khỏe.');
        View::share('keywords', 'Ghế massage KENJI');
        View::share('author', 'KenJi');
        View::share('imageSeo', $imageSeo);

        return view('components.frontend.news.category',$this->data);
    }
}
