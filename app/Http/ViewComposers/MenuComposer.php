<?php
namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use App\Repositories\Eloquent\MenuRepository;

class MenuComposer
{
	/**
     * 菜单仓库实现.
     *
     * @var MenuRepository
     */
    protected $menu;

    /**
     * 创建一个新的属性composer.
     *
     * @param MenuRepository $menu
     * @return void
     */
    public function __construct(MenuRepository $menu)
    {
        // Dependencies automatically resolved by service container...
        $this->menu = $menu;
    }

    /**
     * 绑定数据到视图.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('sidebarMenu', $this->menu->getMenuList());
    }
}