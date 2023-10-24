<?php

namespace App\Http\Controllers\Backend\Unit;

use App\Enums\Departments\DepartmentStatusType;
use App\Helpers\PaginationHelper;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\BackendController;
use App\Http\Requests\Backend\Unit\StoreUnitRequest;
use App\Repositories\Units\UnitRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class UnitController extends BackendController
{

    private $unitRepository;
    protected $data = [];

    public function __construct( UnitRepository $unitRepository)
    {
        parent::__construct();
        $this->unitRepository = $unitRepository;
        $this->data['status'] = [
            DepartmentStatusType::Approved => 'Đang hoạt động',
            DepartmentStatusType::Deactivated => 'Ngừng hoạt động',
        ];
    }

    public function index( Request $request )
    {

        $users = $this->unitRepository->getAll([]);
        $this->data['title'] = 'Đơn Vị Tính';
        $this->data['items'] = $users;
        $total = !empty($users->total) ? $users->total : 0;
        $perPage = !empty($users->perPage) ? $users->perPage : 20;
        $page = !empty($request->page) ? $request->page : 1;
        $url = '?';
        $this->data['pager'] = PaginationHelper::BackendPagination($total, $perPage, $page, $url);
        View::share('title', $this->data['title']);
        return view('components.backend.unit.index', $this->data);
    }

    public function create()
    {
        $this->data['isEdit'] = 0;
        return view('components.backend.unit.create', $this->data);
    }


    public function store( StoreUnitRequest $request )
    {
        $params = $request->all();
        $post = $this->unitRepository->create($params);
        if ( !$post ) {
            return redirect()->route('backend.unit.index')->with('error', 'Server đang bận không thể tạo');
        }

        return redirect()->route('backend.unit.index')->with('success', 'Đã tạo tài thành công');
    }


    public function show( $id )
    {
        //
    }


    public function edit( $id )
    {
        $post = $this->unitRepository->getByID($id);
        $this->data['posts'] = $post;
        if ( !$post ) {
            return redirect()->route('backend.unit.index')->with('error', 'Không tìm thấy dữ liệu');
        }
        $this->data['isEdit'] = 1;
        return view('components.backend.unit.create', $this->data);
    }

    public function update( StoreUnitRequest $request, $id )
    {
        $params = $request->all();
        $post = $this->unitRepository->getByID($id);
        $users = $params['users'] ?? null;
        unset($params['users']);
        $this->data['posts'] = $post;
        if ( !$post ) {
            return redirect()->route('backend.unit.index')->with('error', 'Không tìm thấy dữ liệu');
        }
        $post->update($params);

        return redirect()->route('backend.unit.index')->with('success', 'Đã cập nhật thành công');
    }

    public function destroy( $id )
    {
        $post = $this->unitRepository->getByID($id);
        if ( !$post ) {
            return ResponseHelper::error('Không tìm thấy tài khoản');
        }

        $post->delete();
        return ResponseHelper::success('Đã xóa thành công');
    }
}
