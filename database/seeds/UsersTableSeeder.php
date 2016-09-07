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
        $adminRole = Role::where('display_name', '超级管理员')->first();

        // 普通管理角色
        $ownerRole = Role::where('name', 'user')->first();

        // 创建超级管理员用户
    	factory('App\User')->create([
    		'name'     => 'admin',
            'username' => 'wuliang',
    		'email'    => '7426733245@qq.com',
    		'password' => bcrypt('admin')
    	])->each(function ($admin) use ($adminRole) {
            $admin->attachRole($adminRole);
		});


    	factory('App\User', 2)->create([
    		'password' => bcrypt('123456')
    	])->each(function ($owner) use ($ownerRole) {
            $owner->roles()->attach([$ownerRole->id]);
        });
    }
    
}
