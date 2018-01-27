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

namespace think\response;

use think\Request;
use think\Response;
use think\Session;
use think\Url;

class Redirect extends Response
{

    protected $options = [];

    // URL参数
    protected $params = [];

    public function __construct($data = '', $code = 302, array $header = [], array $options = [])
    {
        parent::__construct($data, $code, $header, $options);
        $this->cacheControl('no-cache,must-revalidate');
    }

    /**
     * 处理数据
     * @access protected
     * @param mixed $data 要处理的数据
     * @return mixed
     */
    protected function output($data)
    {
        $this->header['Location'] = $this->getTargetUrl();
        return;
    }

    /**
     * 重定向传值（通过Session）
     * @access protected
     * @param string|array  $name 变量名或者数组
     * @param mixed         $value 值
     * @return $this
     */
    public function with($name, $value = null)
    {
        if (is_array($name)) {
            foreach ($name as $key => $val) {
                Session::flash($key, $val);
            }
        } else {
            Session::flash($name, $value);
        }
        return $this;
    }

    /**
     * 获取跳转地址
     * @return string
     */
    public function getTargetUrl()
    {
        if (strpos($this->data, '://') || (0 === strpos($this->data, '/') && empty($this->params))) {
            return $this->data;
        } else {
            return Url::build($this->data, $this->params);
        }
    }

    public function params($params = [])
    {
        $this->params = $params;
        return $this;
    }

    /**
     * 记住当前url后跳转
     * @return $this
     */
    public function remember()
    {
        Session::set('redirect_url', Request::instance()->url());
        return $this;
    }

    /**
     * 跳转到上次记住的url
     * @return $this
     */
    public function restore()
    {
        if (Session::has('redirect_url')) {
            $this->data = Session::get('redirect_url');
            Session::delete('redirect_url');
        }
        return $this;
    }
}