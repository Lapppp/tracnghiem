<?php

namespace App\Http\Controllers\Backend\ShowRoom;

use App\Enums\Departments\DepartmentStatusType;
use App\Helpers\PaginationHelper;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\BackendController;
use App\Http\Requests\Backend\ShowRoom\StoreShowRoomRequest;
use App\Repositories\Districts\DistrictRepository;
use App\Repositories\Provinces\ProvinceRepository;
use App\Repositories\ShowRooms\ShowRoomRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ShowRoomController extends BackendController
{

    private $showRoomRepository,$provinceRepository,$districtRepository;
    protected $data = [];

    public function __construct(
        ShowRoomRepository $showRoomRepository,
        ProvinceRepository $provinceRepository,
        DistrictRepository $districtRepository
    )
    {
        parent::__construct();
        $this->showRoomRepository = $showRoomRepository;
        $this->provinceRepository = $provinceRepository;
        $this->districtRepository = $districtRepository;
        $this->data['status'] = [
            DepartmentStatusType::Approved => 'Đang hoạt động',
            DepartmentStatusType::Deactivated => 'Ngừng hoạt động',
        ];
    }

    public function index( Request $request )
    {

        $users = $this->showRoomRepository->getAll([]);
        $this->data['title'] = 'ShowRoom';
        $this->data['items'] = $users;
        $total = !empty($users->total) ? $users->total : 0;
        $perPage = !empty($users->perPage) ? $users->perPage : 20;
        $page = !empty($request->page) ? $request->page : 1;
        $url = '?';
        $this->data['pager'] = PaginationHelper::BackendPagination($total, $perPage, $page, $url);
        View::share('title', $this->data['title']);
        return view('components.backend.showroom.index', $this->data);
    }

    public function create()
    {
        $this->data['isEdit'] = 0;
        $this->data['provinces'] = $this->provinceRepository->getAll([],null);
        $this->data['districts'] = $this->districtRepository->getAll([],null);
        return view('components.backend.showroom.create', $this->data);
    }


    public function store( StoreShowRoomRequest $request )
    {
        $params = $request->all();
        $post = $this->showRoomRepository->create($params);
        if ( !$post ) {
            return redirect()->route('backend.showroom.index')->with('error', 'Server đang bận không thể tạo');
        }

        return redirect()->route('backend.showroom.index')->with('success', 'Đã tạo tài thành công');
    }


    public function show( $id )
    {
        //
    }


    public function edit( $id )
    {
        $post = $this->showRoomRepository->getByID($id);
        $this->data['posts'] = $post;
        if ( !$post ) {
            return redirect()->route('backend.showroom.index')->with('error', 'Không tìm thấy dữ liệu');
        }
        $this->data['isEdit'] = 1;
        $this->data['provinces'] = $this->provinceRepository->getAll([],null);
        $this->data['districts'] = $this->districtRepository->getAll([],null);
        return view('components.backend.showroom.create', $this->data);
    }

    public function districts(Request $request) {

        $city_id = $request->province_id ?? 0;
        $selected_district = $request->district_id ?? 0;
        $districts = $this->districtRepository->getAll(['city_id'=>[$city_id]],null);
        $jsonHtml = view('components.backend.showroom.districts',['districts'=>$districts,'selected_district'=>$selected_district])->render();
        $data = [
            'jsonHtml'=>$jsonHtml
        ];
        return ResponseHelper::success('Thành Công',$data);
    }

    public function update( StoreShowRoomRequest $request, $id )
    {
        $params = $request->all();
        $post = $this->showRoomRepository->getByID($id);
        $users = $params['users'] ?? null;
        unset($params['users']);
        $this->data['posts'] = $post;
        if ( !$post ) {
            return redirect()->route('backend.showroom.index')->with('error', 'Không tìm thấy dữ liệu');
        }
        $post->update($params);

        return redirect()->route('backend.showroom.index')->with('success', 'Đã cập nhật thành công');
    }

    public function destroy( $id )
    {
        $post = $this->showRoomRepository->getByID($id);
        if ( !$post ) {
            return ResponseHelper::error('Không tìm thấy tài khoản');
        }

        $post->delete();
        return ResponseHelper::success('Đã xóa thành công');
    }
}
