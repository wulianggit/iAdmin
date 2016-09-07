<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\Eloquent\MenuRepository;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\MenuRequest;

class MenuController extends Controller
{
    private $menu;

    public function __construct (MenuRepository $menu)
    {
        $this->menu = $menu;
    }

    /**
     * 菜单首页视图
     *
     * @return mixed
     * @author wuliang
     */
    public function index ()
    {
        $menu = $this->menu->findByField('parent_id', 0);
        $menuList = $this->menu->getMenuList();
        return view('admin.menu.list')->with(compact('menu', 'menuList'));
    }


    /**
     * 添加菜单
     *
     * @param \App\Http\Requests\MenuRequest $request
     *
     * @return mixed
     * @author wuliang
     */
    public function store (MenuRequest $request) 
    {
        //dd($request->all());
        $result = $this->menu->create($request->all());
        // 刷新缓存
        $this->menu->sortMenuSetCahce();

        if ($result) {
            flash('菜单添加成功!', 'success');
        } else {
            flash('菜单添加失败!', 'error');
        }

        return redirect('admin/menu');
    }

    /**
     * 获取编辑菜单信息
     * @date   2016-09-06
     * @author 无缺
     * @param  [type]     $id [description]
     * @return [type]         [description]
     */
    public function edit ($id) 
    {
        $menu = $this->menu->editMenu($id);
        return response()->json($menu);
    }

    /**
     * 修改菜单数据
     * @date   2016-09-06
     * @author 无缺
     * @param  MenuRequest $request [description]
     * @return [type]               [description]
     */
    public function update (MenuRequest $request)
    {
        $result = $this->menu->updateMenu($request);
        if ($result) {
            flash('菜单修改成功', 'success');
        } else {
            flash('菜单修改失败', 'error');
        }

        return redirect('admin/menu');
    }

    /**
     * 删除菜单
     * @date   2016-09-06
     * @author 无缺
     * @param  [type]     $id [description]
     * @return [type]         [description]
     */
    public function destroy ($id) 
    {
        $result = $this->menu->destoryMenu($id);
        if ($result) {
            flash('菜单删除成功', 'success');
        } else {
            flash('菜单删除失败', 'error');
        }

        return redirect('admin/menu');
    }
}
