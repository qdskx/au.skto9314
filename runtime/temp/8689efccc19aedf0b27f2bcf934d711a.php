<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:80:"/home/wwwroot/au.skxto9314.com/public/../application/admin/view/index/index.html";i:1519888422;}*/ ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>
            后台管理中心
        </title>
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="format-detection" content="telephone=no">
        <link rel="stylesheet" href="../../static/admin/css/x-admin.css" media="all">
        
        <!-- 烟花外部文件 -->
        <script src="../../static/admin/js/jquery-1.11.1.min.js"></script>
        <link rel="stylesheet" href="../../static/admin/js/jquery-ui.css" />
        <script src="../../static/admin/js/jquery-ui.min.js"></script>
        <script src="../../static/admin/js/firemaks.js" type="text/javascript"></script>

        <style>
            body{
                background: url('../../static/admin/images/bg2.jpg');
            }
        </style>



        <script type="text/javascript">
            var cx = 0,cy = 0;
                
            var color1 = new Array( new Array({r:241,g:0,b:0},  {r:255,g:72,b:72},  {r:239,g:107,b:107},  {r:255,g:191,b:191},  {r:255,g:255,b:255}),
            new Array({r:12,g:152,b:228},  {r:81,g:188,b:246},  {r:100,g:195,b:247},  {r:195,g:232,b:252},  {r:255,g:255,b:255}),
            new Array({r:202,g:228,b:12},  {r:226,g:246,b:81},  {r:229,g:247,b:100},  {r:245,g:252,b:195},  {r:255,g:255,b:255}) );
            var color2 = new Array( new Array({r:255,g:0,b:0}, {r:228,g:225,b:0}, {r:169,g:0,b:231}, {r:255,g:0,b:148}, {r:255,g:255,b:255}),
            new Array({r:0,g:153,b:231}, {r:194,g:0,b:231}, {r:255,g:118,b:0}, {r:141,g:227,b:0}, {r:255,g:255,b:255}), 
            new Array({r:255,g:251,b:125}, {r:0,g:206,b:223}, {r:247,g:154,b:255}, {r:255,g:165,b:106}, {r:255,g:255,b:255}) );
            var color3 = new Array( new Array({r:0,g:94,b:226}, {r:255,g:255,b:255}),
            new Array({r:231,g:234,b:0}, {r:255,g:255,b:255}), 
            new Array({r:255,g:109,b:0}, {r:255,g:255,b:255}) );
            var color4 = new Array(
                new Array({r:255,g:0,b:0}),
                new Array({r:0,g:94,b:226}),
                new Array({r:214,g:214,b:214}),
                new Array({r:0,g:168,b:0}),
                new Array({r:231,g:234,b:0}),
                new Array({r:255,g:118,b:0}),
                new Array({r:0,g:205,b:255}),
                new Array({r:182,g:255,b:125}),
                new Array({r:255,g:0,b:123})    
                );
        

            jQuery(document).ready(function(){
            //  
            $('body').firemaks({
                color: 'random',
                type: 'random',
                color_child: 'inherit',
                type_child: 'random',
                boom_count: 3
                });
            
            // $(document).mousemove(function(e){ cx = e.pageX; cy = e.pageY; });  
            // $('body').on('click',function(){ $('body').firemaks('fire',cx,cy,40,color1/*'full_random'*/,2,1.5); });
            
            // $('#colorset').buttonset();
            // $('#colorset input').on('click', function(){ setcolors ($(this).val());  });
            function setcolors(val) {
                switch (val){
                    case '0': 
                        $('body').firemaks('setcolors', color1);
                        $('#colorsetdesc').html('<img src="images/fw_colorset_1.png"> <br/> * each row - one firework.');
                        $('#descclrset').show();
                        break;
                    case '1': 
                        $('body').firemaks('setcolors', color2);
                        $('#colorsetdesc').html('<img src="images/fw_colorset_2.png"> <br/> * each row - one firework.');
                        $('#descclrset').show();
                        break;
                    case '2': 
                        $('body').firemaks('setcolors', color3); 
                        $('#colorsetdesc').html('<img src="images/fw_colorset_3.png"> <br/> * each row - one firework.');
                        $('#descclrset').show();                
                        break;
                    case '3': 
                        $('body').firemaks('setcolors', color4);
                        $('#colorsetdesc').html('<img src="images/fw_colorset_4.png"> <br/> * each <b>color</b> - <b>one firework</b>.');
                        $('#descclrset').show();
                        break;
                    case '4': 
                        $('body').firemaks('setcolors', 'random');
                        $('#descclrset').hide();
                        break;
                    case '5': 
                        $('body').firemaks('setcolors', 'full_random');
                        $('#descclrset').hide();
                        break;
                    default: 
                        $('body').firemaks('setcolors', color1); 
                        $('#colorsetdesc').html('<img src="images/fw_colorset_1.png"> <br/> * each row - one firework.');
                        $('#descclrset').show(); 
                        break;
                    }
                }
            setcolors($(':radio[name=colorset]').filter(':checked').val());
            
            
            //  
            // $('#typeset').buttonset();
            // $('#typeset input').on('click', function(){ settype ($(this).val(), $(':radio[name=typeset_child]').filter(':checked').val()); });
            // $('#typeset_child').buttonset();
            // $('#typeset_child input').on('click', function(){ settype ($(':radio[name=typeset]').filter(':checked').val(), $(this).val()); });
            
            function settype(val, val2) {
                var vl1 = null, vl2 = null;
                switch (val){
                    case '0': vl1 = 'random'; break;
                    case '1': vl1 = 1; break;
                    case '2': vl1 = 2; break;
                    case '3': vl1 = 3; break;
                    default: vl1 = 'random'; break;
                    }       
                switch (val2){
                    case '0': vl2 = 'random'; break;
                    case '1': vl2 = 1; break;
                    case '2': vl2 = 2; break;
                    case '3': vl2 = 3; break;
                    case '4': vl2 = 'inherit'; break;
                    default: vl2 = 'random'; break;
                    }
                $('body').firemaks('settypes', vl1, vl2);           
                }
                
            settype($(':radio[name=typeset]').filter(':checked').val(), $(':radio[name=typeset_child]').filter(':checked').val());
            
            $('#sound').buttonset();
            // $('#sound input').on('click', function(){ setsound ($(this).val(), $(':radio[name=sound]').filter(':checked').val()); });   
            function setsound(val) {
                switch (val){
                    case '0': $('body').firemaks('setsounds'); break;
                    case '1': $('body').firemaks('setsounds', '../../static/admin/images/sfx/boom.wav', '../../static/admin/images/sfx/crackles.wav'); break;
                    default: 
                        $('body').firemaks('setsounds');                
                        break;
                    }
                }
            // setsound($(':radio[name=sound]').filter(':checked').val());
            setsound(1);
        });
    </script>
    </head>
    <body>
        <div class="layui-layout layui-layout-admin">
            <div class="layui-header header header-demo" style="background: rgba(255,255,255,0.5)">
                <div class="layui-main">
                    <a class="logo" href="/admin/index" style="font-family:楷体;">
                        哎呦,不错哦！
                    </a>
                    <ul class="layui-nav" lay-filter="">
                      <li class="layui-nav-item"><img src="<?php echo \think\Session::get('pic'); ?>" class="layui-circle" style="border: 2px solid #A9B7B7;" width="35px" alt=""></li>
                      <li class="layui-nav-item">
                        <a href="javascript:;"><?php echo \think\Session::get('username'); ?></a>
                        <dl class="layui-nav-child"> <!-- 二级菜单 -->
                          <dd><a href="/admin/permission/editadmin/">个人信息</a></dd>
                          <dd><a href="/admin/user/change">切换帐号</a></dd>
                          <dd><a href="/admin/user/loginout">退出</a></dd>
                        </dl>
                      </li>
  <!--                     <li class="layui-nav-item">
                        <a href="" title="消息">
                            <i class="layui-icon" style="top: 1px;">&#xe63a;</i>
                        </a>
                        </li> -->
                      <li class="layui-nav-item x-index"><a href="/index" target="_blank">前台首页</a></li>
                    </ul>
                </div>
            </div>
            <div class="layui-side layui-bg-black x-side" style="background: rgba(255,255,255,0.2)">
                <div class="layui-side-scroll">
                    <ul style="background: rgba(255,255,255,0.2)" class="layui-nav layui-nav-tree site-demo-nav" lay-filter="side">
                    <?php if(is_array($node) || $node instanceof \think\Collection): $i = 0; $__LIST__ = $node;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;if($value['level']==2): ?>
                        <li class="layui-nav-item">
                            <a class="javascript:;" href="javascript:;">
                                <i class="layui-icon" style="top: 3px;">&#xe634;</i><cite><?php echo $value['name']; ?></cite>
                            </a>
                            <dl class="layui-nav-child">
                            <?php if(is_array($node) || $node instanceof \think\Collection): $i = 0; $__LIST__ = $node;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;if($val['pid']==$value['nid']): ?>
                                <dd class="">
                                    <dd class="">
                                        <a href="javascript:;" _href="<?php echo $val['ename']; ?>">
                                            <cite><?php echo $val['name']; ?></cite>
                                        </a>
                                    </dd>
                                </dd>
                                <?php endif; endforeach; endif; else: echo "" ;endif; ?>
                            </dl>
                        </li>
                        <?php endif; endforeach; endif; else: echo "" ;endif; ?>
                        <li class="layui-nav-item" style="height: 30px; text-align: center">
                        </li>
                    </ul>
                </div>

            </div>
            <div class="layui-tab layui-tab-card site-demo-title x-main" lay-filter="x-tab" lay-allowclose="true">
                <div class="x-slide_left"></div>
                <ul class="layui-tab-title">
                    <li class="layui-this">
                        历史上的今天：<?php echo $str; ?>
                        <i class="layui-icon layui-unselect layui-tab-close">ဆ</i>

                    </li>

                </ul>

                <div class="layui-tab-content site-demo site-demo-body" style="background: rgba(255,255,255,0.2)">
                    <div class="layui-tab-item layui-show">
                        <iframe frameborder="0" style="background: rgba(255,255,255,0.2)" src="/admin/index/welcome" class="x-iframe"></iframe>
                    </div>

                </div>
            </div>

            <div class="site-mobile-shade">
            </div>

        </div>
        <script src="../static/admin/lib/layui/layui.js" charset="utf-8"></script>
        <script src="../static/admin/js/x-admin.js"></script>
        <script>
        var _hmt = _hmt || [];
        (function() {
          var hm = document.createElement("script");
          hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
          var s = document.getElementsByTagName("script")[0]; 
          s.parentNode.insertBefore(hm, s);
        })();
        </script>
    </body>
</html>