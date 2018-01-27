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

use app\admin\model\RouteModel;
use think\Validate;

class SettingSiteValidate extends Validate
{
    protected $rule = [
        'options.site_name'             => 'require',
        'admin_settings.admin_password' => 'alphaNum|checkAlias'
    ];

    protected $message = [
        'options.site_name.require'                => '网站名称不能为空',
        'admin_settings.admin_password.alphaNum'   => '后台加密码只能是英文字母和数字',
        'admin_settings.admin_password.checkAlias' => '此加密码不能使用!',
    ];


    // 自定义验证规则
    protected function checkAlias($value, $rule, $data)
    {
        if (empty($value)) {
            return true;
        }

        if(preg_match('/^\d+$/',$value)){
            return "加密码不能是纯数字！";
        }

        $routeModel = new RouteModel();
        $fullUrl    = $routeModel->buildFullUrl('admin/Index/index', []);
        if (!$routeModel->exists($value.'$', $fullUrl)) {
            return true;
        } else {
            return "URL规则已经存在,无法设置此加密码!";
        }

    }

}