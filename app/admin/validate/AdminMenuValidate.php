<?php
/**
 *
 * ============================================================================
 * [UD IMF System] Copyright (c) 1995-2028https://www.thinkimf.com；
 * 版权所有 1995-2028 UD数据信息有限公司【中国】，并保留所有权利。
 * This is not  free soft ware, use is subject to license.txt
 * 网站地址: https://www.thinkimf.com；
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和
 * 使用；不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * $Author: 陈建华 $
 * $Create Time: 2017-9-6 23:36:30 $
 * email:unnnnn@foxmail.com
 */
namespace app\admin\validate;

use think\Validate;
use think\Db;

class AdminMenuValidate extends Validate
{
    protected $rule = [
        'name'       => 'require',
        'app'        => 'require',
        'controller' => 'require',
        'parent_id'  => 'checkParentId',
        'action'     => 'require|unique:AdminMenu,app^controller^action',
    ];

    protected $message = [
        'name.require'       => '名称不能为空',
        'app.require'        => '应用不能为空',
        'parent_id'          => '超过了4级',
        'controller.require' => '名称不能为空',
        'action.require'     => '名称不能为空',
        'action.unique'      => '同样的记录已经存在!',
    ];

    protected $scene = [
        'add'  => ['name', 'app', 'controller', 'action', 'parent_id'],
        'edit' => ['name', 'app', 'controller', 'action', 'id', 'parent_id'],

    ];

    // 自定义验证规则
    protected function checkParentId($value)
    {
        $find = Db::name('AdminMenu')->where(["id" => $value])->value('parent_id');

        if ($find) {
            $find2 = Db::name('AdminMenu')->where(["id" => $find])->value('parent_id');
            if ($find2) {
                $find3 = Db::name('AdminMenu')->where(["id" => $find2])->value('parent_id');
                if ($find3) {
                    return false;
                }
            }
        }
        return true;
    }
}