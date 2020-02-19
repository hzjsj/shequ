<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:36:"themes/home/index\index\project.html";i:1562661065;s:63:"E:\project\php\shequ\public\themes\home\index\common\index.html";i:1570351085;}*/ ?>
<!DOCTYPE html>
<html>

<head>
  <title></title>
  <link rel="stylesheet" href="/themes/home/public/shequ/layui/css/layui.css">
  <link rel="stylesheet" href="/themes/home/public/shequ/css/index.css">
  <link rel="stylesheet" href="/themes/home/public/shequ/css/shequ.css">
  
  <link rel="stylesheet" href="/themes/home/public/shequ/css/template.css">
  <link rel="stylesheet" href="/themes/home/public/shequ/css/project.css">
  <style type="text/css">

  </style>

</head>

<body>

  <!-- 导航部分 -->
  <div class="layui-header header header-index">
    <div class="layui-main" style="width: 90%;">
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
  

  <div class="layui-card kpbj">
    <div class="layui-card-body">

      <div style="padding-left: 1%">
        <div class="biaoti">
          <h2><?php echo $project['title']; ?></h2>

        </div>
        <div class="txbt">
          <img src="/upload/<?php echo $project['avatar']; ?>" class="layui-nav-img"
            onerror="javascript:this.src='/themes/home/public/shequ/images/touxiang.png';">
          <!-- <img src="http://q4.qlogo.cn/headimg_dl?dst_uin=70106377&spec=100" class="layui-nav-img"> -->
          <p><?php echo $project['user_nickname']; ?></p>
          <p><?php echo $project['create_date']; ?>
          </p>
          <p>
            <img src="/themes/home/public/shequ/images/chakan.png" alt=""><?php echo $project['browse']; ?>
          </p>
        </div>
      </div>

      <div style="clear:both;">
        <div class="zptp" id="layer-photos-demo">
          <img src="/upload/<?php echo $project['image']; ?>" alt="" style="width: 100%;width: 100%;">
        </div>
        <div class="zpxx">
          <div class="overflowTest">
            <div class="zpname">
              作品介绍
            </div>
            <div class="zpnr">
              <pre>
<?php echo $project['content']; ?>
</pre>
            </div>
            <div class="zpname">
              操作说明
            </div>
            <div class="zpnr">
              <pre>
<?php echo $project['desc']; ?>
</pre>
            </div>
          </div style="clear:both;">
          <div style="margin-top: 50px;">
            <a href="<?php echo $project['url']; ?>" target="_blank" class="layui-btn layui-btn-lg layui-btn-radius layui-btn-normal"
              style="width: 40%">查看</a>

            <a href="javascript:;" onclick="dianzan(<?php echo $project['id']; ?>)"
              class="layui-btn layui-btn-lg layui-btn-radius layui-btn-normal" style="width: 40%">点赞</a>

          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="layui-fluid layadmin-message-fluid">
    <div class="layui-row">
      <div class="layui-col-md12">
        <form class="layui-form">
          <input type="hidden" name="pid" value='<?php echo $project['id']; ?>'>
          <div class="layui-form-item layui-form-text">
            <div class="layui-input-block">
              <textarea name="comment" placeholder="请输入内容" class="layui-textarea"></textarea>
            </div>
          </div>
          <div class="layui-form-item" style="overflow: hidden;">
            <div class="layui-input-block layui-input-right">
              <button class="layui-btn  layui-btn-normal" type="button" lay-submit lay-filter="formDemo">留言</button>
            </div>
            <div class="layadmin-messag-icon">
              <a href="javascript:;"><i class="layui-icon layui-icon-face-smile-b"></i></a>
              <a href="javascript:;"><i class="layui-icon layui-icon-picture"></i></a>
              <a href="javascript:;"><i class="layui-icon layui-icon-link"></i></a>
            </div>
          </div>
        </form>
      </div>
      <div class="layui-col-md12 layadmin-homepage-list-imgtxt message-content">
        <?php if(is_array($comment) || $comment instanceof \think\Collection || $comment instanceof \think\Paginator): $i = 0; $__LIST__ = $comment;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
          <div class="media-body">
            <a href="javascript:;" class="media-left" style="float: left;">
              <img src="/upload/<?php echo $vo['avatar']; ?>" height="46px" width="46px"
                onerror="javascript:this.src='/themes/home/public/shequ/images/touxiang.png';">
            </a>
            <div class="pad-btm">
              <p class="fontColor"><a href="javascript:;"><?php echo $vo['user_nickname']; ?></a></p>
              <p class="min-font">
                <span class="layui-breadcrumb" lay-separator="-">
                  <a href="javascript:;" class="layui-icon layui-icon-cellphone"></a>
                  <a href="javascript:;">发布时间</a>
                  <a href="javascript:;"><?php echo $vo['create_date']; ?></a>
                </span>
              </p>
            </div>
            <p class="message-text"><?php echo $vo['comment']; ?></p>
          </div>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        <!-- 
       <div class="layui-row message-content-btn">
          <a href="javascript:;" class="layui-btn">更多</a>
       </div> -->
      </div>
    </div>
  </div>

<footer class="footer mt-20">
  <div class="container-fluid">
    <nav> <a href="javascript:;" target="_blank">关于我们</a> <span class="pipe">|</span> <a href="javascript:;" target="_blank">联系我们</a> <span class="pipe">|</span> <a href="javascript:;" target="_blank">法律声明</a> </nav>
    <p>Copyright &copy;2019 hzpc.xyz All Rights Reserved. <br>
      <a href="http://www.miitbeian.gov.cn/" target="_blank" rel="nofollow">京ICP备1000000号</a><br>
    </p>
  </div>
</footer>
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
      layer.photos({
        photos: '#layer-photos-demo'
        , anim: 5 //0-6的选择，指定弹出图片动画类型，默认随机（请注意，3.0之前的版本用shift参数）
      });
      //监听提交
      form.on('submit(formDemo)', function (data) {
        var load = layer.load(2);
        $.ajax({
          url: '<?php echo url('user/addly'); ?>',
          type: "post",
          data: data.field,
          dataType: "json",
          success: function (r) {
            layer.close(load);
            if (r.code == 1) {
              layer.msg(r.msg, { icon: 1 });
              window.location.reload();
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

    function dianzan(aa) {
      var aa = aa;
      //layer.msg(aa,{icon: 1});

      layer.msg('点赞成功！', { icon: 1 });
    }
  </script>



</body>

</html>