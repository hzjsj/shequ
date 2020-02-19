<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:35:"themes/erp/admin\index\addrole.html";i:1568528612;s:60:"E:\web\www915\public\themes\erp\admin\public\layui_form.html";i:1568524108;}*/ ?>
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
  
    <style type="text/css">

    
    </style>

</head>
<body>
 

     <div class="main">
            <form class="layui-form" action="" style="height: 500px;"> 
                <div class="layui-form-item">
                <label class="layui-form-label">角色名称</label>
                  <div class="layui-input-inline">
                    <input type="text" name="role[title]" required lay-verify="required" placeholder="请输入角色名称" autocomplete="off" class="layui-input">
                 </div>
                </div>
                <div class="layui-form-item">
        <label class="layui-form-label">权限配置</label>
        <div class="layui-input-block">
           <div id="test12" class="demo-tree-more"></div>
        </div>
        </div>
         <div class="layui-form-item">
          <label class="layui-form-label">状态</label>
          <div class="layui-input-block">
            <input type="radio" name="role[status]" value="1" title="正常" checked>
            <input type="radio" name="role[status]" value="0" title="禁用" >
          </div>
        </div>
        <div class="layui-form-item layui-form-text">
          <label class="layui-form-label">备注</label>
          <div class="layui-input-block" style="width:260px;">
            <textarea name="role[remark]" placeholder="请输入备注" class="layui-textarea"></textarea>
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
    }).use(['form', 'layer', 'jquery','kform','tree','util'], function() {
        var tree = layui.tree,util = layui.util;
        var form = layui.form,
            layer = layui.layer,
            $ = layui.jquery;
             var kform = layui.kform;
        kform.set({
            url:'<?php echo url('index/addrole'); ?>',
          success:function(r){
            parent.action.refresh()
          }
        }).init();

    $.ajax({
      url: '<?php echo url('index/hqqx'); ?>',
      dataType: 'json',
      success: function(data){
        //基本演示
        tree.render({
          elem: '#test12'
          ,data: data.data
          ,showCheckbox: true  //是否显示复选框
          ,id: 'demoId1'
          //,isJump: true //是否允许点击节点时弹出新窗口跳转
          ,click: function(obj){
            var data = obj.data;  //获取当前点击的节点数据
            layer.msg('状态：'+ obj.state + '<br>节点数据：' + JSON.stringify(data));
          }
        });
        //tree.setChecked('demoId1', [5, 2]); //勾选指定节点
        }
    });

    });
    </script>

</body>
</html>