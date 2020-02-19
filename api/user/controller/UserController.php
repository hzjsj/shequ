<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2018 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: kane <chengjin005@163.com>
// +----------------------------------------------------------------------
namespace api\user\controller;

use cmf\controller\RestUserBaseController;
use api\user\model\UserModel;

class UserController extends RestUserBaseController
{
    public function setting()
    {


        $param = $this->request->param();

    	$userModel 				= new UserModel();
        $editDataRrturn      	= $userModel->editData($param,$this->userId);
        if (!$editDataRrturn) {
        	$this->error('保存失败!');
        } else {
        	$this->success('保存成功!');
        }
        
    }

}
