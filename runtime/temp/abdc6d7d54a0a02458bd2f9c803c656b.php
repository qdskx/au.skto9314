<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:80:"/home/wwwroot/au.skxto9314.com/public/../application/index/view/index/login.html";i:1519783681;}*/ ?>

<html>
<head>
	<title>登录注册</title>
	<link rel="stylesheet" href="/static/index/css/login.css">
	<link href="/static/index/css/popup-box.css" rel="stylesheet" type="text/css" media="all" />
	<!--第三方登录的js-->
	<script type="text/javascript" src="http://open.51094.com/user/myscript/15a726c37ede6a.html"></script>

		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="Sign In And Sign Up Forms  Widget Responsive, Login Form Web Template, Flat Pricing Tables, Flat Drop-Downs, Sign-Up Web Templates, Flat Web Templates, Login Sign-up Responsive Web Template, Smartphone Compatible Web Template, Free Web Designs for Nokia, Samsung, LG, Sony Ericsson, Motorola Web Design" />
		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

	<script src="/static/index/js/jquery2.min.js"></script>
	<script type="text/javascript" src="/static/index/js/jquery-1.11.3.min.js"></script>
<script src="/static/index/js/jquery.magnific-popup.js" type="text/javascript"></script>
<script type="text/javascript" src="/static/index/js/modernizr.custom.53451.js"></script>
 <script>
						$(document).ready(function() {
						$('.popup-with-zoom-anim').magnificPopup({
							type: 'inline',
							fixedContentPos: false,
							fixedBgPos: true,
							overflowY: 'auto',
							closeBtnInside: true,
							preloader: false,
							midClick: true,
							removalDelay: 300,
							mainClass: 'my-mfp-zoom-in'
						});

						});
</script>

</head>
<body>
	<h1>Au音乐网</h1>
	<div class="w3layouts">
		<div class="signin-agile">
			<h2>登录</h2>
			<form action="/index/user/dologin" method="post">
				<input type="text" name="username" class="name" placeholder="用户名" required="">
				<input type="password" name="password" class="password" placeholder="密码" required="">
				<ul>
					<li>
						<input type="checkbox" id="brand1" value="">
						<!-- <label for="brand1"><span></span>记住密码</label> -->
						<span id="hzy_fast_login"></span>
					</li>
				</ul>
				<a href="/index/user/forgetPwd2" style="font-size:15px">忘记密码?</a><br>
				<div class="clear"></div>

				<input type="submit" value="登录">
			</form>
		</div>
		<div class="signup-agileinfo">
			<h3>注册</h3>
			<!-- <p>表单在网页应用中十分重要，今天我要向大家分享一款基于HMLT5的分步骤注册表单，表单外观比较华丽，点击下一步按钮即可跳转到下一步填写注册信息。改HTML5表单使用了很多CSS3属性，从而在表单切换时拥有弹性的动画，是一款很不错的HTML5表单。</p> -->
			<div class="more">
				<a class="book popup-with-zoom-anim button-isi zoomIn animated" data-wow-delay=".5s" href="#small-dialog">点击注册</a>
			</div>
		</div>
		<div class="clear"></div>
	</div>
	<div class="footer-w3l">
		<p class="agileinfo"> <a href="http://www.mycodes.net/" target="_blank"></a>
 </p>
	</div>
	<div class="pop-up">
	<div id="small-dialog" class="mfp-hide book-form">
		<h3>注册表单 </h3>
			<form action="/index/user/doregister" method="post">
				<input type="text" name="username" placeholder="用户名" style="margin-bottom:8px"/>
				<p id="tname"></p>
				<input type="text" name="email" class="email" placeholder="邮箱" />
				<input type="password" name="password" class="password" placeholder="密码" >
				<input type="password" name="repass" class="password" placeholder="确认密码"/>
                <a href='javascript:;' style="color: #000;font-size:20px;"  id="getcode" onclick="getcode()">获取验证码</a>
                <input type="text" name="phone" id="phoneNumber" placeholder="请输入手机号" style="width:360px">
                <input type="password" name="yzm" class="password" placeholder="输入手机验证码" style="width:360px"/>
				<!-- <input type="password" name="yzm" class="password" placeholder="输入验证码" /> -->
				<input type="submit" value="点击注册">
			</form>
	</div>
</div>
<body>

<!--ajax传值-->
<script >
    //判断注册的用户名
    $('[name=username]').blur(function(){
        var username = $('[name=username]').val();
        // console.log(username);
        $.ajax({
            type:'post',
            url:'/index/user/doregister',
            data:{name:username},
            dataType:'json',
            success:success,
        });
    });
        function success(data)
        {
        	console.log(data);
            if(data.state == 1){
                $('#tname').html('用户名已存在').css({color:'red'});
            }else if(data.state == 2){
                $('#tname').html('用户名不能为空').css({color:'red'});
            }else{
                $('#tname').html('该用户名合法').css({color:'green'});
            }
        }
    // 获取短信验证码
    function getcode()
      { var phone = $('#phoneNumber').val();
        if(phone.length == 0){
            alert('手机号不能为空');
            return;
        }
        $('#getcode').text('60秒后重新获取');

        $('#getcode').removeAttr('onclick');

          //写个定时修改文本settime
        var time = 59;
        var into = setInterval(function(){

          $('#getcode').text(time+'秒后重新获取');
          time =time -1;
          if(time<=-1){
            clearInterval(into);
            $('#getcode').text('获取验证码');
            $('#getcode').attr('onclick');
          }
        },1000);
        //ajax    参数1,url  index1.php   参数2, 数据   1234565432
        $.get('/index/user/phonecode',{phone:phone},function(date){console.log(date);});
      }


</script>

</html>