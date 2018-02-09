<?php
/**
 *
 * ============================================================================
 * [UD DataMap BigData System] Copyright (c) 1995-2028 www.unnnnn.com
 * 版权所有 1995-2028 UD数据信息有限公司【中国】，并保留所有权利。
 * This is not  free soft ware, use is subject to license.txt
 * 网站地址: http://www.unnnnn.com；
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和
 * 使用；不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * $Author: 陈建华 $
 * $Create Time: 2018/2/9 0009 $
 * email:unnnnn@foxmail.com
 * function:Auth.php
 */

namespace think\route;

use think\Container;

abstract class Dispatch
{
    // 应用实例
    protected $app;
    // 调度信息
    protected $dispatch;
    // 调度参数
    protected $param;
    // 状态码
    protected $code;
    // 是否进行大小写转换
    protected $convert;

    public function __construct($dispatch, $param = [], $code = null)
    {
        $this->app      = Container::get('app');
        $this->dispatch = $dispatch;
        $this->param    = $param;
        $this->code     = $code;
    }

    public function convert($convert)
    {
        $this->convert = $convert;

        return $this;
    }

    public function getDispatch()
    {
        return $this->dispatch;
    }

    public function getParam()
    {
        return $this->param;
    }

    abstract public function run();

}
