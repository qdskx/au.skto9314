<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:80:"/home/wwwroot/au.skxto9314.com/public/../application/index/view/index/index.html";i:1519882222;s:75:"/home/wwwroot/au.skxto9314.com/public/../application/index/view/header.html";i:1519800225;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Au音乐网</title>
  <link rel="icon" href="favicons/1.png">
  <link rel="stylesheet" href="/static/index/css/style2.css">
  <link rel="stylesheet" href="/static/index/css/reset.css">
  <link rel="stylesheet" href="/static/index/css/index.css">
  <link rel="stylesheet" type="text/css" href="/static/index/css/style3.css" />


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
<script type="text/javascript" src="/static/index/js2/jquery2.js"></script>
<script type="text/javascript" src="/static/index/js2/index2.js"></script>
 <!--轮播图 开始 -->
    <div class="main_banner" style="margin-top:5px;margin-bottom:30px;background-color: #eee">
        <div class="main_banner_bg"></div>
        <div class="main_banner_wrap">
      <canvas id="myCanvas" width="150" height="150" style="display:none"></canvas>
            <div class="main_banner_box" id="m_box">
                <a href="javascript:void(0)" class="banner_btn js_pre">
                    <span class="banner_btn_arrow"><i></i></span>
                </a>
                <a href="javascript:void(0)" class="banner_btn btn_next js_next">
                    <span class="banner_btn_arrow"><i></i></span>
                </a>
                <!--五个图片-->
                <ul>
                    <li id="imgCard0">
                        <a href="<?php echo $lun[0]['url']; ?>"><span style="opacity:0;"></span></a>
                        <img src="<?php echo $lun[0]['pic']; ?>" alt="">
                        <p style="bottom:0"><?php echo $lun[0]['intro']; ?></p>
                    </li>
                    <li id="imgCard1">
                        <a href="<?php echo $lun[1]['url']; ?>"><span style="opacity:0.4;"></span></a>
                        <img src="<?php echo $lun[1]['pic']; ?>" alt="">
                        <p><?php echo $lun[1]['intro']; ?></p>
                    </li>
                    <li id="imgCard2">
                        <a href="<?php echo $lun[2]['url']; ?>"><span style="opacity:0.4;" ></span></a>
                        <img src="<?php echo $lun[2]['pic']; ?>" alt="">
                        <p><?php echo $lun[2]['intro']; ?></p>
                    </li>
                    <li id="imgCard3">
                        <a href="<?php echo $lun[3]['url']; ?>"><span style="opacity:0.4;"></span></a>
                        <img src="<?php echo $lun[3]['pic']; ?>" alt="">
                        <p><?php echo $lun[3]['intro']; ?></p>
                    </li>
                    <li id="imgCard4">
                        <a href="<?php echo $lun[4]['url']; ?>"><span style="opacity:0.4;"></span></a>
                        <img src="<?php echo $lun[4]['pic']; ?>" alt="">
                        <p><?php echo $lun[4]['intro']; ?></p>
                    </li>
                </ul>
                <!--火狐倒影图层-->
                <p id="rflt"></p>
                <!--火狐倒影图层-->
            </div>
            <!--序列号按钮-->
            <div class="btn_list">
                <span class="curr"></span><span></span><span></span><span></span><span></span>
            </div>
        </div>
    </div>
    <!--轮播图 结束 -->
  <!--轮播图结束-->

  <!-- 排行榜 -->
  <div class="main" id="rank">
    <div class="main-inner">
      <div class="main-title">
        <!-- <h2 class="title"><i style="font-size:50px">排行榜</i></h2> -->
        <h2 class="title" style="font-size:50px" >排行榜</h2>
        <span class="line line-left"></span>
        <span class="line line-right"></span>
      </div>
      <a href="#" class="readAll" style="color:black"><i ></i></a>
      <ul class="rank-list">

        <li class="rank-list__item rank-list__1">
          <span class="rank-bg" style="background:url(<?php echo $song1pic['cover']; ?>);"></span>
          <span class="mask"></span>
          <a href="/index/index/songlist2?id=1"><i class="icon-play"></i></a>

          <div class="title">
            <i></i>
            <h3 style="color:#e85252">流行歌曲</h3>
          </div>
          <i class="line"></i>
          <ul class="song-list">
            <?php if(is_array($song1) || $song1 instanceof \think\Collection): $i = 0; $__LIST__ = $song1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
            <li class="song-list__item">
              <a href="/index/index/songplay?sid=<?php echo $val['sid']; ?>" style="font-size:20px;"><span></span><?php echo $val['sname']; ?></a>
              <span><?php echo $val['singer']; ?></span>
              <?php endforeach; endif; else: echo "" ;endif; ?>
            </li>
          </ul>
        </li>

        <li class="rank-list__item rank-list__1">
          <span class="rank-bg" style="background:url(<?php echo $song2pic['cover']; ?>);"></span>
          <span class="mask"></span>
          <a href="/index/index/songlist2?id=2"><i class="icon-play"></i></a>

          <div class="title">
            <i></i>
            <h3 style="color:#e85252">治愈歌曲</h3>
          </div>
          <i class="line"></i>
          <ul class="song-list">
            <?php if(is_array($song2) || $song2 instanceof \think\Collection): $i = 0; $__LIST__ = $song2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
            <li class="song-list__item" >
              <a href="/index/index/songplay?sid=<?php echo $val['sid']; ?>" style="font-size:20px;"><span></span><?php echo $val['sname']; ?></a>
              <span><?php echo $val['singer']; ?></span>
            </li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
          </ul>
        </li>

        <li class="rank-list__item rank-list__1">
          <span class="rank-bg" style="background:url(<?php echo $song3pic['cover']; ?>);"></span>
          <span class="mask"></span>
          <a href="/index/index/songlist2?id=3"><i class="icon-play"></i></a>

          <div class="title">
            <i></i>
            <h3 style="color:#e85252">粤语歌曲</h3>
          </div>
          <i class="line"></i>
          <ul class="song-list">
            <?php if(is_array($song3) || $song3 instanceof \think\Collection): $i = 0; $__LIST__ = $song3;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
            <li class="song-list__item">
              <a href="/index/index/songplay?sid=<?php echo $val['sid']; ?>" style="font-size:20px;"><span></span><?php echo $val['sname']; ?></a>
              <span><?php echo $val['singer']; ?></span>
            </li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
          </ul>
        </li>

        <li class="rank-list__item rank-list__1">
          <span class="rank-bg" style="background:url(<?php echo $song4pic['cover']; ?>);"></span>
          <span class="mask"></span>
          <a href="/index/index/songlist2?id=4"><i class="icon-play"></i></a>

          <div class="title">
            <i></i>
            <h3 style="color:#e85252">电音歌曲</h3>
          </div>
          <i class="line"></i>
          <ul class="song-list">
          <?php if(is_array($song4) || $song4 instanceof \think\Collection): $i = 0; $__LIST__ = $song4;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
            <li class="song-list__item">
              <a href="/index/index/songplay?sid=<?php echo $val['sid']; ?>" style="font-size:20px;"><span></span><?php echo $val['sname']; ?></a>
              <span><?php echo $val['singer']; ?></span>
            </li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
          </ul>
        </li>

          </ul>
        </li>
      </ul>
    </div>
  </div>

  <!-- 热门歌单 -->
  <div class="main" id="hotSong">
    <div class="main-inner">
      <div class="main-title">
        <h2 class="title"><i></i></h2>
        <span class="line line-left"></span>
        <span class="line line-right"></span>
      </div>
      <div class="main-slider">
        <ul class="slider-wrapper">
        <?php if(is_array($hotsheet) || $hotsheet instanceof \think\Collection): $i = 0; $__LIST__ = $hotsheet;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
          <li>
            <a href="/index/index/playlist?pid=<?php echo $val['pid']; ?>" class="img">
              <!-- <img src="images/cont/slider_img1.jpg" alt="#"> -->
              <img src="<?php echo $val['pic']; ?>" style="min-height:300px">
              <span class="mask"></span>
              <i class="icon-play"></i>
            </a>
            <div class="info">
              <div class="title">
                <!-- <a href="#">那个静默的阳光午后</a> -->
                <a href="/index/index/playlist?pid=<?php echo $val['pid']; ?>"><?php echo $val['pname']; ?></a>
                <i class="icon-sprite"></i>
              </div>
              <a href="/index/index/playlist?pid=<?php echo $val['pid']; ?>" class="author">点击量：<?php echo $val['view_num']; ?></a>
            </div>
          </li>
          <?php endforeach; endif; else: echo "" ;endif; ?>


        </ul>
        <!-- <div class="slider-btns"> -->
          <!-- <span class="cur"><i></i></span> -->
          <!-- <span><i></i></span> -->
          <!-- <span><i></i></span> -->
        <!-- </div> -->
      </div>
    </div>
    <div class="main-operate">
      <!-- <a href="javascript:;" class="slider-prev"><i class="icon-sprite"></i></a> -->
      <!-- <a href="javascript:;" class="slider-next"><i class="icon-sprite"></i></a> -->
    </div>
  </div>


  <!-- MV -->
  <div class="main" id="mv">
    <div class="main-inner">
      <div class="main-title">
        <h2 class="title"><i></i></h2>
        <span class="line line-left"></span>
        <span class="line line-right"></span>
      </div>
      <!-- <a href="#" class="readAll" style="color:black;"> -->
      <!-- 全部<i class="icon-sprite"></i></a> -->

      <ul class="mv-list tab-cont">
        <?php if(is_array($hotmv) || $hotmv instanceof \think\Collection): $i = 0; $__LIST__ = $hotmv;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
        <li class="item">
          <a href="/index/index/mvplay?vid=<?php echo $val['vid']; ?>" class="img"><img src="<?php echo $val['pic']; ?>" alt="#"><i class="icon-play"></i></a>
          <div class="info">
            <a href="/index/index/mvplay?vid=<?php echo $val['vid']; ?>" class="title"><?php echo $val['vname']; ?></a>
            <a href="/index/index/mvplay?vid=<?php echo $val['vid']; ?>" class="author"><?php echo $val['vsinger']; ?></a>
            <span class="play-total"><i class="icon-sprite"></i><?php echo $val['view_num']; ?></span>
          </div>
        </li>
        <?php endforeach; endif; else: echo "" ;endif; ?>
      </ul>
    </div>
  </div>





<!--尾部-->
    <div class="footer">
    <p class="p1">
    <span><a href="#" target="mobile"><img src="/static/index/image/footer1.png">邵凯旋 & 景松旺</a> </span>
    <span><img src="/static/index/image/footer2.png">联系电话：184-3515-4504</span>
    <span><img src="/static/index/image/footer3.png">联系QQ：895770532</span>
    </p>
    <p class="p2">友情链接 &emsp;
    <?php if(!empty($link)): if(is_array($link) || $link instanceof \think\Collection): $i = 0; $__LIST__ = $link;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
      <a href="<?php echo $val['url']; ?>" style="display:inline-block"><?php echo $val['name']; ?></a>
    <?php endforeach; endif; else: echo "" ;endif; endif; ?>

    </p>
    <p class="p3">Au音乐网  &#169;&emsp;晋ICP备18000657号-1
    </p>
    </div>
<!--尾部结束-->

  <link href="/static/index/css/asynctips.css" rel="stylesheet" type="text/css">
  <script type="text/javascript" src="/static/index/js/asyncbox.js"></script>
  <script type="text/javascript" src="/static/index/js/bottom.js"></script>


</body>
</html>



