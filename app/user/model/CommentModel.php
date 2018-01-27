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
namespace app\user\model;

use think\Model;

class CommentModel extends Model
{
    /**
     * 关联 user表
     * @return $this
     */
    public function user()
    {
        return $this->belongsTo('UserModel', 'user_id')->setEagerlyType(1);
    }


    /**
     * content 自动转化
     * @param $value
     * @return string
     */
    public function getContentAttr($value)
    {
        return imf_replace_content_file_url(htmlspecialchars_decode($value));
    }

    /**
     * content 自动转化
     * @param $value
     * @return string
     */
    public function setContentAttr($value)
    {

        $config = \HTMLPurifier_Config::createDefault();
        if (!file_exists(RUNTIME_PATH . 'HTMLPurifier_DefinitionCache_Serializer')) {
            mkdir(RUNTIME_PATH . 'HTMLPurifier_DefinitionCache_Serializer');
        }

        $config->set('Cache.SerializerPath', RUNTIME_PATH . 'HTMLPurifier_DefinitionCache_Serializer');
        $purifier  = new \HTMLPurifier($config);
        $cleanHtml = $purifier->purify(imf_replace_content_file_url(htmlspecialchars_decode($value), true));
        return htmlspecialchars($cleanHtml);
    }

}

