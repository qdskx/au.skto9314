<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:83:"/home/wwwroot/au.skxto9314.com/public/../application/index/view/index/songlist.html";i:1519783681;s:75:"/home/wwwroot/au.skxto9314.com/public/../application/index/view/header.html";i:1519800225;s:75:"/home/wwwroot/au.skxto9314.com/public/../application/index/view/footer.html";i:1519783681;}*/ ?>

<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>音乐列表</title>
<link rel="stylesheet" href="/static/index/css/style.css">
<script type="text/javascript" src="/static/index/js/jquery.js"></script>
<script type="text/javascript" src="/static/index/js/common.js"></script>

<script src="/static/index/js/jquery-1.11.3.min.js"></script>

<style type="text/css" media="screen">
	#pa a:hover{
		color:red;
	}
</style>
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

<div class="bg_box" style="position:relative;min-height:700px;">
	<div class="main">
	<div class="record_list">

	<div class="record_lable">
		<dl>
			<dt>类别</dt>
				<dd><a href="/index/index/songlist">全部</a></dd>
				<?php if(is_array($type) || $type instanceof \think\Collection): $i = 0; $__LIST__ = $type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
				<dd><a href="/index/index/songlist2?id=<?php echo $val['id']; ?>"><?php echo $val['stname']; ?></a></dd>
				<?php endforeach; endif; else: echo "" ;endif; ?>
		</dl>
	</div>

	<div class="box3 mt20">

	<div class="malbum_index">




	</div>
	</div>
	</div>
		<div style="background-color:;height:20px;float:left;width:100%;">
			<div style="width:400px;margin:0 auto;background-color:;height:50px;position:absolute;bottom:30px;left:50%;margin-left:-200px;" id="pa" >
				<a href="" class="pa"><span style="width:50px;background-color:;text-align: center;margin-left:30px">首页</span></a>
				<a href="" class="pa"><span style="width:50px;background-color:;text-align: center;margin-left:30px">上一页</span></a>
				<a href="" class="pa"><span style="width:50px;background-color:;text-align: center;margin-left:30px">下一页</span></a>
				<a href="" class="pa"><span style="width:50px;background-color:;text-align: center;margin-left:30px">尾页</span></a>
			</div>
		</div>
	</div>
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
<script type="text/javascript" src="/static/index/js/asyncbox.js"></script>
<script type="text/javascript" src="/static/index/js/bottom.js"></script>
</body>
</html>

<!--分页-->
<script>
	var big = $('.malbum_index');
	var aA = $('.pa');
	$.ajax({
		method:'get',
		url:'/index/index/songajax',
		async:true,
		data:{page:1},
		success:success,
	});
	function success(data)
	{
		var obj = JSON.parse(data);
		var str = '';

		for(i=0;i<obj.data.length;i++){
		    str += '<dl class="new_music">'+
            '<a '+'href=/index/index/songplay?sid='+obj.data[i].sid+'>'+
            	'<dt>'+
            		'<img src='+obj.data[i].pic+' width="159" height="159"' + 'title="'+obj.data[i].sname+'"/>'+
            		'<span class="malbum"></span>'+
            	'</dt>'+
            '</a>'+
            '<dd class="new_music_title">'+obj.data[i].sname+'--'+obj.data[i].singer+'</dd>'+
            '<dd class="new_music_name">'+obj.data[i].ispay+'</dd>'+
            '</dl>'
			$('.malbum_index').html(str);
		}
		var oPage = obj.allPage;
		var i = 0;
		for (var name in oPage) {
			aA[i].href = 'javascript:test(\'' +oPage[name] +'\')';
			i++;
		}


	}
	function test(url)
	{
		$.ajax({
			method:'get',
			url:url,
			async:true,
			data:null,
			success:success
		});
	}




</script>

