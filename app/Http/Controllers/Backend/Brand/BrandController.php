<?php

namespace App\Http\Controllers\Backend\Brand;

use App\Enums\Departments\DepartmentStatusType;
use App\Helpers\PaginationHelper;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\BackendController;
use App\Http\Requests\Backend\Brand\StoreBrandRequest;
use App\Repositories\Brand\BrandRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class BrandController extends BackendController
{

    private $brandRepository;
    protected $data = [];

    public function __construct( BrandRepository $brandRepository)
    {
        parent::__construct();
        $this->brandRepository = $brandRepository;
        $this->data['status'] = [
            DepartmentStatusType::Approved => 'Đang hoạt động',
            DepartmentStatusType::Deactivated => 'Ngừng hoạt động',
        ];
    }

    public function index( Request $request )
    {

        $users = $this->brandRepository->getAll([]);
        $this->data['title'] = 'Brand';
        $this->data['items'] = $users;
        $total = !empty($users->total) ? $users->total : 0;
        $perPage = !empty($users->perPage) ? $users->perPage : 20;
        $page = !empty($request->page) ? $request->page : 1;
        $url = '?';
        $this->data['pager'] = PaginationHelper::BackendPagination($total, $perPage, $page, $url);
        View::share('title', $this->data['title']);
        return view('components.backend.brand.index', $this->data);
    }

    public function create()
    {
        $this->data['isEdit'] = 0;
        return view('components.backend.brand.create', $this->data);
    }


    public function store( StoreBrandRequest $request )
    {
        $params = $request->all();
        $post = $this->brandRepository->create($params);
        if ( !$post ) {
            return redirect()->route('backend.brand.index')->with('error', 'Server đang bận không thể tạo');
        }

        return redirect()->route('backend.brand.index')->with('success', 'Đã tạo tài thành công');
    }


    public function show( $id )
    {
        //
    }


    public function edit( $id )
    {
        $post = $this->brandRepository->getByID($id);
        $this->data['posts'] = $post;
        if ( !$post ) {
            return redirect()->route('backend.department.index')->with('error', 'Không tìm thấy dữ liệu');
        }
        $this->data['isEdit'] = 1;
        return view('components.backend.brand.create', $this->data);
    }

    public function update( StoreBrandRequest $request, $id )
    {
        $params = $request->all();
        $post = $this->brandRepository->getByID($id);
        $users = $params['users'] ?? null;
        unset($params['users']);
        $this->data['posts'] = $post;
        if ( !$post ) {
            return redirect()->route('backend.brand.index')->with('error', 'Không tìm thấy dữ liệu');
        }
        $post->update($params);

        return redirect()->route('backend.brand.index')->with('success', 'Đã cập nhật thành công');
    }

    public function destroy( $id )
    {
        $post = $this->brandRepository->getByID($id);
        if ( !$post ) {
            return ResponseHelper::error('Không tìm thấy tài khoản');
        }

        $post->delete();
        return ResponseHelper::success('Đã xóa thành công');
    }
}
