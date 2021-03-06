<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:82:"/home/wwwroot/au.skxto9314.com/public/../application/admin/view/user/userlist.html";i:1519888424;}*/ ?>
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
              <a><cite>管理员列表</cite></a>
            </span> -->
            <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>
        </div>
        <div class="x-body" style="background: rgba(255,255,255,0.2)">
            <form class="layui-form x-center" action="/admin/user/userlist" style="width:80%" method="get">
                <div class="layui-form-pane" style="margin-top: 15px;">
                  <div class="layui-form-item">
                    <div class="layui-input-inline">
                    <input type="text" name="username"  placeholder="请输入登录名" autocomplete="off" class="layui-input">
                    </div>
                    <div class="layui-input-inline" style="width:80px">
                        <button type="submit" class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
                    </div>
                  </div>
                </div> 
            </form>
            <xblock><button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon">&#xe640;</i>批量删除</button>
            <button class="layui-btn" onclick="add('添加用户','adduser','600','500')"><i class="layui-icon">&#xe608;</i>添加</button>
            <span class="x-right" style="line-height:40px">共有数据：<?php echo $num; ?> 条</span></xblock>
            <table class="layui-table" style="background: rgba(255,255,255,0.3)">
                <thead>
                    <tr>
                        <th>
                            <!-- <input type="checkbox" name="" value=""> -->
                        </th>
                        <th>
                            ID
                        </th>
                        <th>
                            登录名
                        </th>
                        <th>头像</th>
                        <th>
                            手机
                        </th>
                        <th>
                            邮箱
                        </th>
                        <th>
                            来源
                        </th>
                        <th>
                            加入时间
                        </th>
                        <th>
                            状态
                        </th>
                        <th>
                            操作
                        </th>
                    </tr>
                </thead>
                <tbody>
                <?php if(is_array($user) || $user instanceof \think\Collection): $i = 0; $__LIST__ = $user;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?>
                    <tr>
                        <td>
                            <input type="checkbox" value="<?php echo $value['uid']; ?>" name="">
                        </td>
                        <td>
                            <?php echo $value['uid']; ?>
                        </td>
                        <td>
                            <?php echo $value['username']; ?>
                        </td>
                        <td><img src="<?php echo $value['pic']; ?>" alt="" width="50" height="50"></td>
                        <td >
                            <?php echo $value['phone']; ?>
                        </td>
                        <td >
                            <?php echo $value['email']; ?>
                        </td>
                        <td >
                            <?php if($value['type']==1): ?>
                                AU本站
                            <?php elseif($value['type']==2): ?>
                                QQ
                            <?php elseif($value['type']==3): ?>
                                微博
                            <?php endif; if($value['isred']==1): ?>(红钻)<?php endif; ?>
                        </td>
                        <td>
                            <?php echo date(('Y-m-d H:i:s') , $value['create_time']); ?>
                        </td>
                        <td class="td-status">                                
                            <?php if($value['delete_time']==1): ?>
                            <span onclick="black(this,<?php echo $value['uid']; ?>)" class="layui-btn layui-btn-danger layui-btn-mini" >
                                已拉黑
                            <?php else: ?>
                            <span onclick="black(this,<?php echo $value['uid']; ?>)" class="layui-btn layui-btn-normal layui-btn-mini">
                                已启用
                            <?php endif; ?>
                            </span>
                        </td>
                        <td class="td-manage">
                            <a title="删除" href="javascript:;" onclick="deluser(this,<?php echo $value['uid']; ?>)" 
                            style="text-decoration:none">
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

        </div>
        <script src="../../static/admin/lib/layui/layui.js" charset="utf-8"></script>
        <script src="../../static/admin/lib/layui/lay/modules/element.js" charset="utf-8"></script>
        <script src="../../static/admin/lib/layui/lay/modules/laypage.js" charset="utf-8"></script>
        <script src="../../static/admin/lib/layui/lay/modules/layer.js" charset="utf-8"></script>
        <script src="../../static/admin/lib/layui/lay/modules/laydate.js" charset="utf-8"></script>
        <script src="../../static/admin/lib/layui/lay/modules/form.js" charset="utf-8"></script>
        <script src="../../static/admin/js/x-layui.js" charset="utf-8"></script>
        <script src="../../static/admin/js/x-admin.js" charset="utf-8"></script>
        <script src="../../static/admin/js/jquery.min.js" charset="utf-8"></script>
        <script>
            layui.use(['layer'], function(){
                $ = layui.jquery;//jquery


              layer = layui.layer;//弹出层

              //以上模块根据需要引入
              
            });

            function sear()
            {
                var key = $('[name=username]').val();
                $.ajax({
                    type:'get',
                        url:'/admin/user/userlist',
                        dataType:'json',
                        data:{key:key},
                        success:null
                });
            }

            //批量删除提交
             function delAll () {
                layer.confirm('确认要删除吗？',function(index){

                    var id = []; 
                    for(var i=0;i<$('input').size();i++){
                        if($('input').eq(i).is(':checked')){
                          id.push($('input').eq(i).val());
                        }
                        
                    }

                    $.ajax({

                        type:'get',
                        url:'/admin/user/delall',
                        dataType:'json',
                        data:{all:id},
                        success:success1

                    });

                function success1(data){

                    var obj = JSON.parse(data);
                    if (obj['state']==1){
                        
                        layer.alert("批量删除用户成功", {icon: 6} , function(){
                            window.location.href = '/admin/user/userlist';
                        });
                    }else{
                        layer.alert("批量删除用户失败", {icon: 2});
                    }
                }
                return false;
                    
                });
             }
             /*添加*/
            function add(title,url,w,h){
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
            //编辑
            function admin_edit (title,url,id,w,h) {
                x_admin_show(title,url,w,h); 
            }
            /*删除*/
            function deluser(obj1,id){
                layer.confirm('确认要删除吗？',function(index){
                    $.ajax({

                        type:'get',
                        url:'/admin/user/deluser',
                        dataType:'json',
                        data:{uid:id},
                        success:success

                    });

                    function success(data)
                    {
                        var obj = JSON.parse(data);
                        if (obj['state']==1){
                            var oDel = obj1.parentNode.parentNode;
                            oDel.remove();
                            layer.alert("删除用户成功", {icon: 6});
                        }else{
                            layer.alert("删除用户失败", {icon: 2});
                        }
                    }

                });
            }

            // 拉黑用户
            function black(obj , id)
            {
                layer.confirm('确认要执行此操作吗？',function(index){
                    $.ajax({

                        type:'get',
                        url:'/admin/user/blackuser',
                        dataType:'json',
                        data:{uid:id},
                        success:success

                    });

                    function success(data)
                    {
                        var obj = JSON.parse(data);
                        if (obj['state']==1){

                            layer.alert("操作成功", {icon: 6},function () {
                                // 刷新父页面
                                window.location.href = '/admin/user/userlist';
                            });
                        }else{
                            layer.alert("操作失败", {icon: 2});
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