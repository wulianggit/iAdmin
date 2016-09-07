<?php
namespace App\Repositories\Eloquent;

use App\Models\Menu;
use Bosnadev\Repositories\Eloquent\Repository;
use Cache;

class MenuRepository extends Repository
{
    /**
     * 实现父类的抽象方法,返回模型的实例对象
     *
     * @return mixed
     * @author wuliang
     */
    public function model ()
    {
        return Menu::class;
    }

    /**
     * 重写父类的方法,加入字段的过滤
     *
     * @param array $attributes
     *
     * @return mixed
     * @author wuliang
     */
    public function create ( array $attributes )
    {
        $model = new $this->model();
        return $model->fill($attributes)->save();
    }

    /**
     * 根据字段和值获取数据并排序
     * @date   2016-09-01
     * @author 无缺
     * @param  [type]     $field   [description]
     * @param  [type]     $value   [description]
     * @param  array      $columns [description]
     * @return [type]              [description]
     */
    public function findByField ($field, $value, $columns = ['*']) 
    {
        return $this->model->select($columns)->where($field, $value)->get();
    }

    /**
     * 获取菜单列表
     * @date   2016-09-01
     * @author 无缺
     * @return [type]     [description]
     */
    public function getMenuList()
    {
        // 判断是否缓存菜单
        if (Cache::has(config('admin.globals.cache.menuList'))) {
            return Cache::get(config('admin.globals.cache.menuList'));
        }

        return $this->sortMenuSetCahce();
    }

    /**
     * 对菜单列表按照排序字段排序并设置缓存
     * @date   2016-09-02
     * @author 无缺
     * @return [type]     [description]
     */
    public function sortMenuSetCahce () 
    {
        $menus = $this->model->orderBy('sort', 'desc')->get()->toArray();
        if ($menus) {
            $menuList = $this->handleMenu($menus);
            foreach ($menuList as $key => &$val) {
                if ($val['child']) {
                    $sort = array_column($val['child'], 'sort');
                    array_multisort($sort, SORT_DESC, $val['child']);
                }
            }
            Cache::forever(config('admin.globals.cache.menuList'), $menuList);
            return $menuList;
        }

        return '';
    }

    /**
     * 递归处理菜单
     * @date   2016-09-01
     * @author 无缺
     * @param  [type]     $menus [description]
     * @param  integer    $pid   [description]
     * @return [type]            [description]
     */
    public function handleMenu ($menus, $pid = 0)
    {
        $menuList = [];
        foreach ($menus as $key => $val) {
            $parentId = $val['parent_id'];
            if ($parentId == $pid) {
                $menuList[$key] = $val;
                $menuList[$key]['child'] = self::handleMenu($menus, $val['id']);
            }
        }

        return $menuList;
    }

    /**
     * 读取菜单信息
     * @date   2016-09-06
     * @author 无缺
     * @param  [type]     $id [description]
     * @return [type]         [description]
     */
    public function editMenu ($id)
    {
        $menu = $this->model->find($id)->toArray();
        if ($menu) {
            $menu['status'] = 'success';
            $menu['update'] = url('admin/menu/'.$id);
            $menu['msg'] = '加载成功';
            return $menu;
        }
        return ['status' => 'fail', 'msg' => '加载失败'];
    }

    /**
     * 修改菜单数据
     * @date   2016-09-06
     * @author 无缺
     * @param  [type]     $request [description]
     * @return [type]              [description]
     */
    public function updateMenu ($request)
    {
        $menu = $this->model->find($request->id);
        if ($menu) {
            $result = $menu->update($request->all());
            if ($result) {
                $this->sortMenuSetCahce();
                return true;
            } else {
                return false;
            }
        }
        abort('菜单数据找不到');
    }

    /**
     * 删除菜单
     * @date   2016-09-06
     * @author 无缺
     * @param  [type]     $id [description]
     * @return [type]         [description]
     */
    public function destoryMenu ($id) 
    {
        $isDelete = $this->model->destroy($id);
        if ($isDelete) {
            $this->sortMenuSetCahce();
        }
        return $isDelete;
    }
}