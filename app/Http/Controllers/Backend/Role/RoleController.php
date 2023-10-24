<?php

namespace App\Http\Controllers\Backend\Role;

use App\Enums\Users\UserGenderType;
use App\Http\Controllers\BackendController;
use App\Http\Requests\Backend\Role\RoleCreateRequest;
use App\Repositories\Roles\PermissionRepository;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;

class RoleController extends BackendController
{
    protected $data = [];
    protected $permissionRepository;

    public function __construct(PermissionRepository $permissionRepository)
    {
        parent::__construct();
        $this->data['genders'] = [
            UserGenderType::Male => 'Nam',
            UserGenderType::Female => 'Nữ',
        ];
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['title'] = 'Users';
        $this->data['roles'] = Role::all()->where('guard_name','backend');
        return view('components.backend.role.index', $this->data);
    }

    public function create(Request $request)
    {
        $this->data['title'] = 'Users';
        $this->data['isEdit'] = 0;
        $this->data['admin'] = [];
        $this->data['permissions_roles'] = [];
        $this->data['permissions'] = $this->permissionRepository->getAll(['parent_id'=>[0],'guard_name'=>'backend']);
        return view('components.backend.role.create', $this->data);
    }

    public function store(RoleCreateRequest $request)
    {
        $role = Role::create([
            'name' => Str::slug($request->name),
            'customize_name' => $request->name,
            'guard_name'=>'backend'
            ]);
        $role->syncPermissions($request->permissions);
        //$role->syncPermissions($permissions);
        return redirect()->route('backend.role.index')->with('success', 'Đã tạo vai trò thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin = Role::find($id);
        if ( !$admin ) {
            return redirect()->route('backend.role.index')->with('error', 'Không tìm thấy dữ liệu');
        }
        $this->data['permissions_roles'] = $admin->permissions->pluck('id')->toArray();
        $this->data['title'] = 'Roles';
        $this->data['isEdit'] = 1;
        $this->data['admin'] = $admin;
        $this->data['permissions'] = $this->permissionRepository->getAll(['parent_id'=>[0]]);
        return view('components.backend.role.create', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleCreateRequest $request, $id)
    {
        $role = Role::find($id);
        if ( !$role ) {
            return redirect()->route('backend.role.index')->with('error', 'Không tìm thấy dữ liệu');
        }

        $role->permissions()->detach();
        //$role->name = Str::slug($request->name);
        $role->customize_name = $request->name;
        $role->save();
        $role->syncPermissions($request->permissions);

        return redirect()->route('backend.role.index')->with('success', 'Đã tạo vai trò thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
