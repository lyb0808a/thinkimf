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

namespace imf\controller;

use think\captcha\Captcha;
use think\Request;

class CaptchaController
{
    /**
     * captcha/new?height=50&width=200&font_size=25&length=4&bg=243,251,254&id=1
     * @param Request $request
     * @return \think\Response
     */
    public function index(Request $request)
    {
        $config = [
            // 验证码字体大小(px)
            'fontSize' => 25,
            // 验证码图片高度
            'imageH'   => 0,
            // 验证码图片宽度
            'imageW'   => 0,
            // 验证码位数
            'length'   => 4,
            // 背景颜色
            'bg'       => [243, 251, 254],
        ];

        $fontSize = $request->param('font_size', 25, 'intval');
        if ($fontSize > 8) {
            $config['fontSize'] = $fontSize;
        }

        $imageH = $request->param('height', '');
        if ($imageH != '') {
            $config['imageH'] = intval($imageH);
        }

        $imageW = $request->param('width', '');
        if ($imageW != '') {
            $config['imageW'] = intval($imageW);
        }

        $length = $request->param('length', 4, 'intval');
        if ($length > 2) {
            $config['length'] = $length;
        }

        $bg = $request->param('bg', '');

        if (!empty($bg)) {
            $bg = explode(',', $bg);
            array_walk($bg, 'intval');
            if (count($bg) > 2 && $bg[0] < 256 && $bg[1] < 256 && $bg[2] < 256) {
                $config['bg'] = $bg;
            }
        }

        $id = $request->param('id', 0, 'intval');
        if ($id > 5 || empty($id)) {
            $id = '';
        }

        $defaultCaptchaConfig = config('captcha');
        if($defaultCaptchaConfig && is_array($defaultCaptchaConfig)){
            $config = array_merge($defaultCaptchaConfig, $config);
        }

        $captcha = new Captcha($config);
        return $captcha->entry($id);
    }
}