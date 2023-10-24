<?php

namespace App\Http\Controllers\Backend\Department;

use App\Enums\Departments\DepartmentStatusType;
use App\Enums\Departments\UsersAdminDepartmentStatusType;
use App\Helpers\PaginationHelper;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\BackendController;

use App\Http\Requests\Backend\Department\DepartmentCreateRequest;
use App\Models\Departments\AdminDepartment;
use App\Repositories\Admin\AdminRepository;
use App\Repositories\Departments\DepartmentRepository;
use App\Repositories\Users\UserAdminDepartmentRepository;
use App\Repositories\Users\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class DepartmentController extends BackendController
{


    private $departmentRepository,$adminRepository,$userAdminDepartmentRepository;
    protected $data = [];

    public function __construct(
        DepartmentRepository $departmentRepository,
        AdminRepository $adminRepository,
        UserAdminDepartmentRepository $userAdminDepartmentRepository
    )
    {
        parent::__construct();
        $this->departmentRepository = $departmentRepository;
        $this->adminRepository = $adminRepository;
        $this->userAdminDepartmentRepository = $userAdminDepartmentRepository;
        $this->data['status'] = [
            DepartmentStatusType::Approved => 'Đang hoạt động',
            DepartmentStatusType::Deactivated => 'Ngừng hoạt động',
        ];
    }

    public function index( Request $request )
    {

        $users = $this->departmentRepository->getAll([]);
        $this->data['title'] = 'Users';
        $this->data['items'] = $users;
        $total = !empty($users->total) ? $users->total : 0;
        $perPage = !empty($users->perPage) ? $users->perPage : 20;
        $page = !empty($request->page) ? $request->page : 1;
        $url = '?';
        $this->data['pager'] = PaginationHelper::BackendPagination($total, $perPage, $page, $url);
        View::share('title', $this->data['title']);
        return view('components.backend.department.index', $this->data);
    }

    public function create()
    {
        $this->data['isEdit'] = 0;
        $this->data['users'] = $this->adminRepository->getAll(['status'=>[1]],null);
        $this->data['users_manager'] = $this->adminRepository->getAll(['status'=>[1]],null);
        $this->data['users_selected'] = [];
        $this->data['users_manager_selected'] = [];
        return view('components.backend.department.create', $this->data);
    }


    public function store( DepartmentCreateRequest $request )
    {
        $params = $request->all();
        $users = $params['users'] ?? null;
        $manager = $params['manager'] ?? 0;
        unset($params['users']);
        $post = $this->departmentRepository->create($params);
        if ( !$post ) {
            return redirect()->route('backend.department.index')->with('error', 'Server đang bận không thể tạo');
        }
        if(!empty($users)){
            $date = date('Y-m-d H:i:s');
            //$post->admins()->sync($users,['is_manager' => 0,'created_at'=>$date,'updated_at'=>$date]);
           // $post->admins()->attach($users, ['created_at' => $date,'updated_at'=>$date]);
            $post->admins()->syncWithPivotValues($users, ['created_at' => $date,'updated_at'=>$date]);
           // $post->admins()->detach($users, ['created_at' => $date,'updated_at'=>$date]);
           // $post->admins()->syncWithPivotValues(8, ['is_manager' => 1]);

            if($manager){
                $this->departmentRepository->updateManager($post->id,$manager,1);
            }

        }

        return redirect()->route('backend.department.index')->with('success', 'Đã tạo tài thành công');
    }


    public function show( $id )
    {
        //
    }


    public function edit( $id )
    {
        $post = $this->departmentRepository->getByID($id);
        $this->data['posts'] = $post;
        if ( !$post ) {
            return redirect()->route('backend.department.index')->with('error', 'Không tìm thấy dữ liệu');
        }
        $this->data['users'] = $this->adminRepository->getAll(['status'=>[1]],null);
        $this->data['isEdit'] = 1;
        $this->data['users_selected'] = $post->admins()->get()->pluck('id')->toArray();
        $this->data['users_manager'] = $this->adminRepository->getAll(['status'=>[1],'id'=>$this->data['users_selected']],null);
        $manager = $post->manager()->first() ;
        $this->data['users_manager_selected'] = !empty($manager) ? $manager->id : 0;
        return view('components.backend.department.create', $this->data);
    }

    public function update( DepartmentCreateRequest $request, $id )
    {
        $params = $request->all();
        $post = $this->departmentRepository->getByID($id);
        $users = $params['users'] ?? null;
        $manager = $params['manager'] ?? 0;
        unset($params['users']);
        $this->data['posts'] = $post;
        if ( !$post ) {
            return redirect()->route('backend.department.index')->with('error', 'Không tìm thấy dữ liệu');
        }
        $post->update($params);

        if(!empty($users)){
            $date = date('Y-m-d H:i:s');
           // $post->admins()->sync($users,['is_manager' => 0,'created_at'=>$date,'updated_at'=>$date]);
            $post->admins()->syncWithPivotValues($users, ['created_at' => $date,'updated_at'=>$date]);
           // $post->admins()->attach($users, ['created_at' => $date,'updated_at'=>$date]);
           // $post->admins()->detach($users, ['created_at' => $date,'updated_at'=>$date]);
            if($manager){
                $this->departmentRepository->updateResetManagerDepartment($post->id,0);
                $this->departmentRepository->updateManager($post->id,$manager,1);

                // cập nhật lại trưởng phòng cho bảng users_admin_department
                $newManager = $this->userAdminDepartmentRepository->checkUserAdminManagerDepartment([
                    'department_id'=>$post->id,
                    'type'=>UsersAdminDepartmentStatusType::Manager,
                ]);
                if($newManager) {
                    $newManager->update(['admin_id'=>$manager]);
                }
            }

        }

        return redirect()->route('backend.department.index')->with('success', 'Đã cập nhật thành công');
    }

    public function destroy( $id )
    {
        $post = $this->departmentRepository->getByID($id);
        if ( !$post ) {
            return ResponseHelper::error('Không tìm thấy tài khoản');
        }
        $post->admins()->detach();
        $post->delete();

        return ResponseHelper::success('Đã xóa thành công');
    }
}
