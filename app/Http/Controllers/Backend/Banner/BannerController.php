<?php

namespace App\Http\Controllers\Backend\Banner;

use App\Enums\Banners\BannerStatusType;
use App\Enums\Posts\PostStatusType;
use App\Helpers\PaginationHelper;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\BackendController;

use App\Http\Requests\Backend\Banner\BannerCreateRequest;
use App\Models\Images\Image;
use App\Repositories\Banners\BannerRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image as ImageIntervention;

class BannerController extends BackendController
{


    private $bannerRepository;
    protected $data = [];

    public function __construct( BannerRepository $bannerRepository )
    {
        parent::__construct();
        $this->bannerRepository = $bannerRepository;
        $this->data['status'] = [
            BannerStatusType::Approved => 'Xuất bản',
            BannerStatusType::Deactivated => 'Nháp',
        ];

        $this->data['options'] = [
            PostStatusType::New => 'Vị trí 1',
            PostStatusType::Home => 'Vị trí 2',
            PostStatusType::HomeTwo => 'Vị trí 3',
        ];
    }

    public function index( Request $request )
    {

        $users = $this->bannerRepository->getAll([]);
        $this->data['title'] = 'Users';
        $this->data['items'] = $users;
        $total = !empty($users->total) ? $users->total : 0;
        $perPage = !empty($users->perPage) ? $users->perPage : 20;
        $page = !empty($request->page) ? $request->page : 1;
        $url = '?';
        $this->data['pager'] = PaginationHelper::BackendPagination($total, $perPage, $page, $url);
        View::share('title', $this->data['title']);
        return view('components.backend.banner.index', $this->data);
    }

    public function create()
    {
        $this->data['isEdit'] = 0;
        return view('components.backend.banner.create', $this->data);
    }


    public function store( BannerCreateRequest $request )
    {
        $params = $request->all();
        $params['position'] = 1;
        $params['type'] = 1;
        $post = $this->bannerRepository->create($params);
        if ( !$post ) {
            return redirect()->route('backend.banner.index')->with('error', 'Server đang bận không thể tạo');
        }

        if ( $request->hasfile('files') ) {
            $n = count($request->file('files'));
            $date = date('Y/m/d');
            foreach ( $request->file('files') as $key => $file ) {
                $file->store('banner/' . $date);
                $aImage = $file->hashName();
                $pathOld = public_path('storage/banner/' . $date . '/' . $aImage);
                $fileNewSize = public_path('storage/banner/' . $date . '/thumb_50x50_' . $aImage);
                $img = ImageIntervention::make($pathOld);
                $img->fit(50, 50, function ( $constraint ) {
                    $constraint->upsize();
                });
                $img->save($fileNewSize);

                $photo = new Image();
                $photo->url = $date . '/' . $aImage;
                $photo->device = 'Web';
                $photo->filename = $file->getClientOriginalName();
                $photo->is_default = ( $key == $n - 1 ) ? 1 : 0;
                $post->image()->save($photo);

            }
        }

        if ( $request->hasfile('images') ) {
            $n = count($request->file('images'));
            $date = date('Y/m/d');
            foreach ( $request->file('images') as $key => $file ) {
                $file->store('banner/' . $date);
                $aImage = $file->hashName();
                $pathOld = public_path('storage/banner/' . $date . '/' . $aImage);
                $fileNewSize = public_path('storage/banner/' . $date . '/thumb_50x50_' . $aImage);
                $img = ImageIntervention::make($pathOld);
                $img->fit(50, 50, function ( $constraint ) {
                    $constraint->upsize();
                });
                $img->save($fileNewSize);

                $photo = new Image();
                $photo->url = $date . '/' . $aImage;
                $photo->device = 'Mobile';
                $photo->filename = $file->getClientOriginalName();
                $photo->is_default = ( $key ==  $n - 1 ) ? 1 : 0;
                $post->image()->save($photo);

            }
        }

        return redirect()->route('backend.banner.index')->with('success', 'Đã tạo tài thành công');
    }


    public function show( $id )
    {
        //
    }


    public function edit( $id )
    {
        $post = $this->bannerRepository->getByID($id);
        $this->data['posts'] = $post;
        if ( !$post ) {
            return redirect()->route('backend.banner.index')->with('error', 'Không tìm thấy dữ liệu');
        }
        $this->data['isEdit'] = 1;
        return view('components.backend.banner.create', $this->data);
    }

