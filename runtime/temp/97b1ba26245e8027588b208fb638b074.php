<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:88:"/home/wwwroot/au.skxto9314.com/public/../application/admin/view/permission/rolelist.html";i:1519888423;}*/ ?>
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
        <link href="../../static/admin/css/bootstrap.min.css" rel="stylesheet">
        <script src='../../static/admin/js/ajax.js'></script>
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
            
            <xblock><button class="layui-btn" onclick="add('添加用户','addrole','600','500')"><i class="layui-icon">&#xe608;</i>添加</button><span id='num' class="x-right" style="line-height:40px"></span></xblock>
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
                            角色名
                        </th>
                        <th>
                            描述
                        </th>
                        <th>
                            操作
                        </th>
                    </tr>
                </thead>




                <tbody id='tbody'>

                </tbody>


            </table>

            <div id="page" style="text-align: center">
                <a href="" class="AA" style="color:#F0F0F0;padding: 5px;">首页</a>
                <a href="" class="AA" style="color:#F0F0F0;padding: 5px;">上一页</a>
                <a href="" class="AA" style="color:#F0F0F0;padding: 5px;">下一页</a>
                <a href="" class="AA" style="color:#F0F0F0;padding: 5px;">尾页</a>
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

            var oTbody = document.getElementById('tbody');
            var aA = document.getElementsByClassName('AA');

            ajax({
                method:'get',
                url:'/admin/permission/dorolelist',
                async:true,
                data:{page:1},
                success:success

            });

            function success(data)
            {
                // console.log(data);




                //z这个data是啥玩意？是不是就是list.php得到的数据
                oTbody.innerHTML = '';
                //转化为js的对象
                var obj = JSON.parse(data);
                // console.log(obj);
                var num = document.getElementById('num');
                num.innerHTML = '共有数据：' + obj.num + '条';
                for (var i in obj.data) {
                    //创建tr
                    var oTr = document.createElement('tr');
                    //创建td
                    var oTd1 = document.createElement('td');
                    var oInput = document.createElement('input');
                    //创建td
                    var oTd2 = document.createElement('td');
                    var oTd3 = document.createElement('td');
                    var oTd4 = document.createElement('td');
                    var oTd5 = document.createElement('td');
                    var oA1 = document.createElement('a');
                    var oA2 = document.createElement('a');
                    var oI1 = document.createElement('i');
                    var oI2 = document.createElement('i');
                    // 给每个td赋值
                    oInput.value = obj.data[i].role_id;
                    oInput.type = 'checkbox';
                    oTd2.innerHTML = obj.data[i].role_id;
                    oTd3.innerHTML = obj.data[i].rname;
                    oTd4.innerHTML = obj.data[i].remark;
                    oTd5.className = 'td-manage';
                    oA1.title = '编辑';
                    oA1.href = '/admin/permission/editrole?role_id=' + obj.data[i].role_id;
                    oA1.className = 'ml-5';
                    oA1.style.textDecoration = 'none';
                    oI1.className = 'layui-icon';
                    oI1.innerHTML = '&#xe642;';

                    // oA1.href = 'javascript:;';
                    // oA1.onclick = "edit('添加用户','editrole?role_id=obj.data[i].role_id' ,'600','500')";

                    oA2.title = '删除';
                    oA2.href = 'javascript:;';

                    oA2.style.textDecoration = 'none';
                    oI2.className = 'layui-icon';
                    oI2.innerHTML = '&#xe640;';
                    //然后再将td放到tr里面 //
                    oTr.appendChild(oTd1);
                    oTr.appendChild(oTd2);
                    oTr.appendChild(oTd3);
                    oTr.appendChild(oTd4);
                    oTr.appendChild(oTd5);
                    oTd1.appendChild(oInput);
                    oTd5.appendChild(oA1);
                    oTd5.appendChild(oA2);
                    oA1.appendChild(oI1);
                    oA2.appendChild(oI2);
                    oTbody.appendChild(oTr);

                    oA2.onclick = function()
                    {
                        var oBtn = this.parentNode.parentNode;
                        oTbody.removeChild(oBtn);
                        role_del(this,oTd2.innerHTML);
                    }

                }
                //通过obj.allPage依次给上面每个a标签的href属性设置
                var oPage =  obj.allPage;
                var i = 0;
                for (var name in oPage) {
                    //console.log(name);
                    aA[i].href = 'javascript:test(\'' +oPage[name] +'\')';
                    i++;
                }
            }
            function test(url)
            {
                ajax({
                    method:'get',
                    url:url,
                    async:true,
                    data:null,
                    success:success
                });
            }
















            //批量删除提交
             function delAll () {
                // layer.confirm('确认要删除吗？',function(index){

                    var id = []; 
                    for(var i=0;i<$('input').size();i++){
                        if($('input').eq(i).is(':checked')){
                          id.push($('input').eq(i).val());
                        }
                        
                    }

                    $.ajax({

                        type:'get',
                        url:'/admin/permission/delall',
                        dataType:'json',
                        data:{all:id},
                        success:success1

                    });

                function success1(data){

                    var obj = JSON.parse(data);
                    if (obj['state']==1){
                        var oDel = obj.parentNode.parentNode;
                        oDel.remove();
                        layer.alert("批量删除角色成功", {icon: 6});
                    }else{
                        layer.alert("批量删除角色失败", {icon: 2});
                    }
                }
                return false;
                    
                // });
             }

             function add(title,url,w,h)
            {
                x_admin_show(title,url,w,h);
            } 
             

            /*删除*/
            function role_del(obj,id){
                // alert(id);
                // layer.confirm('确认要删除吗？',function(index){
                    
                        

                    $.ajax({

                        type:'get',
                        url:'/admin/permission/delrole',
                        dataType:'json',
                        data:{role_id:id},
                        success:success

                    });

                    function success(data)
                    {
                        var obj = JSON.parse(data);
                        if (obj['state']==1){
                           
                            layer.alert("删除角色成功", {icon: 6,time:2000});

                        }else{
                            layer.alert("删除角色失败", {icon: 2});
                        }
                    }
                // });
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