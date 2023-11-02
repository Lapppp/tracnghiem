<?php

namespace App\Http\Controllers\Backend\User;

use App\Enums\Departments\UsersAdminDepartmentStatusType;
use App\Enums\Roles\RoleType;
use App\Enums\Users\ExpiryDateType;
use App\Enums\Users\UserGenderType;
use App\Helpers\PaginationHelper;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\BackendController;
use App\Http\Requests\Backend\User\UserRequest;
use App\Http\Requests\Backend\User\UsersImportRequest;
use App\Models\Images\Image;
use App\Repositories\Departments\DepartmentRepository;
use App\Repositories\Region\RegionRepository;
use App\Repositories\Users\UserAdminDepartmentRepository;
use App\Repositories\Users\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image as ImageIntervention;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Auth;

class UserController extends BackendController
{
    protected $data = [];
    protected $userRepository;
    protected $regionRepository;
    protected $departmentRepository;
    protected $userAdminDepartmentRepository;

    public function __construct(
        UserRepository $userRepository,
        RegionRepository $regionRepository,
        DepartmentRepository $departmentRepository,
        UserAdminDepartmentRepository $userAdminDepartmentRepository
    ) {
        parent::__construct();
        $this->data['genders'] = [
            UserGenderType::Male => 'Nam',
            UserGenderType::Female => 'Nữ',
        ];
        $this->userRepository = $userRepository;
        $this->regionRepository = $regionRepository;
        $this->departmentRepository = $departmentRepository;
        $this->userAdminDepartmentRepository = $userAdminDepartmentRepository;
        $this->data['vip'] = ExpiryDateType::getExpiryDate();
    }

    public function index(Request $request)
    {
        $params = $request->all();
        // Role::create(['name' => 'admin', 'team_id' => null]);
        $user = Auth::guard('backend')->user();
        $roles = $user->getRoleNames()->toArray();
        $flag = false;
        if (count($roles) > 0) {
            if (
                in_array(RoleType::manager, $roles) ||
                in_array(RoleType::employee_main, $roles) ||
                in_array(RoleType::employee_sub, $roles)
            ) {
                $flag = true;
            }
        }

        // Nếu là trưởng phòng, nhân viên chính, nhân viên phụ
        if ($flag) {
            $lsCustomer = $user->managementUser()->pluck('user_id');
            $params['id'] = count($lsCustomer) > 0 ? $lsCustomer->toArray() : [0];
        }
        $post = $this->userRepository->getAll($params, 20);
        $this->data['title'] = 'Users';
        $this->data['items'] = $post;
        $total = !empty($post->total()) ? $post->total() : 0;
        $perPage = !empty($post->perPage()) ? $post->perPage() : 2;

        $page = !empty($request->page) ? $request->page : 1;
        $url = route('backend.users.index') . '?' . Arr::query($params);
        $this->data['pager'] = PaginationHelper::BackendPagination($total, $perPage, $page, $url);
        return view('components.backend.user.index', $this->data);
    }

    public function create(Request $request)
    {
        $this->data['isEdit'] = 0;
        $this->data['admin'] = [];
        $this->data['roles'] = Role::all()->where('guard_name', 'web');
        $this->data['role_select'] = [];
        $this->data['regions'] = $this->regionRepository->getAll([]);
        $this->data['departments'] = $this->departmentRepository->getAll([]);
        return view('components.backend.user.create', $this->data);
    }

