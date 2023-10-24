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
use App\Repositories\Post\PostRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\View;
use Intervention\Image\Facades\Image as ImageIntervention;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class ResearchController extends BackendController
{

    private $data = [];
    protected $postRepository, $categoryRepository;

    public function __construct( PostRepository $postRepository, CategoryRepository $categoryRepository )
    {
        parent::__construct();
        View::share('title', 'Nghiên cứu trao đổi');
        $this->data['status'] = [
            PostStatusType::Approved => 'Xuất bản',
            PostStatusType::Deactivated => 'Nháp',
        ];

        $this->data['options'] = [
            PostStatusType::New => 'Mới',
            PostStatusType::Home => 'Xuất hiện trang chủ',
        ];
        $this->postRepository = $postRepository;
        $this->categoryRepository = $categoryRepository;
    }


    public function index( Request $request )
    {
        $params = $request->only(['username', 'password']);
        $post = $this->postRepository->getAll(['module_id'=>[ModuleType::Research]], 20);
        $this->data['title'] = 'Research';
        $this->data['items'] = $post;
        $total = !empty($post->total()) ? $post->total() : 0;
        $perPage = !empty($post->perPage()) ? $post->perPage() : 2;

        $page = !empty($request->page) ? $request->page : 1;
        $url = route('backend.research.index') . '?' . Arr::query($params);
        $this->data['pager'] = PaginationHelper::BackendPagination($total, $perPage, $page, $url);
        return view('components.backend.research.index', $this->data);
    }

    public function create()
    {
        $this->data['category'] = $this->categoryRepository->getAll(['module_id'=>[ModuleType::Research]]);
        $this->data['isEdit'] = 0;
        return view('components.backend.research.create', $this->data);
    }

    public function store( NewsCreateRequest $request )
    {
        $params = $request->all();
        $params['category_id'] = $params['category_id'] ?? 0;
        $params['module_id'] = ModuleType::Research;
        $post = $this->postRepository->create($params);
        if ( !$post ) {
            return redirect()->route('backend.research.index')->with('error', 'Server đang bận không thể tạo');
        }

        if ( $request->hasfile('files') ) {
            $n = count($request->file('files'));
            $date = date('Y/m/d');
            foreach ( $request->file('files') as $key => $file ) {
                $path = $file->store('products/' . $date);
                $aImage = $file->hashName();
                $photo = new Image();
                $photo->url = $date . '/' . $aImage;
                $photo->is_default = ( $key == $n - 1 ) ? 1 : 0;
                $photo->filename = $file->getClientOriginalName();
                $post->image()->save($photo);
                $pathOld = public_path('storage/products/' . $date . '/' . $aImage);
                $fileNew = public_path('storage/products/' . $date . '/thumb_' . $aImage);
                $fileNewSize = public_path('storage/products/' . $date . '/thumb_50x50_' . $aImage);

                // size height 165
                $img = ImageIntervention::make($pathOld);
                $img->heighten(165, function ( $constraint ) {
                    $constraint->upsize();
                });
                $img->save($fileNew);

                // size height 50
                $img->fit(50, 50, function ( $constraint ) {
                    $constraint->upsize();
                });
                $img->save($fileNewSize);


            }
        }
        return redirect()->route('backend.research.index')->with('success', 'Đã tạo  thành công');
    }

    public function edit( $id )
    {
        $post = $this->postRepository->getByID($id);
        $this->data['posts'] = $post;
        if ( !$post ) {
            return redirect()->route('backend.research.index')->with('error', 'Không tìm thấy dữ liệu');
        }
        $this->data['isEdit'] = 1;
        $this->data['category'] = $this->categoryRepository->getAll(['module_id'=>[ModuleType::Research]]);
        return view('components.backend.research.create', $this->data);
    }

    public function update( NewsCreateRequest $request, $id )
    {
        $params = $request->all();
        $params['status'] = $params['status'] ?? 0;
        $params['category_id'] = $params['category_id'] ?? 0;
        $params['updated_at'] = date('Y-m-d H:i:s');
        $post = $this->postRepository->getByID($id);
        if ( !$post ) {
            return redirect()->route('backend.research.index')->with('error', 'Không tìm thấy dữ liệu');
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
                $img->heighten(165, function ( $constraint ) {
                    $constraint->upsize();
                });
                $img->save($fileNew);

                // size height 50

                $img->fit(50, 50, function ( $constraint ) {
                    $constraint->upsize();
                });
                $img->save($fileNewSize);

                $photo = new Image();
                $photo->url = $date . '/' . $aImage;
                $photo->filename = $file->getClientOriginalName();
                $photo->is_default = ( $key == $n - 1 ) ? 1 : 0;
                $post->image()->save($photo);

            }
        }

        return redirect()->route('backend.research.index')->with('success', 'Đã cập nhật thành công');
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
        $post = $this->categoryRepository->getAll(['module_id'=>[ModuleType::Research]], 20);
        $this->data['title'] = 'News';
        $this->data['items'] = $post;
        $total = !empty($post->total()) ? $post->total() : 0;
        $perPage = !empty($post->perPage()) ? $post->perPage() : 2;

        $page = !empty($request->page) ? $request->page : 1;
        $url = route('backend.research.category') . '?' . Arr::query($params);
        $this->data['pager'] = PaginationHelper::BackendPagination($total, $perPage, $page, $url);
        return view('components.backend.research.category', $this->data);
    }

    public function createCategory()
    {
        $this->data['category'] = $this->categoryRepository->getAll(['module_id'=>[ModuleType::Research]]);
        $this->data['isEdit'] = 0;
        return view('components.backend.research.category-create', $this->data);
    }

    public function storeCategory( CategoryRequest $request )
    {
        $params = $request->all();
        $params['status'] = 1;
        $params['module_id'] = ModuleType::Research;
        $post = $this->categoryRepository->create($params);
        if ( !$post ) {
            return redirect()->route('backend.research.category')->with('error', 'Server đang bận không thể tạo');
        }

        return redirect()->route('backend.research.category')->with('success', 'Đã tạo tài thành công');
    }

    public function updateCategory( CategoryRequest $request, $id )
    {
        $params = $request->all();
        $params['status'] = 1;
        $post = $this->categoryRepository->getByID($id);
        if ( !$post ) {
            return redirect()->route('backend.research.category')->with('error', 'Không tìm thấy dữ liệu');
        }
        $post->update($params);

        return redirect()->route('backend.research.category')->with('success', 'Đã cập nhật thành công');
    }

    public function editCategory( $id )
    {
        $post = $this->categoryRepository->getByID($id);
        $this->data['posts'] = $post;
        if ( !$post ) {
            return redirect()->route('backend.research.category')->with('error', 'Không tìm thấy dữ liệu');
        }
        $this->data['isEdit'] = 1;
        return view('components.backend.research.category-create', $this->data);
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
}
