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
namespace tests;

use think\Image;

class WaterTest extends TestCase
{
    public function testJpeg()
    {
        $pathname = TEST_PATH . 'tmp/water.jpg';
        $image    = Image::open($this->getJpeg());

        $image->water(TEST_PATH . 'images/test.gif')->save($pathname);

        $file = new \SplFileInfo($pathname);

        $this->assertTrue($file->isFile());

        @unlink($pathname);
    }

    public function testPng()
    {
        $pathname = TEST_PATH . 'tmp/water.png';
        $image    = Image::open($this->getPng());

        $image->water(TEST_PATH . 'images/test.gif')->save($pathname);

        $file = new \SplFileInfo($pathname);

        $this->assertTrue($file->isFile());

        @unlink($pathname);
    }

    public function testGif()
    {
        $pathname = TEST_PATH . 'tmp/water.gif';
        $image    = Image::open($this->getGif());

        $image->water(TEST_PATH . 'images/test.jpg')->save($pathname);

        $file = new \SplFileInfo($pathname);

        $this->assertTrue($file->isFile());

        @unlink($pathname);
    }
}