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

namespace think;

class View
{
    /**
     * 模板引擎实例
     * @var object
     */
    public $engine;

    /**
     * 模板变量
     * @var array
     */
    protected $data = [];

    /**
     * 内容过滤
     * @var mixed
     */
    protected $filter;

    /**
     * 全局模板变量
     * @var array
     */
    protected static $var = [];

    /**
     * 初始化
     * @access public
     * @param  mixed $engine  模板引擎参数
     * @return $this
     */
    public function init($engine = [])
    {
        // 初始化模板引擎
        $this->engine($engine);

        return $this;
    }

    /**
     * 模板变量静态赋值
     * @access public
     * @param  mixed $name  变量名
     * @param  mixed $value 变量值
     * @return $this
     */
    public function share($name, $value = '')
    {
        if (is_array($name)) {
            self::$var = array_merge(self::$var, $name);
        } else {
            self::$var[$name] = $value;
        }

        return $this;
    }

    /**
     * 模板变量赋值
     * @access public
     * @param  mixed $name  变量名
     * @param  mixed $value 变量值
     * @return $this
     */
    public function assign($name, $value = '')
    {
        if (is_array($name)) {
            $this->data = array_merge($this->data, $name);
        } else {
            $this->data[$name] = $value;
        }

        return $this;
    }

    /**
     * 设置当前模板解析的引擎
     * @access public
     * @param  array|string $options 引擎参数
     * @return $this
     */
    public function engine($options = [])
    {
        if (is_string($options)) {
            $type    = $options;
            $options = [];
        } else {
            $type = !empty($options['type']) ? $options['type'] : 'Think';
        }

        $class = false !== strpos($type, '\\') ? $type : '\\think\\view\\driver\\' . ucfirst($type);

        if (isset($options['type'])) {
            unset($options['type']);
        }

        $this->engine = new $class($options);

        return $this;
    }

    /**
     * 配置模板引擎
     * @access public
     * @param  string|array  $name 参数名
     * @param  mixed         $value 参数值
     * @return $this
     */
    public function config($name, $value = null)
    {
        $this->engine->config($name, $value);

        return $this;
    }

    /**
     * 检查模板是否存在
     * @access public
     * @param  string|array  $name 参数名
     * @return bool
     */
    public function exists($name)
    {
        return $this->engine->exists($name);
    }

    /**
     * 视图过滤
     * @access public
     * @param Callable  $filter 过滤方法或闭包
     * @return $this
     */
    public function filter($filter)
    {
        $this->filter = $filter;
        return $this;
    }

    /**
     * 解析和获取模板内容 用于输出
     * @access public
     * @param  string    $template 模板文件名或者内容
     * @param  array     $vars     模板输出变量
     * @param  array     $config     模板参数
     * @param  bool      $renderContent     是否渲染内容
     * @return string
     * @throws \Exception
     */
    public function fetch($template = '', $vars = [], $config = [], $renderContent = false)
    {
        // 模板变量
        $vars = array_merge(self::$var, $this->data, $vars);

        // 页面缓存
        ob_start();
        ob_implicit_flush(0);

        // 渲染输出
        try {
            $method = $renderContent ? 'display' : 'fetch';
            $this->engine->$method($template, $vars, $config);
        } catch (\Exception $e) {
            ob_end_clean();
            throw $e;
        }

        // 获取并清空缓存
        $content = ob_get_clean();

        if ($this->filter) {
            $content = call_user_func_array($this->filter, [$content]);
        }

        return $content;
    }

    /**
     * 渲染内容输出
     * @access public
     * @param  string $content 内容
     * @param  array  $vars    模板输出变量
     * @param  array  $config  模板参数
     * @return mixed
     */
    public function display($content, $vars = [], $config = [])
    {
        return $this->fetch($content, $vars, $config, true);
    }

    /**
     * 模板变量赋值
     * @access public
     * @param  string    $name  变量名
     * @param  mixed     $value 变量值
     */
    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    /**
     * 取得模板显示变量的值
     * @access protected
     * @param  string $name 模板变量
     * @return mixed
     */
    public function __get($name)
    {
        return $this->data[$name];
    }

    /**
     * 检测模板变量是否设置
     * @access public
     * @param  string $name 模板变量名
     * @return bool
     */
    public function __isset($name)
    {
        return isset($this->data[$name]);
    }
}
