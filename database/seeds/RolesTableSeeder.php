<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 创建超级管理员角色
        $adminRole = new Role();
        $adminRole->name = 'admin';
        $adminRole->display_name = '超级管理员';
        $adminRole->description  = '超级管理员';
        $adminRole->save();

        // 创建普通用户角色
        $userRole = new Role();
        $userRole->name = 'user';
        $userRole->display_name = '普通用户';
        $userRole->description  = '普通用户';
        $userRole->save();

        // 超级管理员分配所有权限
        $allPermission   = Permission::all()->toArray();
        $allPermissionId = array_column($allPermission, 'id');
        $adminRole->perms()->sync($allPermissionId);

        // 普通管理角色分配后台登录权限和创建菜单的权限
        $loginSystem = Permission::where('name', 'admin.global.login')->first();
        $createMenu  = Permission::where('name', 'admin.menus.add')->first();
        $userRole->attachPermissions([$loginSystem, $createMenu]);
    }
}
