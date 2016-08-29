<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->default(0)->comment('父级菜单id');
            $table->string('name', 50)->default('')->comment('菜单名称');
            $table->string('icon')->default('')->comment('菜单图标');
            $table->string('url')->default('')->comment('菜单连接');
            $table->string('hightlight_url')->default('')->comment('菜单高亮');
            $table->tinyInteger('sort')->unsigned()->default(0)->comment('排序');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('menus');
    }
}
