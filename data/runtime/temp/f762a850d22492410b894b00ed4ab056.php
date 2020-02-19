<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:36:"themes/erp/admin\user\addguanli.html";i:1562408644;s:60:"E:\web\www915\public\themes\erp\admin\public\layui_form.html";i:1562115663;}*/ ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title></title>
  <link rel="icon" href="/themes/erp/public/assets/images/favicon.ico" type="image/x-icon" /> 
  <link rel="stylesheet" type="text/css" href="/themes/erp/public/assets/lib/layui-v2.5.4/layui/css/layui.css">
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
  
    <style type="text/css">

    
    </style>

</head>
<body>
 

    <div class="main">
            <form class="layui-form" action="">
                <div class="layui-form-item">
                    <label class="layui-form-label">昵称</label>
                    <div class="layui-input-inline">
                        <input type="text" name="nickname" required lay-verify="required" placeholder="请输入昵称" autocomplete="off" class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">账号</label>
                    <div class="layui-input-inline">
                        <input type="text" name="login" required lay-verify="required" placeholder="请输入账号" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">密码</label>
                    <div class="layui-input-inline">
                        <input type="password" name="pass" required lay-verify="required" placeholder="请输入密码" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">邮箱</label>
                    <div class="layui-input-inline">
                        <input type="text" name="email" required lay-verify="required" placeholder="请输入邮箱" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">性别</label>
                    <div class="layui-input-block">
                        <input type="radio" name="sex" value="1" title="男" checked>
                        <input type="radio" name="sex" value="2" title="女">
                    </div>
                </div>
                <div class="k-fixbar-btns">
                    <button class="layui-btn" onclick="" lay-submit="" lay-filter="submit" id="submit">保存</button>
                </div>
            </form>
            <table id="table" lay-filter="table"></table>
    </div>

 

<script type="text/javascript" src="/themes/erp/public/assets/lib/layui-v2.5.4/layui/layui.js"></script>

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
            url:'<?php echo url('user/addguanli'); ?>',
          success:function(r){
            parent.action.refresh()
          }
        }).init();

    });
    </script>

</body>
</html>