<?php

namespace App\Http\Controllers\Backend\Post;

use App\Enums\Modules\ModuleType;
use App\Enums\Posts\PostStatusType;
use App\Helpers\PaginationHelper;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\BackendController;
use App\Http\Requests\Backend\Category\CategoryRequest;
use App\Http\Requests\Backend\Post\NewsCreateRequest;
use App\Models\Images\Image;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Images\ImageRepository;
use App\Repositories\Post\PostRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Intervention\Image\Facades\Image as ImageIntervention;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;

class NewsController extends BackendController
{

    private $data = [];
    protected $postRepository, $categoryRepository,$imageRepository;

    public function __construct(
        PostRepository $postRepository,
        CategoryRepository $categoryRepository,
        ImageRepository $imageRepository
    )
    {

        parent::__construct();
        $this->data['title'] = 'Tin tức';
        View::share('title', 'Tin tức');

        $this->data['status'] = [
            PostStatusType::Approved => 'Xuất bản',
            PostStatusType::Deactivated => 'Nháp',
        ];

        $this->data['options'] = [
            PostStatusType::New => 'Mới',
            PostStatusType::Home => 'Xuất hiện trang chủ vị trí 1',
            PostStatusType::HomeTwo => 'Xuất hiện trang chủ vị trí 2',
            PostStatusType::HomeThree => 'Xuất hiện trang chủ vị trí 3',
        ];
        $this->postRepository = $postRepository;
        $this->categoryRepository = $categoryRepository;
        $this->imageRepository = $imageRepository;
    }


    public function index( Request $request )
    {
        $params = $request->only(['username', 'password']);
        $status = !empty($request->status) ?  explode(',', $request->status) : [];
        $post = $this->postRepository->getAll(['module_id'=>[ModuleType::News],'search'=>$request->search,'status'=>$status]);


        $this->data['items'] = $post;
        $total = !empty($post->total()) ? $post->total() : 0;
        $perPage = !empty($post->perPage()) ? $post->perPage() : 2;
        $page = !empty($request->page) ? $request->page : 1;
        $url = route('backend.news.index') . '?' . Arr::query($params);
        $this->data['pager'] = PaginationHelper::BackendPagination($total, $perPage, $page, $url);


        return view('components.backend.news.index', $this->data);
    }

    public function create()
    {
        $this->data['category'] = $this->categoryRepository->getAll(['module_id'=>[ModuleType::News]]);
        $this->data['isEdit'] = 0;
        return view('components.backend.news.create', $this->data);
    }

    public function store( NewsCreateRequest $request )
    {
        $params = $request->all();
        $params['category_id'] = $params['category_id'] ?? 0;
        $params['module_id'] = ModuleType::News;
        $post = $this->postRepository->create($params);
        if ( !$post ) {
            return redirect()->route('backend.news.index')->with('error', 'Server đang bận không thể tạo');
        }

        if ( $request->hasfile('files') ) {
            $n = count($request->file('files'));
            $date = date('Y/m/d');
            foreach ( $request->file('files') as $key => $file ) {
                $path = $file->store('products/' . $date);
                $aImage = $file->hashName();
                $photo = new Image();
                $photo->url = $date . '/' . $aImage;
                $photo->is_default = ( $key ==  $n - 1 ) ? 1 : 0;
                $photo->filename = $file->getClientOriginalName();
                $post->image()->save($photo);
                $pathOld = public_path('storage/products/' . $date . '/' . $aImage);
                $fileNew = public_path('storage/products/' . $date . '/thumb_' . $aImage);
                $fileNewSize = public_path('storage/products/' . $date . '/thumb_50x50_' . $aImage);

                // size height 165
                $img = ImageIntervention::make($pathOld);
                $img->fit(360, 313, function ($constraint) {
                    $constraint->upsize();
                });
                $img->save($fileNew);

                // size height 50
                $img->fit(100, 120, function ( $constraint ) {
                    $constraint->upsize();
                });
                $img->save($fileNewSize);


            }
        }
        return redirect()->route('backend.news.index')->with('success', 'Đã tạo tài thành công');
    }

    public function edit( $id )
    {
        $post = $this->postRepository->getByID($id);
        $this->data['posts'] = $post;
        if ( !$post ) {
            return redirect()->route('backend.news.index')->with('error', 'Không tìm thấy dữ liệu');
        }
        $this->data['isEdit'] = 1;
        $this->data['category'] = $this->categoryRepository->getAll(['module_id'=>[ModuleType::News]]);
        return view('components.backend.news.create', $this->data);
    }

