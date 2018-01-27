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
namespace app\admin\annotation;

use mindplay\annotations\AnnotationException;
use mindplay\annotations\Annotation;

/**
 * Specifies validation of a string, requiring a minimum and/or maximum length.
 *
 * @usage('class'=>true, 'inherited'=>true, 'multiple'=>true)
 */
class AdminMenuRootAnnotation extends Annotation
{
    /**
     * @var int|null Minimum string length (or null, if no minimum)
     */
    public $remark = '';

    /**
     * @var int|null Maximum string length (or null, if no maximum)
     */
    public $icon = '';

    /**
     * @var int|null Minimum string length (or null, if no minimum)
     */
    public $name = '';

    public $action = '';

    public $param = '';

    public $parent = '';

    public $display = false;

    public $order = 10000;

    /**
     * Initialize the annotation.
     * @param array $properties
     */
    public function initAnnotation(array $properties)
    {
        parent::initAnnotation($properties);
    }
}
