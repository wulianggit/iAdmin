<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 创建用户的权限
        $createUserPermission = new Permission();
        $createUserPermission->name = 'admin.user.add';
        $createUserPermission->display_name = '创建用户';
        $createUserPermission->description  = '添加用户权限';
        $createUserPermission->save();

        // 查看用户的权限
        Permission::create([
            'name'         => 'admin.user.look',
            'display_name' => '查看用户',
            'description'  => '查看用户资料权限'
        ]);

        // 创建菜单权限
        Permission::create([
            'name'         => 'admin.menu.add',
            'display_name' => '添加菜单',
            'description'  => '新加后台菜单权限'
        ]);

        // 登录后台权限
        Permission::create([
            'name'         => 'admin.global.login',
            'display_name' => '后台登录',
            'description'  => '后台登录权限'
        ]);
    }
}
