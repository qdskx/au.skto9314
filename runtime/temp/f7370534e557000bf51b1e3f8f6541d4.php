<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:83:"/home/wwwroot/au.skxto9314.com/public/../application/index/view/index/playlist.html";i:1519892457;s:75:"/home/wwwroot/au.skxto9314.com/public/../application/index/view/header.html";i:1519800225;s:75:"/home/wwwroot/au.skxto9314.com/public/../application/index/view/footer.html";i:1519783681;}*/ ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>歌单推荐</title>
<link rel="stylesheet" href="/static/index/css/style.css">

 <link rel="stylesheet" href="/static/mplayer/css/mplayer.css">


</head>

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

<body>
<div class="bg_box">
<div class="main">
<div class="malbum">
    <?php if(is_array($sel) || $sel instanceof \think\Collection): $i = 0; $__LIST__ = $sel;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
    <div class="data_cover"> <img src="<?php echo $val['pic']; ?>" alt=""></div>
    <div class="data_cont"><h1><?php echo $val['pname']; ?></h1></div>
    <div class="data_user"><a >&emsp;</a></div>
    <div class="data_info">
        <p>所属分类：<?php echo $type; ?></p>
        <p>歌单热度：<?php echo $val['view_num']; ?></p>
        <p>发行公司：</p>
        <p>歌曲风格：运动</p>
        <p>发布时间：<?php echo date('Y-m-d',$val['create_time']); ?></p>
    </div>


<div class="data_actions">
<a href="/index/index/collectlist?pid=<?php echo $val['pid']; ?>" class="play">收藏此歌单</a>
    <?php endforeach; endif; else: echo "" ;endif; ?>
<div class="bdsharebuttonbox bdshare-button-style1-32" data-bd-bind="1517485084064">
    <a href="#" class="bds_more" data-cmd="more"></a>
    <a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a>
    <a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a>
    <a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a>
    <a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a>
    <a href="#" class="bds_sqq" data-cmd="sqq" title="分享到QQ好友"></a>
    <a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a>
</div>
<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"1","bdSize":"32"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new
 Date()/36e5)];</script>
</div>


<div class="data_layout">
<div class="data_layout_main x5_player">
<ul class="songlist_header">
    <li class="songlist_header_name">　　歌曲</li>
    <li class="songlist_header_author">歌手</li>
    <li class="songlist_artist">热度</li>
</ul>
<?php if(!empty($data)): if(is_array($data) || $data instanceof \think\Collection): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
<ul class="songlist_header list" id="song-1" did="313">
    <li class="songlist_songname"><span><?php echo $val['sid']; ?></span>
    <a href="/index/index/songplay?sid=<?php echo $val['sid']; ?>"><?php echo $val['sname']; ?></a>
    </li>
    <li class="songlist_header_author"><a href="#"  ><?php echo $val['singer']; ?></a></li>
    <li class="songlist_artist"><?php echo $val['view_num']; ?></li>
</ul>
<?php endforeach; endif; else: echo "" ;endif; endif; ?>
</div>

<div class="data_layout_other">
    <h3 class="about_tit mt30">推荐歌单</h3>
    <ul class="playlist_list">
        <?php if(is_array($hot) || $hot instanceof \think\Collection): $i = 0; $__LIST__ = $hot;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
        <li>
            <a href="/index/index/playlist?pid=<?php echo $val['pid']; ?>">
                <img src="<?php echo $val['pic']; ?>"><span class="name"><?php echo $val['pname']; ?></span>
            </a>
        </li>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
    <!-- <div class="ad mt30">300*250广告代码</div> -->
