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
namespace plugins\demo;//Demo插件英文名，改成你的插件英文就行了
use imf\lib\Plugin;

//Demo插件英文名，改成你的插件英文就行了
class DemoPlugin extends Plugin
{

    public $info = [
        'name'        => 'Demo',//Demo插件英文名，改成你的插件英文就行了
        'title'       => '插件演示',
        'description' => '插件演示',
        'status'      => 1,
        'author'      => 'ThinkIMF',
        'version'     => '1.0',
        'demo_url'    => 'http://default.thinkcmf.com',
        'author_url'  => 'https://www.thinkimf.com'
    ];

    public $hasAdmin = 1;//插件是否有后台管理界面

    // 插件安装
    public function install()
    {
        return true;//安装成功返回true，失败false
    }

    // 插件卸载
    public function uninstall()
    {
        return true;//卸载成功返回true，失败false
    }

    //实现的footer_start钩子方法
    public function footerStart($param)
    {
        $config = $this->getConfig();
        $this->assign($config);
        echo $this->fetch('widget');
    }

}