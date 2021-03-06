<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:80:"/home/wwwroot/au.skxto9314.com/public/../application/admin/view/sys/webinfo.html";i:1519888424;}*/ ?>
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
    

         <link rel="stylesheet" type="text/css" href="../../static/admin/css/service.css">
         <script type="text/javascript" src="../../static/admin/js/jquery-1.4.4.min.js"></script>
        <script type="text/javascript" src="../../static/admin/js/jquery.fixed.1.5.1.js"></script>
        
        <script language="javascript" type="text/javascript">
            //must window loading,don't use the document loading
            jQuery.noConflict();  
            jQuery(window).load(function(){
                
                //悬浮客服
                $("#fixedBox").fix({
                    position        : "right",  //悬浮位置 - left或right
                    horizontal      : 0,        //水平方向的位置 - 默认为数字
                    vertical        : 100,      //垂直方向的位置 - 默认为null
                    halfTop         : true,     //是否垂直居中位置
                    minStatue       : false,    //是否最小化
                    hideCloseBtn    : false,    //是否隐藏关闭按钮
                    skin            : "blue",   //皮肤
                    showBtnWidth    : 28,       //show_btn_width
                    contentBoxWidth : 154,      //side_content_width
                    durationTime    : 1000      //完成时间
                });
                
            });
        </script>
    </head>
    <body>
        <div class="x-body">
            <table class="layui-table" style="background: rgba(255,255,255,0.2);">
                <thead>
                    <tr>
                        <th colspan="2" scope="col">服务器信息</th>
                    </tr>
                </thead>
                <tbody id='tbody'>
                    <tr>
                        <th width="30%">网站地址</th>
                        <td><span id="lbServerName"><?php echo $url; ?></span></td>
                    </tr>
                    <tr>
                        <td>网站名称</td>
                        <td><?php echo $name; ?></td>
                    </tr>
                    <tr>
                        <td>备案号 </td>
                        <td><?php echo $icp; ?></td>
                    </tr>
                    <tr>
                        <td>站点状态</td>
                        <td>
                        <form action="/admin/sys/update" method="post" >
                        <input type="radio" name='close' id='open' value="2" <?php if($isclose==2): ?>checked<?php endif; ?>>
                        <label for="open">开启</label>
                        <input type="radio" name='close' value="1" id='off' <?php if($isclose==1): ?>checked<?php endif; ?>>
                        <label for="off">关闭</label>
                        <button >提交</button>
                        </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="layui-footer footer footer-demo">
            <div class="layui-main">
                <!-- <p>感谢layui,百度Echarts,jquery</p>
                <p>
                    <a href="/">
                        Copyright ©2017 x-admin v2.3 All Rights Reserved.
                    </a>
                </p>
                <p>
                    <a href="./" target="_blank">
                        本后台系统由X前端框架提供前端技术支持
                    </a>
                </p> -->
                <!-- /*<div style="float:right;margin-top:-100px;">*/ -->
                    <!-- S 客服 -->uuuuuuu
                    <div class="fixed_box" id="fixedBox">
                        <div class="content_box">
                            <div class="content_inner">
                                <div class="close_btn"><a title="关闭"><span>关闭</span></a></div>
                                <div class="content_title"><span>客服中心</span></div>
                                <div class="content_list">              
                                    <div class="qqserver">
                                        <p>                              
                                            <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=2608153909&site=qq&menu=yes">
                                              <img border="0" src="http://wpa.qq.com/pa?p=2:2608153909:41" alt="点击这里给我发消息" title="点击这里给我发消息">
                                              <span>雨不停雨</span>
                                            </a>
                                        </p>             
                                    </div>               
                                    <hr>
                                    <div class="phoneserver">
                                        <h5>客户服务热线</h5>
                                        <p>请直接QQ联系！</p>
                                    </div>
                                    <hr>
                                    <div class="msgserver">
                                        <p><a href="#">给我们留言</a></p>
                                    </div>
                                </div>
                                <div class="content_bottom"></div>
                            </div>
                        </div>
                        <div class="show_btn"><span>展开客服</span></div>
                    </div>
                    <!-- E 客服 -->
                <!-- </div> -->
            </div>
        </div>


        
        <script src="../../static/admin/lib/layui/layui.js" charset="utf-8"></script>
        <script src="../../static/admin/js/x-admin.js"></script>
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
        function btn()
        {
                var status = $('[name=close]').val();
                alert(status);

                $.ajax({
                                type:'get',
                                url:'/admin/sys/update',
                                dataType:'json',
                                data:{status:status},
                                success:success
                });

                alert(status);

                function success(data)
                {   
                    var obj = JSON.parse(data);

                    if(!obj['state'])
                    {
                        alert('站点修改失败');
                    }
                }            
        }


        </script>
    </body>
</html>