<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:28:"themes/erp/admin\\login.html";i:1562302563;}*/ ?>
<!DOCTYPE html>
<html>
<head>
		<title><?php echo (isset($site_info['site_name']) && ($site_info['site_name'] !== '')?$site_info['site_name']:'登录页面'); ?></title>
    <link rel="stylesheet" type="text/css" href="/themes/erp/public/assets/lib/layui-v2.5.4/layui/css/layui.css">
    <link rel="stylesheet" type="text/css" href="/themes/erp/public/assets/lib/font-awesome-4.7.0/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="/themes/erp/public/assets/css/login.css">
	
</head>
<body>
	<div class="login-content">
		<h1><?php echo (isset($site_info['site_name']) && ($site_info['site_name'] !== '')?$site_info['site_name']:'登录'); ?></h1>
		<form class="layui-form" action="">
			<div class="layui-form-item">
				<div class="layui-inline">
					<label class="fa fa-user-o login-icon"></label>
					<input type="text" name="username" lay-verify="required" autocomplete="off" class="layui-input" placeholder="账号" value="<?php echo cookie('erpadmin_username'); ?>">
				</div>
			</div>
			<div class="layui-form-item">
				<div class="layui-inline">
					<label class="fa fa-lock login-icon"></label>
					<input type="password" name="password" lay-verify="required" autocomplete="off" class="layui-input" placeholder="密码">
				</div>
			</div>
			<div class="layui-form-item">
				<div class="layui-inline loginVerifyInput">
					<label class="layui-icon layui-icon-vercode login-icon"></label>
					<input type="text" name="captcha" lay-verify="required" autocomplete="off" class="layui-input codeInput" placeholder="验证码">
				</div>
				<div class="layui-inline loginVerifyDiv">
					<?php $__CAPTCHA_SRC=url('/captcha/new').'?height=36&width=146&font_size=18'; ?>
<img src="<?php echo $__CAPTCHA_SRC; ?>" onclick="this.src='<?php echo $__CAPTCHA_SRC; ?>&time='+Math.random();" title="换一张" class="captcha captcha-img verify_img" style="cursor: pointer;"/>
<input type="hidden" name="_captcha_id" value="">
				</div>
			</div>
			<div class="layui-form-item" style="display: none;">
			    <div class="layui-inline">
			      <input type="checkbox" name="" lay-skin="primary" title="记住密码">
			    </div>
			</div>
			<div class="layui-form-item">
				<div class="layui-inline">
				  <button class="layui-btn submit-btn" lay-submit="" lay-filter="submit">登录</button>
				</div>
			</div>
		</form>
		<div class="footer">
			<p>© 2019 cmf.xxm9.top</p>
			<p>
				<a target="_blank" href="http://cmf.xxm9.top">前往官网</a>
			</p>
		</div>
			
	</div>
	<script type="text/javascript" src="/themes/erp/public/assets/lib/layui-v2.5.4/layui/layui.js"></script>
	<script>
        layui.config({
            base: '/themes/erp/public/assets/lib/layui-lib/js/'
        }).use(['form','layer','jquery'], function() {
            var form = layui.form
            	,layer = layui.layer
                ,$ = layui.jquery;
            form.on('submit(submit)', function(data){
            	var load = layer.load(2);
			    $.ajax({
					url:'<?php echo url('public/doLogin'); ?>',
					type:"post",
					data:data.field,
					dataType:"json",
					success:function(r){
						layer.close(load);
						if (r.code == 1) {
							layer.msg(r.msg,{icon: 1});
							if (r.url) {
								window.location.href=r.url;
							}
						}else{
							layer.msg(r.msg,{icon: 5});//错误提示
							$('.codeInput').val('');
							$('.verify_img').click();
						}
					},
					error:function(){
						layer.close(load);
						layer.msg('网络错误！',{icon: 5});//错误提示
					}
				});
            	
			    return false;
			});
			if(window.top!=window.self){  //判断是否存在父窗口
			    top.location.href = "<?php echo url(); ?>";
			}
        });
    </script>
</body>
</html>