    public function store(UserRequest $request)
    {
        $params = $request->all();
        $params['status'] = $params['status'] ?? 0;
        $params['username'] = $params['phone'] ?? 0;
        $department_id = $params['department_id'] ?? 0;
        $params['password'] = Hash::make($params['password']);

        $admin = $this->userRepository->create($params);
        if (!$admin) {
            return redirect()->route('backend.users.index')->with('error', 'Server đang bận không thể tạo tài khoản được');
        }

        if ($request->hasfile('image')) {

            $date = date('Y/m/d');
            $request->file('image')->store('avatar/' . $date);
            $aImage = $request->file('image')->hashName();
            $pathOld = public_path('storage/avatar/' . $date . '/' . $aImage);
            $fileNewSize = public_path('storage/avatar/' . $date . '/thumb_50x50_' . $aImage);
            $img = ImageIntervention::make($pathOld);
            $img->fit(50, 50, function ($constraint) {
                $constraint->upsize();
            });
            $img->save($fileNewSize);

            $photo = new Image();
            $photo->url = $date . '/' . $aImage;
            $photo->is_default = 1;
            $admin->image()->save($photo);
        }

        if (!empty($params['role'])) {
            //$admin->assignRole($params['role']);
            $admin->syncRoles($params['role']);
        }

        $department = $this->departmentRepository->getById($department_id);
        if ($department) {

            $manager = $department->manager()->first();
            if ($manager) {
                $p = [
                    'user_id' => $admin->id,
                    'admin_id' => $manager->id,
                    'department_id' => $department_id,
                    'type' => UsersAdminDepartmentStatusType::Manager,
                ];
                $this->userAdminDepartmentRepository->create($p);
            }
        }

        return redirect()->route('backend.users.index')->with('success', 'Đã tạo tài khoản thành công');
    }

    public function edit($id = 0)
    {
        $admin = $this->userRepository->getByID($id);
        if (!$admin) {
            return redirect()->route('backend.users.index')->with('error', 'Không tìm thấy dữ liệu');
        }

        $this->data['admin'] = $admin;
        $this->data['regions'] = $this->regionRepository->getAll([]);
        $this->data['departments'] = $this->departmentRepository->getAll([]);
        $this->data['isEdit'] = 1;
        $this->data['roles'] = Role::all()->where('guard_name', 'web');
        $this->data['role_select'] = $admin->getRoleNames()->toArray();
        return view('components.backend.user.create', $this->data);
    }

