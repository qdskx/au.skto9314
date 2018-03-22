<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:83:"/home/wwwroot/au.skxto9314.com/public/../application/index/view/index/usersong.html";i:1519783682;s:75:"/home/wwwroot/au.skxto9314.com/public/../application/index/view/header.html";i:1519800225;s:75:"/home/wwwroot/au.skxto9314.com/public/../application/index/view/footer.html";i:1519783681;}*/ ?>
<!DOCTYPE html>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="renderer" content="webkit">
<title>AU</title>
<link rel="stylesheet" href="/static/index/css/style.css">
<script type="text/javascript" src="/static/index/js/jquery.js"></script>
<script type="text/javascript" src="/static/index/js/common.js"></script>
<!-- <script type="text/javascript">var web_url="/";web_skin="/skin/qt_fb/";$(function() {$("#nav_news").addClass("current");});</script> -->
</head>
<body>

    <!--头部开始-->
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















    <!--头部结束-->

<div class="bg_box" style="min-height:700px;">
<div class="main" style="min-height:500px;">
<div class="news">
<div class="news_left">
    <!--<ul class="tag_nav_list">
    <li><a href="http://sqdemo.x5mp3.com/news/help/1.html">常见问题</a></li>
    <li><a href="http://sqdemo.x5mp3.com/news/yulebobao/1.html">娱乐播报</a></li>
    <li><a href="http://sqdemo.x5mp3.com/news/gonggao/1.html">网站公告</a></li>
    </ul>-->
<div class="ttitle"><h2><i></i>我的歌曲</h2></div>


<ul class="news-list">
    <?php if(!empty($data)): if(is_array($data) || $data instanceof \think\Collection): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
    <form action="/index/index/cancelsong" method="post" accept-charset="utf-8">


    <li>
        <input type="checkbox" name="id[]" value="<?php echo $val['sid']; ?>">
        <span class="index"></span>
        <span><a href="/index/index/songplay?sid=<?php echo $val['sid']; ?>" style="width:300px;display:block;"><?php echo $val['sname']; ?></a></span>
        <span><a   style="width:300px;display:block;margin-left:30px;"><?php echo $val['singer']; ?></a></span>
        <span class="misc-wrapper">
            <span class="misc-info">
            <span class="update-time"><a href="/index/index/cancelsong?sid=<?php echo $val['sid']; ?>">删除</a></span>
            </span>
        </span>
    </li>
    <?php endforeach; endif; else: echo "" ;endif; endif; if(!empty($data)): ?>
    <li>
        <input type="submit" name="del" value="删除选中" style="background-color: white;">
    </li>
    <?php endif; ?>
    </form>
 </ul>
</div>
</div>
</div>
</div>
<link href="/index/css/asynctips.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/index/js/asyncbox.js"></script>
<script type="text/javascript" src="/index/js/bottom.js"></script>
<!--尾部-->
    

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


</body>
</html>



