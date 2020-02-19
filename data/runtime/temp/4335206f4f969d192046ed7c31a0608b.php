<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:32:"themes/home/index\user\info.html";i:1562660655;s:56:"E:\web\www915\public\themes\home\index\common\index.html";i:1562661653;}*/ ?>
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
                <a href="<?php echo url('user/my'); ?>">
                  <i class="layui-icon layui-icon-release"></i>
                  我的发布
                </a>
              </li>
              <li class="stop">
                <div style=" color: #1E9FFF;">
                  <i class="layui-icon layui-icon-home"></i>
                  我的资料
                </div>
              </li>
              <li class="stop">
                <a href="<?php echo url('user/password'); ?>">
                  <i class="layui-icon layui-icon-password"></i>
                  修改密码
                </a>
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
            <div class="layui-card-header">设置我的资料</div>
            <div class="layui-card-body" pad15>

              <div class="layui-form" lay-filter="">
                <div class="layui-form-item">
                  <label class="layui-form-label">昵称</label>
                  <div class="layui-input-inline">
                    <input type="text" name="nickname" value="<?php echo $user_info['user_nickname']; ?>" lay-verify="nickname"
                      autocomplete="off" placeholder="请输入昵称" class="layui-input">
                  </div>
                </div>
                <div class="layui-form-item">
                  <label class="layui-form-label">性别</label>
                  <div class="layui-input-block">

                    <input type="radio" name="sex" value="1" title="男" <?php if($user_info['sex'] == 1): ?>checked
                    <?php endif; ?>>
                    <input type="radio" name="sex" value="2" title="女" <?php if($user_info['sex'] == 1): ?>checked
                    <?php endif; ?>>

                    <!--  <input type="radio" name="sex" value="男" title="男">
                  <input type="radio" name="sex" value="女" title="女" checked> -->
                  </div>
                </div>

                <div class="layui-form-item">
                  <label class="layui-form-label">头像</label>
                  <div class="layui-input-inline">
                    <input id="LAY_avatarSrc" placeholder="留空不修改" class="layui-input">
                    <input type="hidden" name="image" value='<?php echo $user_info['avatar']; ?>' id="image">
                  </div>
                  <div class="layui-input-inline layui-btn-container" style="width: auto;">
                    <button type="button" class="layui-btn layui-btn-primary" id="test3">
                      <i class="layui-icon">&#xe67c;</i>上传图片
                    </button>
                    <button type="button" class="layui-btn layui-btn-primary chakan">查看图片</button>

                  </div>
                </div>

                <div class="layui-form-item">
                  <label class="layui-form-label">手机</label>
                  <div class="layui-input-inline">
                    <input type="text" name="cellphone" value="<?php echo $user_info['mobile']; ?>" lay-verify="phone"
                      autocomplete="off" class="layui-input">
                  </div>
                </div>
                <div class="layui-form-item">
                  <label class="layui-form-label">邮箱</label>
                  <div class="layui-input-inline">
                    <input type="text" name="email" value="<?php echo $user_info['user_email']; ?>" lay-verify="email"
                      autocomplete="off" class="layui-input">
                  </div>
                </div>
                <div class="layui-form-item layui-form-text">
                  <label class="layui-form-label">个性签名</label>
                  <div class="layui-input-block">
                    <textarea name="remarks" placeholder="请输入个性签名"
                      class="layui-textarea"><?php echo $user_info['signature']; ?></textarea>
                  </div>
                </div>
                <div class="layui-form-item">
                  <div class="layui-input-block">
                    <button class="layui-btn" lay-submit lay-filter="setmyinfo">确认修改</button>
                    <button type="reset" class="layui-btn layui-btn-primary">重新填写</button>
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
    layui.use(['form', 'upload'], function () {
      var form = layui.form;
      upload = layui.upload;

      //头像上传
      var uploadInst = upload.render({
        elem: '#test3'
        , url: '<?php echo url('user/webuploader'); ?>'
        , data: {
          app: 'avatar',
          filetype: 'image',
          type: 'image/jpeg'
        }
        , done: function (res) {
          //如果上传失败
          if (res.code == 0) {
            return layer.msg('上传失败');
          }
          layer.msg('上传成功');
          var tupian = res.data.url;
          //上传成功
          $('#image').attr('value', res.data.filepath);
          $('#LAY_avatarSrc').attr('value', res.data.url);
        }
  });


    $('.chakan').on('click', function () {
      var a = ($("#LAY_avatarSrc").val());

      layer.photos({
        photos: {
          title: "查看头像",
          data: [{
            src: a
          }]
        },
        shade: .01,
        closeBtn: 1,
        anim: 5 //0-6的选择，指定弹出图片动画类型，默认随机（请注意，3.0之前的版本用shift参数）
      });
    });



    //监听提交

    form.on('submit(setmyinfo)', function (data) {
      var load = layer.load(2);
      $.ajax({
        url: '<?php echo url('user/info'); ?>',
        type: "post",
        data: data.field,
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