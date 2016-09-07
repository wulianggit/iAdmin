<?php
namespace App\Repositories\Presenter;

class MenuPresenter
{
	/**
	 * 父级菜单列表
	 * @date   2016-09-01
	 * @author 无缺
	 * @param  [type]     $menus [description]
	 * @return [type]            [description]
	 */
	public function getMenus($menus)
	{
		$option = "<option value='0'>顶级菜单</option>";
		if (!empty($menus)) {
			foreach ($menus as $key => $val) {
				$option .= "<option value='{$val['id']}'>{$val['name']}</option>";
			}
		}
		return $option;
	}

	/**
	 * 获取菜单列表
	 * @date   2016-09-02
	 * @author 无缺
	 * @param  [type]     $menuList [description]
	 * @return [type]               [description]
	 */
	public function getMenuList ($menuList) 
	{
		if ($menuList) {
			$item = '';
			foreach ($menuList as $key => $val) {
				$item .= $this->handleParentMenu($val);
			}
			return $item;
		}

		return '暂无菜单';
	}

	/**
	 * 处理顶级菜单视图
	 * @date   2016-09-01
	 * @author 无缺
	 * @param  [type]     $menus [description]
	 * @return [type]            [description]
	 */
	private function handleParentMenu ($menus) 
	{
		if ($menus['child']) {
			return $this->handleChildMenu($menus['id'], $menus['name'], $menus['child']);
		}

		// 判断是否是顶级菜单
		$topMenu = false;
		if ($menus['parent_id'] == 0) {
			$topMenu = true;
		}

		$item = "<li class='dd-item dd3-item' data-id='".$menus['id']."'>
					<div class='dd-handle dd3-handle'> </div>
						<div class='dd3-content'>{$menus['name']}"
						.$this->getOperatorButton($menus['id'], $topMenu).
					"</div>
				</li>";
		return $item;
	}

	/**
	 * 处理子集菜单视图
	 * @date   2016-09-01
	 * @author 无缺
	 * @param  [type]     $id    [description]
	 * @param  [type]     $name  [description]
	 * @param  [type]     $child [description]
	 * @return [type]            [description]
	 */
	private function handleChildMenu ($id, $name, $child) 
	{
		$childItem = '<li class="dd-item dd3-item" data-id="'.$id.'">
            			<div class="dd-handle dd3-handle"> </div>
            				<div class="dd3-content">'
            				.$name.$this->getOperatorButton($id).
            				'</div>
    					<ol class="dd-list">';
        foreach ($child as $key => $val) {
        	$childItem .= $this->handleParentMenu($val);
        }
		$childItem .= '</ol></li>';     
        
        return $childItem;
	}

	/**
	 * 菜单操作按钮 增(子菜单)、删、改
	 * @date   2016-09-05
	 * @author 无缺
	 * @param  [type]     $id      [description]
	 * @param  [type]     $topMenu [description]
	 * @return [type]              [description]
	 */
	private function getOperatorButton ($id, $topMenu=true) 
	{
		$operate = '<div class="pull-right action-buttons">';
		// 判断登录用户是否有添加菜单的权限
		if (auth()->user()->can(config('admin.permissions.menu.add')) && $topMenu) {
			$operate .= '<a href="javascript:;" data-pid="'.$id.'" class="btn-xs createMenu" data-toggle="tooltip" data-original-title="添加子菜单"  data-placement="top"><i class="fa fa-plus"></i></a>';
		}

		// 编辑菜单的权限
		if (auth()->user()->can(config('admin.permissions.menu.edit'))) {
			$operate .= '<a href="javascript:;" data-href="'
				.url('admin/menu/'.$id.'/edit').
				'" class="btn-xs editMenu" data-toggle="tooltip" data-original-title="修改菜单"  data-placement="top"><i class="fa fa-pencil"></i></a>';
		}

		// 删除菜单权限
		if (auth()->user()->can(config('admin.permissions.menu.delete'))) {
			$operate .= '<a href="javascript:;" data-id="'.$id.'" class="btn-xs destoryMenu" data-original-title="删除菜单" data-toggle="tooltip"  data-placement="top"><i class="fa fa-trash"></i><form action="'.url('admin/menu',[$id]).'" method="POST" name="delete_item_'.$id.'" style="display:none"><input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token" value="'.csrf_token().'"></form></a>';
		}
		$operate .= '</div>';

		return $operate;
	}

	/**
	 * 左侧菜单渲染
	 * @date   2016-09-07
	 * @author 无缺
	 * @param  [type]     $menus [description]
	 * @return [type]            [description]
	 */
	public function getSidebarMenus ($menus) 
	{
		$html = '';
		if ($menus) {
			$html = '<li>';
			foreach ($menus as $v) {
				if (auth()->user()->can($v['slug'])) {
					if ($v['child']) {
						$html .= '<li class="'.active_class(if_uri_pattern(explode(',',$v['hightlight_url']))).'"><a><i class="'.$v['icon'].'"></i> '.$v['name'].' <span class="fa fa-chevron-down"></span></a>'.$this->getSidebarChildMenu($v['url'],$v['child']).'</li>';
					}else{
						if ($v['parent_id'] == 0) {
							$html .= '<li class="'.active_class(if_uri_pattern([$v['hightlight_url']])).'"><a href="'.$v['url'].'"><i class="'.$v['icon'].'"></i> '.$v['name'].'</a></li>';
						} else {
							$html .= '<li class="'.active_class(if_uri_pattern([$v['hightlight_url']])).'"><a href="'.$v['url'].'"><i class="'.url($v['url']).'"></i> '.$v['name'].'</a></li>';
						}
					}
				}
			}
			$html .= '</li>';
		}
		return $html;
	}

	/**
	 * 左侧子菜单渲染
	 * @date   2016-09-07
	 * @author 无缺
	 * @param  string     $url       [description]
	 * @param  string     $childMenu [description]
	 * @return [type]                [description]
	 */
	private function getSidebarChildMenu ($url, $childMenu = '')
	{
		$html = '';
		if ($childMenu) {
			$html = '<ul class="nav child_menu" style="display:'.active_class(if_uri_pattern($url),'block','none').'">';
			foreach ($childMenu as $v) {
				if (auth()->user()->can($v['slug'])) {
					$html .= '<li class="'.active_class(if_uri_pattern([$v['hightlight_url']]),'current-page').'"><a href="'.url($v['url']).'">'.$v['name'].'</a></li>';
				}
			}
			$html .= '</ul>';
		}
		return $html;
	}

}