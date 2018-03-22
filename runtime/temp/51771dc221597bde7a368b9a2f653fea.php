<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:90:"/home/wwwroot/au.skxto9314.com/public/../application/admin/view/permission/addpermiss.html";i:1519888422;}*/ ?>
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
        <script src='https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190'></script>
    </head>
    <body>
        <div class="x-body">
            <form class="layui-form">
                <div class="layui-form-item">
                    <label for="level-name" class="layui-form-label">
                        <span class="x-red">*</span>英文权限名
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="username" name="ename" required="" lay-verify="required" 
                        autocomplete="off"  class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="level-kiss" class="layui-form-label">
                        <span class="x-red">*</span>中文权限名
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="username" name="name" required=""  lay-verify="required"
                        autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="level-kiss" class="layui-form-label">
                        <span class="x-red">*</span>描述
                    </label>
                    <div class="layui-input-inline">
                        <select name="level" id="">
                            <option value="1">模块</option>
                            <option value="2">控制器</option>
                            <option value="3">方法</option>
                        </select>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="level-kiss" class="layui-form-label">
                        父节点
                    </label>
                    <div class="layui-input-inline">
                        <select name="pid" id="" >
    <!--                         <optgroup style="padding-left:30px;">
                            <option value="0">根节点</option>
                            <?php if(is_array($node) || $node instanceof \think\Collection): $i = 0; $__LIST__ = $node;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;if($value['level'] == 1): ?>
                                <option value="<?php echo $value['nid']; ?>">  <?php echo $value['name']; ?></option>
                                <?php elseif($value['level'] == 2): ?>
                                    <option value="<?php echo $value['nid']; ?>">   |——<?php echo $value['name']; ?></option>
                                <?php endif; endforeach; endif; else: echo "" ;endif; ?>
                            </optgroup> -->
                            <option value="0">根节点</option>
                            <?php if(is_array($node) || $node instanceof \think\Collection): $i = 0; $__LIST__ = $node;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;if($value['pid']==0): ?>
                            <option value="<?php echo $value['nid']; ?>"><p style="padding-left: 10px"><?php echo $value['name']; ?></p></option> 
                            <?php if(is_array($node) || $node instanceof \think\Collection): $i = 0; $__LIST__ = $node;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;if($val['pid']==$value['nid']): ?>
                            <option value="<?php echo $val['nid']; ?>" style="margin-left: 20px"><p >&nbsp;&nbsp;&nbsp;|——<?php echo $val['name']; ?></p></option>
                            <?php endif; endforeach; endif; else: echo "" ;endif; endif; endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="L_repass" class="layui-form-label">
                    </label>
                    <button  class="layui-btn" lay-filter="save" lay-submit="" id='btn'>
                        保存
                    </button>
                </div>
            </form>
        </div>
        <script src="../../static/admin/lib/layui/layui.js" charset="utf-8">
        </script>
        <script src="../../static/admin/js/x-layui.js" charset="utf-8">
        </script>
        <script>
            layui.use(['form','layer'], function(){
                $ = layui.jquery;
              var form = layui.form()
              ,layer = layui.layer;
            

            $(function () {
                $('#btn').click(function () {

                    //读取input框中的value值
                    var ename = $('[name=ename]').val();
                    var name = $('[name=name]').val();
                    var level = $('[name=level]').val();
                    var sort = $('[name=sort]').val();
                    var pid = $('[name=pid]').val();

                    $.ajax({
                        type:'post',
                        url:'/admin/permission/doaddpermiss',
                        data:{ename:ename,name:name,level:level,pid:pid,sort:sort},
                        dataType:'json', 
                        success:success
                    });
                    return false;
                    
                });
                function success(data)
                {
                    var obj = JSON.parse(data);

                    if(obj['state'] == 1)
                    {
                        layer.alert('添加权限成功', {icon: 6});

                    }else if(obj['state'] == 2)
                    {
                        layer.alert('权限结构已存在', {icon: 2});
                    }else if(obj['state'] == 3)
                    {
                        layer.alert('权限名已存在', {icon: 2});
                    }else
                    {
                        layer.alert('添加权限失败', {icon: 2});
                    }
                }
                
            });
         

              
              
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