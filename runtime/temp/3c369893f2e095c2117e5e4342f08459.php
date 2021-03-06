<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:86:"/home/wwwroot/au.skxto9314.com/public/../application/admin/view/comment/mvcomlist.html";i:1519894384;}*/ ?>
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
            <!-- <span class="layui-breadcrumb">
              <a><cite>首页</cite></a>
              <a><cite>会员管理</cite></a>
              <a><cite>管理员列表</cite></a>
            </span> -->
            <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>
        </div>
        <div class="x-body">

            <xblock>
                <button class="layui-btn layui-btn-danger" onclick="delAllmv()"><i class="layui-icon">&#xe640;</i>批量删除</button>
            <span class="x-right" style="line-height:40px">共有数据：<?php echo $num; ?> 条</span></xblock>
            <table class="layui-table">
                <thead>
                    <tr>
                        <th>
                            <!-- <input type="checkbox" name="" value=""> -->
                        </th>
                        <th>
                            ID
                        </th>
                        <th>
                            内容
                        </th>
                        <th>
                            用户
                        </th>
                        <th>
                            来源
                        </th>
                        <th>
                            评论时间
                        </th>
                        <th>
                            操作
                        </th>
                    </tr>
                </thead>
                <tbody>
                <?php if(is_array($res) || $res instanceof \think\Collection): $i = 0; $__LIST__ = $res;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?>
                    <tr>
                        <td>
                            <input type="checkbox" value="<?php echo $value['id']; ?>" name="">
                        </td>
                        <td>
                            <?php echo $value['id']; ?>
                        </td>
                        <td>
                            <?php echo $value['content']; ?>
                        </td>
                        <td>
                            <?php echo $value['username']; ?>
                        </td>
                        <td>
                            <?php if($value['type']==1): ?>
                                au本站
                            <?php elseif($value['type']==2): ?>
                                QQ
                            <?php elseif($value['type']==3): ?>
                                微博
                            <?php elseif($value['type']==4): ?>
                                红钻
                            <?php elseif($value['type']==0): ?>
                                管理员
                            <?php endif; if($value['isred']==1): ?>(红钻)<?php endif; ?>
                        </td>
                        <td >
                            <?php echo date('Y-m-d H:i:s' , $value['create_time']); ?>
                        </td>
                        <td class="td-manage">
                            <a title="删除" href="javascript:;" onclick="post_delmv(this,<?php echo $value['id']; ?>)" style="text-decoration:none">
                                <i class="layui-icon">&#xe640;</i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
            </table>

        <div class="page" style="text-align: center">
                <a href="<?php echo $allPage['first']; ?>"  style="color:#F0F0F0;padding: 5px;">首页</a>
                <a href="<?php echo $allPage['prev']; ?>" style="color:#F0F0F0;padding: 5px;">上一页</a>
                <a href="<?php echo $allPage['next']; ?>" style="color:#F0F0F0;padding: 5px;">下一页</a>
                <a href="<?php echo $allPage['end']; ?>" style="color:#F0F0F0;padding: 5px;">尾页</a>
            </div>
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

            //批量删除mv
             function delAllmv () {
                layer.confirm('确认要删除吗？',function(index){

                    var id = []; 
                    for(var i=0;i<$('input').size();i++){
                        if($('input').eq(i).is(':checked')){
                          id.push($('input').eq(i).val());
                        }
                        
                    }

                    $.ajax({

                        type:'get',
                        url:'/admin/comment/delallmv',
                        dataType:'json',
                        data:{all:id},
                        success:success1

                    });

                function success1(data){

                    var obj = JSON.parse(data);
                    if (obj['state']==1){
                        layer.alert("批量删除评论成功", {icon: 6},function () {
                            // 刷新父页面
                            window.location.href = '/admin/mv/mvlist';
                        });
                    }else{
                        layer.alert("批量删除评论失败", {icon: 2});
                    }
                }
                return false;
                    
                });
             }

             /*添加*/
            function admin_add(title,url,w,h){
                x_admin_show(title,url,w,h);
            }

             /*停用*/
            function admin_stop(obj,id){
                layer.confirm('确认要停用吗？',function(index){
                    //发异步把用户状态进行更改
                    $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="admin_start(this,id)" href="javascript:;" title="启用"><i class="layui-icon">&#xe62f;</i></a>');
                    $(obj).parents("tr").find(".td-status").html('<span class="layui-btn layui-btn-disabled layui-btn-mini">已停用</span>');
                    $(obj).remove();
                    layer.msg('已停用!',{icon: 5,time:1000});
                });
            }

            /*启用*/
            function admin_start(obj,id){
                layer.confirm('确认要启用吗？',function(index){
                    //发异步把用户状态进行更改
                    $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="admin_stop(this,id)" href="javascript:;" title="停用"><i class="layui-icon">&#xe601;</i></a>');
                    $(obj).parents("tr").find(".td-status").html('<span class="layui-btn layui-btn-normal layui-btn-mini">已启用</span>');
                    $(obj).remove();
                    layer.msg('已启用!',{icon: 6,time:1000});
                });
            }

            /*删除*/
            // 删除mv
            function post_delmv(obj1,id){

                layer.confirm('确认要删除吗？',function(index){
                    $.ajax({

                        type:'get',
                        url:'/admin/comment/delcomv',
                        dataType:'json',
                        data:{id:id},
                        success:success

                    });

                    function success(data)
                    {
                        var obj = JSON.parse(data);


                        if (obj['state']==1){
                             $(obj1).parents('td').parents("tr").remove();
                            layer.alert("删除评论成功", {icon: 6});
                        }else{
                            layer.alert("删除评论失败", {icon: 2});
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

    <script>
        $(".page a").on("click", function() {
            var page = $(this).attr("href");
            getPage(page);
            return false;
        });
        function getPage(url){
            $.get(url, function(result){
                $("body").html(result);
            });
        }                     
        </script>
    </body>
</html>