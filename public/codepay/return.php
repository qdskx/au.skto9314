<?php
/* *
 * 功能：码支付客服端同步通知页面(可不处理任何业务 为辅助业务实现)
 * 版本：1.0
 * 日期：2016-12-23
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 * 该代码仅供学习和研究码支付接口使用，只是提供一个参考。
 *************************页面功能说明*************************
 * 支付成功后客户默认会跳转到该页面 该页面可做业务 也可不做处理 为了示范我们做了业务仅供参考。
 *
 * 处理业务您需要考虑如下问题如无法解决不建议您在此页面做业务处理：
 * 1：必须要区分是否已经执行成功。不要与异步重复处理
 * 2：需要考虑并发导致数据脏读的可能。

 * 什么时候会跳转？
 * 只要检测到付款成功就会跳转,同步跟异步是并发进行。
 *
 * 以下为不跳转的可能情况：
 * 用户关闭页面：不跳转
 * 未注册通知：不跳转 (默认注册了通知 如果修改了前端需保留那部分功能)
 * 软件版未监听：不跳转 (认证版不用关心)
 *
 * 此页面不处理业务有什么影响？
 * 答：充值 购买之类的没任何影响，对于必须要付款后立即展示用户的一些卡券之类的有影响。
 *
 *
 */
require_once("codepay_config.php"); //导入配置文件
require_once("includes/MysqliDb.class.php");//导入mysqli连接
require_once("includes/M.class.php");//导入mysqli操作类
require_once("lib/codepay_notify.class.php"); //导入通知类

/**
 * 业务处理演示
 * @param $data 接收到的GET参数
 * @return string 返回处理的结果
 */
