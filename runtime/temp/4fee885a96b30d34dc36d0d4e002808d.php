<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:83:"/home/wwwroot/au.skxto9314.com/public/../application/index/view/index/songplay.html";i:1519892088;s:75:"/home/wwwroot/au.skxto9314.com/public/../application/index/view/header.html";i:1519800225;}*/ ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Au音乐网</title>
  <link rel="stylesheet" type="text/css" href="/static/index/css/audio.css">

  <link rel="stylesheet" href="/static/index/css/style2.css">

  <link rel="stylesheet" type="text/css" href="/static/index/css/zaixian.css" />
<!-- <link rel="Shortcut Icon" href="images/favicon.ico" /> -->
<script type="text/javascript" src="/static/index/js/modernizr.js"></script>


</head>
<body style="height: 588px">
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
















  <div class="audio-box" style="z-index:20">
    <div class="audio-container">
      <div class="audio-cover"></div>
      <div class="audio-view">
        <h3 class="audio-title">123</h3>
        <div class="audio-body">
          <div class="audio-backs">
            <div class="audio-this-time">00:00</div>
            <div class="audio-count-time">00:00</div>
            <div class="audio-setbacks" style="height: 8px;">
              <i class="audio-this-setbacks">
                <span class="audio-backs-btn"></span>
              </i>
              <span class="audio-cache-setbacks">
              </span>
            </div>
          </div>
        </div>
        <div class="audio-btn">
          <div class="audio-select">
            <div class="audio-prev"></div>
            <div class="audio-play"></div>
            <div class="audio-next"></div>
            <div class="audio-menu"></div>
            <div class="audio-volume"></div>
          </div>
          <div class="audio-set-volume">
            <div class="volume-box">
              <i><span></span></i>
            </div>
          </div>
          <div class="audio-list">
            <div class="audio-list-head">
              <p>☺随心听</p>
              <span class="menu-close">关闭</span>
            </div>
            <ul class="audio-inline">
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

<div style="width:100%;background-color:#F6F6F6;">
    <div id="song" style="width:1182px;margin:0 auto;height:350px;background:;text-align:center;font-size:30px;color:;font-weight:bold;font-family:sans-serif;line-height:50px;margin-top:30px;">
          <div style="float:left;margin-left:px;">
            <img src="<?php echo $sel[0]['pic']; ?>" style="width:500px;height:300px;float:left;padding:20px;">
          </div>
          <br>
          <div style="background-color:;float:left;width:400px;padding-left: 35px;">
          <li style="width:500px;text-align:left;margin-left:60px;">歌曲：<a style="color:red"><?php echo $sel[0]['sname']; ?></a> <br></li>
          <li style="width:500px;text-align:left;margin-left:60px;">歌手：<a style="color:red"><?php echo $sel[0]['singer']; ?></a> <br></li>
          <li style="width:500px;text-align:left;margin-left:60px;"><a href="/index/index/collectsong?sid=<?php echo $sel[0]['sid']; ?>" style="color:black">收藏此单曲</a></li>
          </div>
            <!--分享开始-->
  <div style="width:px;margin:0 auto;margin-top:80px;margin-bottom:10px;float:left;margin-left:50px;">
