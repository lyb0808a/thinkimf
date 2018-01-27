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
namespace app\portal\controller;

use app\admin\model\RouteModel;
use imf\controller\AdminBaseController;
use app\portal\model\PortalPostModel;
use app\portal\service\PostService;
use app\admin\model\ThemeModel;

class AdminPageController extends AdminBaseController
{

    /**
     * 页面管理
     * @adminMenu(
     *     'name'   => '页面管理',
     *     'parent' => 'portal/AdminIndex/default',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '页面管理',
     *     'param'  => ''
     * )
     */
    public function index()
    {
        $param = $this->request->param();

        $postService = new PostService();
        $data        = $postService->adminPageList($param);
        $data->appends($param);

        $this->assign('keyword', isset($param['keyword']) ? $param['keyword'] : '');
        $this->assign('pages', $data->items());
        $this->assign('page', $data->render());

        return $this->fetch();
    }

    /**
     * 添加页面
     * @adminMenu(
     *     'name'   => '添加页面',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '添加页面',
     *     'param'  => ''
     * )
     */
    public function add()
    {
        $themeModel     = new ThemeModel();
        $pageThemeFiles = $themeModel->getActionThemeFiles('portal/Page/index');
        $this->assign('page_theme_files', $pageThemeFiles);
        return $this->fetch();
    }

    /**
     * 添加页面提交
     * @adminMenu(
     *     'name'   => '添加页面提交',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '添加页面提交',
     *     'param'  => ''
     * )
     */
    public function addPost()
    {
        $data = $this->request->param();

        $result = $this->validate($data['post'], 'AdminPage');
        if ($result !== true) {
            $this->error($result);
        }

        $portalPostModel = new PortalPostModel();
        $portalPostModel->adminAddPage($data['post']);
        $this->success(lang('ADD_SUCCESS'), url('AdminPage/edit', ['id' => $portalPostModel->id]));

    }

    /**
     * 编辑页面
     * @adminMenu(
     *     'name'   => '编辑页面',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '编辑页面',
     *     'param'  => ''
     * )
     */
    public function edit()
    {
        $id = $this->request->param('id', 0, 'intval');

        $portalPostModel = new PortalPostModel();
        $post            = $portalPostModel->where('id', $id)->find();

        $themeModel     = new ThemeModel();
        $pageThemeFiles = $themeModel->getActionThemeFiles('portal/Page/index');

        $routeModel         = new RouteModel();
        $alias              = $routeModel->getUrl('portal/Page/index', ['id' => $id]);
        $post['post_alias'] = $alias;
        $this->assign('page_theme_files', $pageThemeFiles);
        $this->assign('post', $post);

        return $this->fetch();
    }

    /**
     * 编辑页面提交
     * @adminMenu(
     *     'name'   => '编辑页面提交',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '编辑页面提交',
     *     'param'  => ''
     * )
     */
    public function editPost()
    {
        $data = $this->request->param();

        $result = $this->validate($data['post'], 'AdminPage');
        if ($result !== true) {
            $this->error($result);
        }

        $portalPostModel = new PortalPostModel();

        $portalPostModel->adminEditPage($data['post']);

        $this->success(lang('SAVE_SUCCESS'));

    }

    /**
     * 删除页面
     * @author    iyting@foxmail.com
     * @adminMenu(
     *     'name'   => '删除页面',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '删除页面',
     *     'param'  => ''
     * )
     */
    public function delete()
    {
        $portalPostModel = new PortalPostModel();
        $data            = $this->request->param();

        $result = $portalPostModel->adminDeletePage($data);
        if ($result) {
            $this->success(lang('DELETE_SUCCESS'));
        } else {
            $this->error(lang('DELETE_FAILED'));
        }

    }

}
