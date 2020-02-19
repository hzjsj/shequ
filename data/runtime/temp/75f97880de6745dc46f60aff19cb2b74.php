<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:36:"themes/home/index\user\password.html";i:1562660729;s:56:"E:\web\www915\public\themes\home\index\common\index.html";i:1562661653;}*/ ?>
<!DOCTYPE html>
<html>

<head>
  <title></title>
  <link rel="stylesheet" href="/themes/home/public/shequ/layui/css/layui.css">
  <link rel="stylesheet" href="/themes/home/public/shequ/css/index.css">
  <link rel="stylesheet" href="/themes/home/public/shequ/css/shequ.css">
  

  <style type="text/css">
    .left {
      width: 20%;
      float: left;
    }

    .right {
      width: 80%;
      float: left;
    }
  </style>

</head>

<body>

  <!-- 导航部分 -->
  <div class="layui-header header header-index">
    <div class="layui-main">
      <a class="logo" href="/">
        <img src="/themes/home/public/shequ/images/logo.png" alt="layui">
      </a>
      <div class="layui-form component" lay-filter="LAY-site-header-component"></div>
      <ul class="layui-nav">
        <li class="layui-nav-item ">
          <a href="<?php echo url('index/index'); ?>">首页
            <!-- <span class="layui-badge-dot"></span> --></a>
        </li>
        <li class="layui-nav-item">
          <a href="<?php echo url('index/projectlist'); ?>">发现
            <!-- <span class="layui-badge-dot"></span> --></a>
        </li>
        <li class="layui-nav-item layui-hide-xs">
          <a href="http://www.fanggexia.com/" target="_blank">创作</a>
        </li>

        <li class="layui-nav-item layui-hide-xs">
          <a href="http://hzpc.xyz/index.php/Home/index/message.html" target="_blank">留言</a>
        </li>

        <?php if(empty(\think\Session::get('user_info.id')) || ((\think\Session::get('user_info.id') instanceof \think\Collection || \think\Session::get('user_info.id') instanceof \think\Paginator ) && \think\Session::get('user_info.id')->isEmpty())): ?>
          <li class="layui-nav-item layui-hide-xs" lay-unselect>
            <a href="javascript:;" class="dengru">登入/注册</a>
          </li>

          <?php else: ?>
          <li class="layui-nav-item layui-hide-xs">
            <a href="javascript:;"><img src="/upload/<?php echo \think\Session::get('user_info.avatar'); ?>" class="layui-nav-img"
                onerror="javascript:this.src='/themes/home/public/shequ/images/touxiang.png';"></a>
            <dl class="layui-nav-child">
              <dd lay-unselect>
                <a href="javascript:;"><?php echo \think\Session::get('user_info.user_nickname'); ?></a>
              </dd>
              <dd lay-unselect>
                <a href="<?php echo url('user/my'); ?>">我的</a>
              </dd>
              <dd lay-unselect>
                <a href="<?php echo url('login/logout'); ?>">退出</a>
              </dd>
            </dl>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
  

  <div class="left mtop">
    <div class="layui-card  yjsm " style="margin-left: 15px;">
      <div class="layui-card-body">
        <div class="center">
          <img src="/upload/<?php echo \think\Session::get('user_info.avatar'); ?>" class="layui-nav-img touxiang" alt=""
            onerror="javascript:this.src='/themes/home/public/shequ/images/touxiang.png';">
          <p><?php echo \think\Session::get('user_info.user_nickname'); ?></p>
          <p><?php echo \think\Session::get('user_info.user_login'); ?></p>
          <div style="margin-top: 20px;border-top: 1px solid #edf1f7;">
            <ul>
              <li class="stop">

                <i class="layui-icon layui-icon-release"></i>
                <a href="<?php echo url('user/my'); ?>">
                  我的发布
                </a>
              </li>
              <li class="stop">
                <a href="<?php echo url('user/info'); ?>">
                  <i class="layui-icon layui-icon-home"></i>
                  我的资料
                </a>
              </li>
              <li class="stop">
                <div style=" color: #1E9FFF;">
                  <i class="layui-icon layui-icon-password"></i>
                  修改密码
                </div>
              </li>

            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- 右边 -->
  <div class="right mtop">
    <div class="layui-fluid">
      <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
          <div class="layui-card">
            <div class="layui-card-header">修改密码</div>
            <div class="layui-card-body" pad15>

              <div class="layui-form" lay-filter="">
                <div class="layui-form-item">
                  <label class="layui-form-label">当前密码</label>
                  <div class="layui-input-inline">
                    <input type="password" name="oldPassword" lay-verify="required" lay-verType="tips"
                      class="layui-input">
                  </div>
                </div>
                <div class="layui-form-item">
                  <label class="layui-form-label">新密码</label>
                  <div class="layui-input-inline">
                    <input type="password" name="password" lay-verify="pass" lay-verType="tips" autocomplete="off"
                      id="LAY_password" class="layui-input">
                  </div>
                  <div class="layui-form-mid layui-word-aux">建议6到16个字符</div>
                </div>
                <div class="layui-form-item">
                  <label class="layui-form-label">确认新密码</label>
                  <div class="layui-input-inline">
                    <input type="password" name="repassword" lay-verify="repass" lay-verType="tips" autocomplete="off"
                      class="layui-input">
                  </div>
                </div>
                <div class="layui-form-item">
                  <div class="layui-input-block">
                    <button class="layui-btn" lay-submit lay-filter="setmypass">确认修改</button>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="hotbt"> </div>


  <div class="layui-footer footer footer-index">
    <div class="layui-main">
      <p>© 2019 <a href="http://www.fanggexia.com/" target="_blank">fanggexia.com</a> MIT license</p>
      <p>
        <a href="http://hzpc.xyz/" target="_blank">案例</a>
        <!--  <a href="http://fly.layui.com/jie/3147/" target="_blank">支持</a> -->

        <a href="https://wpa.qq.com/msgrd?v=3&uin=70106377&site=qq&menu=yes" target="_blank" title="70106377">QQ</a>

        <a href="javascript:;" title="wxl20000509">微信</a>
        <a href="javascript:;" title="17681016211">联系电话</a>
        <!-- <a href="https://github.com/sentsin/layui/" target="_blank" rel="nofollow">GitHub</a>
      <a href="https://gitee.com/sentsin/layui" target="_blank" rel="nofollow">码云</a>
      <a href="http://fly.layui.com/jie/2461/" target="_blank">公众号</a> -->
        <a href="javascript:;">皖ICP备19005551号</a>
      </p>
    </div>
  </div>
  <script src="/themes/home/public/shequ/layui/layui.js" charset="utf-8"></script>
  <script src="/themes/home/public/shequ/js/jquery.min.js"></script>
  <script>
    layui.use(['element', 'form'], function () {
      var element = layui.element;

      form = layui.form;

      $('.dengru').on('click', function () {
        layer.open({
          type: 2,
          title: '登入/注册',
          shadeClose: true,
          shade: 0.8,
          area: ['50%', '86%'],
          content: '<?php echo url('login/login'); ?>' //iframe的url
    });
    });
})
  </script>
  
  <script>
    //Demo
    layui.use('form', function () {
      var form = layui.form;
      //提交
      form.on('submit(setmypass)', function (obj) {
        var field = obj.field;

        //确认密码
        if (field.password !== field.repassword) {
          return layer.msg('两次密码输入不一致');
        }


        //请求接口
        var load = layer.load(2);
        $.ajax({
          url: '<?php echo url('user/password'); ?>',
          type: "post",
          data: field,
          dataType: "json",
          success: function (r) {
            layer.close(load);
            if (r.code == 1) {
              layer.msg(r.msg, { icon: 1 });
            } else {
              layer.msg(r.msg, { icon: 5 });//错误提示
            }
          },
          error: function () {
            layer.close(load);
            layer.msg('网络错误！', { icon: 5 });//错误提示
          }
        });

      return false;
    });
  });
  </script>





</body>

</html>