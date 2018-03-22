<?php
    if(!function_exists('parse_padding')){
        function parse_padding($source)
        {
            $length  = strlen(strval(count($source['source']) + $source['first']));
            return 40 + ($length - 1) * 8;
        }
    }

    if(!function_exists('parse_class')){
        function parse_class($name)
        {
            $names = explode('\\', $name);
            return '<abbr title="'.$name.'">'.end($names).'</abbr>';
        }
    }

    if(!function_exists('parse_file')){
        function parse_file($file, $line)
        {
            return '<a class="toggle" title="'."{$file} line {$line}".'">'.basename($file)." line {$line}".'</a>';
        }
    }

    if(!function_exists('parse_args')){
        function parse_args($args)
        {
            $result = [];

            foreach ($args as $key => $item) {
                switch (true) {
                    case is_object($item):
                        $value = sprintf('<em>object</em>(%s)', parse_class(get_class($item)));
                        break;
                    case is_array($item):
                        if(count($item) > 3){
                            $value = sprintf('[%s, ...]', parse_args(array_slice($item, 0, 3)));
                        } else {
                            $value = sprintf('[%s]', parse_args($item));
                        }
                        break;
                    case is_string($item):
                        if(strlen($item) > 20){
                            $value = sprintf(
                                '\'<a class="toggle" title="%s">%s...</a>\'',
                                htmlentities($item),
                                htmlentities(substr($item, 0, 20))
                            );
                        } else {
                            $value = sprintf("'%s'", htmlentities($item));
                        }
                        break;
                    case is_int($item):
                    case is_float($item):
                        $value = $item;
                        break;
                    case is_null($item):
                        $value = '<em>null</em>';
                        break;
                    case is_bool($item):
                        $value = '<em>' . ($item ? 'true' : 'false') . '</em>';
                        break;
                    case is_resource($item):
                        $value = '<em>resource</em>';
                        break;
                    default:
                        $value = htmlentities(str_replace("\n", '', var_export(strval($item), true)));
                        break;
                }

                $result[] = is_int($key) ? $value : "'{$key}' => {$value}";
            }

            return implode(', ', $result);
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>404</title>
    <meta name="robots" content="noindex,nofollow" />
    <style>
        /* Base */
        body {
            color: #333;
            font: 16px Verdana, "Helvetica Neue", helvetica, Arial, 'Microsoft YaHei', sans-serif;
            margin: 0;
            padding: 0 20px 20px;
        }
        h1{
            margin: 10px 0 0;
            font-size: 28px;
            font-weight: 500;
            line-height: 32px;
        }
        h2{
            color: #4288ce;
            font-weight: 400;
            padding: 6px 0;
            margin: 6px 0 0;
            font-size: 18px;
            border-bottom: 1px solid #eee;
        }
        h3{
            margin: 12px;
            font-size: 16px;
            font-weight: bold;
        }
        abbr{
            cursor: help;
            text-decoration: underline;
            text-decoration-style: dotted;
        }
        a{
            color: #868686;
            cursor: pointer;
        }
        a:hover{
            text-decoration: underline;
        }
        .line-error{
            background: #f8cbcb;
        }

        .echo table {
            width: 100%;
        }

        .echo pre {
            padding: 16px;
            overflow: auto;
            font-size: 85%;
            line-height: 1.45;
            background-color: #f7f7f7;
            border: 0;
            border-radius: 3px;
            font-family: Consolas, "Liberation Mono", Menlo, Courier, monospace;
        }

        .echo pre > pre {
            padding: 0;
            margin: 0;
        }
    
        /* Exception Info */
        .exception {
            margin-top: 20px;
        }
        .exception .message{
            padding: 12px;
            border: 1px solid #ddd;
            border-bottom: 0 none;
            line-height: 18px;
            font-size:16px;
            border-top-left-radius: 4px;
            border-top-right-radius: 4px;
            font-family: Consolas,"Liberation Mono",Courier,Verdana,"微软雅黑";
        }

        .exception .code{
            float: left;
            text-align: center;
            color: #fff;
            margin-right: 12px;
            padding: 16px;
            border-radius: 4px;
            background: #999;
        }
        .exception .source-code{
            padding: 6px;
            border: 1px solid #ddd;

            background: #f9f9f9;
            overflow-x: auto;

        }
        .exception .source-code pre{
            margin: 0;
        }
        .exception .source-code pre ol{
            margin: 0;
            color: #4288ce;
            display: inline-block;
            min-width: 100%;
            box-sizing: border-box;
        font-size:14px;
            font-family: "Century Gothic",Consolas,"Liberation Mono",Courier,Verdana;
            padding-left: <?php echo (isset($source) && !empty($source)) ? parse_padding($source) : 40;  ?>px;
        }
        .exception .source-code pre li{
            border-left: 1px solid #ddd;
            height: 18px;
            line-height: 18px;
        }
        .exception .source-code pre code{
            color: #333;
            height: 100%;
            display: inline-block;
            border-left: 1px solid #fff;
        font-size:14px;
            font-family: Consolas,"Liberation Mono",Courier,Verdana,"微软雅黑";
        }
        .exception .trace{
            padding: 6px;
            border: 1px solid #ddd;
            border-top: 0 none;
            line-height: 16px;
        font-size:14px;
            font-family: Consolas,"Liberation Mono",Courier,Verdana,"微软雅黑";
        }
        .exception .trace ol{
            margin: 12px;
        }
        .exception .trace ol li{
            padding: 2px 4px;
        }
        .exception div:last-child{
            border-bottom-left-radius: 4px;
            border-bottom-right-radius: 4px;
        }

        /* Exception Variables */
        .exception-var table{
            width: 100%;
            margin: 12px 0;
            box-sizing: border-box;
            table-layout:fixed;
            word-wrap:break-word;            
        }
        .exception-var table caption{
            text-align: left;
            font-size: 16px;
            font-weight: bold;
            padding: 6px 0;
        }
        .exception-var table caption small{
            font-weight: 300;
            display: inline-block;
            margin-left: 10px;
            color: #ccc;
        }
        .exception-var table tbody{
            font-size: 13px;
            font-family: Consolas,"Liberation Mono",Courier,"微软雅黑";
        }
        .exception-var table td{
            padding: 0 6px;
            vertical-align: top;
            word-break: break-all;
        }
        .exception-var table td:first-child{
            width: 28%;
            font-weight: bold;
            white-space: nowrap;
        }
        .exception-var table td pre{
            margin: 0;
        }

        /* Copyright Info */
        .copyright{
            margin-top: 24px;
            padding: 12px 0;
            border-top: 1px solid #eee;
        }

        /* SPAN elements with the classes below are added by prettyprint. */
        pre.prettyprint .pln { color: #000 }  /* plain text */
        pre.prettyprint .str { color: #080 }  /* string content */
        pre.prettyprint .kwd { color: #008 }  /* a keyword */
        pre.prettyprint .com { color: #800 }  /* a comment */
        pre.prettyprint .typ { color: #606 }  /* a type name */
        pre.prettyprint .lit { color: #066 }  /* a literal value */
        /* punctuation, lisp open bracket, lisp close bracket */
        pre.prettyprint .pun, pre.prettyprint .opn, pre.prettyprint .clo { color: #660 }
        pre.prettyprint .tag { color: #008 }  /* a markup tag name */
        pre.prettyprint .atn { color: #606 }  /* a markup attribute name */
        pre.prettyprint .atv { color: #080 }  /* a markup attribute value */
        pre.prettyprint .dec, pre.prettyprint .var { color: #606 }  /* a declaration; a variable name */
        pre.prettyprint .fun { color: red }  /* a function name */
    </style>


 <style>
 html,body {
  height: 100%;
  min-height: 450px;
  font-size: 32px;
  font-weight: 500;
  color: #5d7399;
  margin:0;padding:0;border:0;
}

.content {
  height: 100%;
  position: relative;
  z-index: 1;
  background-color: #d2e1ec;
  background-image: -webkit-linear-gradient(top, #bbcfe1 0%, #e8f2f6 80%);
  background-image: linear-gradient(to bottom, #bbcfe1 0%, #e8f2f6 80%);
  overflow: hidden;
}

.snow {
  position: absolute;
  top: 0;
  left: 0;
  pointer-events: none;
  z-index: 20;
}

.main-text {
  padding: 20vh 20px 0 20px;
  text-align: center;
  line-height: 2em;
  font-size: 5vh;
}
.main-text h1 {
  font-size:45px;
  line-height:48px;
  margin:0;
  padding:0;}
.main-text-a{
  height:32px;
  margin-left:auto;
  margin-right:auto;
  text-align:center;
}
.main-text-a a {
   font-size:16px;
   text-decoration:none;
   color:#0066CC;
 }
.main-text-a a:hover{
   color:#000;
}
.home-link {
  font-size: 0.6em;
  font-weight: 400;
  color: inherit;
  text-decoration: none;
  opacity: 0.6;
  border-bottom: 1px dashed rgba(93, 115, 153, 0.5);
}
.home-link:hover {
  opacity: 1;
}

.ground {
  height: 160px;
  width: 100%;
  position: absolute;
  bottom: 0;
  left: 0;
  background: #f6f9fa;
  box-shadow: 0 0 10px 10px #f6f9fa;
}
.ground:before, .ground:after {
  content: '';
  display: block;
  width: 250px;
  height: 250px;
  position: absolute;
  top: -62.5px;
  z-index: -1;
  background: transparent;
  -webkit-transform: scaleX(0.2) rotate(45deg);
          transform: scaleX(0.2) rotate(45deg);
}
.ground:after {
  left: 50%;
  margin-left: -166.66667px;
  box-shadow: -340px 260px 15px #8193b2, -620px 580px 15px #8193b2, -900px 900px 15px #b0bccf, -1155px 1245px 15px #b4bed1, -1515px 1485px 15px #8193b2, -1755px 1845px 15px #8a9bb8, -2050px 2150px 15px #91a1bc, -2425px 2375px 15px #bac4d5, -2695px 2705px 15px #a1aec6, -3020px 2980px 15px #8193b2, -3315px 3285px 15px #94a3be, -3555px 3645px 15px #9aa9c2, -3910px 3890px 15px #b0bccf, -4180px 4220px 15px #bac4d5, -4535px 4465px 15px #a7b4c9, -4840px 4760px 15px #94a3be;
}
.ground:before {
  right: 50%;
  margin-right: -166.66667px;
  box-shadow: 325px -275px 15px #b4bed1, 620px -580px 15px #adb9cd, 925px -875px 15px #a1aec6, 1220px -1180px 15px #b7c1d3, 1545px -1455px 15px #7e90b0, 1795px -1805px 15px #b0bccf, 2080px -2120px 15px #b7c1d3, 2395px -2405px 15px #8e9eba, 2730px -2670px 15px #b7c1d3, 2995px -3005px 15px #9dabc4, 3285px -3315px 15px #a1aec6, 3620px -3580px 15px #8193b2, 3880px -3920px 15px #aab6cb, 4225px -4175px 15px #9dabc4, 4510px -4490px 15px #8e9eba, 4785px -4815px 15px #a7b4c9;
}

.mound {
  margin-top: -80px;
  font-weight: 800;
  font-size: 180px;
  text-align: center;
  color: #dd4040;
  pointer-events: none;
}
.mound:before {
  content: '';
  display: block;
  width: 600px;
  height: 200px;
  position: absolute;
  left: 50%;
  margin-left: -300px;
  top: 50px;
  z-index: 1;
  border-radius: 100%;
  background-color: #e8f2f6;
  background-image: -webkit-linear-gradient(top, #dee8f1, #f6f9fa 60px);
  background-image: linear-gradient(to bottom, #dee8f1, #f6f9fa 60px);
}
.mound:after {
  content: '';
  display: block;
  width: 28px;
  height: 6px;
  position: absolute;
  left: 50%;
  margin-left: -150px;
  top: 68px;
  z-index: 2;
  background: #dd4040;
  border-radius: 100%;
  -webkit-transform: rotate(-15deg);
          transform: rotate(-15deg);
  box-shadow: -56px 12px 0 1px #dd4040, -126px 6px 0 2px #dd4040, -196px 24px 0 3px #dd4040;
}

.mound_text {
  -webkit-transform: rotate(6deg);
          transform: rotate(6deg);
}

.mound_spade {
  display: block;
  width: 35px;
  height: 30px;
  position: absolute;
  right: 50%;
  top: 42%;
  margin-right: -250px;
  z-index: 0;
  -webkit-transform: rotate(35deg);
          transform: rotate(35deg);
  background: #dd4040;
}
.mound_spade:before, .mound_spade:after {
  content: '';
  display: block;
  position: absolute;
}
.mound_spade:before {
  width: 40%;
  height: 30px;
  bottom: 98%;
  left: 50%;
  margin-left: -20%;
  background: #dd4040;
}
.mound_spade:after {
  width: 100%;
  height: 30px;
  top: -55px;
  left: 0%;
  box-sizing: border-box;
  border: 10px solid #dd4040;
  border-radius: 4px 4px 20px 20px;
}
 </style>
</head>
<body>
    <div class="echo">
        <!-- <?php echo $echo;?> -->
    </div>
    <?php if(\think\App::$debug) { ?>
    <div class="exception">
    <div class="message">
        
            <div class="info">
                <div>
                    <h2>[<?php echo $code; ?>] <?php echo sprintf('%s in %s', parse_class($name), parse_file($file, $line)); ?></h2>
                </div>
                <!-- <div><h1><?php echo nl2br(htmlentities($message)); ?></h1></div> -->
            </div>
        
    </div>
	<?php if(!empty($source)){?>
        <div class="source-code">
            <pre class="prettyprint lang-php"><ol start="<?php echo $source['first']; ?>"><?php foreach ((array) $source['source'] as $key => $value) { ?><li class="line-<?php echo $key + $source['first']; ?>"><code><?php echo htmlentities($value); ?></code></li><?php } ?></ol></pre>
        </div>
	<?php }?>
        <div class="trace">
            <h2>Call Stack</h2>
            <ol>
                <li><?php echo sprintf('in %s', parse_file($file, $line)); ?></li>
                <?php foreach ((array) $trace as $value) { ?>
                <li>
                <?php 
                    // Show Function
                    if($value['function']){
                        echo sprintf(
                            'at %s%s%s(%s)', 
                            isset($value['class']) ? parse_class($value['class']) : '',
                            isset($value['type'])  ? $value['type'] : '', 
                            $value['function'], 
                            isset($value['args'])?parse_args($value['args']):''
                        );
                    }

                    // Show line
                    if (isset($value['file']) && isset($value['line'])) {
                        echo sprintf(' in %s', parse_file($value['file'], $value['line']));
                    }
                ?>
                </li>
                <?php } ?>
            </ol>
        </div>
    </div>
    <?php } else { ?>
    <!-- <div class="exception"> -->
        
            <!-- <div class="info"><h1><?php echo htmlentities($message); ?></h1></div> -->
        
    <!-- </div> -->
    <?php } ?>
    
    <?php if(!empty($datas)){ ?>
    <div class="exception-var">
        <h2>Exception Datas</h2>
        <?php foreach ((array) $datas as $label => $value) { ?>
        <table>
            <?php if(empty($value)){ ?>
            <caption><?php echo $label; ?><small>empty</small></caption>
            <?php } else { ?>
            <caption><?php echo $label; ?></caption>
            <tbody>
                <?php foreach ((array) $value as $key => $val) { ?>
                <tr>
                    <td><?php echo htmlentities($key); ?></td>
                    <td>
                        <?php 
                            if(is_array($val) || is_object($val)){ 
                                echo htmlentities(json_encode($val, JSON_PRETTY_PRINT));
                            } else if(is_bool($val)) { 
                                echo $val ? 'true' : 'false';
                            } else if(is_scalar($val)) {
                                echo htmlentities($val);
                            } else {
                                echo 'Resource';
                            }
                        ?>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
            <?php } ?>
        </table>
        <?php } ?>
    </div>
    <?php } ?>

    <?php if(!empty($tables)){ ?>
    <div class="exception-var">
        <h2>Environment Variables</h2>
        <?php foreach ((array) $tables as $label => $value) { ?>
        <table>
            <?php if(empty($value)){ ?>
            <caption><?php echo $label; ?><small>empty</small></caption>
            <?php } else { ?>
            <caption><?php echo $label; ?></caption>
            <tbody>
                <?php foreach ((array) $value as $key => $val) { ?>
                <tr>
                    <td><?php echo htmlentities($key); ?></td>
                    <td>
                        <?php 
                            if(is_array($val) || is_object($val)){ 
                                echo htmlentities(json_encode($val, JSON_PRETTY_PRINT));
                            } else if(is_bool($val)) { 
                                echo $val ? 'true' : 'false';
                            } else if(is_scalar($val)) {
                                echo htmlentities($val);
                            } else {
                                echo 'Resource';
                            }
                        ?>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
            <?php } ?>
        </table>
        <?php } ?>
    </div>
    <?php } ?>

    <!-- <div class="copyright"> -->
        <div class="content">
          <canvas class="snow" id="snow" width="1349" height="400"></canvas>
          <div class="main-text">
            <h1>天啊。<br>那页失踪了。</h1>
            <div class="main-text-a"><a href="/admin/index">< 返回管理中心</a></div>  
            <div class="main-text-a"><a href="/index">< 返回前台首页</a></div> 
          </div>
          <div class="ground">
            <div class="mound"> 
              <div class="mound_text">404 </div>
              <div class="mound_spade"></div> 
            </div>
          </div>
        </div>

    <!-- </div> -->
    <!-- <?php if(\think\App::$debug) { ?> -->
    <script>
        var LINE = <?php echo $line; ?>;

        function $(selector, node){
            var elements;

            node = node || document;
            if(document.querySelectorAll){
                elements = node.querySelectorAll(selector);
            } else {
                switch(selector.substr(0, 1)){
                    case '#':
                        elements = [node.getElementById(selector.substr(1))];
                        break;
                    case '.':
                        if(document.getElementsByClassName){
                            elements = node.getElementsByClassName(selector.substr(1));
                        } else {
                            elements = get_elements_by_class(selector.substr(1), node);
                        }
                        break;
                    default:
                        elements = node.getElementsByTagName();
                }
            }
            return elements;

            function get_elements_by_class(search_class, node, tag) {
                var elements = [], eles, 
                    pattern  = new RegExp('(^|\\s)' + search_class + '(\\s|$)');

                node = node || document;
                tag  = tag  || '*';

                eles = node.getElementsByTagName(tag);
                for(var i = 0; i < eles.length; i++) {
                    if(pattern.test(eles[i].className)) {
                        elements.push(eles[i])
                    }
                }

                return elements;
            }
        }

        $.getScript = function(src, func){
            var script = document.createElement('script');
            
            script.async  = 'async';
            script.src    = src;
            script.onload = func || function(){};
            
            $('head')[0].appendChild(script);
        }

        ;(function(){
            var files = $('.toggle');
            var ol    = $('ol', $('.prettyprint')[0]);
            var li    = $('li', ol[0]);   

            // 短路径和长路径变换
            for(var i = 0; i < files.length; i++){
                files[i].ondblclick = function(){
                    var title = this.title;

                    this.title = this.innerHTML;
                    this.innerHTML = title;
                }
            }

            // 设置出错行
            var err_line = $('.line-' + LINE, ol[0])[0];
            err_line.className = err_line.className + ' line-error';

            $.getScript('//cdn.bootcss.com/prettify/r298/prettify.min.js', function(){
                prettyPrint();

                // 解决Firefox浏览器一个很诡异的问题
                // 当代码高亮后，ol的行号莫名其妙的错位
                // 但是只要刷新li里面的html重新渲染就没有问题了
                if(window.navigator.userAgent.indexOf('Firefox') >= 0){
                    ol[0].innerHTML = ol[0].innerHTML;
                }
            });

        })();
    </script>
    <?php } ?>

        <script>
    (function() {
    function ready(fn) {
        if (document.readyState != 'loading'){
            fn();
        } else {
            document.addEventListener('DOMContentLoaded', fn);
        }
    }
    
    function makeSnow(el) {
        var ctx = el.getContext('2d');
        var width = 0;
        var height = 0;
        var particles = [];
        
        var Particle = function() {
            this.x = this.y = this.dx = this.dy = 0;
            this.reset();
        }
        
        Particle.prototype.reset = function() {
            this.y = Math.random() * height;
            this.x = Math.random() * width;
            this.dx = (Math.random() * 1) - 0.5;
            this.dy = (Math.random() * 0.5) + 0.5;
        }
        
        function createParticles(count) {
            if (count != particles.length) {
                particles = [];
                for (var i = 0; i < count; i++) {
                    particles.push(new Particle());
                }
            }
        }
                
        function onResize() {
            width = window.innerWidth;
            height = window.innerHeight;
            el.width = width;
            el.height = height;
            
            createParticles((width * height) / 10000);
        }
        
        function updateParticles() {
            ctx.clearRect(0, 0, width, height);
            ctx.fillStyle = '#f6f9fa';
            
            particles.forEach(function(particle) {
                particle.y += particle.dy;
                particle.x += particle.dx;
                
                if (particle.y > height) {
                    particle.y = 0;
                }
                
                if (particle.x > width) {
                    particle.reset();
                    particle.y = 0;
                }
                
                ctx.beginPath();
                ctx.arc(particle.x, particle.y, 5, 0, Math.PI * 2, false);
                ctx.fill();
            });
            
            window.requestAnimationFrame(updateParticles);
        }
        
        onResize();
        updateParticles();
    }
    
    ready(function() {
        var canvas = document.getElementById('snow');
        makeSnow(canvas);
    });
})();
  </script>
</body>
</html>
