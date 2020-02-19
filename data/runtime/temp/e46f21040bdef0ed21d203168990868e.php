<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:34:"themes/erp/admin\setting\site.html";i:1568468926;s:62:"E:\project\php\shequ\public\themes\erp\admin\public\layui.html";i:1568457209;}*/ ?>
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
    .layui-fluid{
      padding: 10px;
    }
    </style>

</head>
<body>
 

<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
      <div class="layui-col-md12">
        <div class="layui-card">
          <div class="layui-card-header">网站设置</div>
          <div class="layui-card-body" pad15>
            
            <div class="layui-form" wid100 lay-filter="">
              <div class="layui-form-item">
                <label class="layui-form-label">网站名称</label>
                <div class="layui-input-block">
                  <input type="text" name="options[site_name]" value="<?php echo (isset($site_info['site_name']) && ($site_info['site_name'] !== '')?$site_info['site_name']:''); ?>" class="layui-input">
                </div>
              </div>
              <div class="layui-form-item">
                <label class="layui-form-label">网站域名</label>
                <div class="layui-input-block">
                  <input type="text" name="options[web]" lay-verify="url" value="<?php echo (isset($site_info['web']) && ($site_info['web'] !== '')?$site_info['web']:''); ?>" class="layui-input">
                </div>
              </div>
              <div class="layui-form-item">
                <label class="layui-form-label">缓存时间</label>
                <div class="layui-input-inline" style="width: 80px;">
                  <input type="text" name="options[cache]" lay-verify="number" value="<?php echo (isset($site_info['cache']) && ($site_info['cache'] !== '')?$site_info['cache']:''); ?>" class="layui-input">
                </div>
                <div class="layui-input-inline layui-input-company">分钟</div>
                <div class="layui-form-mid layui-word-aux">本地开发一般推荐设置为 0，线上环境建议设置为 10。</div>
              </div>
              <div class="layui-form-item">
                <label class="layui-form-label">最大文件上传</label>
                <div class="layui-input-inline" style="width: 80px;">
                  <input type="text" name="options[max_file]" lay-verify="number" value="<?php echo (isset($site_info['max_file']) && ($site_info['max_file'] !== '')?$site_info['max_file']:''); ?>" class="layui-input">
                </div>
                <div class="layui-input-inline layui-input-company">KB</div>
                <div class="layui-form-mid layui-word-aux">提示：1 M = 1024 KB</div>
              </div>
              <div class="layui-form-item">
                <label class="layui-form-label">上传文件类型</label>
                <div class="layui-input-block">
                  <input type="text" name="options[file_type]" value="<?php echo (isset($site_info['file_type']) && ($site_info['file_type'] !== '')?$site_info['file_type']:''); ?>" class="layui-input">
                </div>
              </div>
              
              <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">首页标题</label>
                <div class="layui-input-block">
                  <textarea name="options[site_title]" class="layui-textarea"><?php echo (isset($site_info['site_title']) && ($site_info['site_title'] !== '')?$site_info['site_title']:''); ?></textarea>
                </div>
              </div>
              <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">META关键词</label>
                <div class="layui-input-block">
                  <textarea name="options[site_keywords]" class="layui-textarea" placeholder="多个关键词用英文状态 , 号分割"><?php echo (isset($site_info['site_keywords']) && ($site_info['site_keywords'] !== '')?$site_info['site_keywords']:''); ?></textarea>
                </div>
              </div>
              <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">META描述</label>
                <div class="layui-input-block">
                  <textarea name="options[site_descript]" class="layui-textarea"><?php echo (isset($site_info['site_descript']) && ($site_info['site_descript'] !== '')?$site_info['site_descript']:''); ?></textarea>
                </div>
              </div>
              <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">版权信息</label>
                <div class="layui-input-block">
                  <textarea name="options[copyright]" class="layui-textarea"><?php echo (isset($site_info['copyright']) && ($site_info['copyright'] !== '')?$site_info['copyright']:''); ?></textarea>
                </div>
              </div>
              <div class="layui-form-item">
                <div class="layui-input-block">
                  <button class="layui-btn" lay-submit lay-filter="submit">确认保存</button>
                </div>
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </div>
  </div>

 

<script type="text/javascript" src="/themes/erp/public/assets/lib/layui-v2.5.5/layui/layui.js"></script>

  <script>
      var _tools;
      layui.config({
          base: '/themes/erp/public/assets/lib/layui-lib/js/'
      }).use(['app','jquery','layer','element','form','kform'], function() {
          var app = layui.app,
              layer = layui.layer,
              $ = layui.jquery;
          var element = layui.element,
              kform = layui.kform;
          kform.set({
            url:'<?php echo url('setting/site'); ?>',
            success:function(r){
              parent.action.refresh()
            }            
          }).init();
      });
          
  </script>

</body>
</html>