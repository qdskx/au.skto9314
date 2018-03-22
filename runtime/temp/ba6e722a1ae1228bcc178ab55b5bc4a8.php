<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:77:"/home/wwwroot/au.skxto9314.com/public/../application/admin/view/sys/link.html";i:1519810554;}*/ ?>
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
        <div class="x-nav">
            <span class="layui-breadcrumb">
              <a><cite>首页</cite></a>
              <a><cite>会员管理</cite></a>
              <a><cite>友情链接</cite></a>
            </span>
            <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>
        </div>
        <div class="x-body">
            <xblock><button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon">&#xe640;</i>批量删除</button><a href='/admin/sys/addlink' class="layui-btn"><i class="layui-icon">&#xe608;</i>添加</a><span class="x-right" style="line-height:40px">共有数据：<?php echo $num; ?> 条</span></xblock>
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
                            链接名
                        </th>
                        <th>
                            url
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
                    <?php if(is_array($info) || $info instanceof \think\Collection): $i = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?>
                    <tr>
                        <td>
                            <input type="checkbox" value="<?php echo $value['lid']; ?>">
                        </td>
                        <td><?php echo $value['lid']; ?></td>
                        <td><p><?php echo $value['name']; ?></p>
                        </td>
                        <td>
                            <?php echo $value['url']; ?>
                        </td>
                        <td>
                            <p style="overflow: hidden;"><?php echo $value['description']; ?></p>
                        </td>
                        <td>
                            <a title="删除" href="javascript:;" onclick="feedback_del(this,<?php echo $value['lid']; ?>)"
                            style="text-decoration:none">
                                <i class="layui-icon">&#xe640;</i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
            </table>

            <div id="page"></div>
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
                        url:'/admin/sys/delallink',
                        dataType:'json',
                        data:{all:id},
                        success:success1
                    });

                function success1(data){

                    var obj = JSON.parse(data);
                    if (obj['state']==1){
                        layer.alert("批量删除成功", {icon: 6},function(){
                            window.location.href = '/admin/sys/link';
                        });                       
                    }else{
                        layer.alert("批量删除失败", {icon: 2});
                    }
                }
                return false;
                    
                })
             }
            

           }); 

// <script>
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
                    /*删除*/
            function feedback_del(obj1,id){
                layer.confirm('确认要删除吗？',function(index){
                    $.ajax({

                        type:'get',
                        url:'/admin/sys/delink',
                        dataType:'json',
                        data:{lid:id},
                        success:success

                    });

                    function success(data)
                    {   
                        var obj = JSON.parse(data);
                        if (obj['state']==1){
                            var oo = obj1.parentNode.parentNode;
                            oo.remove();
                            layer.alert("删除链接成功", {icon: 6});
                        }else{
                            layer.alert("删除链接失败", {icon: 2});
                        }
                    }
                })
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
                        url:'/admin/sys/delallink',
                        dataType:'json',
                        data:{all:id},
                        success:success1
                    });

                function success1(data){

                    var obj = JSON.parse(data);
                    if (obj['state']==1){
                        layer.alert("批量删除成功", {icon: 6},function(){
                            window.location.href = '/admin/sys/link';
                        });                       
                    }else{
                        layer.alert("批量删除失败", {icon: 2});
                    }
                }
                return false;
                    
                })
             }
        
            </script>
    </body>
</html>