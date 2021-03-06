<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:79:"/home/wwwroot/au.skxto9314.com/public/../application/admin/view/user/login.html";i:1519888424;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> 登录</title>
    <style>
        *{margin: 0;padding: 0;list-style: none}
        body{overflow: hidden; }
        #bg_wrap{width: 100%;height: 100%;position: absolute;left: 0px;top: 0px;overflow: hidden;}
        #bg_wrap div{width: 100%;height: 100%;position: absolute;left: 0px;top: 0px;opacity: 0;transition:opacity 3s; }
        #bg_wrap div:nth-of-type(1){opacity: 1;}
        #Login{width: 272px;height: 300px;margin: 200px auto;}
        #Login .move{position: absolute;top: -100px;}
        #Login h3{font-size: 30px;font-weight: 700;color: #ffffff;font-family: 宋体;margin-bottom: 30px;cursor: move;}
        #Login input.txt{width: 270px;height: 42px;color: #ffffff;background: rgba(45,45,45,.15);
                            border-radius: 6px;border: 1px solid rgba(255,255,255,.15);box-shadow: 0 2px 3px 0 rgba(0,0,0,.1) inset;
                             -webkit-box-shadow: 0 2px 3px 0 rgba(0,0,0,.1) inset;-moz-box-shadow:  0 2px 3px 0 rgba(0,0,0,.1) inset;
                            margin-bottom: 25px;text-shadow: 0 1px 2px rgba(0,0,0,.1);text-indent: 10px;}
        #Login input.but{background: #ef4300;width: 272px;height: 44px;box-shadow: 0 15px 30px 0 rgba(255,255,255,.25)inset,
                             0 2px 7px 0 rgba(0,0,0,.2);-webkit-box-shadow: 0 15px 30px 0 rgba(255,255,255,.25)inset, 0 2px 7px 0 rgba(0,0,0,.2);
        -moz-box-shadow:  0 15px 30px 0 rgba(255,255,255,.25)inset, 0 2px 7px 0 rgba(0,0,0,.2); border: 0px;border-radius: 6px;
                            color: #ffffff;font-size: 14px;}
        #Login input:focus{outline: none;-webkit-box-shadow: 0 2px 3px 0 rgba(0,0,0,.1)inset,0 2px 7px 0 rgba(0,0,0,.2);
                            -moz-box-shadow: 0 2px 3px 0 rgba(0,0,0,.1)inset,0 2px 7px 0 rgba(0,0,0,.2);
                            box-shadow:  0 2px 3px 0 rgba(0,0,0,.1)inset,0 2px 7px 0 rgba(0,0,0,.2); }
        input::-webkit-input-placeholder{color: #ffffff;}
        #title{width: 272px;text-align: center;}
    </style>
</head>
<body>
<div id="bg_wrap">
    <div><img src="../../static/admin/images/1.jpg" alt=""width="100%"height="100%"/></div>
    <div><img src="../../static/admin/images/2.jpg" alt=""width="100%"height="100%"/></div>
    <div><img src="../../static/admin/images/3.jpg" alt=""width="100%"height="100%"/></div>
</div>
<div id="Login">
    <h3  id="title" class="move">Administer Login</h3>
    <form action="/admin/user/dologin" method="post">
        <input  type="text" placeholder="Username"class="txt move" name="username"autocomplete="off" required />
        <input   type="password" placeholder="Password" class="txt move" name="password"/>
        <input  type="submit" class="but move" id="submit"value="Sign in"/>
        <!-- <button style="border:1px solid #eaeaea;width: 200px;height: 50px;background: orange;" id="submit">登录</button> -->
        <!-- <button type="submit">sign in</button> -->

        <!-- kkkkkkkkkkk -->
    </form>
</div>
<script>
    //背景轮播
    (function(){
        var timer=null;
        oImg=document.querySelectorAll('#bg_wrap div');
        var len=oImg.length;
        var index=0;
        timer=setInterval(function () {
            oImg[index].style.opacity=0;
            index++;
            index%=len;
            oImg[index].style.opacity=1;
        },5000)
    })();
    
    //弹跳
    (function () {
       var oMove=document.querySelectorAll('.move');
        var len=oMove.length;
        var timer=null;
        var timeout=null;
        var speed=3;
        move(len-1);
        function move(index){
            if(index<0){
                clearInterval(timer);
                clearTimeout(timeout);
                return;
            }
            var end=150+(index*60);
            timer=setInterval(function(){
                speed+=3;
                var T=oMove[index].offsetTop+speed;
                if(T>end){
                    T=end;
                    speed*=-1;
                    speed*=0.4;
                }
                oMove[index].style.top=T+'px';
            },20);
            timeout=setTimeout(function () {
                clearInterval(timer);
                index--;
                move(index);
            },900);
        }

    })()
</script>

<script>
    
</script>
</body>
</html>