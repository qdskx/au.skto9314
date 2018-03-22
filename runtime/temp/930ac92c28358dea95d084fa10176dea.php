<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:85:"/home/wwwroot/au.skxto9314.com/public/../application/index/view/index/singerinfo.html";i:1519865041;s:75:"/home/wwwroot/au.skxto9314.com/public/../application/index/view/header.html";i:1519800225;s:75:"/home/wwwroot/au.skxto9314.com/public/../application/index/view/footer.html";i:1519783681;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta charset="gb2312">
	<meta name="renderer" content="webkit">
	<title>歌手信息</title>
	<link rel="stylesheet" href="/static/index/css/style.css">
	<script type="text/javascript" src="/static/index/js/jquery.js"></script>
	<script type="text/javascript" src="/static/index/js/common.js"></script>
	<script type="text/javascript">
	  var web_url="/";web_skin="/skin/qt_fb/";$(function() {$("img").lazyload({placeholder : "/skin/qt_fb/images/loading.gif",effect: "fadeIn"});$("#nav_artist").addClass("current");});
	function hideText(e,conLen,str1,str2){textBox=document.getElementById(e);if(""==conText){conText=textBox.innerHTML}if(navigator.appName.indexOf("Explorer")>-1){if(textBox.innerText.length<conLen){return}textBox.innerHTML=textBox.innerText.substr(0,conLen)}else{if(textBox.textContent.length<conLen){return}textBox.innerHTML=textBox.textContent.substr(0,conLen)}textBox.innerHTML+='.....</div><div style="float:right;margin-top:15px;"><a class="singerintro" href="javascript:;" onclick="showText(\''+e+"','"+conLen+"', '"+str1+"', '"+str2+'\');return false" target="_self">'+str1+"</a></div><br>"}function showText(e,conLen,str1,str2){textBox=document.getElementById(e);textBox.innerHTML=conText+'</div><div style="float:right;margin-top:15px;"><a class="singerintro" href="javascript:;" onclick="hideText(\''+e+"', '"+conLen+"', '"+str1+"', '"+str2+'\');return false" target="_self">'+str2+"</a></div><br>"};
	  </script>
	<script src="/static/index/js/share.js"></script>
	<link rel="stylesheet" href="/static/index/css/share_style0_32.css">
</head>

﻿



	<script type="text/javascript" src="/static/index/js/jquery.js"></script>
	<script type="text/javascript" src="/static/index/js/common.js"></script>

	<div class="header">
  <div class="logo_nav">
  <h1 class="logo"><a href="/index/index/index"><img src="/static/index/image/qw.png" original="/skin/qt_fb/images/logo.png" height="33"></a></h1>
  <dl class="nav">
    <dt><a href="/index/index/index">首页</a><span id="nav_index"></span></dt>
    <dt><a href="/index/index/songlist">乐库</a><span id="nav_play"></span></dt>
    <dt><a href="/index/index/songsheet">歌单</a><span id="nav_malbum" class="current"></span></dt>
    <dt><a href="/index/index/mvlist">MV</a><span id="nav_video"></span></dt>
    <dt><a href="/index/index/singerlist">歌手</a><span id="nav_artist"></span></dt>
    <?php if(!empty(\think\Session::get('username'))): ?>
    <dt><a  href="/codepay/index.php?user=<?php echo $uid; ?>">开通红钻会员</a><span id="nav_news"></span></dt>
    <?php endif; ?>
  </dl>
   <div class="login">
    <ul>
      <?php if((\think\Session::get('username') == null)): ?>
      <li style="margin-right: 15px;"><a href="/index/user/login" >登录</a></li>
      <li><a href="/index/user/login">注册</a></li>
      <?php else: ?>
      <li style="margin-right: 5px;"><a href="/index/index/userinfo"><img src="<?php echo $result[0]['pic']; ?>" width="45px;" height="45px"></a></li>
      <li style="margin-right:;overflow:hidden;width:60px;"><a><?php echo \think\Session::get('username'); ?></a></li>
        <?php if(($result[0]['isred'] == 0)): if(($result[0]['type'] == 2)): ?>
        <li><a>普通[QQ]</a></li>
              <?php elseif(($result[0]['type'] == 3)): ?>
        <li><a>普通[微博]</a></li>
              <?php elseif(($result[0]['type'] == 1)): ?>
        <li><a>普通[Au]</a></li>
              <?php endif; else: if(($result[0]['type'] == 2)): ?>
        <li><a style="color:yellow">红钻[QQ]</a></li>
              <?php elseif(($result[0]['type'] == 3)): ?>
        <li><a style="color:yellow">红钻[微博]</a></li>
              <?php elseif(($result[0]['type'] == 1)): ?>
        <li><a style="color:yellow">红钻[Au]</a></li>
              <?php endif; endif; ?>
      <li><a href="/index/user/loginout">退出</a></li>
      <?php endif; ?>


    </ul>
  </div>
  </div>
