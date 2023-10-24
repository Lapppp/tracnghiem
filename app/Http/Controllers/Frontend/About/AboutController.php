<?php

namespace App\Http\Controllers\Frontend\About;

use App\Enums\Modules\ModuleType;
use App\Http\Controllers\FrontendController;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Post\PostRepository;
use App\Repositories\Products\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class AboutController extends FrontendController
{

    protected $data = [];
    protected $postRepository,$categoryRepository,$productRepository;
    public function __construct(
        PostRepository $postRepository,
        CategoryRepository $categoryRepository,
        ProductRepository $productRepository)
    {
        parent::__construct();
        $this->postRepository = $postRepository;
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
    }


    public function index( Request $request )
    {
        $post = $this->postRepository->getByID(66);
        if(!$post) {
            return redirect()->route('frontend.home.index');
        }
        $this->data['post'] = $post;
        $this->data['category'] = $this->categoryRepository->getAll(['module_id'=>[ModuleType::Research]]);
        $pOtherSameNews = [
            'module_id'=>[ModuleType::News],
            'notInId'=>$post->id
        ];
        $this->data['otherSameNews'] = $this->postRepository->getAll($pOtherSameNews,10);
        $this->data['otherNews'] = $this->postRepository->getAll(['not_in_category_id'=>[$post->category_id]],10);
        $this->data['products'] = $this->productRepository->getAll([],10);

        // Seo key word
        $imageSeo ='';
        if($post->default() && $post->default()['url']){
            $imageSeo =  url('').'/storage/'.str_replace(Str::of($post->default()['url'])->basename(),Str::of($post->default()['url'])->basename(),asset('storage/products/'.$post->default()['url']));
        }
        View::share('title', 'Giới thiệu về KenJi');
        View::share('description', 'Ghế massage KENJI – K8 tự hào là sản phẩm chất lượng được đài truyền hình VTC6 lựa chọn đưa tin trong mục cẩm nang sức khỏe.');
        View::share('keywords', 'Ghế massage KENJI');
        View::share('author', 'KenJi');
        View::share('imageSeo', $imageSeo);
        View::share('textCate', $textCate);

        return view('components.frontend.about.index',$this->data);
    }
}
