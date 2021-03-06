<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:91:"/home/wwwroot/au.skxto9314.com/public/../application/admin/view/permission/permisslist.html";i:1519888423;}*/ ?>
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
        <style>
            th,td{
                /*text-align: center;*/
            }
        </style>
    </head>
    <body style="background: rgba(255,255,255,0.4)">
        <div class="x-nav">
            <span class="layui-breadcrumb">
              <a><cite>首页</cite></a>
              <a><cite>权限管理</cite></a>
              <a><cite>角色管理</cite></a>
            </span>
            <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>
        </div>
        <div class="x-body">
            <xblock><button class="layui-btn" onclick="add('添加用户','addpermiss','600','500')"><i class="layui-icon">&#xe608;</i>添加</button><span class="x-right" style="line-height:40px">共有数据：<?php echo $num; ?> 条</span></xblock>
            
            <table class="layui-table" style="background: rgba(255,255,255,0.4)">
                <thead>
                    <tr>
                        <th>权限ID</th>
                        <th>权限结构</th>
                        <th>权限路径</th>
                        <th>类型</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(is_array($node) || $node instanceof \think\Collection): $i = 0; $__LIST__ = $node;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;if($value['pid']==0): ?>
                    <tr>
                        <td><?php echo $value['nid']; ?></td>
                        <td><p style="text-indent:<?php echo $value['level']*20; ?>px">|——&nbsp;&nbsp;<?php echo $value['name']; ?></p>
                        </td>
                        <td><p style="text-indent:<?php echo $value['level']*20; ?>px">&nbsp;&nbsp;<?php echo $value['ename']; ?></p>
                        </td>
                        <td>
                            <p style="color: orange">模块</p>
                        </td>
                        <td>
                            <a title="编辑" href='/admin/permission/editpermiss?nid=<?php echo $value['nid']; ?>'
                            class="ml-5" style="text-decoration:none">
                                <i class="layui-icon">&#xe642;</i>
                            </a>
                            <a title="删除" href="javascript:;" onclick="role_del(this,<?php echo $value['nid']; ?>)" 
                            style="text-decoration:none">
                                <i class="layui-icon">&#xe640;</i>
                            </a>
                        </td>
                    </tr>
                        <?php if(is_array($node) || $node instanceof \think\Collection): $i = 0; $__LIST__ = $node;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;if($val['pid']==$value['nid']): ?>
                        <tr>
                            <td><?php echo $val['nid']; ?></td>
                            <td><p style="text-indent:<?php echo $val['level']*20; ?>px">|——&nbsp;&nbsp;<?php echo $val['name']; ?></p>
                                <input type="hidden" type='text' id='up'/> 
                            </td>
                            <td><p style="text-indent:<?php echo $val['level']*20; ?>px">&nbsp;&nbsp;<?php echo $val['ename']; ?></p>
                            </td>
                            <td>
                                控制器
                            </td>
                            <td>
                                <a title="编辑" href='/admin/permission/editpermiss?nid=<?php echo $val['nid']; ?>'
                                class="ml-5" style="text-decoration:none">
                                    <i class="layui-icon">&#xe642;</i>
                                </a>
                                <a title="删除" href="javascript:;" onclick="role_del(this,<?php echo $val['nid']; ?>)" 
                                style="text-decoration:none">
                                    <i class="layui-icon">&#xe640;</i>
                                </a>
                            </td>
                        </tr>
                            <?php if(is_array($node) || $node instanceof \think\Collection): $i = 0; $__LIST__ = $node;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;if($v['pid']==$val['nid']): ?>
                            <tr>
                                <td><?php echo $v['nid']; ?></td>
                                <td><p style="text-indent:<?php echo $v['level']*20; ?>px">|——&nbsp;&nbsp;<?php echo $v['name']; ?></p>
                                    <input type="hidden" type='text' id='up'/> 
                                </td>
                                <td><p style="text-indent:<?php echo $v['level']*20; ?>px">&nbsp;&nbsp;<?php echo $v['ename']; ?></p>
                                </td>
                                <td>
                                    <p style="color: green">方法</p>
                                </td>
                                <td>
                                    <a title="编辑" href='/admin/permission/editpermiss?nid=<?php echo $v['nid']; ?>'
                                    class="ml-5" style="text-decoration:none">
                                        <i class="layui-icon">&#xe642;</i>
                                    </a>
                                    <a title="删除" href="javascript:;" onclick="role_del(this,<?php echo $v['nid']; ?>)" 
                                    style="text-decoration:none">
                                        <i class="layui-icon">&#xe640;</i>
                                    </a>
                                </td>
                            </tr>
                            <?php endif; endforeach; endif; else: echo "" ;endif; endif; endforeach; endif; else: echo "" ;endif; endif; endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
            </table>

            <div id="page"></div>
        </div>
        <script src="../../static/admin/lib/layui/layui.js" charset="utf-8"></script>
        <script src="../../static/admin/js/x-layui.js" charset="utf-8"></script>
        <script>
            layui.use(['laydate','element','laypage','layer'], function(){
                $ = layui.jquery;//jquery
              laydate = layui.laydate;//日期插件
              lement = layui.element();//面包导航
              laypage = layui.laypage;//分页
              layer = layui.layer;//弹出层

              //以上模块根据需要引入
            });
             function add(title,url,w,h)
            {
                x_admin_show(title,url,w,h);
            }           

            /*删除*/
            function role_del(obj1,id){
                layer.confirm('确认要删除吗？',function(index){

                    $.ajax({

                        type:'get',
                        url:'/admin/permission/delpermiss',
                        dataType:'json',
                        data:{nid:id},
                        success:success

                    });

                    function success(data)
                    {   
                        var obj = JSON.parse(data);
                        if (obj['state']==1){
                        //     var oDel = obj1.parentNode.parentNode;
                        // oDel.remove();
                            layer.alert("删除权限成功", {icon: 6} , function (){
                                window.location.href = '/admin/permission/permisslist';
                            });
                        }else if(obj['state'] == 2)
                        {
                            layer.alert("不能删除最高权限", {icon: 2});
                        }else{
                            layer.alert("删除权限失败", {icon: 2});
                        }
                    }

                });
            }




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