<?php

namespace App\Http\Controllers\Frontend\Products;

use App\Enums\Modules\ModuleType;
use App\Enums\Products\ColorType;
use App\Enums\Products\StarType;
use App\Helpers\CookiesHelper;
use App\Helpers\PaginationHelper;
use App\Http\Controllers\FrontendController;
use App\Http\Requests\Frontend\Products\StoreProductRequest;
use App\Models\Post\Comment;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Post\PostRepository;
use App\Repositories\Products\ProductRepository;
use App\Repositories\Provinces\ProvinceRepository;
use App\Repositories\ShowRooms\ShowRoomRepository;
use App\Repositories\Videos\VideoRepository;
use App\Models\Images\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image as ImageIntervention;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;

class ProductController extends FrontendController
{
    protected $data = [];
    protected $productRepository, $videoRepository, $postRepository, $categoryRepository,$provinceRepository,$showRoomRepository;

    public function __construct(
        ProductRepository $productRepository,
        VideoRepository $videoRepository,
        PostRepository $postRepository,
        CategoryRepository $categoryRepository,
        ProvinceRepository $provinceRepository,
        ShowRoomRepository $showRoomRepository
    ) {
        parent::__construct();
        $this->productRepository = $productRepository;
        $this->videoRepository = $videoRepository;
        $this->postRepository = $postRepository;
        $this->categoryRepository = $categoryRepository;
        $this->showRoomRepository = $showRoomRepository;
        $this->provinceRepository = $provinceRepository;

        $this->data['colors'] = ColorType::Colors;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $params = $request->all();
        $price = !empty($params['price']) ? explode('-', $params['price']) : [];
        $color = $params['color'] ?? 0;
        $category_id = $params['category_id'] ?? null;
        $pPost = [
            'colors' => [$color],
            'sort_id' => $params['sort_id'] ?? 0,
            'between_price_from' => !empty($price) ? $price[0] : 0,
            'between_price_to' => !empty($price) ? $price[1] : 0,
            'search' => $params['search'] ?? null,
            'category_id' => $category_id,
            'status' => [1],
        ];
        $post = $this->productRepository->getAll($pPost );
        $this->data['products'] = $post;
        $this->data['title'] = 'Sản phẩm';
        $total = !empty($post->total()) ? $post->total() : 0;
        $perPage = !empty($post->perPage()) ? $post->perPage() : 2;

        $page = !empty($request->page) ? $request->page : 1;
        unset($params['page']);
        $url = route('frontend.products.all.index').'?'.Arr::query($params);
        $this->data['pager'] = PaginationHelper::Pagination($total, $perPage, $page, $url);
        $this->data['params'] = $params;

        $this->data['videoHome'] = $this->videoRepository->getAll([], null);
        $this->data['about'] = $this->postRepository->getByID(66);

        return view('components.frontend.products.index', $this->data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function category(Request $request, $id = 0)
    {
        $params = $request->all();
        $price = !empty($params['price']) ? explode('-', $params['price']) : [];
        $color = $params['color'] ?? 0;
        $category_id = $id ?? null;
        $category = $this->categoryRepository->getByID($category_id);
        if ( $category ) {
            if ( $category->category_id == 0 ) {
                $category_id = $category->childrenCategories->pluck('id')->toArray();
            }
        }

        $category_id_new = [];
        if ( !empty($category_id) ) {
            if ( is_array($category_id) ) {
                array_push($category_id, $id);
                $category_id_new = $category_id;
            } else {
                $category_id_new = [$id];
            }
        }

        $pPost = [
            'colors' => [$color],
            'sort_id' => $params['sort_id'] ?? 0,
            'between_price_from' => !empty($price) ? $price[0] : 0,
            'between_price_to' => !empty($price) ? $price[1] : 0,
            'search' => $params['search'] ?? null,
            'category_id' => $category_id_new,
            'status' => [1],
        ];


        $post = $this->productRepository->getAll($pPost, 18);

        $this->data['products'] = $post;
        $this->data['title'] = 'Sản phẩm';
        $total = !empty($post->total()) ? $post->total() : 0;
        $perPage = !empty($post->perPage()) ? $post->perPage() : 2;

        $page = !empty($request->page) ? $request->page : 1;
        unset($params['page']);
        $url = route('frontend.products.category', ['id' => $id]).'?'.Arr::query($params);
        $this->data['pager'] = PaginationHelper::Pagination($total, $perPage, $page, $url);
        $this->data['params'] = $params;
        $this->data['category'] = $category;


        $imageSeo ='';
        if($category->default() && $category->default()['url']){
            $imageSeo =  str_replace(Str::of($category->default()['url'])->basename(),Str::of($category->default()['url'])->basename(),asset('storage/category/'.$category->default()['url']));
        }
        $title = $category->meta_title ?? $category->name ;
        $description = $category->meta_description ?? $category->description ?? $title;
        $keywords = $category->meta_keywords ?? $category->description ?? $title;
        View::share('title', $title);
        View::share('description', $description);
        View::share('keywords', $keywords);
        View::share('author', 'kenjivietnam.vn');
        View::share('imageSeo', $imageSeo);


        return view('components.frontend.products.category', $this->data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function categorySubSub(Request $request, $slug = '')
    {

        $params = $request->all();
        $categorySlug = $this->categoryRepository->getSlug($slug);
        if ( !$categorySlug ) {
            return redirect().route('frontend.products.all.index');
        }

        $price = !empty($params['price']) ? explode('-', $params['price']) : [];
        $color = $params['color'] ?? 0;
        $category_id = $categorySlug->id ?? null;
        $category_new = $categorySlug->id;

        $category = $this->categoryRepository->getByID($category_id);
        if ( $category ) {
            if ( $category->category_id == 0 ) {
                $category_id = $category->childrenCategories->pluck('id')->toArray();
            }
        }

        $category_id_new = [];
        if ( !empty($category_id) ) {

            if ( is_array($category_id) ) {
                array_push($category_id, $category_new);
                $category_id_new = $category_id;
            } else {
                $category_id_new = [$category_new];
            }
        }else {
            $category_id_new = [$category_new];
        }

        $pPost = [
            'colors' => [$color],
            'sort_id' => $params['sort_id'] ?? 0,
            'between_price_from' => !empty($price) ? $price[0] : 0,
            'between_price_to' => !empty($price) ? $price[1] : 0,
            'search' => $params['search'] ?? null,
            'category_id' => $category_id_new,
            'status' => [1],
        ];


        $post = $this->productRepository->getAll($pPost, 20);

        $this->data['products'] = $post;
        $this->data['title'] = 'Sản phẩm';
        $total = !empty($post->total()) ? $post->total() : 0;
        $perPage = !empty($post->perPage()) ? $post->perPage() : 2;

        $page = !empty($request->page) ? $request->page : 1;
        unset($params['page']);
        $prefixPage = !empty($params) ? '' : '&';
        $url = route('frontend.product.edit', ['slug' => $categorySlug->slug]).'?'.Arr::query($params).$prefixPage;
        $this->data['pager'] = PaginationHelper::Pagination($total, $perPage, $page, $url);
        $this->data['params'] = $params;
        $this->data['category'] = $category;


        $imageSeo ='';
        if($categorySlug->default() && $categorySlug->default()['url']){
            $imageSeo =  str_replace(Str::of($categorySlug->default()['url'])->basename(),Str::of($categorySlug->default()['url'])->basename(),asset('storage/category/'.$categorySlug->default()['url']));
        }

        $title = $categorySlug->meta_title ?? $categorySlug->name ;
        $description = $categorySlug->meta_description ?? $categorySlug->description ?? $title;
        $keywords = $categorySlug->meta_keywords ?? $categorySlug->description ?? $title;
        View::share('title', $title);
        View::share('description', $description);
        View::share('keywords', $keywords);
        View::share('author', 'kenjivietnam.vn');
        View::share('imageSeo', $imageSeo);

        return view('components.frontend.products.category', $this->data);
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
    public function store(StoreProductRequest $request)
    {
        $params = $request->safe()->only(['phone', 'email', 'message']);
        $product_id = $request->product_id ?? 0;
        $number_star = $request->input('number_star') ?? 5;
        $product = $this->productRepository->getById($product_id);
        if ( !$product ) {
            return redirect()->route('frontend.home.index');
        }

        DB::beginTransaction();
        try {

            $user = Auth::guard('web')->user();
            $params['user_id'] = $user ? $user->id : 0;
            $comment = new Comment();
            $comment->phone = $params['phone'];
            $comment->email = $params['email'];
            $comment->message = $params['message'];
            $comment->name = $user ? 'Khách hàng Kiwi - '.$user->name : 'Khách hàng Kiwi';
            $comment->user_id = $user ? $user->id : 0;
            $comment->status = 0;
            $comment->number_star = in_array($number_star,StarType::NumberStart) ? $number_star : 5;
            $commentLast = $product->comments()->save($comment);
            $commentInfo = Comment::find($commentLast->id);
            if ( $request->hasfile('voteImage') ) {
                $n = count($request->file('voteImage'));
                $date = date('Y/m/d');
                foreach ( $request->file('voteImage') as $key => $file ) {
                    $path = $file->store('products/'.$date);
                    $aImage = $file->hashName();
                    $photo = new Image();
                    $photo->url = $date.'/'.$aImage;
                    $photo->is_default = ( $key == $n -  1) ? 1 : 0;
                    $photo->filename = $file->getClientOriginalName();
                    $photo->comment_id = $commentLast->id;
                    $photo->user_id = $user ? $user->id : 0;
                    $commentInfo->image()->save($photo);
                    $pathOld = public_path('storage/products/'.$date.'/'.$aImage);
                    $fileNew = public_path('storage/products/'.$date.'/thumb_'.$aImage);
                    $fileNewSize = public_path('storage/products/'.$date.'/thumb_50x50_'.$aImage);

                    // size height 165
                    $img = ImageIntervention::make($pathOld);
                    $img->heighten(200, function ($constraint) {
                        $constraint->upsize();
                    });
                    $img->save($fileNew);

                    // size height 50
                    $img->fit(50, 50, function ($constraint) {
                        $constraint->upsize();
                    });
                    $img->save($fileNewSize);
                }
            }
            DB::commit();
            return redirect()->route('frontend.home.index')->with('success', 'Bạn đã đánh giá thành công');
        } catch ( \Exception $e ) {
            DB::rollback();
            return redirect()->route('frontend.home.index');
        } catch ( \Throwable $e ) {
            DB::rollback();
            return redirect()->route('frontend.home.index');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $slug)
    {
        $product = $this->productRepository->getBySlug($slug);
        if ( !$product ) {
            $post = $this->postRepository->getBySlug($slug);

            $categorySlug = $this->categoryRepository->getSlug($slug);
            if($categorySlug)  {
                return self::categorySubSub($request,$slug);
            }else if($post) {
                return self::news($slug);
            }else {
                return response()->view('errors.404', [], 404);
            }
        }

        CookiesHelper::setCookies($product->id);
        $this->data['product'] = $product;
        $this->data['productOthers'] = $this->productRepository->getAll([
            'notInId' => $product->id,
            'category_id' => [$product->category_id],
            'status' => [1]
        ]);
        $this->data['productNew'] = $this->productRepository->getAll([
            'not_in_category_id' => [$product->category_id],
            'status' => [1],
        ]);

        // Seo key word
        $imageSeo = '';
        if ( $product->default() && $product->default()['url'] ) {
            $imageSeo = str_replace(Str::of($product->default()['url'])->basename(),
                Str::of($product->default()['url'])->basename(), asset('storage/products/'.$product->default()['url']));
        }
        View::share('title', $product->meta_title ?? $product->name);
        View::share('description', $product->meta_description ?? $product->name);
        View::share('keywords', $product->meta_keywords ?? $product->name);
        View::share('author', 'KenJi');
        View::share('imageSeo', $imageSeo);

        return view('components.frontend.products.show', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $slug)
    {

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
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function news($slug = '')
    {
        $post = $this->postRepository->getBySlug($slug);
        if(!$post) {
            return redirect()->route('frontend.home.index');
        }
        $this->data['post'] = $post;
        $this->data['category'] = $this->categoryRepository->getAll(['module_id'=>[ModuleType::News]]);
        $pOtherSameNews = [
            'module_id'=>[ModuleType::News],
            'category_id'=>[$post->category_id],
            'notInId'=>$post->id
        ];
        $this->data['otherSameNews'] = $this->postRepository->getAll($pOtherSameNews);
        $this->data['otherNews'] = $this->postRepository->getAll(['not_in_category_id'=>[$post->category_id]]);
        $this->data['products'] = $this->productRepository->getAll([]);

        $this->data['showroom'] = $this->showRoomRepository->getAll([],3);
        $this->data['numberShowRoom'] = $this->showRoomRepository->getTotal();
        $this->data['province'] = $this->provinceRepository->getAll([],null);


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
}
