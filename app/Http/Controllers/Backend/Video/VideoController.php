<?php

namespace App\Http\Controllers\Backend\Video;

use App\Enums\Videos\VideoStatusType;
use App\Helpers\PaginationHelper;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\BackendController;
use App\Http\Requests\Backend\Video\StoreVideoRequest;
use App\Repositories\Videos\VideoRepository;
use Illuminate\Database\Eloquent\Model;
use App\Models\Images\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image as ImageIntervention;

class VideoController extends BackendController
{

    private $videoRepository,$categoryRepository;
    protected $data = [];

    public function __construct(
        VideoRepository $videoRepository
    )
    {
        parent::__construct();
        $this->videoRepository = $videoRepository;
        $this->data['status'] = [
            VideoStatusType::Approved => 'Xuất bản',
            VideoStatusType::Deactivated => 'Nháp',
        ];
    }

    public function index( Request $request )
    {
        $users = $this->videoRepository->getAll([]);
        $this->data['title'] = 'Videos';
        $this->data['items'] = $users;
        $total = !empty($users->total) ? $users->total : 0;
        $perPage = !empty($users->perPage) ? $users->perPage : 20;
        $page = !empty($request->page) ? $request->page : 1;
        $url = '?';
        $this->data['pager'] = PaginationHelper::BackendPagination($total, $perPage, $page, $url);
        View::share('title', $this->data['title']);
        return view('components.backend.video.index', $this->data);
    }

    public function create()
    {
        $this->data['isEdit'] = 0;
        return view('components.backend.video.create', $this->data);
    }


    public function store( StoreVideoRequest $request )
    {
        $params = $request->all();
        $post = $this->videoRepository->create($params);
        if ( !$post ) {
            return redirect()->route('backend.video.index')->with('error', 'Server đang bận không thể tạo');
        }

        if ( $request->hasfile('files') ) {


            $n = count($request->file('files'));
            $date = date('Y/m/d');
            foreach ( $request->file('files') as $key => $file ) {
                $file->store('video/' . $date);
                $aImage = $file->hashName();
                $pathOld = public_path('storage/video/' . $date . '/' . $aImage);
                $fileNewSize = public_path('storage/video/' . $date . '/thumb_50x50_' . $aImage);
                $img = ImageIntervention::make($pathOld);
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
        return redirect()->route('backend.video.index')->with('success', 'Đã tạo tài thành công');
    }


    public function show( $id )
    {
        //
    }


    public function edit( $id )
    {
        $post = $this->videoRepository->getByID($id);
        $this->data['posts'] = $post;
        if ( !$post ) {
            return redirect()->route('backend.video.index')->with('error', 'Không tìm thấy dữ liệu');
        }
        $this->data['isEdit'] = 1;
        return view('components.backend.video.create', $this->data);
    }

    public function update( StoreVideoRequest $request, $id )
    {
        $params = $request->all();
        $post = $this->videoRepository->getByID($id);
        $users = $params['users'] ?? null;
        unset($params['users']);
        $this->data['posts'] = $post;
        if ( !$post ) {
            return redirect()->route('backend.video.index')->with('error', 'Không tìm thấy dữ liệu');
        }
        $post->update($params);

        if ( $request->hasfile('files') ) {

            $images = $post->image()->get();
            if ( count($images) > 0 ) {
                foreach ( $images as $item ) {
                    $deleteFile = $item->url ?? null;
                    if ( !empty($deleteFile) ) {
                        $fileUnlink = Str::of('/' . $deleteFile)->basename();
                        @unlink(public_path('storage/video/' . $deleteFile));
                        @unlink(public_path('storage/video/' . str_replace($fileUnlink, 'thumb_50x50_' . $fileUnlink, $deleteFile)));
                    }
                    $item->delete();
                }
            }

            $n = count($request->file('files'));
            $date = date('Y/m/d');
            foreach ( $request->file('files') as $key => $file ) {
                $file->store('video/' . $date);
                $aImage = $file->hashName();

                $pathOld = public_path('storage/video/' . $date . '/' . $aImage);
                $fileNewSize = public_path('storage/video/' . $date . '/thumb_50x50_' . $aImage);
                $img = ImageIntervention::make($pathOld);
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

        return redirect()->route('backend.video.index')->with('success', 'Đã cập nhật thành công');
    }

    public function destroy( $id )
    {
        $post = $this->videoRepository->getByID($id);
        if ( !$post ) {
            return ResponseHelper::error('Không tìm thấy tài khoản');
        }

        $post->delete();
        return ResponseHelper::success('Đã xóa thành công');
    }
}
