<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:84:"/home/wwwroot/au.skxto9314.com/public/../application/index/view/user/forgetpwd2.html";i:1519822234;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Author" contect="http://www.webqin.net">
<title>忘记密码</title>
<link rel="shortcut icon" href="images/favicon.ico" />
<link type="text/css" href="/static/index/css/css.css" rel="stylesheet" />
<!-- <script type="text/javascript" src="/static/index/js/jquery-1.8.3-min.js"></script> -->
<script type="text/javascript" src="/static/index/js/jquery-1.11.3.min.js"></script>
<script type="text/javascript">
 //导航定位
 $(function(){
	// $(".nav li:eq(2) a:first").addClass("navCur")
	 //验证手机 邮箱
	 $(".selyz").change(function(){
	   var selval=$(this).find("option:selected").val();
		 if(selval=="0"){
			 $(".sel-yzsj").show()
			 $(".sel-yzyx").hide()
			 }
		 else if(selval=="1"){
			 $(".sel-yzsj").hide()
			 $(".sel-yzyx").show()
			 }
		 })
	 })
</script>
</head>

<body>

  <div class="content">
   <div class="web-width">
     <div class="for-liucheng">
      <div class="liulist for-cur"></div>
      <div class="liulist for-cur"></div>
      <div class="liulist"></div>
      <div class="liulist"></div>
      <div class="liutextbox">
       <div class="liutext for-cur"><em>1</em><br /><strong>填写账户名</strong></div>
       <div class="liutext for-cur"><em>2</em><br /><strong>验证身份</strong></div>
       <div class="liutext"><em>3</em><br /><strong>设置新密码</strong></div>
       <div class="liutext"><em>4</em><br /><strong>完成</strong></div>
      </div>
     </div><!--for-liucheng/-->
     <form action="/index/user/doforgetPwd2" method="post" class="forget-pwd">
       <dl>

        <div class="clears"></div>
       </dl>
       <dl>
        <dt>用户名：</dt>
        <dd><input type="text" name="username"/></dd>
        <dd id="tname" style="margin-left:110px;font-size:15px;"></dd>
        <div class="clears"></div>
       </dl>
       <dl class="sel-yzyx">
        <dt>已验证邮箱：</dt>
        <dd><input type="text"  name="email"/></dd>
        <div class="clears"></div>
       </dl>
       <div class="subtijiao"><input type="submit" value="提交" /></div>
      </form><!--forget-pwd/-->
   </div><!--web-width/-->
  </div><!--content/-->

</body>
</html>
<script>
      $('[name=username]').blur(function(){
        var username = $('[name=username]').val();
        // console.log(username);
        $.ajax({
            type:'get',
            url:'/index/user/doforgetPwd2',
            data:{name:username},
            dataType:'json',
            success:success,
        });

    });
        function success(data)
        {
          console.log(data);
            if(data.state == 1){
                $('#tname').html('用户名合法').css({color:'green'});
            }else{
                $('#tname').html('用户名不存在').css({color:'red'});
            }
        }


</script>
