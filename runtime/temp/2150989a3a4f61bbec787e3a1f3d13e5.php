<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:86:"/home/wwwroot/au.skxto9314.com/public/../application/admin/view/singer/singerlist.html";i:1519888424;}*/ ?>
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

        <style>
            td , th{
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div class="x-nav">
            <span class="layui-breadcrumb">
              <a><cite>首页</cite></a>
              <a><cite>会员管理</cite></a>
              <a><cite>意见列表</cite></a>
            </span>
            <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>
        </div>
        <div class="x-body">
            <xblock><button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon">&#xe640;</i>批量删除</button><button class="layui-btn" onclick="add('添加歌手','addsinger','600','500')"><i class="layui-icon">&#xe608;</i>添加</button><span class="x-right" style="line-height:40px">共有数据：<?php echo $num; ?> 条</span></xblock>
            <table class="layui-table" style="background: rgba(255,255,255,0.4)">
                <thead>
                    <tr>
                        <th>
                            <!-- <input type="checkbox" name="" value=""> -->
                        </th>
                        <th>
                            ID
                        </th>
                        <th>
                            封面
                        </th>
                        <th>
                            歌手
                        </th>
                        <th>
                            省份
                        </th>
                        <th>
                            描述
                        </th>
                        <th>
                            操作
                        </th>
                    </tr>
                </thead>
                <tbody id="x-link">
                <?php if(is_array($singer) || $singer instanceof \think\Collection): $i = 0; $__LIST__ = $singer;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$singer): $mod = ($i % 2 );++$i;?> 
                    <tr>
                        <td>
                            <input type="checkbox" value="<?php echo $singer['aid']; ?>" name="">
                        </td>
                        <td>
                            <?php echo $singer['aid']; ?>
                        </td>
                        <td >
                            <img src="<?php echo $singer['pic']; ?>" alt="" width="80" height="50">
                        </td>
                        <td >
                            <?php echo $singer['singer_name']; ?>
                        </td>
                        <td>
                            <?php echo $singer['province']; ?>
                        </td>
                        <td>
                            <?php echo $singer['intro']; ?>
                        </td>
                        <td class="td-manage">
                            <a title="删除" href="javascript:;" onclick="feedback_del(this,<?php echo $singer['aid']; ?>)" 
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
                        url:'/admin/singer/delall',
                        dataType:'json',
                        data:{all:id},
                        success:success1

                    });

                function success1(data){

                    var obj = JSON.parse(data);
                    if (obj['state']==1){
                        layer.alert("批量删除歌手成功", {icon: 6} , function(){
                            window.location.href = '/admin/singer/singerlist';
                        });
                    }else{
                        layer.alert("批量删除歌手失败", {icon: 2});
                    }
                }
                return false;
                    
                });
             }
            
            

            // 编辑
            function add (title,url,id,w,h) {
                x_admin_show(title,url,w,h); 
            }
            
            /*删除*/
            function feedback_del(obj1,id){
                layer.confirm('确认要删除吗？',function(index){
                    $.ajax({

                        type:'get',
                        url:'/admin/singer/delsinger',
                        dataType:'json',
                        data:{aid:id},
                        success:success

                    });

                    function success(data)
                    {
                        var obj = JSON.parse(data);
                        if (obj['state']==1){
                             var oDel = obj1.parentNode.parentNode;
                            oDel.remove();
                            layer.alert("删除歌手成功", {icon: 6});
                        }else{
                            layer.alert("删除歌手失败", {icon: 2});
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