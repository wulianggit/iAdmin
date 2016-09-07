<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class MenuRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'parent_id' => 'required',
            'url' => 'required',
        ];
        // 修改菜单时，菜单名称不需要判断唯一性
        if (request('id')) {
            // unique:table,column,except,idColumn
            $rules['name'] = 'required|unique:menus,name,'.$this->id;
        } else {
            $rules['name'] = 'required|unique:menus,name';
        }

        return $rules;
    }

    /**
     * 添加菜单验证规则提示信息
     * @date   2016-08-29
     * @author 无缺
     * @return [type]     [description]
     */
    public function messages ()
    {
        return [
            'name.required' => '菜单名称不能为空',
            'name.unique'   => '菜单名称不能重复',
            'url.required'  => '菜单链接不能为空',
            'parent_id.required' => '父级菜单不能为空'
        ];
    }
}
