<?php

namespace App\Http\Controllers\Backend\Region;

use App\Enums\Departments\DepartmentStatusType;
use App\Helpers\PaginationHelper;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\BackendController;
use App\Http\Requests\Backend\Region\StoreRegionRequest;
use App\Repositories\Region\RegionRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class RegionController extends BackendController
{

    private $regionRepository;
    protected $data = [];

    public function __construct( RegionRepository $regionRepository)
    {
        parent::__construct();
        $this->regionRepository = $regionRepository;
        $this->data['status'] = [
            DepartmentStatusType::Approved => 'Đang hoạt động',
            DepartmentStatusType::Deactivated => 'Ngừng hoạt động',
        ];
    }

    public function index( Request $request )
    {

        $users = $this->regionRepository->getAll([]);
        $this->data['title'] = 'Users';
        $this->data['items'] = $users;
        $total = !empty($users->total) ? $users->total : 0;
        $perPage = !empty($users->perPage) ? $users->perPage : 20;
        $page = !empty($request->page) ? $request->page : 1;
        $url = '?';
        $this->data['pager'] = PaginationHelper::BackendPagination($total, $perPage, $page, $url);
        View::share('title', $this->data['title']);
        return view('components.backend.region.index', $this->data);
    }

    public function create()
    {
        $this->data['isEdit'] = 0;
        return view('components.backend.region.create', $this->data);
    }


    public function store( StoreRegionRequest $request )
    {
        $params = $request->all();
        $post = $this->regionRepository->create($params);
        if ( !$post ) {
            return redirect()->route('backend.region.index')->with('error', 'Server đang bận không thể tạo');
        }

        return redirect()->route('backend.region.index')->with('success', 'Đã tạo tài thành công');
    }


    public function show( $id )
    {
        //
    }


    public function edit( $id )
    {
        $post = $this->regionRepository->getByID($id);
        $this->data['posts'] = $post;
        if ( !$post ) {
            return redirect()->route('backend.department.index')->with('error', 'Không tìm thấy dữ liệu');
        }
        $this->data['isEdit'] = 1;
        return view('components.backend.region.create', $this->data);
    }

    public function update( StoreRegionRequest $request, $id )
    {
        $params = $request->all();
        $post = $this->regionRepository->getByID($id);
        $users = $params['users'] ?? null;
        unset($params['users']);
        $this->data['posts'] = $post;
        if ( !$post ) {
            return redirect()->route('backend.region.index')->with('error', 'Không tìm thấy dữ liệu');
        }
        $post->update($params);

        return redirect()->route('backend.region.index')->with('success', 'Đã cập nhật thành công');
    }

    public function destroy( $id )
    {
        $post = $this->regionRepository->getByID($id);
        if ( !$post ) {
            return ResponseHelper::error('Không tìm thấy tài khoản');
        }

        $post->delete();
        return ResponseHelper::success('Đã xóa thành công');
    }
}
