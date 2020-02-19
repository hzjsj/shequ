<?php
namespace app\index\controller;
use cmf\controller\HomeBaseController;
use think\Db;
class LoginController extends HomeBaseController 
{
    public function index()
    {
        return $this->fetch();
    }

         //注册用户
    public function reg()
    {
        if ($this->request->isPost()) {
            $param = $this->request->param();
            if (!cmf_captcha_check($param['vercode'])) {
            $this->error('验证码错误！');
            }
            $zh=Db::name('user')->where('user_login',$param['cellphone'])->value('user_login');
            // p($zh);die;
            if ($zh) {
               $this->error('手机号已被注册。。。');
            }
            $user = ['user_nickname'=>$param['nickname'],
            'user_pass'=>cmf_password($param['password']),
            'user_login'=>$param['cellphone'],'user_type'=>'2'];
            $r = Db::name('user')->insert($user);
            if($r){
                $this->success('注册成功，跳转中。。。');
            } else {
                $this->error('注册失败！');
            }
        }else{
          return $this->fetch();   
        }    
    }
    public function login()
    {
        return $this->fetch();
    }


    // 登入
     public function doLogin()
    {
        
        
        //判断验证码是否为空
        $captcha = $this->request->param('captcha');
        if (empty($captcha)) {
            $this->error(lang('CAPTCHA_REQUIRED'));
        }
        //验证码
        if (!cmf_captcha_check($captcha)) {
            $this->error(lang('验证码错误！'));
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
                $result['last_login_ip']   = get_client_ip(0, true);
                $result['last_login_time'] = time();
                Db::name('user')->update($result);
                $token                     = cmf_generate_user_token($result["id"], 'web');
                if (!empty($token)) {
                    session('token', $token);
                }
                cookie("username", $name, 3600 * 24 * 30);
                session('user_info', $result);
			//p($result);          
 			$return_data = array(
                'code'=>1,
                'data'=>"登录成功，跳转中。。。",
                'url'=>url('index/index'),
            );
              return json($return_data);

            } else {
                $this->error(lang('密码错误!'));
            }
        } else {
            $this->error(lang('用户名不存在!'));
        }
    }

        /**
     * 退出
     */
    public function logout()
    {
        session('user_info', null);
        return redirect(url('/', [], false, true));
    }
}