</div>
</div>
</div>
</div>
</div>


 <!--音乐歌词 start-->

  <div class="mp" style="z-index:20;opacity: 0.8;">
  <div class="mp-box">
    <img src="" alt="music cover" class="mp-cover">
    <div class="mp-info">
      <p class="mp-name">燕归巢</p>
      <p class="mp-singer">许嵩</p>
      <p><span class="mp-time-current">00:00</span>/<span class="mp-time-all">00:00</span></p>
    </div>
    <div class="mp-btn">
      <button class="mp-prev" title="上一首"></button>
      <button class="mp-pause" title="播放"></button>
      <button class="mp-next" title="下一首"></button>
      <button class="mp-mode" title="播放模式"></button>
      <div class="mp-vol">
        <button class="mp-vol-img" title="静音"></button>
        <div class="mp-vol-range" data-range_min="0" data-range_max="100" data-cur_min="80">
          <div class="mp-vol-current"></div>
          <div class="mp-vol-circle"></div>
        </div>
      </div>
    </div>
    <div class="mp-pro">
      <div class="mp-pro-current"></div>
    </div>
    <div class="mp-menu">
      <button class="mp-list-toggle"></button>
      <button class="mp-lrc-toggle"></button>
    </div>
  </div>
  <button class="mp-toggle">
    <span class="mp-toggle-img"></span>
  </button>
  <div class="mp-lrc-box">
    <ul class="mp-lrc"></ul>
  </div>
  <button class="mp-lrc-close"></button>
  <div class="mp-list-box">
    <ul class="mp-list-title"></ul>
    <table class="mp-list-table">
      <thead>
        <tr>
          <th>歌名</th>
          <th>歌手</th>
          <th>时长</th>
        </tr>
      </thead>
      <tbody class="mp-list"></tbody>
    </table>
  </div>
</div>


<!--music js start-->
<script src="http://www.jq22.com/jquery/jquery-2.1.1.js"></script>
<script src="/static/mplayer/js/mplayer.js"></script>
<script src="/static/mplayer/js/mplayer-list.js"></script>
<script src="/static/mplayer/js/mplayer-functions.js"></script>
<script src="http://cdn.bootcss.com/jquery-nstslider/1.0.13/jquery.nstSlider.min.js"></script>
<!--music js end-->

<script>
var modeText = ['顺序播放','单曲循环','随机播放','列表循环'];
<?php if(!empty($song)): foreach($song as $value): ?>
    // var tmp = {
    //   "name":"<?php echo $value['musicname']; ?>",
    //   "singer":"<?php echo $value['songer']; ?>",
    //   "img":"<?php echo $value['img']; ?>",
    //   "src":"<?php echo $value['url']; ?>",
    //   "lrc":"<?php echo $value['songword']; ?>",
    // };
    var tmp = {
      "name":"<?php echo $value['musicname']; ?>",
      "singer":"<?php echo $value['songer']; ?>",
      "img":"<?php echo $value['img']; ?>",
      "src":"<?php echo $value['url']; ?>",
      "lrc":"<?php echo $value['songword']; ?>"
    };
    mplayer_song[0].push(tmp);
<?php endforeach; endif; ?>
var player = new MPlayer({
  // 容器选择器名称
  containerSelector: '.mp',
  // 播放列表
  songList: mplayer_song,
  // 专辑图片错误时显示的图片
  defaultImg: '/static/index/fengmian/wake.jpg',
  // 自动播放
  autoPlay: true,
  // 播放模式(0->顺序播放,1->单曲循环,2->随机播放,3->列表循环(默认))
  playMode:0,
  playList:0,
  playSong:0,
  // 当前歌词距离顶部的距离
  lrcTopPos: 34,
  // 列表模板，用${变量名}$插入模板变量
  listFormat: '<tr><td>${name}$</td><td>${singer}$</td><td>${time}$</td></tr>',
  // 音量滑块改变事件名称
  volSlideEventName:'change',
  // 初始音量
  defaultVolume:80
}, function () {
  // 绑定事件
  this.on('afterInit', function () {
    console.log('播放器初始化完成，正在准备播放');
  }).on('beforePlay', function () {
    var $this = this;
    var song = $this.getCurrentSong(true);
    var songName = song.name + ' - ' + song.singer;
    console.log('即将播放'+songName+'，return false;可以取消播放');
  }).on('timeUpdate', function () {
    var $this = this;
    console.log('当前歌词：' + $this.getLrc());
  }).on('end', function () {
    var $this = this;
    var song = $this.getCurrentSong(true);
    var songName = song.name + ' - ' + song.singer;
    console.log(songName+'播放完毕，return false;可以取消播放下一曲');
  }).on('mute', function () {
    var status = this.getIsMuted() ? '已静音' : '未静音';
    console.log('当前静音状态：' + status);
  }).on('changeMode', function () {
    var $this = this;
    var mode = modeText[$this.getPlayMode()];
    $this.dom.container.find('.mp-mode').attr('title',mode);
    console.log('播放模式已切换为：' + mode);
  });
});
setEffects(player);
</script>
  <!--音乐歌词end-->


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
