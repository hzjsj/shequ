<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:28:"themes/erp/admin\\index.html";i:1568531853;}*/ ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>管理端</title>
    <link rel="icon" href="/themes/erp/public/assets/images/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="/themes/erp/public/assets/lib/layui-v2.5.5/layui/css/layui.css">
    <link rel="stylesheet" type="text/css" href="/themes/erp/public/assets/lib/font-awesome-4.7.0/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="/themes/erp/public/assets/lib/layui-lib/css/app.css">
</head>

<body>
    <div class="layui-layout layui-layout-admin k-layout-admin">
        <div class="layui-header">
            <div class="layui-logo">管理端</div>
            <div class="layui-logo k-logo-mobile">管理端</div>
            <ul class="layui-nav layui-layout-left k-nav">
                <li class="layui-nav-item layui-this" k-onelevel><a href="javascript:;">网站管理</a></li>
                <li class="layui-nav-item" data-v="11" k-onelevel><a href="javascript:;">后台设置</a></li>
            </ul>
            <ul class="layui-nav layui-layout-right k-nav" style="margin-right: 30px;">
                <li class="layui-nav-item">
                    <a href="javascript:;">
                        <img src="<?php echo cmf_get_user_avatar_url($admin_user_info['avatar']); ?>" class="layui-nav-img"
                            onerror="javascript:this.src='/themes/erp/public/assets/images/default_head_img.gif';">
                        <?php echo $admin_user_info['user_nickname']; ?>
                    </a>
                    <dl class="layui-nav-child">
                        <dd><a href="javascript:;" k-target data-url="<?php echo url('setting/info'); ?>"
                            data-title="基本资料"><span>基本资料</span></a>
                        </dd>
                        <dd><a href="javascript:;" k-target data-url="<?php echo url('setting/password'); ?>"
                            data-title="修改密码"><span>修改密码</span></a>
                        </dd>
                        <dd><a href="<?php echo url('public/logout'); ?>" k-target><span>退出账号</span></a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item" style="display: none;">
                    <a href="javascript:;">消息<span class="layui-badge">9</span></a>
                </li>
            </ul>
        </div>
        <div class="layui-side layui-bg-black k-side">
            <div class="layui-side-scroll">
                <div class="k-side-fold"><i class="fa fa-navicon" aria-hidden="true"></i></div>
                <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
                <ul class="layui-nav layui-nav-tree nav-on" lay-filter="kNavbar" k-navbar>
                    <li class="layui-nav-item">
                        <a href="javascript:;" k-target data-url="<?php echo url('notice/index'); ?>"
                            data-title="网站公告"><span>网站公告</span></a>
                    </li>
                    <li class="layui-nav-item">
                        <a href="javascript:;">一级菜单</a>
                        <dl class="layui-nav-child">
                            <a href="javascript:;">二级菜单</a>
                            <dl class="layui-nav-child">
                                <dd><a href="javascript:;" k-target data-url="<?php echo url('baidu'); ?>" data-title="三级菜单"><span>三级菜单</span></a></dd>
                            </dl>
                            </dd>
                        </dl>
                    </li>
                </ul>
                <ul class="layui-nav layui-nav-tree" k-navbar>
                    <li class="layui-nav-item">
                        <a href="javascript:;" k-target data-url="<?php echo url('setting/site'); ?>"
                            data-title="网站设置"><span>网站设置</span></a>
                    </li>
                    <li class="layui-nav-item">
                        <a href="javascript:;">用户管理</a>
                        <dl class="layui-nav-child">
                            <dd><a href="javascript:;" k-target data-url="<?php echo url('user/index'); ?>"
                                    data-title="网站用户"><span>网站用户</span></a></dd>
                        </dl>
                        <dl class="layui-nav-child">
                            <dd><a href="javascript:;" k-target data-url="<?php echo url('rule/role'); ?>"
                                    data-title="角色管理"><span>角色管理</span></a></dd>
                        </dl>
                        <dl class="layui-nav-child">
                            <dd><a href="javascript:;" k-target data-url="<?php echo url('rule/index'); ?>"
                                    data-title="节点管理"><span>节点管理</span></a></dd>
                        </dl>
                    </li>
                </ul>
            </div>
        </div>
        <div class="layui-body" id="container">
            <!-- 内容主体区域 -->
            <div style="padding: 15px;">主体内容加载中,请稍等...</div>
        </div>
        <div class="layui-footer">
            <!-- 底部固定区域 -->
            2018 &copy;
            <a href="http://www.baidu.com/">www.baidu.com/</a> MIT license
        </div>
    </div>
    <script type="text/javascript" src="/themes/erp/public/assets/lib/layui-v2.5.5/layui/layui.js"></script>
    <script>
        var _tools, message;
        layui.config({
            base: '/themes/erp/public/assets/lib/layui-lib/js/'
        }).use(['app', 'message', 'jquery', 'tab'], function () {
            var app = layui.app,
                layer = layui.layer,
                $ = layui.jquery,
                tab = layui.tab;
            //将message设置为全局以便子页面调用
            message = layui.message;
            //主入口
            app.set({
                mainUrl: '<?php echo url('welcome'); ?>',//首页定义
            }).init();
            _tools = {
                tabAdd: function (options) {
                    tab.tabAdd({
                        title: options.title,
                        icon: options.icon,
                        url: options.url
                    })
                }
            }
        });
    </script>
</body>

</html>