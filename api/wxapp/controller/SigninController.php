<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2017 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Dean <zxxjjforever@163.com>
// +----------------------------------------------------------------------
namespace api\wxapp\controller;

use cmf\controller\RestUserBaseController;
use think\Validate;
use think\Db;

class SigninController extends RestUserBaseController
{
    // 签到列表
    public function index()
    {

    }

    // 发起签到
    public function addSignIn()
    {

        if (!$this->request->isPost()) {
            $this->error('404');
        }
        $validate = new Validate([
            'date'           => 'require',
        ]);

        $validate->message([
            'date.require'           => '缺少参数date!',
        ]);

        $data = $this->request->param();
        if (!$validate->check($data)) {
            $this->error($validate->getError());
        }
        $date 		= $data['date'];
        $remark 	= $data['remark'];

        $code		= md5(time().rand(1000,9999));
        
        Db::name("sign_in")->insert([
            'create_user_id'        => $this->userId,
            'create_time'     		=> time(),
            'remark'          		=> $remark,
            'code'					=> $code,
            'end_time'				=> strtotime($date)
        ]);
        $this->success("添加成功!",['code'=>$code]);
    }

    // 签到列表
    public function SignInLog()
    {
    	
    }

    // 签到
    public function addSignInLog()
    {
    	$validate = new Validate([
            'code'           => 'require',
        ]);

        $validate->message([
            'code.require'           => '缺少参数code!',
        ]);

        $data = $this->request->param();
        if (!$validate->check($data)) {
            $this->error($validate->getError());
        }
        $code 		= $data['code'];
        $remark 	= $data['remark'];

        $findSignIn = Db::name("sign_in")
            		->where('code', $code)
            		->find();

        if(!$findSignIn){
        	$this->error('二维码无效!');
        }

        if($findSignIn['end_time'] < time()){
        	$this->error('已过签到时间!');
        }
        $findSignInLog = Db::name("sign_in_log")
            		->where('sign_in_id', $findSignIn['id'])
            		->where('create_user_id', $this->userId)
            		->find();
        if ($findSignInLog) {
        	$this->error('已签到!');
        }
        
        Db::name("sign_in_log")->insert([
            'sign_in_id'          	=> $findSignIn['id'],
            'create_user_id'        => $this->userId,
            'create_time'     		=> time(),
            'remark'          		=> $remark
        ]);
        $this->success("签到成功!");
    }

}