function DemoHandle($data)
{ //业务处理例子 返回一些字符串
    $pay_id = $data['pay_id']; //需要充值的ID 或订单号 或用户名
    $money = (float)$data['money']; //实际付款金额
    $price = (float)$data['price']; //订单的原价
    $type = (int)$data['type']; //支付方式
    $pay_no = $data['pay_no']; //支付流水号
    $param = $data['param']; //自定义参数 原封返回 您创建订单提交的自定义参数
    $pay_time = (int)$data['pay_time']; //付款时间戳
    $pay_tag = $data['tag']; //支付备注 仅支付宝才有 其他支付方式全为0或空
    $status = 2; //业务处理状态 这里就全设置为2  如有必要区分是否业务同时处理了可以处理完再更新该字段为其他值
    $creat_time = time(); //创建数据的时间戳


    if ($money <= 0 || empty($pay_id) || $pay_time <= 0 || empty($pay_no)) {
        return '缺少必要的一些参数'; //测试数据中 唯一标识必须包含这些
    }


    //实例化mysqli 操作库 需在php.ini启用mysqli 启用方法：删除extension=php_mysqli.dll前面的 ; (分号)重启web服务器
    //MYSQL用户需要拥有INSERT update权限
    $m = new M();


    //以下参数为不小心删除了导致无法执行做准备 没有太多实际意义 就是些初始值

    if (!defined('DB_USERTABLE')) defined('DB_USERTABLE', 'codepay_user');  //默认的用户数据表
    if (!defined('DB_PREFIX')) defined('DB_PREFIX', 'codepay'); //默认的表前缀
    if (!defined('DB_AUTOCOMMIT')) defined('DB_AUTOCOMMIT', false); //默认使用事物 回滚
    if (!defined('DEBUG')) defined('DEBUG', false); //默认启用调试模式 但这里如果读不到就不启用了

    //初始化结束

    /**
     * 检测订单是否已经处理
     *
     * 以下代码需要安装我们的测试数据才可正常运行。 仅是个参考 请根据需求自行开发
     * 如有开发经验可参考我们的API自行编写否则建议安装测试数据来修改
     * --------------------------------------
     * ★★★ 以插入方式判断订单是否存在 默认只数据库引擎为:InnoDB才会补单 优点：简单高效 兼容性强。
     * ---------------------------------------
     * 开启处理业务失败补单方法：
     * 默认已经开启但数据库引擎需要为:InnoDB 否则业务失败不会再第2次执行
     * 打开codepay_config.php配置文件搜索DB_AUTOCOMMIT修改为define('DB_AUTOCOMMIT', false);
     *
     * 不使用InnoDB引擎也不会影响使用。业务这步调试好后不成功几率几乎不可能出现,除非你的SQL存在问题。
     *----------------------------------------
     *
     * ★★ 以订单状态标识判断是否已经处理 这是最常用的方式。
     * 但步骤繁多(需要考虑脏读的可能) 为了新手易懂下面使用插入方式
     *---------------------------------------
     *---------------------------------------
     * 我不想这样处理业务有其他方式吗？
     * 有的,这只是个示范
     */

    $m->db->autocommit(DB_AUTOCOMMIT);//默认不自动提交 即事物开启 只针对InnoDB引擎有效


    /**
     * 插入到用户付款记录默认codepay_order表使用了2种唯一索引来区分是否已经存在。确保业务只执行一次
     * 以下为作为识别是否已经执行过此笔订单 建议保留 否则您必须确保业务已经处理
     */
    $insertSQL = "INSERT INTO `" . DB_PREFIX . "_order` (`pay_id`, `money`, `price`, `type`, `pay_no`, `param`, `pay_time`, `pay_tag`, `status`, `creat_time`)values(?,?,?,?,?,?,?,?,?,?)";
    $stmt = $m->prepare($insertSQL);//预编译SQL语句
    if (!$stmt) return "数据表:" . DB_PREFIX . "_order  不存在 可能需要重新安装";
    $stmt->bind_param('sddissisii', $pay_id, $money, $price, $type, $pay_no, $param, $pay_time, $pay_tag, $status, $creat_time); //防止SQL注入
    $rs = $stmt->execute(); //执行SQL


    if ($rs && $stmt->affected_rows >= 1) { //插入成功 是首次通知 可以执行业务 
        mysqli_stmt_close($stmt); //关闭上次的预编译
        /**订单第一次执行
         * 执行业务：
         * ----------------------------------------------------------------
         * 以下参考代码需满足以下2个条件、:
         * 1：代码中的【表名】 跟 本程序默认数据库为同一个且MYSQL用户拥有update权限。
         * 2：$pay_id参数： 我们允许用户ID 商户订单号 用户名。 所以需要根据自己需求来开发。
         * ---------------------
         *
         * 需要注意：
         * price是用户提交的金额。 money是用户实际支付金额 。
         * 比如：用户充值100元 如果同一时间2人充值100元 为了区分是谁付款 此时会让他支付100.01 或99.99 价格范围在您设置的范围内
         * 实际支付可能跟原价会有出入,一般是几分的范围。  要用哪个金额参数请根据业务来决定
         *
         *---------------------------------------
         *
         * 将下面用户【表名】 改为您现有储存用户的表名
         * 将下面【金额字段】 改为您现有储存用户金额的字段
         * 将下面【用户ID字段】 改为您现有储存用户ID的字段 如果传递其他唯一标识按需修改 可以从自定义参数中取用户ID
         *
         * ---------------------
         * 充值:
         * 参考代码：（并不是必须使用我们的参考代码）
         * ----------------------------------------------------------------
         * $stmt = $m->prepare("update 表名 set 金额字段=金额字段+{$money} where 用户ID字段=?");
         * $stmt->bind_param('s', $pay_id);  //$pay_id 为您传递的参数 可以是用户ID 用户名 订单号。
         * $rs=$stmt->execute();
         * ----------------------------------------------------------------
         *
         * 购买: (修改方法同上)
         * 参考代码： （并不是必须使用我们的参考代码）
         * ----------------------------------------------------------------
         * $stmt = $m->prepare("update 表名 set 支付状态字段=1 where 订单ID=?");
         * //update 表名 set vip=1 where 用户ID=?  //购买会员服务参考代码。
         * $stmt->bind_param('s', $pay_id); //用这种bind_param绑定参数方式是为了安全性防止注入。
         * $rs=$stmt->execute();
         * ----------------------------------------------------------------
         */


        //以下为充值示范的代码 需要改为您的业务代码 如果已经知道开发可直接删除
        //为用户充值demo 修改为自己业务请看上面方法

        $sql = "update `" . DB_USERTABLE . "` set " . DB_USERMONEY . "=" . DB_USERMONEY . "+{$price} where " . DB_USERNAME . "=?";

        //默认sql为：update `codepay_user` set money=money+{$price} where user=?

        $stmt = $m->prepare($sql); //预编译SQL语句

        if ($stmt->error != '') { //捕获错误 这一般是数据表不存在造成
            $result = sprintf("数据表存在问题 ：%s SQL: %s 参数：%s ", $stmt->error, $sql, createLinkstring($data));
            mysqli_stmt_close($stmt); //关闭预编译
            $m->rollback();//回滚
            return $result;
        }

        $stmt->bind_param('s', $pay_id); //绑定参数 防止注入
        $rs = $stmt->execute(); //执行SQL语句

        if ($rs && $stmt->affected_rows >= 1) {

            if (!DB_AUTOCOMMIT) $m->db->commit(); //提交事物
            mysqli_stmt_close($stmt); //关闭预编译
            return 'ok'; //业务处理完成 。

        } else { //如果下次还要处理则应该开启事物 数据库引擎为InnoDB 不支持事物该笔订单是无法再执行到业务处理这个步骤除非是使用订单状态标识区分
            $error_msg = $stmt->error;
            if ($error_msg == '' && $stmt->affected_rows <= 0) {
                $error_msg = '该用户可能不存在 请核对';
            }
            $result = sprintf("业务处理失败了 ：%s SQL: %s 参数：%s ", $error_msg, $sql, createLinkstring($data));
            $m->rollback();//回滚
        }

    } else if ($stmt->errno == 1062) {

        return 'success';
        //已经存在 表示已经执行过 直接返回ok或success 不要再通知了.
        //如果不支持事物 就算之前执行失败了也是直接返回成功。

    } else {
        $m->rollback();//错误回滚
        if ($stmt->errno == 1146) { //不存在测试数据表
            $result = '您还未安装测试数据 无法使用业务处理示范'; //需在网页执行 install.php 安装测试数据 如访问：http://您的网站/codepay/install.php
        } else {
            $result = sprintf("比较严重的错误必须处理 ：%s SQL: %s 参数：%s \r\nMYSQL信息：%s", $stmt->error, $insertSQL, createLinkstring($data), createLinkstring($stmt));
        }
    }
    mysqli_stmt_close($stmt); //关闭预编译
    return $result;
}


