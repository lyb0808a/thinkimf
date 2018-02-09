<?php

namespace app\Admin\controller;

use think\Controller;

class Index extends Controller
{
    public function index()
    {
        echo APP_ROOT;
        return $this->fetch('admin/index');
    }

    protected function LeftMenu()
    {

    }

    protected function TopMenu()
    {

    }

    public function MainFrameDefault()
    {
        return $this->fetch('main_default');
    }
}
