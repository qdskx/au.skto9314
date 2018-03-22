<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:90:"/home/wwwroot/au.skxto9314.com/public/../application/admin/view/classify/classifylist.html";i:1519888422;}*/ ?>
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
        <script src='../../static/admin/js/jquery-1.11.3.min.js'></script>
    </head>
    <body>
        <div class="x-nav">
<!--             <span class="layui-breadcrumb">
              <a><cite>首页</cite></a>
              <a><cite>会员管理</cite></a>
              <a><cite>意见列表</cite></a>
            </span> -->
            <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>
        </div>
        <div class="x-body">
            <xblock>
            <button class="layui-btn" onclick="add('添加类别','addclassify','600','500')"><i class="layui-icon">&#xe608;</i>添加</button>
            </xblock>
            <table class="layui-table" style="background: rgba(255,255,255,0.4)">
                <thead>
                    <tr>
                        <th>
                            类别ID
                        </th>
                        <th>
                            分类名
                        </th>
                        <th>
                            创建时间
                        </th>
                        <th>
                            操作
                        </th>
                    </tr>
                </thead>
                <tbody id="x-link">
                <?php if(is_array($info) || $info instanceof \think\Collection): $i = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?>
                    <tr>
                        <td>
                            <?php echo $value['cid']; ?>
                        </td>
                        <td>
                            <p style="text-indent:<?php echo $value['level']*20; ?>px">|——&nbsp;&nbsp;<?php echo $value['classname']; ?></p>
                            <!-- <?php echo $value['classname']; ?> -->
                        </td>
                        <td >
                            <?php echo date('Y-m-d H:i:s' , $value['create_time']); ?>
                        </td>
                        <td class="td-manage">
                            <a title="编辑" href="/admin/classify/editclassify?cid=<?php echo $value['cid']; ?>"
                            class="ml-5" style="text-decoration:none">
                                <i class="layui-icon">&#xe642;</i>
                            </a>
                            <a title="删除" href="javascript:;" onclick="feedback_del(this,<?php echo $value['cid']; ?>)" 
                            style="text-decoration:none">
                                <i class="layui-icon">&#xe640;</i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
            </table>


        </div>
        <script src="../../static/admin/lib/layui/layui.js" charset="utf-8"></script>
        <script src="../../static/admin/js/x-layui.js" charset="utf-8"></script>
        <script>
            layui.use(['element','laypage','layer','form'], function(){
                $ = layui.jquery;//jquery
              lement = layui.element();//面包导航
              laypage = layui.laypage;//分页
              layer = layui.layer;//弹出层
              form = layui.form();//弹出层


          })

              

              //以上模块根据需要引入


            
             function add(title,url,w,h)
            {
                x_admin_show(title,url,w,h);
            }           

            // 编辑
            function feedback_edit (title,url,id,w,h) {
                x_admin_show(title,url,w,h); 
            }
            
            /*删除*/
            /*删除*/
            function feedback_del(obj1,id){
                layer.confirm('确认要删除吗？',function(index){
                    $.ajax({

                        type:'get',
                        url:'/admin/classify/delclassify',
                        dataType:'json',
                        data:{cid:id},
                        success:success

                    });

                    function success(data)
                    {
                        var obj = JSON.parse(data);
                        if (obj['state']==1){
                            //  var oDel = obj1.parentNode.parentNode;
                            // oDel.remove();
                            layer.alert("删除分类成功", {icon: 6} , function(){
                                window.location.href = '/admin/classify/classifylist';
                            });
                        }else{
                            layer.alert("删除分类失败", {icon: 2});
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