    public function update( BannerCreateRequest $request, $id )
    {
        $params = $request->all();
        $post = $this->bannerRepository->getByID($id);
        $this->data['posts'] = $post;
        if ( !$post ) {
            return redirect()->route('backend.banner.index')->with('error', 'Không tìm thấy dữ liệu');
        }
        $post->update($params);

        if ( $request->hasfile('files') ) {

            $images = $post->image()->where('device','Web')->get();
            if ( count($images) > 0 ) {
                foreach ( $images as $item ) {
                    $deleteFile = $item->url ?? null;
                    if ( !empty($deleteFile) ) {
                        $fileUnlink = Str::of('/' . $deleteFile)->basename();
                        @unlink(public_path('storage/banner/' . $deleteFile));
                        @unlink(public_path('storage/banner/' . str_replace($fileUnlink, 'thumb_50x50_' . $fileUnlink, $deleteFile)));
                    }
                    $item->delete();
                }
            }

            $n = count($request->file('files'));
            $date = date('Y/m/d');
            foreach ( $request->file('files') as $key => $file ) {
                $file->store('banner/' . $date);
                $aImage = $file->hashName();

                $pathOld = public_path('storage/banner/' . $date . '/' . $aImage);
                $fileNewSize = public_path('storage/banner/' . $date . '/thumb_50x50_' . $aImage);
                $img = ImageIntervention::make($pathOld);
                $img->fit(50, 50, function ( $constraint ) {
                    $constraint->upsize();
                });
                $img->save($fileNewSize);

                $photo = new Image();
                $photo->url = $date . '/' . $aImage;
                $photo->device = 'Web';
                $photo->filename = $file->getClientOriginalName();
                $photo->is_default = ( $key ==  $n - 1 ) ? 1 : 0;
                $post->image()->save($photo);

            }
        }

        if ( $request->hasfile('images') ) {

            $images = $post->image()->where('device','Mobile')->get();
            if ( count($images) > 0 ) {
                foreach ( $images as $item ) {
                    $deleteFile = $item->url ?? null;
                    if ( !empty($deleteFile) ) {
                        $fileUnlink = Str::of('/' . $deleteFile)->basename();
                        @unlink(public_path('storage/banner/' . $deleteFile));
                        @unlink(public_path('storage/banner/' . str_replace($fileUnlink, 'thumb_50x50_' . $fileUnlink, $deleteFile)));
                    }
                    $item->delete();
                }
            }

            $n = count($request->file('images'));
            $date = date('Y/m/d');
            foreach ( $request->file('images') as $key => $file ) {
                $file->store('banner/' . $date);
                $aImage = $file->hashName();

                $pathOld = public_path('storage/banner/' . $date . '/' . $aImage);
                $fileNewSize = public_path('storage/banner/' . $date . '/thumb_50x50_' . $aImage);
                $img = ImageIntervention::make($pathOld);
                $img->fit(50, 50, function ( $constraint ) {
                    $constraint->upsize();
                });
                $img->save($fileNewSize);

                $photo = new Image();
                $photo->url = $date . '/' . $aImage;
                $photo->device = 'Mobile';
                $photo->filename = $file->getClientOriginalName();
                $photo->is_default = ( $key ==  $n - 1 ) ? 1 : 0;
                $post->image()->save($photo);

            }
        }

        return redirect()->route('backend.banner.index')->with('success', 'Đã cập nhật thành công');
    }

    public function destroy( $id )
    {
        $post = $this->bannerRepository->getByID($id);
        if ( !$post ) {
            return ResponseHelper::error('Không tìm thấy tài khoản');
        }

        $images = $post->image()->get();
        if ( count($images) > 0 ) {
            foreach ( $images as $item ) {
                $deleteFile = $item->url ?? null;
                if ( !empty($deleteFile) ) {
                    $fileUnlink = Str::of('/' . $deleteFile)->basename();
                    @unlink(public_path('storage/banner/' . $deleteFile));
                    @unlink(public_path('storage/banner/' . str_replace($fileUnlink, 'thumb_50x50_' . $fileUnlink, $deleteFile)));
                }
                $item->delete();
            }
        }

        $post->delete();
        return ResponseHelper::success('Đã xóa thành công');
    }
}
