<?php

namespace App\Http\Controllers\Backend\Comment;

use App\Enums\Comments\CommentStatusType;
use App\Helpers\PaginationHelper;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\BackendController;
use App\Http\Requests\Backend\Comment\StoreCommentRequest;
use App\Models\Post\Comment;
use App\Repositories\Comments\CommentRepository;
use App\Repositories\Products\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\View;
use App\Models\Images\Image;
use Intervention\Image\Facades\Image as ImageIntervention;

class CommentController extends BackendController
{
    protected $data = [];
    protected $commentRepository, $productRepository;

    public function __construct(
        CommentRepository $commentRepository,
        ProductRepository $productRepository
    ) {
        parent::__construct();
        $this->commentRepository = $commentRepository;
        $this->productRepository = $productRepository;
        $this->data['status'] = [
            CommentStatusType::Deactivated => 'Ẩn đánh giá',
            CommentStatusType::Approved => 'Hiển thị đánh giá'
        ];
    }

    public function index(Request $request)
    {
        //$user = Auth()->guard('backend')->user()->toArray();
        $params = $request->all();
        $paramsData = [
            'search' => $request->search ?? '',
            'status' => !empty($params['status']) ? [$params['status']] : [],
        ];
        $users = $this->commentRepository->getAll($paramsData);
        $this->data['title'] = 'Đánh giá';
        $this->data['items'] = $users;
        $total = !empty($users->total()) ? $users->total() : 0;
        $perPage = !empty($users->perPage()) ? $users->perPage() : 20;
        $page = !empty($request->page) ? $request->page : 1;
        unset($params['page']);
        $url = route('backend.comments.index').'?'.Arr::query($params).'&';
        $this->data['pager'] = PaginationHelper::BackendPagination($total, $perPage, $page, $url);
        View::share('title', $this->data['title']);
        return view('components.backend.comment.index', $this->data);
    }

    public function create(Request $request)
    {
        $this->data['isEdit'] = 0;
        $this->data['products'] = $this->productRepository->getAll([], null);
        return view('components.backend.comment.create', $this->data);
    }

    public function store(StoreCommentRequest $request)
    {
        $params = $request->all();
        $product = $this->productRepository->getById($params['product_id']);
        if ( !$product ) {
            return redirect()->route('backend.comments.index');
        }

        $comment = new Comment();
        $comment->phone = $params['phone'];
        $comment->email = $params['email'];
        $comment->message = $params['message'];
        $comment->name = $params['name'];
        $comment->user_id = 0;
        $comment->status = $params['status'];
        $comment->number_star = $params['number_star'];
        $commentLast = $product->comments()->save($comment);
        $commentInfo = Comment::find($commentLast->id);

        if ( $request->hasfile('files') ) {
            $n = count($request->file('files'));
            $date = date('Y/m/d');
            foreach ( $request->file('files') as $key => $file ) {
                $file->store('products/'.$date);
                $aImage = $file->hashName();
                $photo = new Image();
                $photo->url = $date.'/'.$aImage;
                $photo->is_default = ( $key == $n - 1) ? 1 : 0;
                $photo->filename = $file->getClientOriginalName();
                $photo->comment_id = $commentLast->id;
                $photo->user_id = 0;
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

        return redirect()->route('backend.comments.index');

    }

    public function edit($id = 0) {

        $comment = $this->commentRepository->getById($id);
        if(!$comment) {
            return redirect()->route('backend.comments.index');
        }

        $this->data['isEdit'] = 1;
        $this->data['posts'] = $comment;
        $this->data['products'] = $this->productRepository->getAll([], null);
        return view('components.backend.comment.create', $this->data);
    }

    public function update(StoreCommentRequest $request, $id) {
        $params = $request->all();
        $comment = $this->commentRepository->getById($id);
        $product = $this->productRepository->getById($params['product_id']);
        if ( !$product ) {
            return redirect()->route('backend.comments.index');
        }

        $comment->phone = $params['phone'];
        $comment->email = $params['email'];
        $comment->message = $params['message'];
        $comment->name = $params['name'];
        $comment->user_id = 0;
        $comment->status = $params['status'];
        $comment->number_star = $params['number_star'];
        $comment->save();

        if ( $request->hasfile('files') ) {
            $n = count($request->file('files'));
            $date = date('Y/m/d');
            foreach ( $request->file('files') as $key => $file ) {
                $file->store('products/'.$date);
                $aImage = $file->hashName();
                $photo = new Image();
                $photo->url = $date.'/'.$aImage;
                $photo->is_default = ($key == $n - 1) ? 1 : 0;
                $photo->filename = $file->getClientOriginalName();
                $photo->comment_id = $comment->id;
                $photo->user_id = 0;
                $comment->image()->save($photo);
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

        return redirect()->route('backend.comments.index');
    }

    public function destroy($id)
    {
        $post = $this->commentRepository->getByID($id);
        if ( !$post ) {
            return ResponseHelper::error('Không tìm thấy tài khoản');
        }

        $post->delete();
        return ResponseHelper::success('Đã xóa thành công');
    }

}
