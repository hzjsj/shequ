<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:34:"themes/home/index\index\index.html";i:1565516109;s:63:"E:\project\php\shequ\public\themes\home\index\common\index.html";i:1570351085;}*/ ?>
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
  

  <!-- banner/登入部分 -->
  <div class="head-banner">
    <div class="zuo">
      <div class="layui-carousel" id="test1" lay-filter="test1">
        <div carousel-item="" class="yjxs">
          <div><img src="/themes/home/public/shequ/images/banner1.png" class="banner" alt=""></div>
          <div><img src="/themes/home/public/shequ/images/banner2.png" class="banner" alt=""></div>
          <div><img src="/themes/home/public/shequ/images/banner3.jpg" class="banner" alt=""></div>
          <div><img src="/themes/home/public/shequ/images/banner4.jpg" class="banner" alt=""></div>
          <div><img src="/themes/home/public/shequ/images/banner5.png" class="banner" alt=""></div>
        </div>
      </div>
    </div>
    <div class="you">
      <?php if(empty(\think\Session::get('user_info.id')) || ((\think\Session::get('user_info.id') instanceof \think\Collection || \think\Session::get('user_info.id') instanceof \think\Paginator ) && \think\Session::get('user_info.id')->isEmpty())): ?>
        <div class="layui-card dr yjsm">
          <div class="layui-card-body">
            <div class="center">
              <img src="/themes/home/public/shequ/images/touxiang.png" class="touxiang" alt="">
              <p>欢迎来方格侠社区</p>
              <p>登录开始分享作品</p>
              <button class="login-btn dengru sbyd">登录/注册</button>
            </div>
          </div>
        </div>
        <?php else: ?>
        <div class="layui-card dr yjsm">
          <div class="layui-card-body">
            <div class="center">
              <img src="/upload/<?php echo \think\Session::get('user_info.avatar'); ?>" class="layui-nav-img touxiang" alt=""
                onerror="javascript:this.src='/themes/home/public/shequ/images/touxiang.png';">
              <p><?php echo \think\Session::get('user_info.user_nickname'); ?></p>

              <div class="p-section" style="box-sizing: border-box;margin-top: 10px;">
                <div class="project-section" style="margin-right: 20px;height: 70px;">
                  <a href="<?php echo url('user/my'); ?>">
                    <div class="my-project myfabu">
                      <i class="layui-icon layui-icon-release"></i>
                    </div>
                    <p style="line-height: 24px;">我的发布</p>
                  </a>
                </div>
                <div class="project-section" style="height: 70px;">
                  <a href="<?php echo url('user/info'); ?>">
                    <div class="my-project myfabu">
                      <i class="layui-icon layui-icon-home"></i>
                    </div>
                    <p style="line-height: 24px;">个人中心</p>
                  </a>
                </div>
              </div>

            </div>
          </div>
        </div>
      <?php endif; ?>


      <button type="button" class="layui-btn layui-btn-lg layui-btn-normal yjsm zpfx" style="width: 100%;">开始分享</button>
    </div>
  </div>
  <!-- body/作品部分 -->
  <div class="zplist">
    <div class="biaoti">
      <h2><i class="layui-icon layui-icon-rate-solid" style="font-size: 26px; color: #FFB800;margin-left: 1.3%"></i>
        精选作品</h2>
    </div>

    <?php if(is_array($project) || $project instanceof \think\Collection || $project instanceof \think\Paginator): $i = 0;$__LIST__ = is_array($project) ? array_slice($project,0,8, true) : $project->slice(0,8, true); if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
      <div class="zuoping">
        <a href="<?php echo url('index/project'); ?>?id=<?php echo $vo['id']; ?>" target="_blank">
          <img src="/upload/<?php echo $vo['image']; ?>" alt="">
        </a>
        <div class="bianju">
          <p><?php echo $vo['title']; ?></p>
          <div class="tubiao">
            <i class="layui-icon layui-icon-search"></i> <?php echo $vo['browse']; ?>
            <i class="layui-icon layui-icon-praise" style="margin-left: 10px;"></i> <?php echo $vo['browse']; ?>
          </div>
          <div class="txbt">
            <img src="/upload/<?php echo $vo['avatar']; ?>" class="layui-nav-img"
              onerror="javascript:this.src='/themes/home/public/shequ/images/touxiang.png';">
            <?php echo $vo['user_nickname']; ?>
          </div>
        </div>
      </div>
    <?php endforeach; endif; else: echo "" ;endif; ?>

  </div>

  <!-- 排行榜 -->
  <div class="you">
    <div class="biaoti">
      <h2><i class="layui-icon layui-icon-chart-screen" style="font-size: 26px; color: #FFB800;margin-left: 1.3%"></i>
        劲作周榜</h2>
    </div>
    <div class="zhoubang yjsm">
      <div class="zbnr">

        <?php if(is_array($project) || $project instanceof \think\Collection || $project instanceof \think\Paginator): $i = 0;$__LIST__ = is_array($project) ? array_slice($project,0,6, true) : $project->slice(0,6, true); if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
          <div class="zblist">
            <div class="zbnbj">
              <a href="<?php echo url('index/project'); ?>?id=<?php echo $vo['id']; ?>" target="_blank">
                <img src="/upload/<?php echo $vo['image']; ?>" alt="">
                <div class="zbname"><?php echo $vo['title']; ?></div>
              </a>
            </div>
          </div>
        <?php endforeach; endif; else: echo "" ;endif; ?>

      </div>
      <div class="zbgd">
        <a href="<?php echo url('index/projectlist'); ?>">查看更多排行榜</a>
      </div>
    </div>
  </div>



  <!-- 热门作品 -->
  <div class="hotbt">


    <div class="hotzpbt youbianju">
      <h2><i class="layui-icon layui-icon-fire" style="font-size: 26px; color: #ff5181; margin-left: 1%"></i> 热门作品 <a
          href="<?php echo url('index/projectlist'); ?>" class="sbyd">更多作品<i class="layui-icon layui-icon-right"></i></a></h2>
    </div>
    <?php if(is_array($project) || $project instanceof \think\Collection || $project instanceof \think\Paginator): $i = 0;$__LIST__ = is_array($project) ? array_slice($project,0,10, true) : $project->slice(0,10, true); if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
      <div class="hotzp">
        <a href="">
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
            王小龙
          </div>
        </div>
      </div>
    <?php endforeach; endif; else: echo "" ;endif; ?>


    <!-- 热门专题 -->
    <div class="hotbt" style="margin-top: 20px;">


      <div class="hotzpbt youbianju">
        <h2><i class="layui-icon layui-icon-find-fill" style="font-size: 26px; color: #48c1f5; margin-left: 1%"></i>
          精选专题 <a href="<?php echo url('index/projectlist'); ?>" class="sbyd">更多专题<i class="layui-icon layui-icon-right"></i></a>
        </h2>
      </div>
    </div>


    <div class="hotbt">

      <div class="zttp">
        <img src="/themes/home/public/shequ/images/zt1.jpg" alt="">
      </div>
      <div class="zttp">
        <img src="/themes/home/public/shequ/images/zt2.jpg" alt="">
      </div>
      <div class="zttp">
        <img src="/themes/home/public/shequ/images/zt3.png" alt="">
      </div>
      <div class="zttp">
        <img src="/themes/home/public/shequ/images/zt4.png" alt="">
      </div>

    </div>


    <div class="hotbt "></div>




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
  
  <!-- 注意：如果你直接复制所有代码到本地，上述js路径需要改成你本地的 -->
  <script>
  $(document).ready(function(){
    $(".layui-nav li:nth-child(1)").addClass("layui-this");

});
    layui.use(['carousel', 'element', 'form'], function () {
      var element = layui.element;
      var carousel = layui.carousel
        , form = layui.form;

      //常规轮播
      carousel.render({
        elem: '#test1'
        , arrow: 'always'
        , width: '100%'
        , height: '360px'
      });

      $('.zpfx').on('click', function () {
        layer.open({
          type: 2,
          title: '分享作品',
          shadeClose: true,
          shade: 0.8,
          area: ['50%', '92%'],
          content: '<?php echo url('user/addproject'); ?>' //iframe的url
    });
    });
})
  </script>



</body>

</html>