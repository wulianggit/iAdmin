<?php

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {	
    	$control = Menu::create([
    		'name' => '控制台',
    		'parent_id' => 0,
    		'slug' => 'admin.global.login',
    		'url' => 'admin',
    		'hightlight_url' => 'admin'
		]);

		$system = Menu::create([
			'name' => '系统管理',
			'parent_id' => 0,
			'slug' => 'admin.system.manager',
    		'url' => 'admin/menu',
    		'hightlight_url' => 'admin/menu*,admin/user*,admin/permission*,admin/role*'
		]);

		Menu::create([
			'name' => '菜单管理',
			'parent_id' => $system->id,
			'slug' => 'admin.menus.list'
		]);

		Menu::create([
			'name' => '用户管理',
			'parent_id' => $system->id,
			'slug' => 'admin.users.list'
		]);

		Menu::create([
			'name' => '角色管理',
			'parent_id' => $system->id,
			'slug' => 'admin.roles.list'
		]);

		Menu::create([
			'name' => '权限管理',
			'parent_id' => $system->id,
			'slug' => 'admin.permissions.list'
		]);

		$nav = Menu::create([
			'name' => 'Web前端',
			'parent_id' => 0,
		]);

		Menu::create([
			'name' => 'javascript',
			'parent_id' => $nav->id,
		]);

		Menu::create([
			'name' => 'AngularJs',
			'parent_id' => $nav->id,
		]);

		Menu::create([
			'name' => 'ReactJs',
			'parent_id' => $nav->id,
		]);
    }
}
