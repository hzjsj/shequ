<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:34:"themes/erp/admin\rule\addrule.html";i:1557221346;s:60:"E:\web\www915\public\themes\erp\admin\public\layui_form.html";i:1568524108;}*/ ?>
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
        border-radius: 5px;
        min-height: 50px;
        padding: 10px;
        position: relative;
    }
    .k-fixbar-btns{
      position: fixed;
      bottom: 0px;
      z-index: 9999;
      width: 100%;
      padding: 5px;
      text-align: center;
      background-color: #fff;
      box-shadow: 0px -1px 2px #888888;
      left: 0px;
    }
  </style>
  
    <style type="text/css"></style>

</head>
<body>
 

    <div class="main">
            <form class="layui-form" action="">
            <div class="layui-form-item">
                <label class="layui-form-label">父级节点</label>
                <div class="layui-input-inline">
                  <select name="pid" lay-verify="required">
                     <option value="0">作为顶级节点</option>
                    <?php if(is_array($getauth_rule) || $getauth_rule instanceof \think\Collection || $getauth_rule instanceof \think\Paginator): $i = 0; $__LIST__ = $getauth_rule;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <option value="<?php echo $vo['id']; ?>" <?php if($vo['id'] == $auth_rule['id']): ?>selected <?php endif; ?>><?php echo $vo['title']; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                  </select>
                </div>
            </div>
            <div class="layui-form-item">
                    <label class="layui-form-label">名称</label>
                    <div class="layui-input-inline">
                        <input type="text" name="title"  required lay-verify="required" placeholder="请输入名称" autocomplete="off" class="layui-input">
                    </div>
            </div>

            <div class="layui-form-item">
                    <label class="layui-form-label">规则</label>
                    <div class="layui-input-inline">
                        <input type="text" name="name" required placeholder="请输入规则" autocomplete="off" class="layui-input">
                    </div>
            </div>
                <div class="k-fixbar-btns">
                    <button class="layui-btn" onclick="" lay-submit="" lay-filter="submit" id="submit">保存</button>
                </div>
            </form>
            <table id="table" lay-filter="table"></table>
    </div>

 

<script type="text/javascript" src="/themes/erp/public/assets/lib/layui-v2.5.5/layui/layui.js"></script>

    <script>
    //注意：导航 依赖 element 模块，否则无法进行功能性操作
    layui.config({
        base: '/themes/erp/public/assets/lib/layui-lib/js/'
    }).use(['form', 'layer', 'jquery','kform'], function() {
        var form = layui.form,
            layer = layui.layer,
            $ = layui.jquery;
             var kform = layui.kform;
        kform.set({
            url:'<?php echo url('rule/addrule'); ?>',
          success:function(r){
            parent.action.refresh()
          }
        }).init();

    });
    </script>

</body>
</html>