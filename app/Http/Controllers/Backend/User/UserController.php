<?php

namespace App\Http\Controllers\Backend\User;

use App\Enums\Departments\UsersAdminDepartmentStatusType;
use App\Enums\Modules\ModuleType;
use App\Enums\Roles\RoleType;
use App\Enums\Users\ExpiryDateType;
use App\Enums\Users\UserGenderType;
use App\Helpers\PaginationHelper;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\BackendController;
use App\Http\Requests\Backend\User\UserRequest;
use App\Http\Requests\Backend\User\UsersImportRequest;
use App\Models\Images\Image;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Departments\DepartmentRepository;
use App\Repositories\Quiz\TestUsersTestsRepository;
use App\Repositories\Region\RegionRepository;
use App\Repositories\Users\UserAdminDepartmentRepository;
use App\Repositories\Users\UserAgentRepository;
use App\Repositories\Users\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image as ImageIntervention;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class UserController extends BackendController
{
    protected $data = [];
    protected $userRepository;
    protected $regionRepository;
    protected $departmentRepository;
    protected $userAdminDepartmentRepository;
    protected $categoryRepository;
    protected $userAgentRepository;
    protected $testUsersTestsRepository;

    public function __construct(
        UserRepository $userRepository,
        RegionRepository $regionRepository,
        DepartmentRepository $departmentRepository,
        UserAdminDepartmentRepository $userAdminDepartmentRepository,
        CategoryRepository $categoryRepository,
        UserAgentRepository $userAgentRepository,
        TestUsersTestsRepository $testUsersTestsRepository
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
        $this->categoryRepository = $categoryRepository;
        $this->userAgentRepository = $userAgentRepository;
        $this->testUsersTestsRepository = $testUsersTestsRepository;
        $this->data['vip'] = ExpiryDateType::getExpiryDate();
    }

    public function index(Request $request)
    {
        $user_id = 29;
        $user = $this->userRepository->getByID($user_id);
        $params = $request->all();
        $p = $request->all();
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

        $params['status'] = [1];
        $params['locked'] = [0];
        $p['status'] = 1;

        $post = $this->userRepository->getAll($params, 20);
        $this->data['title'] = 'Users';
        $this->data['items'] = $post;
        $this->data['params'] = $params;

        $total = !empty($post->total()) ? $post->total() : 0;
        $perPage = !empty($post->perPage()) ? $post->perPage() : 2;
        $this->data['deactivated'] = 0;

        $page = !empty($request->page) ? $request->page : 1;
        unset($p['page']);

        $url = route('backend.users.index') . '?' . Arr::query($p) . '&';
        $this->data['pager'] = PaginationHelper::BackendPagination($total, $perPage, $page, $url);
        return view('components.backend.user.index', $this->data);
    }

    public function deactivated(Request $request)
    {
        $params = $request->all();
        $p = $request->all();
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

        $params['status'] = [0];
        $p['status'] = 0;
        $this->data['deactivated'] = 1;
        $post = $this->userRepository->getAll($params, 20);
        $this->data['title'] = 'Users';
        $this->data['items'] = $post;
        $this->data['params'] = $params;
        $total = !empty($post->total()) ? $post->total() : 0;
        $perPage = !empty($post->perPage()) ? $post->perPage() : 2;

        $page = !empty($request->page) ? $request->page : 1;
        unset($p['page']);
        $url = route('backend.users.index') . '?' . Arr::query($p) . '&';
        $this->data['pager'] = PaginationHelper::BackendPagination($total, $perPage, $page, $url);
        return view('components.backend.user.index', $this->data);
    }

    public function locked(Request $request)
    {
        $params = $request->all();
        $p = $request->all();
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

        $params['locked'] = [1];
        $p['locked'] = 1;
        $this->data['deactivated'] = 2;
        $post = $this->userRepository->getAll($params, 20);
        $this->data['title'] = 'Users';
        $this->data['items'] = $post;
        $this->data['params'] = $params;
        $total = !empty($post->total()) ? $post->total() : 0;
        $perPage = !empty($post->perPage()) ? $post->perPage() : 2;

        $page = !empty($request->page) ? $request->page : 1;
        unset($p['page']);
        $url = route('backend.users.index') . '?' . Arr::query($p) . '&';
        $this->data['pager'] = PaginationHelper::BackendPagination($total, $perPage, $page, $url);
        return view('components.backend.user.index', $this->data);
    }

    public function lockedAccount(Request $request, $id)
    {
        $admin = $this->userRepository->getByID($id);
        if (!$admin) {
            return redirect()->route('backend.users.index')->with('error', 'Không tìm thấy dữ liệu');
        }
        $admin->update(['locked' => 1]);
        return ResponseHelper::success('Đã xóa thành công');
    }
    public function create(Request $request)
    {
        $this->data['isEdit'] = 0;
        $this->data['admin'] = [];
        $this->data['roles'] = Role::all()->where('guard_name', 'web');
        $this->data['role_select'] = [];
        $this->data['regions'] = $this->regionRepository->getAll([]);
        $this->data['departments'] = $this->departmentRepository->getAll([]);
        $this->data['category_parents'] = $this->categoryRepository->getAll([
            'module_id' => [ModuleType::Quiz], 'parent_id' => [0]
        ]);
        $this->data['permission_category'] = [];

        return view('components.backend.user.create', $this->data);
    }

    public function store(UserRequest $request)
    {
        $params = $request->all();
        $params['status'] = $params['status'] ?? 0;
        $params['username'] = $params['phone'] ?? 0;
        $department_id = $params['department_id'] ?? 0;
        $params['password'] = Hash::make($params['password']);
        $params['permission_category'] = !empty($params['permission_category']) ? implode(',', $params['permission_category']) : '';
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

        $this->data['category_parents'] = $this->categoryRepository->getAll([
            'module_id' => [ModuleType::Quiz], 'parent_id' => [0]
        ]);
        $this->data['permission_category'] = !empty($admin->permission_category) ? explode(',', $admin->permission_category) : [];

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
        $params['permission_category'] = !empty($params['permission_category']) ? implode(',', $params['permission_category']) : '';

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
        $number = $request->number ?? 0;
        $currentTime = date('Y-m-d H:i:s');
        $strVip = "+" . $vip . " days";
        if ($vip == ExpiryDateType::Days_customize) {
            $currentTime =  date('Y-m-d H:i:s', strtotime($request->date));
            $strVip = $number . " days";
        }
        $expiry_date = date("Y-m-d H:i:s", strtotime($strVip, strtotime($currentTime)));
        $admin->update(['vip' => $request->vip, 'expiry_date' => $expiry_date]);
        $data = [
            'showTime' => $expiry_date,
            'id' => $id
        ];
        return ResponseHelper::success('Cập nhật thành công', $data);
    }

    public function active(Request $request, $id = 0)
    {
        $admin = $this->userRepository->getByID($id);
        if (!$admin) {
            return ResponseHelper::error('Không tìm thấy tài khoản');
        }
        $admin->status = 1;
        $admin->locked = 0;
        $admin->save();
        $items = $admin->userAgent()->get();
        foreach ($items as $key => $value) {
            $value->delete();
        }

        return ResponseHelper::success('Cập nhật thành công', $admin);
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

    public function showTest(Request $request)
    {

        $user_id = $request->id ?? 0;
        $user = $this->userRepository->getByID($user_id);
        if ($user) {
            $html = view('components.backend.user.showTest', ['user' => $user])->render();
            return ResponseHelper::success('Thành công', ['responseJson' => $html]);
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
    public function insertImport(UsersImportRequest $request)
    {
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
                    'name' => $user[1] ?? '',
                    'email' => $user[2] ?? 0,
                    'status' => 1,
                    'password' => Hash::make($user[3]),
                ];
                $checkUser = $this->userRepository->getEmail($p['email']);
                if (!$checkUser) {
                    $this->userRepository->create($p);
                } else {
                    $checkUser->update($p);
                }
            }
        }
    }

    public function export(Request $request)
    {
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");
        $spreadsheet = $reader->load(public_path('template/khachhang.xlsx'));
        $sheet = $spreadsheet->getActiveSheet();

        $posts = $this->userRepository->getAll([], null);
        $i = 2;
        foreach ($posts as $key => $value) {
            $sheet->setCellValue('A' . $i, $value->name ?? '');
            $sheet->setCellValue('B' . $i, $value->email ?? '');
            $sheet->setCellValue('C' . $i, $value->phone ?? '');
            $i++;
        }
        $pathfile = "danh-sach-khach-hang.xlsx";
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");;
        header('Content-Disposition: attachment; filename=' . basename($pathfile) . '');
        header("Content-Transfer-Encoding: binary ");

        ob_end_clean();
        ob_start();

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Xlsx");
        $writer->save('php://output');
        exit;
    }

    public function exportTest(Request $request)
    {
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");
        $spreadsheet = $reader->load(public_path('template/baocao.xlsx'));
        $sheet = $spreadsheet->getActiveSheet();

        $params = $request->all();
        $post = $this->testUsersTestsRepository->getAll($params, 20);
        $i = 2;
        $k = 1;
        foreach ($post as $key => $item) {
            $sheet->setCellValue('A' . $i, $k);
            $sheet->setCellValue('B' . $i,  $item->name ?? $item->username  ?? '');
            $sheet->setCellValue('C' . $i, $item->title ?? '');

            $sheet->setCellValue('D' . $i, $item->email ?? '');
            $sheet->setCellValue('E' . $i, $item->score ?? 0);
            $sheet->setCellValue('F' . $i, !empty($item->created_at ) ? date('d/m/Y',strtotime($item->created_at)) : '');

            $i++;
            $k++;
        }
        $pathfile = "ket-qua-bai-thi-cua-khach-hang.xlsx";
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");;
        header('Content-Disposition: attachment; filename=' . basename($pathfile) . '');
        header("Content-Transfer-Encoding: binary ");

        ob_end_clean();
        ob_start();

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Xlsx");
        $writer->save('php://output');
        exit;
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxLoadPreviewWebsite(Request $request,$id = 0) {
        $user = $this->userRepository->getByID($id);
        if ($user) {
            $userAgent = $user->userAgent()->get();
            $html = view('components.backend.user.loadingPreviewWebsite', ['userAgent' => $userAgent])->render();
            return ResponseHelper::success('Thành công', ['responseJson' => $html]);
        }
        return ResponseHelper::error('Thất bại');
    }

    public function test(Request $request) {

        $params = $request->all();
        $p = $request->all();
        $post = $this->testUsersTestsRepository->getAll($params, 20);

        $this->data['title'] = 'Users';
        $this->data['items'] = $post;
        $this->data['params'] = $params;

        $total = !empty($post->total()) ? $post->total() : 0;
        $perPage = !empty($post->perPage()) ? $post->perPage() : 2;

        $page = !empty($request->page) ? $request->page : 1;
        unset($p['page']);

        $url = route('backend.test.userxx.index') . '?' . Arr::query($p) . '&';
        $this->data['pager'] = PaginationHelper::BackendPagination($total, $perPage, $page, $url);

        return view('components.backend.user.test', $this->data);
    }
}
