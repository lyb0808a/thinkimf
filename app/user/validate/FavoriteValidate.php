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
namespace app\user\validate;

use think\Validate;

class FavoriteValidate extends Validate
{
    protected $rule = [
        'id'    => 'require',
        'title' => 'require|checkTitle',
        'table' => 'require',
        'url'   => 'require|checkUrl',
    ];
    protected $message = [
        'id.require'    => '收藏内容ID不能为空!',
        'title.require' => '收藏内容标题不能为空!',
        'table.require' => '收藏内容所在表不能为空!',
        'url.require'   => '收藏内容链接不能为空!',
        'url.checkUrl'  => '收藏内容链接格式不正确!'
    ];

    protected $scene = [
    ];

    // 验证url 格式
    protected function checkUrl($value, $rule, $data)
    {
        $url = json_decode(base64_decode($value), true);

        if (!empty($url['action'])) {
            return true;
        }
        return '收藏内容链接格式不正确!';
    }

    // 验证url 格式
    protected function checkTitle($value, $rule, $data)
    {
        if (base64_decode($value)!==false) {
            return true;
        }
        return '收藏内容标题格式不正确!';
    }
}