<div class="bshare-custom icon-medium-plus"><a title="分享到" href="http://www.bShare.cn/" id="bshare-shareto" class="bshare-more">分享到</a><a title="分享到QQ空间" class="bshare-qzone"></a><a title="分享到新浪微博" class="bshare-sinaminiblog"></a><a title="分享到人人网" class="bshare-renren"></a><a title="分享到腾讯微博" class="bshare-qqmb"></a><a title="分享到网易微博" class="bshare-neteasemb"></a><a title="更多平台" class="bshare-more bshare-more-icon more-style-addthis"></a><span class="BSHARE_COUNT bshare-share-count">0</span></div><script type="text/javascript" charset="utf-8" src="http://static.bshare.cn/b/button.js#style=-1&amp;uuid=&amp;pophcol=2&amp;lang=zh"></script><a class="bshareDiv" onclick="javascript:return false;"></a><script type="text/javascript" charset="utf-8" src="http://static.bshare.cn/b/bshareC0.js"></script>
  </div>

  <!--分享结束-->
        </div>


    <!--在线首发 开始-->
    <div class="new_songs new_common">
        <!--标题 开始-->
        <div class="new_songs_title new_common_title">

        <span style="color:red">最新推荐</span>
        </div>
        <!--标题 结束-->
        <!--第1页-->
        <ul class="show">
        <?php if(is_array($hot) || $hot instanceof \think\Collection): $i = 0; $__LIST__ = $hot;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
            <li class="albumBox">
                <div class="album">
                    <p>
                        <a href="/index/index/songplay?sid=<?php echo $val['sid']; ?>">
                          <img width="220" height="220" src="<?php echo $val['pic']; ?>" class="attachment-220x220 wp-post-image"  />
                        <span><em><?php echo $val['sname']; ?></em><em><?php echo $val['singer']; ?></em><i></i></span>
                        </a>
                    </p>
                    <a href="/index/index/songplay?sid=<?php echo $val['sid']; ?>"><span>歌曲</span><strong><?php echo $val['sname']; ?></strong></a>
                    <a href="/index/index/songplay?sid=<?php echo $val['sid']; ?>"><span>试听</span><strong><?php echo $val['view_num']; ?><em></em></strong></a>
                </div>
            </li>
            <div class="url2" style="display:none" >
              <?php echo $val['sid']; ?>
            </div>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>

  </div><br>

    <!--在线首发 结束-->





 <div style="min-height:400px;width:100%;background-color:;margin:0 auto;padding:0px;">
    <?php if(is_array($sel) || $sel instanceof \think\Collection): $i = 0; $__LIST__ = $sel;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
    <div id="url" style="display: none;">
        <?php echo $val['url']; ?>
    </div>
    <div id="pic" style="display:none">
        <?php echo $val['pic']; ?>
    </div>
    <div id="name" style="display:none">
        <?php echo $val['sname']; ?>
    </div>
    <?php endforeach; endif; else: echo "" ;endif; ?>

    <!--评论留言开始-->
    <div  style="background-color:white;margin:10px auto;margin-bottom:0px;width:1182px;min-height:300px;background-color:white;border:1px solid #ccc">
    <p style="font-size:20px;font-family:STsong;text-indent: 30px;margin-top: 10px;">来给这首歌一个评论吧</p>
    <form method="post" action="/index/index/songpost?ctype=0&sid=<?php echo $sid; ?>">
    <div style="width:100%;background-color:;margin-top: 10px;">
      <span style="margin-left:10px;text-indent: 50px;"><img src="/static/index/image/hc2.jpg" width="70px;" style="border-radius: 80%;"></span>
      <textarea name="content" style="height:70px;width:73%;border:1px solid #D1605A;margin-left:20px;border-radius:5px;font-size:20px;">

      </textarea>
      <input type="submit" name="" style="width:100px;height:30px;background-color:#E85252;color:white;border-radius:10px;margin-left:163px;margin-top:16px;" value="评论">

    </div>
    </form>
    <p style="font-size:20px;font-family:STSong;text-indent: 30px;margin-top: 10px;">最新评论</p>


    <?php if(is_array($post) || $post instanceof \think\Collection): $i = 0; $__LIST__ = $post;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
    <div style="width:100%;background-color:;margin-top: 10px;min-height:100px;">
      <div style="margin-left:10px;float:left;width:65px;height:65px;">
        <img src="<?php echo $val['pic']; ?>" alt="加载失败" width="60px;" height="60px">
      </div>
      <div name="" style="height:40px;width:60%;border:1px solid #D1605A;margin-left:20px;margin-top:15px;border-radius: 5px;float:left;text-align:;line-height:40px;font-size:20px;"><?php echo $val['content']; ?>
      </div>
      <div style="float:left;width:100%;">
        &emsp;作者：<?php echo $val['username']; ?><span style="width:100px;"></span>发表于：<?php echo date("y-m-d h:i:s",$val['create_time']); ?>&emsp;&emsp;&emsp;
		<!-- <span><img src="/static/index/image/赞.png" width="30px;"><?php echo $val['likes']; ?></span> -->
		</div>
    </div>
    <?php endforeach; endif; else: echo "" ;endif; ?>

  </div> <!--评论留言结束-->

  </div>

<!--站位-->
<!-- <div style="width:100%;background-color:#F6F6F6;height:100px;">

</div> -->
<!--结束站位-->

<!--返回顶部-->
<link href="/static/index/css/asynctips.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/static/index/js/asyncbox.js"></script>
<script type="text/javascript" src="/static/index/js/bottom.js"></script>
<!--返回顶部结束-->


<script type="text/javascript" src="/static/index/js/jquery.min.js"></script>
<script type="text/javascript" src="/static/index/js/audio.js"></script>
<script type="text/javascript">
$(function(){
  var url = $('#url').html();
  var pic = $('#pic').html();
  var name = $('#name').html();

  var song = [
    {
      'cover' : pic,
      'src' : url,
      'title' :name
    },
    {
      'cover' : 'images/cover2.jpg',
      'src' : 'http://p3nictroy.bkt.clouddn.com/Wake.mp3',
      'title' : 'wake-邵凯旋'
    },
    {
      'cover' : 'images/cover5.jpg',
      'src' : 'http://p3nictroy.bkt.clouddn.com/%E5%91%A8%E7%AC%94%E7%95%85%20-%20%E6%9C%80%E7%BE%8E%E7%9A%84%E6%9C%9F%E5%BE%85.mp3',
      'title' : '最美的期待-周笔畅'
    },
    {
      'cover' : 'images/cover3.jpg',
      'src' : 'http://p3nictroy.bkt.clouddn.com/%E5%91%A8%E6%9D%B0%E4%BC%A6%20-%20%E7%94%9C%E7%94%9C%E7%9A%84.mp3',
      'title' : '甜甜的-周杰伦'
    },
    {
      'cover' : 'images/cover1.jpg',
      'src' : 'http://p3nictroy.bkt.clouddn.com/%E5%91%A8%E6%9D%B0%E4%BC%A6%20-%20%E6%99%B4%E5%A4%A9.mp3',
      'title' : '晴天 - 周杰伦'
    }
  ];

  var audioFn = audioPlay({
    song : song,
    autoPlay : true  //是否立即播放第一首，autoPlay为true且song为空，会alert文本提示并退出
  });

  /* 向歌单中添加新曲目，第二个参数true为新增后立即播放该曲目，false则不播放 */
  // audioFn.newSong({
  //   'cover' : 'images/cover4.jpg',
  //   'src' : 'http://p3fczj25n.bkt.clouddn.com/%E9%87%91%E7%8E%9F%E5%B2%90%20-%20%E5%B2%81%E6%9C%88%E7%A5%9E%E5%81%B7.mp3',
  //   'title' : '极乐净土 - GARNiDELiA'
  // },false);

  /* 暂停播放 */
  //audioFn.stopAudio();

  /* 开启播放 */
  //audioFn.playAudio();

  /* 选择歌单中索引为3的曲目(索引是从0开始的)，第二个参数true立即播放该曲目，false则不播放 */
  //audioFn.selectMenu(3,true);

  /* 查看歌单中的曲目 */
  //console.log(audioFn.song);

  /* 当前播放曲目的对象 */
  //console.log(audioFn.audio);
});
</script>



<script>

</script>
</body>
</html>