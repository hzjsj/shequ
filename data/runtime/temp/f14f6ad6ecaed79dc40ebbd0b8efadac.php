<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:32:"themes/erp/admin\rule\index.html";i:1562338979;s:62:"E:\project\php\shequ\public\themes\erp\admin\public\layui.html";i:1568457209;}*/ ?>
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
        
        .layui-form-item{
            margin-bottom: 10px;
        }
        .layui-table-view{
            margin:0;
        }
        .layui-nav-img{
            width: 20px;
            height: 20px;
        }
    </style>

</head>
<body>
 


        <div class="main">
            <div class="card">
            <div class="layui-input-inline" style="width: 80px;margin-bottom:10px;">
                    <button type="button" class="add layui-btn layui-btn-primary">添加</button>
                </div>
                <!-- <form class="layui-form" action="">
                <div class="layui-form-item">
                    
                    
                    <div class="layui-input-inline">
                      <input type="text" name="keywords" lay-verify="" placeholder="请输入关键字" autocomplete="off" class="layui-input">
                    </div>
                <div class="layui-input-inline" style="width: 250px">
                  <button class="layui-btn" lay-submit lay-filter="submit">搜索</button>
                  <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                </div>
                  </div>
            </form> -->
        <div style="height: 500px;">
            <table class="layui-hide" id="treeTable" lay-filter="treeTable"></table>
            </div>
        </div>
        </div>


 

<script type="text/javascript" src="/themes/erp/public/assets/lib/layui-v2.5.5/layui/layui.js"></script>

<script type="text/html" id="bar">
  <a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="tianjia"><i class="layui-icon layui-icon-add-1"></i>添加</a>
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del"><i class="layui-icon layui-icon-delete"></i>删除</a>
  </script>
    
   <script>
var editObj=null,ptable=null,treeGrid=null,tableId='treeTable',layer=null;
layui.config({
    base: '/themes/erp/public/assets/lib/layui-lib/module/'
}).extend({
    treeGrid:'treeGrid'
}).use(['jquery','treeGrid','layer','table'], function(){
    var $=layui.jquery,table=layui.table;
    treeGrid = layui.treeGrid;//很重要
    layer=layui.layer;
    ptable=treeGrid.render({
        id:tableId
        ,elem: '#'+tableId
        ,idField:'id'
        ,url:'<?php echo url(); ?>?is_ajax=1'
        ,cellMinWidth: 100
        ,treeId:'id'//树形id字段名称
        ,treeUpId:'pid'//树形父id字段名称
        ,treeShowName:'title'//以树形式显示的字段
        ,height:'full-60'
        ,cols: [[
            {field:'id',width:80, title: 'ID', align:'center'}
            ,{field:'title', edit:'text',width:300, title: '名称'}
            ,{field:'pid', title: '父级ID', edit:"text",width:80, align:'center'}
            ,{field:'name', title: '规则', edit:"text", align:'center'}
            // ,{field:'create_time', title: '创建时间', edit:"text", align:'center'}
              ,{field: '', title: '操作',align:'center',toolbar: '#bar',width:160},
            // {width:160,title: '', align:'center'
            //     ,templet: function(d){
            //     var html='';
            //     var addBtn='<a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="tianjia"><i class="layui-icon layui-icon-add-1"></i>添加</a>';
            //     var delBtn='<a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del"><i class="layui-icon layui-icon-delete"></i>删除</a>';
            //     return addBtn+delBtn;
            //   }
            // }
        ]]
        ,page:true
         ,limit: 120
        //,skin:'line'
    });
    //单元格编辑
    treeGrid.on('edit('+tableId+')', function(obj){
        layer.confirm('确定要提交修改吗?', {icon: 3, title:'提示'}, function(index){
            $.ajax({
              url:"<?php echo url('editrule'); ?>",
              type:'post',
              data:{id:obj.data.id,field:obj.field,value:obj.value},
              success:function(res){
                if(res.code == 1){
                  layer.msg(res.msg);
                }else{
                  layer.msg(res.msg);
                }
              }
            }) 
            layer.close(index);
        });
    });
    //删除
    treeGrid.on('tool('+tableId+')',function (obj) {
        if(obj.event === 'del'){
            layer.confirm('确定要删除吗?', {icon: 3, title:'提示'}, function(index){
                $.ajax({
                  url:"<?php echo url('delrule'); ?>",
                  type:'post',
                  data:{id:obj.data.id},
                  success:function(res){
                    layer.msg(res.msg);
                    if(res.code == 1){
                        obj.del();
                    }
                  }
                }) 
                layer.close(index);
            });
        }
        if(obj.event === 'tianjia'){
            layer.open({
            type: 2,
            title: '添加',
            shadeClose: true,
            shade: 0.8,
            area: ['500px', '400px'],
            content: '<?php echo url('rule/addrule'); ?>?id=' +obj.data.id , //iframe的url
          end: function () {
                window.location.reload();
            }
          }); 
        }
    });
    $('.add').on('click', function(){
         layer.open({
          type: 2,
          title: '添加',
          shadeClose: true,
          shade: 0.8,
          area: ['500px', '400px'],
          content: '<?php echo url('rule/addrule'); ?>?id='+0 ,//iframe的url
        end: function () {
                window.location.reload();
            }
        }); 
        });
});
function openorclose() {
    var map=treeGrid.getDataMap(tableId);
    var o= map['1'];
    treeGrid.treeNodeOpen(o,!o[treeGrid.config.cols.isOpen]);
}

function getCheckData() {
    var checkStatus = treeGrid.checkStatus(tableId)
        ,data = checkStatus.data;
    layer.alert(JSON.stringify(data));
}
</script>


</body>
</html>