<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2018 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 小夏 < 449134904@qq.com>
// +----------------------------------------------------------------------
namespace app\admin\controller;

use cmf\controller\AdminBaseController;
use think\Db;

class PublicController extends AdminBaseController
{
    public function _initialize()
    {
    }

    /**
     * 后台登陆界面
     */
  public function login()
    {
        

        $admin_user_info = session('admin_user_info');
        if (!empty($admin_user_info)) {//已经登录
            return redirect(url("admin/Index/index"));
        } else {
                $site_info = cmf_get_option('site_info',1);
                $this->assign("site_info", $site_info);
                return $this->fetch(":login");
            
        }
    }

    /**
     * 登录验证
     */
     public function doLogin()
    {
        
        
        //判断验证码是否为空
        $captcha = $this->request->param('captcha');
        if (empty($captcha)) {
            $this->error(lang('CAPTCHA_REQUIRED'));
        }
        //验证码
        if (!cmf_captcha_check($captcha)) {
            $this->error(lang('CAPTCHA_NOT_RIGHT'));
        }

        $name = $this->request->param("username");
        if (empty($name)) {
            $this->error(lang('USERNAME_OR_EMAIL_EMPTY'));
        }
        $pass = $this->request->param("password");
        if (empty($pass)) {
            $this->error(lang('PASSWORD_REQUIRED'));
        }
        if (strpos($name, "@") > 0) {//邮箱登陆
            $where['user_email'] = $name;
        } else {
            $where['user_login'] = $name;
        }

        $result = Db::name('user')->where($where)->find();

        if (!empty($result)) {
            if (cmf_compare_password($pass, $result['user_pass'])) {

                // if ($result["id"] != 1 &&  empty($result['status'])) {
                //     $this->error(lang('USE_DISABLED'));
                // }

                // $org_id = cookie("org_id_".$result["id"]);
                // if ($org_id) {
                //     $org_find = Db::name('org')->where(['id'=>$org_id])->find();
                //     session('org_info', $org_find);
                // } else {
                //     $org_user_select = Db::name('org_user')->where(['user_id'=>$result['id']])->select();

                //     $org_find = Db::name('org')->where(['id'=>$org_user_select[0]['org_id']])->find();
                //     session('org_info', $org_find);
                // }
                

                $result['last_login_ip']   = get_client_ip(0, true);
                $result['last_login_time'] = time();
                Db::name('user')->update($result);
                $token                     = cmf_generate_user_token($result["id"], 'web');
                if (!empty($token)) {
                    session('token', $token);
                }
                cookie("admin_username", $name, 3600 * 24 * 30);
                session('admin_user_info', $result);

                $this->success(lang('LOGIN_SUCCESS'),url("admin/Index/index"));
            } else {
                $this->error(lang('PASSWORD_NOT_RIGHT'));
            }
        } else {
            $this->error(lang('USERNAME_NOT_EXIST'));
        }
    }


    /**
     * 后台管理员退出
     */
    public function logout()
    {
        session('admin_user_info', null);
        return redirect(url('/admin', [], false, true));
    }


    public function switchOrg()
    {
        $param = $this->request->param();
        $user_session = session('admin_user_info');
        $org_id = $param['org_id'];
        $org_user_find = Db::name('org_user')->where(['user_id'=>$user_session['id'],'org_id'=>$org_id])->find();
        if ($org_user_find) {
            $org_find = Db::name('org')->where(['id'=>$org_id])->find();
            cookie("org_id_".$user_session["id"],$org_id);
            session('org_info', $org_find);
        }
        return redirect(url("admin/Index/index"));
    }
}