<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:81:"/home/wwwroot/au.skxto9314.com/public/../application/index/view/index/mvplay.html";i:1519890875;s:75:"/home/wwwroot/au.skxto9314.com/public/../application/index/view/header.html";i:1519800225;s:75:"/home/wwwroot/au.skxto9314.com/public/../application/index/view/footer.html";i:1519783681;}*/ ?>
<!doctype html>
<html>
    <head>
    <meta charset="utf-8">
    <title>Au音乐网-mv</title>
    <link href="/static/index/css/video-js.css" rel="stylesheet">

     <link rel="stylesheet" href="/static/index/css/style2.css">
<style>
  body {
      /* background-color: #191919; */
  }
  .m {
      /* width: 740px; */
      width: 960px;
      min-height: 400px;
      margin-left: auto;
      margin-right: auto;
      padding:20px;
  }
  #bg_box{
        /* background:url(/static/index/image/ti3.jpg); */
        /* background-color:#3A89AA; */
        background-color:#eee;
        min-height:800px;
  }
</style>
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















<div id="bg_box">
    <div class="m">
      <?php if(is_array($sel) || $sel instanceof \think\Collection): $i = 0; $__LIST__ = $sel;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
      <video id="my-video" class="video-js" controls preload="auto" width="960" min-height="450"
          poster="<?php echo $val['pic']; ?>" data-setup="{}">
        <source src="<?php echo $val['url']; ?>" type="video/mp4">
      </video>
      <?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
    <!--评论留言开始-->
<div  style="background-color:white;margin:10px auto;margin-bottom:0px;width:960px;min-height:300px;background-color:white;border:1px solid #ccc;min-height:100px;">
    <p style="font-size:15px;font-family:STsong;text-indent: 30px;margin-top: 10px;">来给这首MV一个评论吧</p>
    <form method="post" action="/index/index/mvpost?ctype=2&vid=<?php echo $vid; ?>">
    <div style="width:100%;background-color:;margin-top: 20px;;">
      <span style="margin-left:10px;width:70px;height:70px;text-indent: 50px;">
        <img src="/static/index/image/hc2.jpg" alt="加载失败" width="70px;" style="border-radius: 80%;">
      </span>
      <textarea name="content" style="height:70px;width:73%;border:1px solid #D1605A;margin-left:90px;margin-top:3px;border-radius:10px;font-size:20px;">

      </textarea>
      <input type="submit" name="" style="width:100px;height:30px;background-color:#E85252;color:white;border-radius:10px;margin-left:163px;margin-top:16px;" value="评论">

    </div>
    </form>
    <p style="font-size:20px;font-family:STSong;text-indent: 30px;margin-top: 20px;margin-bottom: 20px;">最新评论</p>


    <?php if(is_array($data) || $data instanceof \think\Collection): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>

    <div style="width:100%;background-color:;margin-top: 10px;min-height:128px;margin-left:<?php echo $val['level']*20; ?>px;"  class="comm_list">
      <div style="margin-left:30px;float:left;width:60px;height:60px;">
        <img src="<?php echo $val['pic']; ?>" alt="加载失败" width="50px;" style="border-radius: 80%;">
      </div>
      <div name="" style="height:40px;width:60%;border:1px solid #D1605A;margin-left:20px;margin-top:8px;border-radius: 5px;float:left;text-align:;line-height:40px;padding-left:10px;font-size:15px;"><?php echo $val['content']; ?>
      </div>
      <div style="float:left;width:100%;">
        &emsp;作者：<?php echo $val['username']; ?><span style="width:100px;"></span>发表于：<?php echo date("y-m-d h:i:s",$val['create_time']); ?>&emsp;&emsp;&emsp;
        <!-- 点赞<span><img src="/static/index/image/赞.png" width="30px;"></span>&emsp;&emsp;&emsp; -->
        <span style="display: none;" id="id"><?php echo $val['id']; ?></span>
        <span style="display: none;" id="id"><?php echo $vid; ?></span>
        <span>
          <a class="comment-reply" style="color:red">回复</a>
        </span> <br>
          <!-- <input type="text" name="reply" value="" style="border:1px solid #aaa;width:300px;height:50px; display:none;" id="<?php echo $val['id']; ?>"> -->
      </div>
    </div>

    <?php endforeach; endif; else: echo "" ;endif; ?>

  </div> <!--评论留言结束-->

</div>


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
  <!-- <link href="/static/index/css/asynctips.css" rel="stylesheet" type="text/css"> -->
  <!-- <script type="text/javascript" src="/static/index/js/asyncbox.js"></script> -->
  <script type="text/javascript" src="/static/index/js/bottom.js"></script>
</body>
</html>
  <!--js开始-->
<!--   <script src="/static/index/js/video.min.js"></script>
  <script src="http://vjs.zencdn.net/5.19/lang/zh-CN.js"></script>
  <script type="text/javascript">

        var myPlayer = videojs('my-video');
        videojs("my-video").ready(function(){
            var myPlayer = this;
            myPlayer.play();
        });
  </script> -->
<!--回复-->
<script src="/static/index/js/jquery-1.11.3.min.js"></script>
  <script>
//点击"回复"按钮显示或隐藏回复输入框
    $('.comment-reply').click(function(){
      var id = $(this).parent().prev().prev().html();
      var vid = $(this).parent().prev().html();
        if($(this).next().length>0)
        {
          $(this).next().remove();
        } else {
            //添加回复div
            $('.comment-reply').next().remove();//删除已存在的所有回复div
            //添加当前回复div
            var parent_id = $(this).attr("comment_id");//要回复的评论id
            divhtml = '<div>'+
                      '<form method="post" action="/index/index/mvpost?vid='+vid+'&id='+id+'">'+
                        '<input type="text" style="border:1px solid green;width:200px;height:30px;border-radius:5px 0 0 5px;margin-top:10px;" name="content">'+
                      '<input type="submit" style="border:1px solid green;width:50px;height:32px;margin-top:10px;">'+
                      '</form>'+
                      '</div>';
            $(this).after(divhtml);
         }
    });




  </script>








