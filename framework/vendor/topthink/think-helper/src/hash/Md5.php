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
namespace think\helper\hash;

class Md5
{

    protected $salt = 'think';

    public function make($value, array $options = [])
    {
        $salt = isset($options['salt']) ? $options['salt'] : $this->salt;

        return md5(md5($value) . $salt);
    }

    public function check($value, $hashedValue, array $options = [])
    {
        if (strlen($hashedValue) === 0) {
            return false;
        }

        $salt = isset($options['salt']) ? $options['salt'] : $this->salt;

        return md5(md5($value) . $salt) == $hashedValue;
    }

    public function setSalt($salt)
    {
        $this->salt = (string)$salt;

        return $this;
    }
}