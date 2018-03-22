<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:86:"/home/wwwroot/au.skxto9314.com/public/../application/admin/view/banner/editbanner.html";i:1519810552;}*/ ?>
<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="utf-8">
        <title>
            X-admin v1.0
        </title>
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="format-detection" content="telephone=no">
        <link rel="stylesheet" href="../../static/admin/css/x-admin.css" media="all">
    </head>
   
    <body>
        <div class="x-body">
        <?php if(is_array($ing) || $ing instanceof \think\Collection): $i = 0; $__LIST__ = $ing;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?>
            <form action="/admin/banner/doeditbanner" method="post" enctype="multipart/form-data" class="layui-form">
                <div class="layui-form-item">
                    <label for="link" class="layui-form-label">
                        <span class="x-red">*</span>轮播图
                    </label>
                    <div class="layui-input-inline">
                      <div class="site-demo-upbar">
                        <input type="file" name="file" class="layui-upload-file" id="test">
                      </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label  class="layui-form-label">缩略图
                    </label>
                    <img width="200" src="<?php echo $value['pic']; ?>">
                </div>
                <div class="layui-form-item">
                    <label  class="layui-form-label">
                    </label>
                </div>
                
                <div class="layui-form-item">
                    <label for="link" class="layui-form-label">
                        <span class="x-red">*</span>链接
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="link" name="link" required="" lay-verify="required" value="<?php echo $value['url']; ?>" 
                        autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="desc" class="layui-form-label">
                        <span class="x-red">*</span>描述
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="desc" name="desc" required="" lay-verify="required" value="<?php echo $value['intro']; ?>" 
                        autocomplete="off" class="layui-input">
                    </div>
                    <div class="layui-form-mid layui-word-aux">
                        <span class="x-red">*</span>
                    </div>
                </div>
                <input type="hidden" name="id" value="<?php echo $value['lid']; ?>" />
                <div class="layui-form-item">
                    <label for="L_repass" class="layui-form-label">
                    </label>
                    <button class="layui-btn" lay-filter="add" lay-submit="">
                        提交
                    </button>
                </div>
            </form>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <script src="../../static/admin/lib/layui/layui.js" charset="utf-8">
        </script>
        <script src="../../static/admin/js/x-layui.js" charset="utf-8">
        </script>
        <script>
            layui.use(['form','layer','upload'], function(){
                $ = layui.jquery;
              var form = layui.form()
              ,layer = layui.layer;         
              
            });
        </script>
        <script>
        var _hmt = _hmt || [];
        (function() {
          var hm = document.createElement("script");
          hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
          var s = document.getElementsByTagName("script")[0]; 
          s.parentNode.insertBefore(hm, s);
        })();
        </script>
    </body>

</html>