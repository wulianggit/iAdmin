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
        // Admin 角色
        $adminRole = new Role();
        $adminRole->name         = '超级管理员';
        $adminRole->display_name = 'admin';
        $adminRole->description  = '超级管理员拥有所有权限';
        $adminRole->save();

        // 用户管理角色
        $userRole = new Role();
        $userRole->name = '用户管理员';
        $userRole->display_name = 'userManager';
        $userRole->description  = '用户管理员';
        $userRole->save();

        // 创建用户
        $createUserRole = new Role();
        $createUserRole->name = '添加用户';
        $createUserRole->display_name = 'addUser';
        $createUserRole->description  = '创建新用户';
        $createUserRole->save();

        // 查看用户
        $lookUserRole = new Role();
        $lookUserRole->name = '查看用户';
        $lookUserRole->display_name = 'catUser';
        $lookUserRole->description  = '查看用户资料';
        $lookUserRole->save();

        // 创建菜单
        $createMenuRole = new Role();
        $createMenuRole->name = '添加菜单';
        $createMenuRole->display_name = 'addMenu';
        $createMenuRole->description  = '添加新菜单';
        $createMenuRole->save();


        // 获取所有权限
        $allPermission = array_column(Permission::all()->toArray(), 'id');
        // 为超级管理员角色赋予所有权限
        $adminRole->perms()->sync($allPermission);

        // 获取后台登录权限
        $loginPermission = Permission::where('name', 'admin.global.login')->first();


        // 获取创建用户权限
        $createUserPermission = Permission::where('display_name', '创建用户')->first();
        // 获取查看用户权限
        $lookUserPermission = Permission::where('name', 'admin.user.look')->first();

        // 为创建用户角色赋予相关权限
        $createUserRole->attachPermissions([
            $createUserPermission,
            $lookUserPermission,
            $loginPermission,
        ]);

        // 为查看用户角色赋予权限
        $lookUserRole->attachPermissions([
            $lookUserPermission, $loginPermission
        ]);


        // 获取创建菜单的权限
        $createMenuPermission = Permission::where('name', 'admin.menu.add')->first();
        $createMenuRole->attachPermissions([
            $createMenuPermission, $loginPermission
        ]);
    }
}
