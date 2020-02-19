<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2018 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +---------------------------------------------------------------------
// | Author: 小夏 < 449134904@qq.com>
// +----------------------------------------------------------------------
namespace cmf\controller;

use think\Db;

class ErpadminBaseController extends BaseController
{

    public function _initialize()
    {
        parent::_initialize();
        $erp_admin_user_info = session('erp_admin_user_info');
        $session_admin_id = $erp_admin_user_info['id'];
        if (!empty($session_admin_id)) {
            $user = Db::name('user')->where(['id' => $session_admin_id])->find();

            if (!$this->checkAccess($session_admin_id)) {
                //$this->error("您没有访问权限！");
            }
            $this->assign("erp_admin_user_info", $user);
            $this->erp_admin_user_info = $user;
            $site_info = k_get_option('site_info',1);
            $this->assign("site_info", $site_info);
        } else {
            if ($this->request->isPost()) {
                $this->error("您还没有登录！", url("erpadmin/public/login"));
            } else {
                header("Location:" . url("erpadmin/public/login"));

        
                exit();
            }
        }
    }

    public function _initializeView()
    {
        $cmfAdminThemePath    = config('cmf_erpadmin_theme_path');
        $cmfAdminDefaultTheme = config('cmf_erpadmin_default_theme');

        $themePath = "{$cmfAdminThemePath}{$cmfAdminDefaultTheme}";

        $root = cmf_get_root();

        
        $viewReplaceStr = [
            '__ROOT__'     => $root,
            '__TMPL__'     => "{$root}/{$themePath}",
            '__STATIC__'   => "{$root}/static",
            '__WEB_ROOT__' => $root
        ];

        $viewReplaceStr = array_merge(config('view_replace_str'), $viewReplaceStr);
        config('template.view_base', "$themePath/");
        config('view_replace_str', $viewReplaceStr);
    }

    /**
     * 初始化后台菜单
     */
    public function initMenu()
    {
    }

    /**
     *  检查后台用户访问权限
     * @param int $userId 后台用户id
     * @return boolean 检查通过返回true
     */
    private function checkAccess($userId)
    {
        // 如果用户id是1，则无需判断
        if ($userId == 1) {
            return true;
        }

        $module     = $this->request->module();
        $controller = $this->request->controller();
        $action     = $this->request->action();
        $rule       = $module . $controller . $action;

        $notRequire = ["adminIndexindex", "adminMainindex"];
        if (!in_array($rule, $notRequire)) {
            return cmf_auth_check($userId);
        } else {
            return true;
        }
    }

}