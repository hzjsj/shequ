<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:34:"themes/home/index\login\login.html";i:1562659837;}*/ ?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>登入</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport"
    content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <link rel="stylesheet" href="/themes/home/public/shequ/layui/css/layui.css" media="all">
  <link rel="stylesheet" href="/themes/home/public/shequ/css/login.css" media="all">
  <script src="/themes/home/public/shequ/js/jquery.min.js"></script>
</head>

<body>

  <div class="layadmin-user-login layadmin-user-display-show" id="LAY-user-login" style="display: none;">

    <div class="layadmin-user-login-main">
      <div class="layadmin-user-login-box layadmin-user-login-header">
        <h2>登入</h2>
        <p>登入 方格侠社区</p>
      </div>
      <div class="layadmin-user-login-box layadmin-user-login-body layui-form">
        <div class="layui-form-item">
          <label class="layadmin-user-login-icon layui-icon layui-icon-username" for="LAY-user-login-username"></label>
          <input type="text" name="username" id="LAY-user-login-username" lay-verify="required" placeholder="用户名"
            class="layui-input">
        </div>
        <div class="layui-form-item">
          <label class="layadmin-user-login-icon layui-icon layui-icon-password" for="LAY-user-login-password"></label>
          <input type="password" name="password" id="LAY-user-login-password" lay-verify="required" placeholder="密码"
            class="layui-input">
        </div>
        <div class="layui-form-item">
          <div class="layui-row">
            <div class="layui-col-xs7">
              <label class="layadmin-user-login-icon layui-icon layui-icon-vercode"
                for="LAY-user-login-vercode"></label>
              <input type="text" name="captcha" lay-verify="required" placeholder="图形验证码" class="layui-input codeInput">
            </div>
            <div class="layui-col-xs5">
              <div style="margin-left: 10px;">
                <?php $__CAPTCHA_SRC=url('/captcha/new').'?height=35&width=107&font_size=14'; ?>
<img src="<?php echo $__CAPTCHA_SRC; ?>" onclick="this.src='<?php echo $__CAPTCHA_SRC; ?>&time='+Math.random();" title="换一张" class="captcha captcha-img verify_img" style="cursor: pointer;"/>
<input type="hidden" name="_captcha_id" value="">
              </div>
            </div>
          </div>
        </div>

        <div class="layui-form-item">
          <button class="layui-btn layui-btn-fluid" lay-submit lay-filter="formDemo">登 入</button>
        </div>
        <div class="layui-trans layui-form-item layadmin-user-login-other">
          <label>社交账号登入</label>
          <a href="javascript:;"><i class="layui-icon layui-icon-login-qq"></i></a>
          <a href="javascript:;"><i class="layui-icon layui-icon-login-wechat"></i></a>
          <a href="javascript:;"><i class="layui-icon layui-icon-login-weibo"></i></a>

          <a href="reg.html" class="layadmin-user-jump-change layadmin-link">注册帐号</a>
        </div>
      </div>
    </div>
  </div>

  <script src="/themes/home/public/shequ/layui/layui.js" charset="utf-8"></script>
  <script>
    //Demo
    layui.use('form', function () {
      var form = layui.form;
      form.on('submit(formDemo)', function (data) {
        var load = layer.load(2);
        $.ajax({
          url: '<?php echo url('login/doLogin'); ?>',
          type: "post",
          data: data.field,
          dataType: "json",
          success: function (r) {
            layer.close(load);
            if (r.code == 1) {
              layer.msg(r.data, { icon: 1 }, function () {
                window.top.location.href = r.url; //在当前页面打开
              });
            } else {
              layer.msg(r.msg, { icon: 5 });//错误提示
              $('.codeInput').val('');
              $('.verify_img').click();
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