    public function update( NewsCreateRequest $request, $id )
    {
        $params = $request->all();
        $params['status'] = $params['status'] ?? 0;
        $params['category_id'] = $params['category_id'] ?? 0;
        $params['updated_at'] = date('Y-m-d H:i:s');
        $post = $this->postRepository->getByID($id);
        if ( !$post ) {
            return redirect()->route('backend.news.index')->with('error', 'Không tìm thấy dữ liệu');
        }
        $post->update($params);

        if ( $request->hasfile('files') ) {

            $images = $post->image()->get();
            if ( count($images) > 0 ) {
                foreach ( $images as $item ) {
                    $deleteFile = $item->url ?? null;
                    if ( !empty($deleteFile) ) {
                        $fileUnlink = Str::of('/' . $deleteFile)->basename();
                        @unlink(public_path('storage/products/' . $deleteFile));
                        @unlink(public_path('storage/products/' . str_replace($fileUnlink, 'thumb_' . $fileUnlink, $deleteFile)));
                        @unlink(public_path('storage/products/' . str_replace($fileUnlink, 'thumb_50x50_' . $fileUnlink, $deleteFile)));
                    }
                    $item->delete();
                }
            }

            $n = count($request->file('files'));
            $date = date('Y/m/d');
            foreach ( $request->file('files') as $key => $file ) {
                $file->store('products/' . $date);
                $aImage = $file->hashName();

                $pathOld = public_path('storage/products/' . $date . '/' . $aImage);
                $fileNew = public_path('storage/products/' . $date . '/thumb_' . $aImage);
                $fileNewSize = public_path('storage/products/' . $date . '/thumb_50x50_' . $aImage);

                // size height 165
                $img = ImageIntervention::make($pathOld);
                $img->fit(360, 313, function ($constraint) {
                    $constraint->upsize();
                });
                $img->save($fileNew);

                // size height 50

                $img->fit(100, 120, function ( $constraint ) {
                    $constraint->upsize();
                });
                $img->save($fileNewSize);

                $photo = new Image();
                $photo->url = $date . '/' . $aImage;
                $photo->is_default = ( $key == $n - 1 ) ? 1 : 0;
                $photo->filename = $file->getClientOriginalName();
                $post->image()->save($photo);

            }
        }

        return redirect()->route('backend.news.index')->with('success', 'Đã cập nhật thành công');
    }

    public function destroy( $id )
    {
        $post = $this->postRepository->getByID($id);
        if ( !$post ) {
            return ResponseHelper::error('Không tìm thấy tài khoản');
        }

        $images = $post->image()->get();
        if ( count($images) > 0 ) {
            foreach ( $images as $item ) {
                $deleteFile = $item->url ?? null;
                if ( !empty($deleteFile) ) {
                    $fileUnlink = Str::of('/' . $deleteFile)->basename();
                    @unlink(public_path('storage/products/' . $deleteFile));
                    @unlink(public_path('storage/products/' . str_replace($fileUnlink, 'thumb_' . $fileUnlink, $deleteFile)));
                    @unlink(public_path('storage/products/' . str_replace($fileUnlink, 'thumb_50x50_' . $fileUnlink, $deleteFile)));
                }
                $item->delete();
            }
        }

        $post->delete();
        return ResponseHelper::success('Đã xóa thành công');
    }

    public function category( Request $request )
    {
        $params = $request->only(['username', 'password']);
        $post = $this->categoryRepository->getAll(['module_id'=>[ModuleType::News]], 20);
        $this->data['title'] = 'News';
        $this->data['items'] = $post;
        $total = !empty($post->total()) ? $post->total() : 0;
        $perPage = !empty($post->perPage()) ? $post->perPage() : 2;

        $page = !empty($request->page) ? $request->page : 1;
        $url = route('backend.news.category') . '?' . Arr::query($params);
        $this->data['pager'] = PaginationHelper::BackendPagination($total, $perPage, $page, $url);
        return view('components.backend.news.category', $this->data);
    }

    public function createCategory()
    {
        $this->data['category_parents'] = $this->categoryRepository->getAll(['module_id'=>[ModuleType::News],'parent_id'=>[0]]);
        $this->data['isEdit'] = 0;
        return view('components.backend.news.category-create', $this->data);
    }

    public function storeCategory( CategoryRequest $request )
    {
        $params = $request->all();
        $params['status'] = 1;
        $params['module_id'] = ModuleType::News;
        $post = $this->categoryRepository->create($params);
        if ( !$post ) {
            return redirect()->route('backend.news.category')->with('error', 'Server đang bận không thể tạo');
        }

        return redirect()->route('backend.news.category')->with('success', 'Đã tạo tài thành công');
    }

    public function updateCategory( CategoryRequest $request, $id )
    {
        $params = $request->all();
        $params['status'] = 1;
        $post = $this->categoryRepository->getByID($id);
        if ( !$post ) {
            return redirect()->route('backend.news.category')->with('error', 'Không tìm thấy dữ liệu');
        }
        $post->update($params);

        return redirect()->route('backend.news.category')->with('success', 'Đã cập nhật thành công');
    }

    public function editCategory( $id )
    {
        $post = $this->categoryRepository->getByID($id);
        $this->data['posts'] = $post;
        if ( !$post ) {
            return redirect()->route('backend.news.category')->with('error', 'Không tìm thấy dữ liệu');
        }
        $this->data['isEdit'] = 1;
        $this->data['category_parents'] = $this->categoryRepository->getAll(['module_id'=>[ModuleType::News],'parent_id'=>[0]]);
        return view('components.backend.news.category-create', $this->data);
    }

    public function destroyCategory( $id )
    {
        $category = $this->categoryRepository->getByID($id);
        if ( !$category ) {
            return ResponseHelper::error('Không tìm thấy tài khoản');
        }
        $category->posts()->delete();
        $category->delete();
        return ResponseHelper::success('Đã xóa thành công');
    }

    public function updateImageDefault(Request $request) {
        $id = $request->post_id ?? 0;
        $image_id = $request->image_id ?? 0;
        $post = $this->postRepository->getByID($id);
        if($post) {
            $post->image()->update(['is_default' => 0 ]);
            $image = $this->imageRepository->getByID($image_id);
            $image->is_default = 1;
            $image->save();
            return ResponseHelper::success('Đã xóa thành công');
        }
        return ResponseHelper::error('Không tìm thấy tài khoản');
    }
}
