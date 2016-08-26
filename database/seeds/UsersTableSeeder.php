<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 超级管理员角色
        $adminRole = Role::where('display_name', 'admin')->first();

        // 创建新用户角色
        $createUserRole = Role::where('display_name', 'addUser')->first();

        // 查看用户资料角色
        $lookUserRole = Role::where('display_name', 'catUser')->first();

        // 创建菜单角色
        $createMenuRole = Role::where('display_name', 'addMenu')->first();

        // 创建超级管理员用户
    	factory('App\User')->create([
    		'name' => 'admin',
    		'email' => '7426733245@qq.com',
    		'password' => bcrypt('admin')
    	])->each(function ($admin) use ($adminRole) {
            $admin->attachRole($adminRole);
		});


    	factory('App\User', 2)->create([
    		'password' => bcrypt('123456')
    	])->each(function ($user) use ($createUserRole) {
            $user->roles()->attach([$createUserRole->id]);
        });

        factory('App\User', 2)->create([
            'password' => bcrypt('123456')
        ])->each(function ($user) use($lookUserRole) {
            $user->roles()->attach([$lookUserRole->id]);
        });

        factory('App\User', 2)->create([
            'password' => bcrypt('123456')
        ])->each(function ($user) use ($createMenuRole) {
            $user->attachRole($createMenuRole);
        });
    }
}
