<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:40:"themes/home/index\index\projectlist.html";i:1565516132;s:63:"E:\project\php\shequ\public\themes\home\index\common\index.html";i:1570351085;}*/ ?>
<!DOCTYPE html>
<html>

<head>
  <title></title>
  <link rel="stylesheet" href="/themes/home/public/shequ/layui/css/layui.css">
  <link rel="stylesheet" href="/themes/home/public/shequ/css/index.css">
  <link rel="stylesheet" href="/themes/home/public/shequ/css/shequ.css">
  
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
  
  <?php if(is_array($projectlist) || $projectlist instanceof \think\Collection || $projectlist instanceof \think\Paginator): $i = 0; $__LIST__ = $projectlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
    <div class="hotzp">
      <a href="<?php echo url('index/project'); ?>?id=<?php echo $vo['id']; ?>">
        <img src="/upload/<?php echo $vo['image']; ?>" alt="">
      </a>
      <div class="bianju">
        <p><?php echo $vo['title']; ?></p>
        <div class="tubiao">
          <i class="layui-icon layui-icon-search"></i> <?php echo $vo['browse']; ?>
          <i class="layui-icon layui-icon-praise" style="margin-left: 10px;"></i> <?php echo $vo['browse']; ?>
        </div>
        <div class="txbt">
          <div class="zptx">
            <img src="/upload/<?php echo $vo['avatar']; ?>" class="layui-nav-img"
              onerror="javascript:this.src='/themes/home/public/shequ/images/touxiang.png';">
          </div>
          <p>王小龙</p>
        </div>
      </div>
    </div>
  <?php endforeach; endif; else: echo "" ;endif; ?>
  <div class="hotbt"></div>

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
  $(document).ready(function(){
    $(".layui-nav li:nth-child(2)").addClass("layui-this");

  });
</script>



</body>

</html>