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


class PublicController extends RestUserBaseController
{
    public function getUserInfo()
    {
    	$user = $this->user;
    	$user['birthday'] = $user['birthday'] ? date('Y-m-d',$user['birthday']):'';
        $this->success('ok',$user);
    }

}
