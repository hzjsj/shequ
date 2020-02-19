<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:30:"themes/home/index\user\my.html";i:1562660615;s:56:"E:\web\www915\public\themes\home\index\common\index.html";i:1562661653;}*/ ?>
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
                <div style=" color: #1E9FFF;">
                  <i class="layui-icon layui-icon-release"></i>

                  我的发布
                </div>
              </li>
              <li class="stop">
                <a href="<?php echo url('user/info'); ?>">
                  <i class="layui-icon layui-icon-home"></i>
                  我的资料
                </a>
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
  <div class="right stop">
    <?php if(is_array($project) || $project instanceof \think\Collection || $project instanceof \think\Paginator): $i = 0; $__LIST__ = $project;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
      <div class="zuoping">
        <a href="<?php echo url('index/project'); ?>?id=<?php echo $vo['id']; ?>" target="_blank">
          <img src="/upload/<?php echo $vo['image']; ?>" alt="">
        </a>
        <div class="bianju">
          <p><?php echo $vo['title']; ?></p>

          <div class="stop">
            更新时间：<?php echo $vo['update']; ?>

          </div>
          <hr>
          <div class="stop">
            <a href="<?php echo url('index/project'); ?>?id=<?php echo $vo['id']; ?>" target="_blank"><i
                class="layui-icon layui-icon-search"></i>查看</a>
            <span class="shuxian"></span>
            <a onclick="bj(<?php echo $vo['id']; ?>)"><i class="layui-icon layui-icon-edit"></i>编辑 </a>
            <span class="shuxian"></span>
            <a onclick="sc(<?php echo $vo['id']; ?>)"><i class="layui-icon layui-icon-delete"></i>删除 </a>
          </div>

        </div>
      </div>
    <?php endforeach; endif; else: echo "" ;endif; ?>


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
    function bj(id) {
      var url = '<?php echo url('user/editproject'); ?>?id=' + id;
      layer.open({
        type: 2,
        title: '修改',
        shadeClose: true,
        shade: 0.3,
        area: ['50%', '92%'],
        content: url //iframe的url
      });
    }
    function sc(id) {
      var id = id;
      layer.confirm('真的删除行么', function (index) {
        var load = layer.load(2);
        $.ajax({
          url: '<?php echo url('user/delproject'); ?>',
          type: "post",
          data: { id: id },
          dataType: "json",
          success: function (r) {
            layer.close(load);
            if (r.code == 1) {

              layer.msg(r.msg, { icon: 1 }, function () {
                window.location.reload();
              });
            } else {
              layer.msg(r.msg, { icon: 2 }); //错误提示
            }
          },
          error: function () {
            layer.close(load);
            layer.msg('网络错误！', { icon: 2 }); //错误提示
          }
       });


    });
   }
  </script>





</body>

</html>