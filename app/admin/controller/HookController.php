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
namespace app\admin\controller;

use imf\controller\AdminBaseController;
use app\admin\model\HookModel;
use app\admin\model\PluginModel;
use app\admin\model\HookPluginModel;
use think\Db;

/**
 * Class HookController 钩子管理控制器
 * @package app\admin\controller
 */
class HookController extends AdminBaseController
{
    /**
     * 钩子管理
     * @adminMenu(
     *     'name'   => '钩子管理',
     *     'parent' => 'admin/Plugin/default',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '钩子管理',
     *     'param'  => ''
     * )
     */
    public function index()
    {
        $hookModel = new HookModel();
        $hooks     = $hookModel->select();
        $this->assign('hooks', $hooks);
        return $this->fetch();
    }

    /**
     * 钩子插件管理
     * @adminMenu(
     *     'name'   => '钩子插件管理',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '钩子插件管理',
     *     'param'  => ''
     * )
     */
    public function plugins()
    {
        $hook        = $this->request->param('hook');
        $pluginModel = new PluginModel();
        $plugins     = $pluginModel->field('a.*,b.hook,b.plugin,b.list_order,b.status as hook_plugin_status,b.id as hook_plugin_id')->alias('a')->join('__HOOK_PLUGIN__ b', 'a.name = b.plugin')->where('b.hook', $hook)->select();
        $this->assign('plugins', $plugins);
        return $this->fetch();
    }

    /**
     * 钩子插件排序
     * @adminMenu(
     *     'name'   => '钩子插件排序',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '钩子插件排序',
     *     'param'  => ''
     * )
     */
    public function pluginListOrder()
    {
        $hookPluginModel = new HookPluginModel();
        parent::listOrders($hookPluginModel);

        $this->success("排序更新成功！");
    }

    /**
     * 同步钩子
     * @adminMenu(
     *     'name'   => '同步钩子',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '同步钩子',
     *     'param'  => ''
     * )
     */
    public function sync()
    {

        $apps = imf_scan_dir(APP_PATH . '*', GLOB_ONLYDIR);

        foreach ($apps as $app) {
            $hookConfigFile = APP_PATH . $app . '/hooks.php';
            if (file_exists($hookConfigFile)) {
                $hooksInFile = include $hookConfigFile;

                foreach ($hooksInFile as $hookName => $hook) {

                    $hook['type'] = empty($hook['type']) ? 2 : $hook['type'];

                    if (!in_array($hook['type'], [2, 3, 4])) {
                        $hook['type'] = 2;
                    }

                    $findHook = Db::name('hook')->where(['hook' => $hookName])->count();

                    $hook['app'] = $app;

                    if ($findHook > 0) {
                        Db::name('hook')->where(['hook' => $hookName])->strict(false)->field(true)->update($hook);
                    } else {
                        $hook['hook'] = $hookName;
                        Db::name('hook')->insert($hook);
                    }
                }
            }
        }

        return $this->fetch();
    }


}