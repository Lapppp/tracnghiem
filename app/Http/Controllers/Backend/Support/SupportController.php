<?php

namespace App\Http\Controllers\Backend\Support;

use App\Enums\Videos\VideoStatusType;
use App\Helpers\PaginationHelper;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\BackendController;
use App\Http\Requests\Backend\Support\StoreSupportRequest;
use App\Repositories\Support\SupportRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class SupportController extends BackendController
{

    private $supportRepository;
    protected $data = [];

    public function __construct(
        SupportRepository $supportRepository
    )
    {
        parent::__construct();
        $this->supportRepository = $supportRepository;
        $this->data['status'] = [
            VideoStatusType::Approved => 'Xuất bản',
            VideoStatusType::Deactivated => 'Nháp',
        ];
    }

    public function index( Request $request )
    {
        $users = $this->supportRepository->getAll([]);
        $this->data['title'] = 'Hỗ trợ';
        $this->data['items'] = $users;
        $total = !empty($users->total) ? $users->total : 0;
        $perPage = !empty($users->perPage) ? $users->perPage : 20;
        $page = !empty($request->page) ? $request->page : 1;
        $url = '?';
        $this->data['pager'] = PaginationHelper::BackendPagination($total, $perPage, $page, $url);
        View::share('title', $this->data['title']);
        return view('components.backend.support.index', $this->data);
    }

    public function edit( $id )
    {
        $post = $this->supportRepository->getByID($id);
        $this->data['posts'] = $post;
        if ( !$post ) {
            return redirect()->route('backend.support.index')->with('error', 'Không tìm thấy dữ liệu');
        }
        $this->data['isEdit'] = 1;
        return view('components.backend.support.create', $this->data);
    }

    public function update( StoreSupportRequest $request, $id )
    {
        $params = $request->all();
        $post = $this->supportRepository->getByID($id);
        $users = $params['users'] ?? null;
        unset($params['users']);
        $this->data['posts'] = $post;
        if ( !$post ) {
            return redirect()->route('backend.support.index')->with('error', 'Không tìm thấy dữ liệu');
        }
        $post->update($params);

        return redirect()->route('backend.support.index')->with('success', 'Đã cập nhật thành công');
    }

    public function destroy( $id )
    {
        $post = $this->supportRepository->getByID($id);
        if ( !$post ) {
            return ResponseHelper::error('Không tìm thấy tài khoản');
        }

        $post->delete();
        return ResponseHelper::success('Đã xóa thành công');
    }
}
