<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:32:"themes/erp/admin\user\index.html";i:1559274308;s:62:"E:\project\php\shequ\public\themes\erp\admin\public\layui.html";i:1568457209;}*/ ?>
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
    .layui-form-item {
        margin-bottom: 10px;
    }

    .layui-table-view {
        margin: 0;
    }

    .layui-nav-img {
        width: 20px;
        height: 20px;
    }
    </style>

</head>
<body>
 

    <div class="main">
        <div class="card">
            <form class="layui-form" action="">
                <div class="layui-form-item">
                    <div class="layui-input-inline" style="width: 80px">
                        <button type="button" class="add layui-btn layui-btn-primary">添加</button>
                    </div>
                    <div class="layui-input-inline">
                        <select name="status" lay-verify="">
                            <option value="1">状态</option>
                        </select>
                    </div>
                    <div class="layui-input-inline">
                        <input type="text" name="keywords" lay-verify="" placeholder="请输入关键字" autocomplete="off" class="layui-input">
                    </div>
                    <div class="layui-input-inline" style="width: 250px">
                        <button class="layui-btn" lay-submit lay-filter="submit">搜索</button>
                        <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                    </div>
                </div>
            </form>
            <table id="table" lay-filter="table"></table>
        </div>
    </div>

 

<script type="text/javascript" src="/themes/erp/public/assets/lib/layui-v2.5.5/layui/layui.js"></script>

    <script type="text/html" id="bar">
        <a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="edit"><i class="layui-icon layui-icon-edit"></i>编辑</a>
	  <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del"><i class="layui-icon layui-icon-delete"></i>删除</a>
	</script>
    <script>
    var action;
    layui.config({
        base: '/themes/erp/public/assets/lib/layui-lib/js/'
    }).use(['app', 'jquery', 'layer', 'element', 'form', 'table', 'klayer'], function() {
        var app = layui.app,
            layer = layui.layer,
            $ = layui.jquery;
        var element = layui.element,
            form = layui.form,
            table = layui.table,
            klayer = layui.klayer;

        table.render({
            elem: '#table',
            // size: 'sm',
            height: 'full-90',
            url: '<?php echo url(); ?>?is_ajax=1' //数据接口
                ,
            page: true //开启分页
                ,
            cols: [
                [ //表头
                    { field: 'id', title: 'ID', align: 'center', width: 80 },
                     { field: 'user_login', title: '用户名', align: 'center' },
                     { field: 'user_email', title: '邮箱', align: 'center' }, 
                     { field: 'user_nickname', title: '昵称', align: 'center' }, {
                        field: '',
                        title: '头像',
                        align: 'center',
                        width: 80,
                        templet: function(d) {
                            return '<img src="' + d.avatar_new + '" class="layui-nav-img" onerror="javascript:this.src=\'/themes/erp/public/assets/images/default_head_img.gif\';">';
                        }
                    }, { field: 'sex_new', title: '性别', align: 'center', width: 80 }
                    , { field: '', title: '操作', align: 'center', toolbar: '#bar',width:160 }
                ]
            ]
        });

        form.on('submit(submit)', function(data) {
            action.listRefresh(data.field);
            return false;
        });

        action = {
            listRefresh: function(field) {
                table.reload('table', {
                    where: field,
                    page: {
                        curr: 1
                    }
                });
            }
            ,refresh:function(){
            	table.reload('table', {
                  page: {
                      curr: 1
                  }
              });
            }
        }


        table.on('tool(table)', function(obj) {
            var data = obj.data;

            if (obj.event === 'edit') {
                layer.open({
                    type: 2,
                    title: '编辑用户',
                    shadeClose: true,
                    shade: 0.8,
                    area: ['500px', '420px'],
                    content: '<?php echo url('user/editguanli'); ?>?id=' + data.id //iframe的url
                });
            } else if (obj.event === 'del') {
                layer.confirm('真的删除行么', function(index) {
                    var load = layer.load(2);
                    $.ajax({
                        url: '<?php echo url('user/delguanli'); ?>',
                        type: "post",
                        data: { id: data.id },
                        dataType: "json",
                        success: function(r) {
                            layer.close(load);
                            if (r.code == 1) {
                                obj.del();
                                layer.msg(r.msg, { icon: 1 }, function() {
                                    layer.close(index);
                                });
                            } else {
                                layer.msg(r.msg, { icon: 2 }); //错误提示
                            }
                        },
                        error: function() {
                            layer.close(load);
                            layer.msg('网络错误！', { icon: 2 }); //错误提示
                        }
                    });


                });
            }
        });

        //添加用户
        $('.add').on('click', function() {
            klayer.set({
                title: '添加用户',
                area: ['500px','420px'],// xs sm md lg
                url: '<?php echo url('user/addguanli'); ?>'
            }).init();
        });
    });
    </script>

</body>
</html>