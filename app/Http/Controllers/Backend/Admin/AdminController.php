<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Enums\Users\UserGenderType;
use App\Helpers\PaginationHelper;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\BackendController;
use App\Http\Requests\Backend\Admin\AdminCreateRequest;
use App\Repositories\Admin\AdminRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminController extends BackendController
{
    protected $data = [];
    protected $adminRepository;

    public function __construct( AdminRepository $adminRepository )
    {
        parent::__construct();
        $this->adminRepository = $adminRepository;
        $this->data['genders'] = [
            UserGenderType::Male => 'Nam',
            UserGenderType::Female => 'Nữ',
        ];
    }

    public function index( Request $request )
    {
        // Role::create(['name' => 'admin', 'team_id' => null]);
        $params = $request->only(['username', 'password']);
        $post = $this->adminRepository->getAll([], 20);

        $this->data['title'] = 'Users';
        $this->data['items'] = $post;
        $total = !empty($post->total()) ? $post->total() : 0;
        $perPage = !empty($post->perPage()) ? $post->perPage() : 2;

        $page = !empty($request->page) ? $request->page : 1;
        $url = route('backend.admin.index') . '?' . Arr::query($params);
        $this->data['pager'] = PaginationHelper::BackendPagination($total, $perPage, $page, $url);
        return view('components.backend.admin.index', $this->data);
    }

    public function create( Request $request )
    {
        $this->data['isEdit'] = 0;
        $this->data['admin'] = [];
        $this->data['roles'] = Role::all()->where('guard_name','backend');
        $this->data['role_select'] = [];
        return view('components.backend.admin.create', $this->data);
    }

    public function store( AdminCreateRequest $request )
    {
        $params = $request->all();
        $params['status'] = $params['status'] ?? 0;
        $params['password'] = Hash::make($params['password']);
        $admin = $this->adminRepository->create($params);
        if ( !$admin ) {
            return redirect()->route('backend.admin.index')->with('error', 'Server đang bận không thể tạo tài khoản được');
        }
        if(!empty($params['role'])){
             //$admin->assignRole($params['role']);
             $admin->syncRoles($params['role']);
        }
        return redirect()->route('backend.admin.index')->with('success', 'Đã tạo tài khoản thành công');
    }

    public function edit( $id = 0 )
    {
        $admin = $this->adminRepository->getByID($id);
        if ( !$admin ) {
            return redirect()->route('backend.admin.index')->with('error', 'Không tìm thấy dữ liệu');
        }

        $this->data['admin'] = $admin;
        $this->data['isEdit'] = 1;
        $this->data['roles'] = Role::all()->where('guard_name','backend');
        $this->data['role_select'] = $admin->getRoleNames()->toArray();
        return view('components.backend.admin.create', $this->data);
    }

    public function update(AdminCreateRequest $request,$id = 0)
    {
        $params = $request->all();
        $params['status'] = $params['status'] ?? 0;
        $admin = $this->adminRepository->getByID($id);
        if ( !$admin ) {
            return redirect()->route('backend.admin.index')->with('error', 'Không tìm thấy dữ liệu');
        }

        if(!empty($params['role'])){
           // $admin->assignRole($params['role']);
            $admin->syncRoles($params['role']);
        }

        //$user->assignRole('writer');
        $params['password'] = Hash::make($params['password']);
        if(empty($request->password)){
            unset($params['password']);
        }
        $admin->update($params);
        return redirect()->route('backend.admin.index')->with('success', 'Đã cập nhật tài khoản thành công');
    }

    public function destroy($id =  0)
    {
        $admin = $this->adminRepository->getByID($id);
        if(!$admin) {
            return ResponseHelper::error('Không tìm thấy tài khoản');
        }
        $admin->delete();
        return ResponseHelper::success('Đã xóa thành công');
    }
}
