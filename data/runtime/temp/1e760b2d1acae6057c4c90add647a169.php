<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:34:"themes/erp/admin\setting\info.html";i:1568469385;s:62:"E:\project\php\shequ\public\themes\erp\admin\public\layui.html";i:1568457209;}*/ ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title></title>
  <link rel="icon" href="/themes/erp/public/assets/images/favicon.ico" type="image/x-icon" /> 
  <link rel="stylesheet" type="text/css" href="/themes/erp/public/assets/lib/layui-v2.5.5/layui/css/layui.css">
  <link rel="stylesheet" type="text/css" href="/themes/erp/public/assets/lib/font-awesome-4.7.0/css/font-awesome.css">
  <style type="text/css">
    .form-required{
      color: red;
      font-weight: bold;
    }
    html{
      width: 100%;
      height: 100%;
      padding: 0;
      margin: 0;
    }
    body{
      background-color: #F2F2F2;
      width: 100%;
      height: 100%;
      padding: 0;
      margin: 0;
    }
    a.k-btn{
      color: #007bff;
      cursor:pointer;
    }
    a.k-btn:hover{
      color: #0056b3;
    }
    .main{
      padding: 10px;
    }
    .card{

        background-color: #fff;
        box-sizing: border-box;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, .1);
     /*   border-radius: 5px;*/
        min-height: 50px;
        padding: 10px;
        position: relative;
    }
  </style>
  
    <style type="text/css">
    .layui-fluid{
      padding: 10px;
    }
    </style>

</head>
<body>
 

   <!--  <div class="main"> -->

  <div class="layui-fluid">
    <div class="layui-row layui-col-space15">
      <div class="layui-col-md12">
        <div class="layui-card">
          <div class="layui-card-header">设置我的资料</div>
          <div class="layui-card-body" pad15>
            
            <div class="layui-form" lay-filter="">
              <div class="layui-form-item">
                <label class="layui-form-label">用户名</label>
                <div class="layui-input-inline">
                  <input type="text" name="user_login" value="<?php echo $info['user_login']; ?>" readonly class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">不可修改。一般用于后台登入名</div>
              </div>
              <div class="layui-form-item">
                <label class="layui-form-label">昵称</label>
                <div class="layui-input-inline">
                  <input type="text" name="user_nickname" value="<?php echo $info['user_nickname']; ?>" lay-verify="nickname" autocomplete="off" placeholder="请输入昵称" class="layui-input">
                </div>
              </div>




              <div class="layui-form-item">
                <label class="layui-form-label">性别</label>
                <div class="layui-input-block">
                  <input type="radio" name="sex" value="1" title="男" <?php if($info['sex'] == 1): ?>checked <?php endif; ?>>
                  <input type="radio" name="sex" value="2" title="女" <?php if($info['sex'] == 2): ?>checked <?php endif; ?>>
                </div>
              </div>
<!--               <div class="layui-form-item">
                <label class="layui-form-label">头像</label>
                <div class="layui-input-inline">
                  <input name="avatar" lay-verify="required" id="LAY_avatarSrc" placeholder="图片地址" value="http://cdn.layui.com/avatar/168.jpg" class="layui-input">
                </div>
                <div class="layui-input-inline layui-btn-container" style="width: auto;">
                  <button type="button" class="layui-btn layui-btn-primary" id="LAY_avatarUpload">
                    <i class="layui-icon">&#xe67c;</i>上传图片
                  </button>
                  <button class="layui-btn layui-btn-primary" layadmin-event="avartatPreview">查看图片</button >
                </div>
             </div> -->
                 <div class="layui-form-item">
      <label class="layui-form-label">头像</label>
      <div class="layui-input-inline">
        <input lay-verify="required" id="LAY_avatarSrc" placeholder="图片地址" class="layui-input" value="<?php echo $info['avatar_src']; ?>">
        <input type="hidden" name="image" value="<?php echo $info['avatar']; ?>" id="image">
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
                  <input type="text" name="mobile" value="<?php echo $info['mobile']; ?>" lay-verify="phone" autocomplete="off" class="layui-input">
                </div>
              </div>
              <div class="layui-form-item">
                <label class="layui-form-label">邮箱</label>
                <div class="layui-input-inline">
                  <input type="text" name="user_email" value="<?php echo $info['user_email']; ?>" lay-verify="email" autocomplete="off" class="layui-input">
                </div>
              </div>
              <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">个性签名</label>
                <div class="layui-input-block">
                  <textarea name="signature" placeholder="请输入个性签名" class="layui-textarea"><?php echo $info['signature']; ?></textarea>
                </div>
              </div>
              <div class="layui-form-item">
                <div class="layui-input-block">
                  <button class="layui-btn" lay-submit lay-filter="submit">确认修改</button>
                  <button type="reset" class="layui-btn layui-btn-primary">重新填写</button>
                </div>
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </div>
  </div>

 

<script type="text/javascript" src="/themes/erp/public/assets/lib/layui-v2.5.5/layui/layui.js"></script>

    <script>
    //注意：导航 依赖 element 模块，否则无法进行功能性操作
    layui.config({
        base: '/themes/erp/public/assets/lib/layui-lib/js/'
    }).use(['form', 'upload', 'jquery','kform'], function() {
        var form = layui.form,
            upload = layui.upload,
            $ = layui.jquery;
             var kform = layui.kform;
        kform.set({
            url:'<?php echo url('setting/info'); ?>',
          success:function(r){
            parent.action.refresh()
          }
        }).init();

            //头像上传
      var uploadInst = upload.render({
        elem: '#test3'
        , url: '<?php echo url('setting/webuploader'); ?>'
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
        }
        , anim: 5 //0-6的选择，指定弹出图片动画类型，默认随机（请注意，3.0之前的版本用shift参数）
      });
    });

    });
    </script>

</body>
</html>