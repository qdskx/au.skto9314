<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:81:"/home/wwwroot/au.skxto9314.com/public/../application/index/view/index/mvlist.html";i:1519783681;s:75:"/home/wwwroot/au.skxto9314.com/public/../application/index/view/header.html";i:1519800225;s:75:"/home/wwwroot/au.skxto9314.com/public/../application/index/view/footer.html";i:1519783681;}*/ ?>
<!DOCTYPE html>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>音乐列表</title>
<link rel="stylesheet" href="/static/index/css/style.css">
<script type="text/javascript" src="/static/index/js/jquery.js"></script>
<script type="text/javascript" src="/static/index/js/common.js"></script>
<script type="text/javascript">
    var web_url="/";web_skin="/skin/qt_fb/";$(function() {$("img").lazyload({placeholder : "/skin/qt_fb/images/loading.gif",effect: "fadeIn"});$("#nav_malbum").addClass("current");});
</script>
</head>
<body>
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















<div class="bg_box">
<div class="main">
<div class="video">


<div class="record_list">
<div class="record_lable">
<dl>
<dt>所有</dt>
  <!--   <dd><a href="http://sqdemo.x5mp3.com/video/neidi/1.html">内地</a></dd>
    <dd><a href="http://sqdemo.x5mp3.com/video/gangtai/1.html">港台</a></dd>
    <dd><a href="http://sqdemo.x5mp3.com/video/oumei/1.html">欧美</a></dd>
    <dd><a href="http://sqdemo.x5mp3.com/video/dj/1.html">DJ现场</a></dd>
    <dd><a href="http://sqdemo.x5mp3.com/video/rihan/1.html">日韩</a></dd> -->
</dl>
</div>
</div>
<ul class="list">
<?php if(is_array($sel) || $sel instanceof \think\Collection): $i = 0; $__LIST__ = $sel;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
<li>
    <a target="video" href="/index/index/mvplay?vid=<?php echo $val['vid']; ?>">
        <img src="<?php echo $val['pic']; ?>" alt="" ><h5><?php echo $val['vname']; ?></h5><p><?php echo $val['vsinger']; ?></p>
    </a>
</li>
<?php endforeach; endif; else: echo "" ;endif; ?>

<!--
<li><a target="video" href="http://sqdemo.x5mp3.com/video/1209.html"><img src="%E8%A7%86%E9%A2%91%E5%BA%93_%E9%AB%98%E6%B8%85%E9%9F%B3%E4%B9%90MV%E8%A7%86%E9%A2%91_x5Music_files/-M-8624504ceb567ba85786f0dc38f0d7a1_240x135.jpg" alt="勇者没意见 - 子" original="//img1.c.yinyuetai.com/video/mv/180124/0/-M-8624504ceb567ba85786f0dc38f0d7a1_240x135.jpg"><h5>勇者没意见 - 子</h5><p>子</p></a></li> -->


</ul>
</div>
</div>
</div>
</body></html>
<!--占位的-->
<div class="bg_box" style="height:300px;">
</div>
<!--占位结束-->


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

<link href="/static/index/css/asynctips.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/static/index/js/asyncbox.js"></script>
<script type="text/javascript" src="/static/index/js/bottom.js"></script>



</body>
</html>