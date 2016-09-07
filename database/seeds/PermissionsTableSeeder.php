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
        // 登录后台权限
        Permission::create([
            'name'         => 'admin.global.login',
            'display_name' => '后台登录',
            'description'  => '后台登录'
        ]);

        // 系统管理
        Permission::create([
            'name' => 'admin.system.manager',
            'display_name' => '系统管理',
            'description'  => '系统管理'
        ]);

        // 创建菜单权限
        Permission::create([
            'name' => 'admin.menus.add',
            'display_name' => '添加菜单',
            'description'  => '天价菜单', 
        ]);

        // 查看菜单权限
        Permission::create([
            'name' => 'admin.menus.list',
            'display_name' => '菜单列表',
            'description'  => '菜单列表',
        ]);

        // 修改菜单权限
        Permission::create([
            'name' => 'admin.menus.edit',
            'display_name' => '修改菜单',
            'description'  => '修改菜单',
        ]);

        // 删除菜单权限
        Permission::create([
            'name' => 'admin.menus.delete',
            'display_name' => '删除菜单',
            'description'  => '删除菜单',
        ]);
    }
}
