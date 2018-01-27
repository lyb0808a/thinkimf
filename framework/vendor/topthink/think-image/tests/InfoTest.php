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

class InfoTest extends TestCase
{

    public function testOpen()
    {
        $this->setExpectedException("\\think\\image\\Exception");
        Image::open('');
    }

    public function testIllegal()
    {
        $this->setExpectedException("\\think\\image\\Exception", 'Illegal image file');
        Image::open(TEST_PATH . 'images/test.bmp');
    }

    public function testJpeg()
    {
        $image = Image::open($this->getJpeg());
        $this->assertEquals(800, $image->width());
        $this->assertEquals(600, $image->height());
        $this->assertEquals('jpeg', $image->type());
        $this->assertEquals('image/jpeg', $image->mime());
        $this->assertEquals([800, 600], $image->size());
    }


    public function testPng()
    {
        $image = Image::open($this->getPng());
        $this->assertEquals(800, $image->width());
        $this->assertEquals(600, $image->height());
        $this->assertEquals('png', $image->type());
        $this->assertEquals('image/png', $image->mime());
        $this->assertEquals([800, 600], $image->size());
    }

    public function testGif()
    {
        $image = Image::open($this->getGif());
        $this->assertEquals(380, $image->width());
        $this->assertEquals(216, $image->height());
        $this->assertEquals('gif', $image->type());
        $this->assertEquals('image/gif', $image->mime());
        $this->assertEquals([380, 216], $image->size());
    }
}