//计算得出通知验证结果
$codepayNotify = new CodepayNotify($codepay_config);
$verify_result = $codepayNotify->verifyAll(); //这里验证的是全部参数 这样软件端也能调试

if ($verify_result) { //验证成功
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //请在这里加上商户的业务逻辑程序代

    //——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
    //获取码支付的通知返回参数，可参考技术文档中异步通知参数列表
    $result = '充值成功';
    //下面的代码我们注释了直接显示的成功  因为 同步跟异步的业务部分需要相同
    // 否则这边执行了但没更改业务 会导致异步那边无法执行业务

//    $result = DemoHandle($_GET); //调用示例业务代码 处理业务获得返回值 传递的参数为post或get参数
//
//    if ($result == 'ok' || $result == 'success') { //如果返回的是业务处理完成
//
//        $result = '充值成功';
//
//    } else {
//        //下面是存在错误 方便调试
//        //logResult($result); //错误写入到日志文本中 用于追查问题
//        $error_msg = defined('DEBUG') && DEBUG ? $result : ''; //正式环境 直接打印no 不返回任何错误信息
//        $result = '充值失败';
//    }


//——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

} else {  //验证失败
    $result = "充值失败";
    $error_msg = defined('DEBUG') && DEBUG ? "签名验证失败了" : '';
    //调试用，写文本函数记录程序运行情况是否正常
    //logResult("验证失败了");
}

$return_url = $_SERVER["SERVER_PORT"] == '80' ? '/' : '//'.$_SERVER['SERVER_NAME'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="Content-Language" content="zh-cn">
    <meta name="apple-mobile-web-app-capable" content="no"/>
    <meta name="apple-touch-fullscreen" content="yes"/>
    <meta name="format-detection" content="telephone=no,email=no"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="white">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>支付详情</title>
    <link href="css/wechat_pay.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" type="text/css" media="screen" href="css/font-awesome.min.css">
    <style>
        .text-success {
            color: #468847;
            font-size: 2.33333333em;
        }

        .text-fail {
            color: #ff0c13;
            font-size: 2.33333333em;
        }

        .text-center {
            text-align: center;
        }

        .text-left {
            text-align: left;
        }

        .error {

            display: block;
            padding: 9.5px;
            margin: 0 0 10px;
            font-size: 13px;
            line-height: 1.42857143;
            color: #333;
            word-break: break-all;
            word-wrap: break-word;
            background-color: #f5f5f5;
            border: 1px solid #ccc;
            border-radius: 4px;

        }
    </style>
</head>

<body>
<div class="body">
    <h1 class="mod-title">
        <span class="ico_log ico-<?php echo (int)$_GET['type'] ?>"></span>
    </h1>

    <div class="mod-ct">
        <div class="order">
        </div>
        <div class="amount" id="money">￥<?php echo (float)$_GET["money"]; ?></div>
        <h1 class="text-center text-<?php echo($result != '充值成功' ? 'fail' : 'success'); ?>"><strong><i
                    class="fa fa-check fa-lg"></i> <?php echo $result; ?></strong></h1>
        <?php echo($error_msg ? "以下错误信息关闭调试模式可隐藏：<div class='error text-left'>{$error_msg}</div>" : ''); ?>
        <div class="detail detail-open" id="orderDetail" style="display: block;">
            <dl class="detail-ct" id="desc">
                <dt>金额</dt>
                <dd><?php echo (float)$_GET["money"] ?></dd>
                <dt>商户订单：</dt>
                <dd><?php echo htmlentities($_GET["pay_id"]) ?></dd>
                <dt>流水号：</dt>
                <dd><?php echo htmlentities($_GET["pay_no"]) ?></dd>
                <dt>付款时间：</dt>
                <dd><?php echo date("Y-m-d H:i:s", (int)$_GET["pay_time"]) ?></dd>
                <dt>状态</dt>
                <dd><?php echo $result; ?></dd>
            </dl>


        </div>

        <div class="tip-text">
        </div>


    </div>
    <div class="foot">
        <div class="inner">
            <p>如未到账请联系我们</p>
        </div>
    </div>

</div>
<div class="copyRight">
    <p>支付合作：<a href="http://codepay.fateqq.com/" target="_blank">码支付</a></p>
</div>
<script>
    setTimeout(function () {
        //这里可以写一些后续的业务
        window.location.href = '<?php echo $return_url?>';
    }, 3000);//3秒后跳转
</script>
</body>
</html>



