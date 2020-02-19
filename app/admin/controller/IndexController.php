<?php
namespace app\admin\controller;
use cmf\controller\AdminBaseController;
use think\Db;

class IndexController extends AdminBaseController
{
     public function index()
    {
        return $this->fetch(":index");
    }

    public function welcome()
    {
        return $this->fetch();
    }
}
