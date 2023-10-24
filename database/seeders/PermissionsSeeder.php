<?php

namespace Database\Seeders;

use App\Models\Admin\Admin;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $role = Role::findByName('super_admin','backend');
        if(!$role){
            $role = Role::create(['name' => 'super_admin','customize_name'=>'Super Admin','guard_name'=>'backend']);
            $user = Admin::create([
                'name' => 'Supper Admin',
                'email' => 'admin@gmail.com',
                'status' => 1,
                'password' => Hash::make('admin_x')
            ]);
            $permission_array = [];
            array_push($permission_array, Permission::create([
                'name' => 'create_books',
                'guard_name'=>'backend',
                'parent_id'=>0,
                'customize_name'=>'Tài khoản Administrator'
            ]));
            array_push($permission_array, Permission::create(['name' => 'edit_books']));
            array_push($permission_array, Permission::create(['name' => 'delete_books']));
            array_push($permission_array, Permission::create(['name' => 'view_books']));
            array_push($permission_array, Permission::create(['name' => 'reserve_books']));

            array_push($permission_array, Permission::create(['name' => 'create_users']));
            array_push($permission_array, Permission::create(['name' => 'edit_users']));
            array_push($permission_array, Permission::create(['name' => 'delete_users']));
            array_push($permission_array, Permission::create(['name' => 'view_users']));

            array_push($permission_array, Permission::create(['name' => 'create_roles']));
            array_push($permission_array, Permission::create(['name' => 'edit_roles']));
            array_push($permission_array, Permission::create(['name' => 'delete_roles']));
            array_push($permission_array, Permission::create(['name' => 'view_roles']));
            $user->assignRole($role->id);
            $role->syncPermissions($permission_array);
        }

    }
}