    public function update(UserRequest $request, $id = 0)
    {
        $params = $request->all();
        $params['status'] = $params['status'] ?? 0;
        $params['username'] = $params['phone'] ?? 0;
        $params['updated_at'] = date('Y-m-d H:i:i');
        $admin = $this->userRepository->getByID($id);
        $departmentOld = $this->departmentRepository->getById($admin->department_id);
        if (!$admin) {
            return redirect()->route('backend.users.index')->with('error', 'Không tìm thấy dữ liệu');
        }

        if (!empty($params['role'])) {
            // $admin->assignRole($params['role']);
            $admin->syncRoles($params['role']);
        }

        //$user->assignRole('writer');
        $params['password'] = Hash::make($params['password']);
        if (empty($request->password)) {
            unset($params['password']);
        }


        /*
        $department_id = $params['department_id'] ?? 0;
        $department = $this->departmentRepository->getById($department_id);
        $manager = $department->manager()->first();
        */

        //Nếu khác phòng ban trước đó
        /*
        if ($department_id != $admin->department_id) {
            $checkManager = $this->userAdminDepartmentRepository->checkUserAdminManagerDepartment(
                [
                    'department_id' => $admin->department_id,
                    'type' => UsersAdminDepartmentStatusType::Manager,
                ]
            );
            // Nếu có trưởng phòng trước đó
            if ($checkManager) {

                $checkManager->update([
                    'admin_id' => $manager->id,
                    'department_id' => $department_id
                ]);

                // Xóa các thành viên khác, để cho trưởng phòng mới phân công lại
                $this->userAdminDepartmentRepository->deleteUserAdminDepartment([
                    'department_id' => $admin->department_id,
                    'type' => UsersAdminDepartmentStatusType::Manager
                ]);
            } else {
                // Nếu không có trưởng phòng
                if ($department) {
                    if ($manager) {
                        $this->userAdminDepartmentRepository->create([
                            'user_id' => $admin->id,
                            'admin_id' => $manager->id,
                            'department_id' => $department_id,
                            'type' => UsersAdminDepartmentStatusType::Manager,
                        ]);
                    }
                }
            }
        }*/

        // cùng phòng trước đó
        /*
        if ($department_id == $admin->department_id) {
            $checkManager = $this->userAdminDepartmentRepository->checkUserAdminManagerDepartment(
                [
                    'department_id' => $admin->department_id,
                    'type' => UsersAdminDepartmentStatusType::Manager,
                ]
            );

            if($checkManager){
                $checkManager->update([
                    'admin_id' => $manager->id,
                    'department_id' => $department_id
                ]);
            }else{
                $this->userAdminDepartmentRepository->create([
                    'user_id' => $admin->id,
                    'admin_id' => $manager->id,
                    'department_id' => $department_id,
                    'type' => UsersAdminDepartmentStatusType::Manager,
                ]);
            }

        } */

        $admin->update($params);
        if ($request->hasfile('image')) {

            $images = $admin->image()->get();
            if (count($images) > 0) {
                foreach ($images as $item) {
                    $deleteFile = $item->url ?? null;
                    if (!empty($deleteFile)) {
                        $fileUnlink = Str::of('/' . $deleteFile)->basename();
                        @unlink(public_path('storage/avatar/' . $deleteFile));
                        @unlink(public_path('storage/avatar/' . str_replace($fileUnlink, 'thumb_50x50_' . $fileUnlink, $deleteFile)));
                    }
                    $item->delete();
                }
            }

            $date = date('Y/m/d');
            $request->file('image')->store('avatar/' . $date);
            $aImage = $request->file('image')->hashName();
            $pathOld = public_path('storage/avatar/' . $date . '/' . $aImage);
            $fileNewSize = public_path('storage/avatar/' . $date . '/thumb_50x50_' . $aImage);
            $img = ImageIntervention::make($pathOld);
            $img->fit(50, 50, function ($constraint) {
                $constraint->upsize();
            });
            $img->save($fileNewSize);

            $photo = new Image();
            $photo->url = $date . '/' . $aImage;
            $photo->is_default = 1;
            $admin->image()->save($photo);
        }

        return redirect()->route('backend.users.index')->with('success', 'Đã cập nhật tài khoản thành công');
    }

    public function destroy($id = 0)
    {
        $admin = $this->userRepository->getByID($id);
        if (!$admin) {
            return ResponseHelper::error('Không tìm thấy tài khoản');
        }
        $admin->delete();
        return ResponseHelper::success('Đã xóa thành công');
    }

