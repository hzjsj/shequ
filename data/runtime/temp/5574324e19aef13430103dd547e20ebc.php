<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:39:"themes/home/index\user\editproject.html";i:1562660573;}*/ ?>
<!DOCTYPE html>
<html>

<head>
  <title></title>
  <link rel="stylesheet" href="/themes/home/public/shequ/layui/css/layui.css">
  <script src="/themes/home/public/shequ/layui/layui.js" charset="utf-8"></script>
</head>

<body>


  <form class="layui-form" action="" style="margin-top:20px;">
    <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
    <div class="layui-form-item">
      <label class="layui-form-label">作品名称</label>
      <div class="layui-input-block" style="width: 66%;">
        <input type="text" name="title" value="<?php echo $data['title']; ?>" required lay-verify="required" placeholder="请输入作品名称"
          autocomplete="off" class="layui-input">
      </div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">作品网址</label>
      <div class="layui-input-block" style="width: 66%;">
        <input type="text" name="url" value="<?php echo $data['url']; ?>" required lay-verify="url" placeholder="请输入作品网址"
          autocomplete="off" class="layui-input">
      </div>
    </div>

    <div class="layui-form-item layui-form-text">
      <label class="layui-form-label">作品介绍</label>
      <div class="layui-input-block" style="width: 66%;">
        <textarea name="content" placeholder="请输入作品介绍" class="layui-textarea"><?php echo $data['content']; ?></textarea>
      </div>
    </div>
    <div class="layui-form-item layui-form-text">
      <label class="layui-form-label">操作说明</label>
      <div class="layui-input-block" style="width: 66%;">
        <textarea name="desc" placeholder="请输入操作说明" class="layui-textarea"><?php echo $data['desc']; ?></textarea>
      </div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">作品图片</label>
      <div class="layui-input-inline">
        <input id="LAY_avatarSrc" placeholder="留空不修改" class="layui-input">
        <input type="hidden" name="image" value="<?php echo $data['image']; ?>" id="image">
      </div>
      <div class="layui-input-inline layui-btn-container" style="width: auto;">
        <button type="button" class="layui-btn layui-btn-primary" id="test3">
          <i class="layui-icon">&#xe67c;</i>上传图片
        </button>
        <button type="button" class="layui-btn layui-btn-primary chakan">查看图片</button>

      </div>
    </div>
    <div class="layui-form-item">
      <div class="layui-input-block">
        <button class="layui-btn  layui-btn-normal" lay-submit lay-filter="formDemo">立即提交</button>
        <button type="reset" class="layui-btn layui-btn-primary">重置</button>
      </div>
    </div>
  </form>
  <script src="/themes/home/public/shequ/js/jquery.min.js"></script>
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
          app: 'project',
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



    //监听提交

    form.on('submit(formDemo)', function (data) {
      var load = layer.load(2);
      $.ajax({
        url: '<?php echo url('user/editproject'); ?>',
        type: "post",
        data: data.field,
        dataType: "json",
        success: function (r) {
          layer.close(load);
          if (r.code == 1) {
            layer.msg(r.msg, { icon: 1 }, function () {
              parent.location.reload();
            });
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