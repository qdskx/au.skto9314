<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:82:"/home/wwwroot/au.skxto9314.com/public/../application/admin/view/index/welcome.html";i:1519888422;}*/ ?>
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
            
        </style>
    </head>
    <body>
    
        <div id='reply' style="position:relative;width:1300px;height:400px;background:rgba(255,255,255,0.2)"> 

 

            <form action="/admin/index/dowelcome" method="post" style="position:absolute;top:150px;left:180px;">
                <input type="text" name="cont" style="border:1px solid #eaeaea;width:300px;height:45px;float:left;padding-left:5px;" placeholder="聊点什么呢" />
                <!-- <input type="submit" value="发送" style="width:80px;height:47px;border:none;float:left;background:#169386;color:#fff;" /> -->

                <button style="width:80px;height:47px;border:none;float:left;background:#169386;color:#fff;">发送</button>
            </form>


            
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
            function send()
            {
                var cont = $('[name=cont]').val();
                $.ajax({
                    type:'post',
                    url:'/admin/index/dowelcome',
                    data:{cont:cont},
                    dataType:'json',
                    success:success
                });

                function success(data)
                {
                    var obj = JSON.parse(data);

                    $('#reply').html('<img src="../../static/admin/images/singer1.jpg" alt="" style="position:absolute;top:10px;left:500px;width:50px;height:50px;border-radius:50%;"><p style="position:absolute;top:30px;left:460px;">'+obj['origin']+'</p><img src="../../static/admin/images/qq.jpg" alt="" style="position:absolute;top:60px;left:40px;width:50px;height:50px;border-radius:50%;"><p style="position:absolute;top:80px;left:100px;">'+obj['contentStr']+'</p>');
                }
            }
        </script>
    </body>
</html>