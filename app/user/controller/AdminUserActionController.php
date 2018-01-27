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

namespace app\user\controller;

use imf\controller\AdminBaseController;
use think\Db;

/**
 * Class AdminUserActionController
 * @package app\user\controller
 */
class AdminUserActionController extends AdminBaseController
{

    /**
     * 用户操作管理
     * @adminMenu(
     *     'name'   => '用户操作管理',
     *     'parent' => 'admin/Setting/default',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '用户操作管理',
     *     'param'  => ''
     * )
     */
    public function index()
    {
        $where   = [];
        $request = input('request.');

        if (!empty($request['uid'])) {
            $where['id'] = intval($request['uid']);
        }
        $keywordComplex = [];
        if (!empty($request['keyword'])) {
            $keyword = $request['keyword'];

            $keywordComplex['user_login']    = ['like', "%$keyword%"];
            $keywordComplex['user_nickname'] = ['like', "%$keyword%"];
            $keywordComplex['user_email']    = ['like', "%$keyword%"];
        }

        $actions = Db::name('user_action')->paginate(20);
        // 获取分页显示
        $page = $actions->render();
        $this->assign('actions', $actions);
        $this->assign('page', $page);
        // 渲染模板输出
        return $this->fetch();
    }

    /**
     * 编辑用户操作
     * @adminMenu(
     *     'name'   => '编辑用户操作',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '编辑用户操作',
     *     'param'  => ''
     * )
     */
    public function edit()
    {
        $id     = $this->request->param('id', 0, 'intval');
        $action = Db::name('user_action')->where('id', $id)->find();
        $this->assign($action);

        return $this->fetch();
    }

    /**
     * 编辑用户操作提交
     * @adminMenu(
     *     'name'   => '编辑用户操作提交',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '编辑用户操作提交',
     *     'param'  => ''
     * )
     */
    public function editPost()
    {
        $id = $this->request->param('id', 0, 'intval');

        $data = $this->request->param();

        Db::name('user_action')->where('id', $id)
            ->strict(false)
            ->field('score,coin,reward_number,cycle_type,cycle_time')
            ->update($data);

        $this->success('保存成功！');
    }

    /**
     * 同步用户操作
     * @adminMenu(
     *     'name'   => '同步用户操作',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '同步用户操作',
     *     'param'  => ''
     * )
     */
    public function sync()
    {

        $apps = imf_scan_dir(APP_PATH . '*', GLOB_ONLYDIR);

        foreach ($apps as $app) {
            $userActionConfigFile = APP_PATH . $app . '/user_action.php';
            if (file_exists($userActionConfigFile)) {
                $userActionsInFile = include $userActionConfigFile;

                foreach ($userActionsInFile as $userActionKey => $userAction) {

                    $userAction['cycle_type'] = empty($userAction['cycle_type']) ? 0 : $userAction['cycle_type'];

                    if (!in_array($userAction['cycle_type'], [0, 1, 2, 3])) {
                        $userAction['cycle_type'] = 0;
                    }

                    if (!empty($userAction['url']) && is_array($userAction['url']) && !empty($userAction['url']['action'])) {
                        $userAction['url'] = json_encode($userAction['url']);
                    } else {
                        $userAction['url'] = '';
                    }

                    $findUserAction = Db::name('user_action')->where(['action' => $userActionKey])->count();

                    $userAction['app'] = $app;

                    if ($findUserAction > 0) {
                        Db::name('user_action')->where(['action' => $userActionKey])
                            ->strict(false)->field(true)
                            ->update([
                                'name' => $userAction['name'],
                                'url'  => $userAction['url']
                            ]);
                    } else {
                        $userAction['action'] = $userActionKey;
                        Db::name('user_action')->strict(false)
                            ->field(true)
                            ->insert($userAction);
                    }
                }
            }
        }

        return $this->fetch();
    }


}