    /**
     * @param  Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateVip(Request $request, $id = 0): \Illuminate\Http\JsonResponse
    {
        $admin = $this->userRepository->getByID($id);
        if (!$admin) {
            return ResponseHelper::error('Không tìm thấy tài khoản');
        }

        $vip = $request->vip;
        $currentTime = date('Y-m-d H:i:s');
        $strVip = "+".$vip." days";
        $expiry_date = date("Y-m-d H:i:s",strtotime($strVip, strtotime($currentTime)));
        $admin->update(['vip'=>$request->vip,'expiry_date'=>$expiry_date]);
        return ResponseHelper::success('Cập nhật thành công');
    }

    public function search(Request $request)
    {
        $search = $request->q ?? null;
        $users = $this->userRepository->getAll(['search' => $search]);

        return ResponseHelper::success('thành công', $users);
    }

    public function ajaxLoadApprovedUsers(Request $request)
    {
        // $returnHTML = view("components.backend.user.user-main")->with(['sendData' => $sendData])->render();

        $user_id = $request->id ?? 0;
        $user = $this->userRepository->getByID($user_id);
        $managerInfo = [];
        $main = 0;
        $sub = 0;
        $users = [];
        $department = [];

        if ($user) {
            $managerInfo = $user->manager()->first();
            if ($managerInfo) {
                $department_id = $managerInfo->department_id;
                $department = $this->departmentRepository->getById($department_id);
                if ($department->admins()->get()->count() > 0) {
                    foreach ($department->admins()->get() as  $value) {
                        $users[] = [
                            'id' => $value->id,
                            'text' => $value->name,
                        ];
                    }
                }
            }
            $main = !empty($user->main()->first()->admin_id) ? $user->main()->first()->admin_id : 0;
            $sub = !empty($user->sub()->first()->admin_id) ? $user->sub()->first()->admin_id : 0;
        }

        $data = [
            'manager' => $managerInfo,
            'main' => $main,
            'sub' => $sub,
            'users' => $users,
            'department' => $department,
        ];
        return ResponseHelper::success('Thành công', $data);
    }

    public function updateAdminDepartment(Request $request)
    {
        $params = $request->all();
        $department_id = $params['department_id'] ?? 0;
        $user_id = $params['user_id'] ?? 0;
        $department = $this->departmentRepository->getById($department_id);
        if ($department) {

            //kiểm tra người quản lý chính
            $main = self::checkUserSubMainExperts([
                'user_id' => $user_id,
                'department_id' => $department_id,
                'type' => UsersAdminDepartmentStatusType::Main,
                'admin_id' => $params['user_main'],
            ]);

            //kiểm tra người quản lý phụ
            $sub = self::checkUserSubMainExperts([
                'user_id' => $user_id,
                'department_id' => $department_id,
                'type' => UsersAdminDepartmentStatusType::Sub,
                'admin_id' => $params['user_sub'],
            ]);
        }
        return ResponseHelper::success('Thành công', $request->all());
    }

    public function showTest(Request $request) {

        $user_id = $request->id ?? 0 ;
        $user = $this->userRepository->getByID($user_id);
        if($user) {
            $html = view('components.backend.user.showTest',['user'=>$user])->render();
            return ResponseHelper::success('Thành công', ['responseJson'=>$html]);
        }
        return ResponseHelper::error('Thất bại');
    }

    public function checkUserSubMainExperts($params = [])
    {
        //kiểm tra người quản lý phụ,chính, chuyên gia
        $checkTypeSub = $this->userAdminDepartmentRepository->checkUserAdminDepartmentType([
            'user_id' => $params['user_id'],
            'department_id' => $params['department_id'],
            'type' => $params['type'],
        ]);

        if ($checkTypeSub) {
            $checkTypeSub->admin_id = $params['admin_id'];
            $checkTypeSub->department_id = $params['department_id'];
            $checkTypeSub->save();
        } else {
            $this->userAdminDepartmentRepository->create([
                'user_id' => $params['user_id'],
                'department_id' => $params['department_id'],
                'admin_id' => $params['admin_id'],
                'type' => $params['type'],
            ]);
        }
    }

    public function import(Request $request)
    {
        return view('components.backend.user.import', $this->data);
    }
    public function insertImport(UsersImportRequest $request) {
        $params = $request->all();
        $excelMimes = [
            'text/xls',
            'text/xlsx',
            'application/excel',
            'application/vnd.msexcel',
            'application/vnd.ms-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        ];

        $file = $_FILES['file'];
        $type = $_FILES['file']['type'];
        if ($request->hasfile('file') && in_array($type, $excelMimes)) {
            $reader = new Xlsx();
            $spreadsheet = $reader->load($file['tmp_name']);
            $worksheet = $spreadsheet->getActiveSheet();
            $users = $worksheet->toArray();
            unset($users[0]);
            foreach ($users as $key => $user) {
                $p = [
                    'name'=>$user[1] ?? '',
                    'email'=>$user[2]?? 0,
                    'status'=>1,
                    'password'=>Hash::make($user[3]),
                ];
                $checkUser = $this->userRepository->getEmail($p['email']);
                if(!$checkUser) {
                    $this->userRepository->create($p);
                }else {
                    $checkUser->update($p);
                }
            }

        }
    }
}