</div>

<div class="nav_list">
  <ul class="nav_l" style="margin-left:100px;">
    <?php if(\think\Session::get('username') !== null): ?>
    <li><a href="/index/index/userinfo">个人资料</a></li>
    <li><a href="/index/index/usersheet">我的歌单</a></li>
    <li><a href="/index/index/usersong">我的歌曲</a></li>
    <li><a href="/index/index/seachres">搜索</a></li>
    <?php else: ?>
    <li style="width:320px;"><marquee behavior="alternate">登录查看更多内容哦~~~~</marquee></li>
    <?php endif; ?>
    <!-- <li><a href="index/index/songlist">自定义菜单</a></li> -->
    <!-- <li><a href="index/index/songlist" id="nav_valbum">MV专辑</a></li> -->
    <!-- <li><a href="index/index/songlistr">会员中心</a></li> -->
  </ul>

</div>

    <link rel="stylesheet" type="text/css" href="/static/index/css/xcConfirm.css"/>
    <script src="/static/index/js/jquery-1.9.1.js" type="text/javascript" charset="utf-8"></script>
    <script src="/static/index/js/xcConfirm.js" type="text/javascript" charset="utf-8"></script>
    <style type="text/css">
      .sgBtn{width: 135px; height: 35px; line-height: 35px; margin-left: 10px; margin-top: 10px; text-align: center; background-color: #0095D9; color: #FFFFFF; float: left; border-radius: 5px;}
    </style>
    <script type="text/javascript">
      $(function(){

        $("#vip").click(function(){
          var txt=  "请确认是否花费100RMB开通红钻会员";
          var option = {
            title: "您即开通本站会员业务",
            btn: parseInt("0011",2),
            onOk: function(){
              // console.log("确认啦");
                $.ajax({
                  method:'get',
                  url:'/index/index/vip',
                  async:true,
                  data:{page:1},
                  success:success,
                });
            }
          }
          function success(data)
          {
            console.log(data);
            var obj = JSON.parse(data);
            console.log(obj);
            if(obj.status==1){
              window.location.reload();
              alert('开通成功');
            }else{
              alert('开通失败');

            }
          }
          window.wxc.xcConfirm(txt, "custom", option);
        });

      });
    </script>
</html>
















<?php if(is_array($singer) || $singer instanceof \think\Collection): $i = 0; $__LIST__ = $singer;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
<div class="bg_box">
	<div class="main">
	<div class="singer">
	<div class="singer-pic">
	<img src="<?php echo $val['pic']; ?>"  width="200" height="200">
	</div>
	<div class="singer-info">
	<div class="title">
	<h1><a><?php echo $val['singer_name']; ?></a></h1>
	</div>
	<div class="scrollbar2">
	<ul>
	<li>姓名：<?php echo $val['singer_name']; ?></li>
	<li>国籍： 中国</li>
	<li>语言： 国语</li>
	<li>出生地： <?php echo $val['province']; ?></li>
	<li>更新时间：2017-06-04</li>
	</ul>
	</div>

	</div>
	<div class="word">
	<div class="title">
	<h2>个人资料</h2>
	</div>
	<div id="cText">
		<?php echo $val['intro']; ?>
		<div style="float:right;margin-top:15px;"><a class="singerintro" href="javascript:;" onclick="showText('cText','300', '[详细资料+]', '[收回-]');return false" target="_self">[详细资料+]</a></div><br>
	</div>
	<script language="javascript"> var conText = ""; hideText("cText", 300, "[详细资料+]", "[收回-]"); </script>
	</div>
	</div>


	</div>
	</div>


</div>
</div>
<?php endforeach; endif; else: echo "" ;endif; ?>


<link href="css/asynctips.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/asyncbox.js"></script>
<script type="text/javascript" src="js/bottom.js"></script>

<!--尾部开始-->


    <div class="footer">
    <p class="p1">
    <span><a href="http://au.skxto9314.com" target="mobile"><img src="/static/index/image/footer1.png">手机版</a> </span>
    <span><img src="/static/index/image/footer2.png">联系电话：184-3515-4504</span>
    <span><img src="/static/index/image/footer3.png">联系QQ：895770532</span>
    </p>
    <p class="p2">友情链接 </p>
    <p class="p3">Au音乐网  &#169;&emsp;晋ICP备18000657号-1


    </div>






<!--尾部结束-->

