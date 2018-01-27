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

namespace think\helper;


class Hash
{
    protected static $handle = [];

    public static function make($value, $type = null, array $options = [])
    {
        return self::handle($type)->make($value, $options);
    }

    public static function check($value, $hashedValue, $type = null, array $options = [])
    {
        return self::handle($type)->check($value, $hashedValue, $options);
    }

    public static function handle($type)
    {
        if (is_null($type)) {
            if (PHP_VERSION_ID >= 50500) {
                $type = 'bcrypt';
            } else {
                $type = 'md5';
            }
        }
        if (empty(self::$handle[$type])) {
            $class = "\\think\\helper\\hash\\" . ucfirst($type);
            if (!class_exists($class)) {
                throw new \ErrorException("Not found {$type} hash type!");
            }
            self::$handle[$type] = new $class();
        }
        return self::$handle[$type];
    }

}