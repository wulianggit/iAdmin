<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$admin = factory('App\User')->create([
    		'name' => 'admin',
    		'email' => '7426733245@qq.com',
    		'password' => bcrypt('admin')
    	]);

    	$users = factory('App\User', 3)->create([
    		'password' => bcrypt('123456')
    	]);
    }
}
