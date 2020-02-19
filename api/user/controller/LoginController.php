<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2017 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Dean <zxxjjforever@163.com>
// +----------------------------------------------------------------------
namespace api\user\controller;

use cmf\controller\RestBaseController;
use think\Validate;
use think\Db;
use api\user\model\UserModel;

class LoginController extends RestBaseController
{
    // 登录
    public function index()
    {
        if ($this->request->isPost()) {
            $validate = new \think\Validate([
                //'captcha'  => 'require',
                'username' => 'require',
                'password' => 'require|min:6|max:32',
            ]);
            $validate->message([
                'username.require' => '用户名不能为空',
                'password.require' => '密码不能为空',
                'password.max'     => '密码不能超过32个字符',
                'password.min'     => '密码不能小于6个字符',
                //'captcha.require'  => '验证码不能为空',
            ]);

            $data = $this->request->post();
            if (!$validate->check($data)) {
                $this->error($validate->getError());
            }

            //if (!cmf_captcha_check($data['captcha'])) {
                //$this->error('验证码错误!');
            //}

            $userModel         = new UserModel();
            $user['user_pass'] = $data['password'];
            if (Validate::is($data['username'], 'email')) {
                $user['user_email'] = $data['username'];
                $log                = $userModel->doEmail($user);
            } else if (cmf_check_mobile($data['username'])) {
                $user['mobile'] = $data['username'];
                $log            = $userModel->doMobile($user);
            } else {
                $user['user_login'] = $data['username'];
                $log                = $userModel->doName($user);
            }

            switch ($log) {
                case 0:
                    cmf_user_action('login');
                    $userInfo = session('user');
                    unset($userInfo['user_pass']);


                    $userInfo['avatar'] = cmf_get_image_url($userInfo['avatar']);

                    $this->success("ok", ['token' => session('token'), 'user' =>$userInfo ]);
                    break;
                case 1:
                    $this->error('密码错误!');
                    break;
                case 2:
                    $this->error('账户不存在!');
                    break;
                case 3:
                    $this->error('账号被禁止访问系统');
                    break;
                default :
                    $this->error('未受理的请求');
            }
        } else {
            $this->error("请求错误");
        }
    }


    //注册
    public function register()
    {
        if ($this->request->isPost()) {
            $validate = new \think\Validate([
                //'captcha'  => 'require',
                'nickname' => 'require|min:1|max:16',
                'username' => 'require|min:6|max:32',
                'password' => 'require|min:6|max:32',
                'password2' => 'require|min:6|max:32',
            ]);
            $validate->message([
                'nickname.require' => '昵称不能为空',
                'nickname.max'     => '昵称不能超过16个字符',
                'nickname.min'     => '昵称不能小于1个字符',
                'username.require' => '账号不能为空',
                'username.max'     => '账号不能超过32个字符',
                'username.min'     => '账号不能小于6个字符',
                'password.require' => '密码不能为空',
                'password.max'     => '密码不能超过32个字符',
                'password.min'     => '密码不能小于6个字符',
                'password2.require' => '确认密码不能为空',
                'password2.max'     => '确认密码不能超过32个字符',
                'password2.min'     => '确认密码不能小于6个字符',
                //'captcha.require'  => '验证码不能为空',
            ]);

            $post = $this->request->post();
            if (!$validate->check($post)) {
                $this->error($validate->getError());
            }

            //if (!cmf_captcha_check($data['captcha'])) {
                //$this->error('验证码错误!');
            //}

            $user_find = Db::name('user')
                        ->where(['user_login' => $post['username']])
                        ->find();

            if ($user_find) {
                $this->error('账号已存在!');
            } 
            if ($post['password'] != $post['password2']) {
                $this->error('两次密码不一致!');
            }
            


            $data['user_nickname']  = $post['nickname']; 
            $data['user_login']     = $post['username']; 
            $data['user_pass']      = cmf_password($post['password']); 
            
            $r = Db::name('user')->insert($data);
            if (!$r) {
                $this->error('注册失败!');
            } else {
                $this->success('注册成功!');
            }
            

        } else {
            $this->error("请求错误");
        }
    }

}
