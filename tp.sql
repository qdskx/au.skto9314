-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2018-03-01 19:06:18
-- 服务器版本： 5.5.56-log
-- PHP Version: 7.0.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tp`
--

-- --------------------------------------------------------

--
-- 表的结构 `codepay_order`
--

CREATE TABLE `codepay_order` (
  `id` int(11) UNSIGNED NOT NULL,
  `pay_id` varchar(50) NOT NULL COMMENT '用户ID或订单ID',
  `money` decimal(6,2) UNSIGNED NOT NULL COMMENT '实际金额',
  `price` decimal(6,2) UNSIGNED NOT NULL COMMENT '原价',
  `type` int(1) NOT NULL DEFAULT '1' COMMENT '支付方式',
  `pay_no` varchar(100) NOT NULL COMMENT '流水号',
  `param` varchar(200) DEFAULT NULL COMMENT '自定义参数',
  `pay_time` bigint(11) NOT NULL DEFAULT '0' COMMENT '付款时间',
  `pay_tag` varchar(100) NOT NULL DEFAULT '0' COMMENT '金额的备注',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '订单状态',
  `creat_time` bigint(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `up_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用于区分是否已经处理';

--
-- 转存表中的数据 `codepay_order`
--

INSERT INTO `codepay_order` (`id`, `pay_id`, `money`, `price`, `type`, `pay_no`, `param`, `pay_time`, `pay_tag`, `status`, `creat_time`, `up_time`) VALUES
(1, 'admin', '0.10', '0.10', 1, '20180228200040011100180030683526', NULL, 1519784251, '0', 2, 1519784321, '2018-02-28 02:18:41'),
(25, '1', '0.10', '0.10', 1, '20180228200040011100180030741455', NULL, 1519790288, '0', 2, 1519790340, '2018-02-28 03:59:00'),
(27, '1', '0.10', '0.10', 1, '20180228200040011100180030822669', NULL, 1519790387, '0', 2, 1519790395, '2018-02-28 03:59:55'),
(32, '38', '0.10', '0.10', 1, '20180228200040011100180030849809', NULL, 1519797381, '0', 2, 1519797448, '2018-02-28 05:57:28'),
(41, '每天都有川流不息的感觉', '0.10', '0.10', 1, '20180228200040011100180030917232', NULL, 1519798771, '0', 2, 1519798777, '2018-02-28 06:19:37'),
(43, '每天都有川流不息的感觉', '0.10', '0.10', 1, '20180228200040011100180030925065', NULL, 1519798926, '0', 2, 1519798931, '2018-02-28 06:22:11'),
(54, '每天都有川流不息的感觉', '0.10', '0.10', 1, '20180228200040011100180030916083', NULL, 1519799238, '0', 2, 1519799248, '2018-02-28 06:27:28'),
(57, '景', '0.10', '0.10', 1, '20180228200040011100180031182533', NULL, 1519822717, '0', 2, 1519823220, '2018-02-28 13:07:00'),
(58, '景', '0.10', '0.10', 1, '20180228200040011100180031134218', NULL, 1519823231, '0', 2, 1519823251, '2018-02-28 13:07:31'),
(61, '13.10.6', '0.10', '0.10', 1, '20180301200040011100180031304255', NULL, 1519866116, '0', 2, 1519866125, '2018-03-01 01:02:05'),
(63, '13.10.6', '0.10', '0.10', 1, '2018030121001004180210724092', NULL, 1519893451, '0', 2, 1519893493, '2018-03-01 08:38:13');

-- --------------------------------------------------------

--
-- 表的结构 `codepay_user`
--

CREATE TABLE `codepay_user` (
  `id` int(10) NOT NULL COMMENT '用户ID',
  `user` varchar(100) NOT NULL DEFAULT '' COMMENT '用户名',
  `money` decimal(6,2) NOT NULL DEFAULT '0.00' COMMENT '金额',
  `vip` int(1) NOT NULL DEFAULT '0' COMMENT '会员开通',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '会员状态'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `codepay_user`
--

INSERT INTO `codepay_user` (`id`, `user`, `money`, `vip`, `status`) VALUES
(1, 'admin', '0.10', 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `tp_access`
--

CREATE TABLE `tp_access` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(11) NOT NULL,
  `node_id` int(11) NOT NULL,
  `level` tinyint(1) DEFAULT NULL,
  `module` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tp_access`
--

INSERT INTO `tp_access` (`id`, `role_id`, `node_id`, `level`, `module`) VALUES
(146, 3, 12, NULL, NULL),
(147, 3, 8, NULL, NULL),
(148, 3, 10, NULL, NULL),
(149, 3, 11, NULL, NULL),
(150, 3, 22, NULL, NULL),
(151, 3, 2, NULL, NULL),
(152, 3, 4, NULL, NULL),
(153, 3, 5, NULL, NULL),
(154, 3, 6, NULL, NULL),
(155, 3, 7, NULL, NULL),
(161, 4, 8, NULL, NULL),
(162, 4, 10, NULL, NULL),
(163, 4, 4, NULL, NULL),
(164, 4, 5, NULL, NULL),
(168, 5, 10, NULL, NULL),
(169, 5, 5, NULL, NULL),
(218, 1, 12, NULL, NULL),
(219, 1, 9, NULL, NULL),
(220, 1, 31, NULL, NULL),
(221, 1, 32, NULL, NULL),
(222, 1, 8, NULL, NULL),
(223, 1, 10, NULL, NULL),
(224, 1, 11, NULL, NULL),
(225, 1, 22, NULL, NULL),
(226, 1, 27, NULL, NULL),
(227, 1, 28, NULL, NULL),
(228, 1, 34, NULL, NULL),
(229, 1, 36, NULL, NULL),
(230, 1, 2, NULL, NULL),
(231, 1, 3, NULL, NULL),
(232, 1, 4, NULL, NULL),
(233, 1, 5, NULL, NULL),
(234, 1, 6, NULL, NULL),
(235, 1, 7, NULL, NULL),
(236, 1, 26, NULL, NULL),
(237, 1, 33, NULL, NULL),
(238, 1, 35, NULL, NULL),
(277, 2, 12, NULL, NULL),
(278, 2, 31, NULL, NULL),
(279, 2, 8, NULL, NULL),
(280, 2, 10, NULL, NULL),
(281, 2, 11, NULL, NULL),
(282, 2, 22, NULL, NULL),
(283, 2, 27, NULL, NULL),
(284, 2, 28, NULL, NULL),
(285, 2, 34, NULL, NULL),
(286, 2, 36, NULL, NULL),
(287, 2, 2, NULL, NULL),
(288, 2, 3, NULL, NULL),
(289, 2, 4, NULL, NULL),
(290, 2, 5, NULL, NULL),
(291, 2, 6, NULL, NULL),
(292, 2, 7, NULL, NULL),
(293, 2, 26, NULL, NULL),
(294, 2, 33, NULL, NULL),
(295, 2, 35, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `tp_classify`
--

CREATE TABLE `tp_classify` (
  `cid` int(10) UNSIGNED NOT NULL,
  `classname` varchar(255) DEFAULT NULL,
  `pid` int(10) DEFAULT NULL,
  `create_time` int(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tp_classify`
--

INSERT INTO `tp_classify` (`cid`, `classname`, `pid`, `create_time`) VALUES
(1, '内地', 0, NULL),
(2, '港台', 0, NULL),
(3, '欧美', 0, NULL),
(4, '韩国', 0, NULL),
(5, '治愈', 1, NULL),
(6, '流行', 1, NULL),
(7, '嘻哈', 1, NULL),
(8, '杰伦', 2, NULL),
(9, '粤语', 2, NULL),
(11, '吧吧吧吧吧吧吧v   v', 4, 1519203629),
(14, 'dsf', 11, 1519788921);

-- --------------------------------------------------------

--
-- 表的结构 `tp_link`
--

CREATE TABLE `tp_link` (
  `lid` smallint(6) NOT NULL,
  `showorder` tinyint(2) NOT NULL DEFAULT '0',
  `name` varchar(30) NOT NULL,
  `url` varchar(255) NOT NULL,
  `description` mediumtext,
  `logo` varchar(255) DEFAULT NULL,
  `addtime` int(12) NOT NULL,
  `ishow` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否被显示'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tp_link`
--

INSERT INTO `tp_link` (`lid`, `showorder`, `name`, `url`, `description`, `logo`, `addtime`, `ishow`) VALUES
(3, 2, 'Yeswan', 'http://www.yeswan.com/', '', '', 1508649284, 0),
(4, 1, '我的领地', 'http://www.5d6d.com/', '', '', 2147483647, 1),
(5, 4, '百度', 'http://www.baidu.com', '', '', 1508999422, 0),
(6, 5, '亡与栀枯', 'http://www.skxto9314.com', '个人网站,bbs论坛', 'hi chuan', 1512395837, 0),
(7, 6, '风花雪月话阳光', 'http://www.skxto9314.com', '若有风来 便随风来 等风走 若有思念来袭 便随思念来 ', '没关系,是爱情', 1512395837, 0);

-- --------------------------------------------------------

--
-- 表的结构 `tp_music`
--

CREATE TABLE `tp_music` (
  `mid` int(10) NOT NULL,
  `musicname` varchar(255) DEFAULT NULL COMMENT '歌曲名',
  `songer` varchar(255) DEFAULT NULL COMMENT '歌手名',
  `img` char(150) DEFAULT NULL COMMENT '专辑图片',
  `songword` varchar(10240) DEFAULT NULL COMMENT '歌词',
  `url` varchar(255) DEFAULT NULL COMMENT '歌曲地址',
  `long` varchar(255) DEFAULT NULL COMMENT '时长'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tp_music`
--

INSERT INTO `tp_music` (`mid`, `musicname`, `songer`, `img`, `songword`, `url`, `long`) VALUES
(9, '明天你好', '牛奶咖啡', 'sd', '[00:00.00]牛奶咖啡-明天，你好\\n[00:03.00]作词：王海涛\\n[00:05.00]作曲：牛奶咖啡\\n[00:07.00]编曲：格非口琴：彭坦\\n[00:10.00]箱琴：格非\\n[00:12.00]合声：富妍kiki\\n[00:14.00]\\n[00:15.50]习习\\n[00:18.50]\\n[00:21.80]www.9ku.com\\n[00:23.32]看昨天的我们走远了\\n[00:28.16]在命运广场中央等待\\n[00:33.14]那模糊的肩膀\\n[00:36.66]越奔跑越渺小\\n[00:40.95]\\n[00:42.68]曾经并肩往前的伙伴\\n[00:48.24]在举杯祝福后都走散\\n[00:53.56]只是那个夜晚\\n[00:56.58]我深深的都留藏在心坎\\n[01:00.61]长大以后我只能奔跑\\n[01:05.71]我多害怕黑暗中跌倒\\n[01:10.69]明天你好含着泪微笑\\n[01:15.67]越美好越害怕得到\\n[01:20.67]每一次哭又笑着奔跑\\n[01:25.68]一边失去一边在寻找\\n[01:30.71]明天你好声音多渺小\\n[01:35.78]却提醒我勇敢是什么\\n[01:43.81]\\n[01:59.89]\\n[02:03.17]当我朝着反方向走去\\n[02:08.44]在楼梯的角落找勇气\\n[02:13.50]抖着肩膀哭泣\\n[02:16.50]问自己在哪里\\n[02:21.02]\\n[02:23.20]曾经并肩往前的伙伴\\n[02:27.85]沉默着懂得我的委屈\\n[02:33.24]时间它总说谎\\n[02:36.52]我从不曾失去那些肩膀\\n[02:40.55]长大以后我只能奔跑\\n[02:45.75]我多害怕黑暗中跌倒\\n[02:50.74]明天你好含着泪微笑\\n[02:55.68]越美好越害怕得到\\n[03:00.67]每一次哭又笑着奔跑\\n[03:05.60]一边失去一边在寻找\\n[03:10.81]明天你好声音多渺小\\n[03:15.73]却提醒我\\n[03:20.72]长大以后我只能奔跑\\n[03:25.66]我多害怕黑暗中跌倒\\n[03:30.65]明天你好含着泪微笑\\n[03:35.66]越美好越害怕得到\\n[03:40.43]每一次哭又笑着奔跑\\n[03:45.65]一边失去一边在寻找\\n[03:50.58]明天你好 声音多渺小\\n[03:55.67]却提醒我勇敢是什么\\n[04:03.94]', 'http://p3nictroy.bkt.clouddn.com/牛奶咖啡 - 明天你好.mp3', '4:39'),
(10, '再见', '邓紫棋', '/uploads/20180301/55598406eb2059ac6649fe4e3398e1a1.jpg', '[00:00.00] 邓紫棋 - 再见\\n[00:01.00] 词曲：G.E.M. 邓紫棋\\n[00:02.00] 编曲：Lupo Groinig\\n[00:07.21] 爱情的起点\\n[00:08.48] 都是最美的瞬间\\n[00:12.88] 什么铁达尼的经典\\n[00:15.34] 罗密欧跟茱丽叶\\n[00:19.88] 那些最煽情的电影情节\\n[00:23.41] 都说爱能超越生死离别\\n[00:26.96] 曾经　我们都很坚决\\n\\n[00:29.49] 爱了就不改变\\n[00:34.10] 不要对我说再见\\n[00:36.37] 一句再见　就结束这一切\\n[00:41.19] 能否不要说再见\\n[00:43.38] 你的再见　说得那么明确\\n[00:48.02] 怎么我和你之间\\n[00:50.32] 两个世界　再也没有交接\\n[00:55.51] 如果告别　能不能再见\\n[01:03.68] 我们的照片　纪录幸福到永远\\n[01:09.58] 只是再幸福的画面\\n[01:11.86] 只定格在一瞬间\\n[01:16.79] 那些慢吞吞悲情的音乐\\n[01:20.17] 早说过爱过之后就是离别\\n[01:23.73] 早该相信那些预言\\n[01:27.10] 我们也没有多特别\\n[01:31.93] 不要对我说再见\\n[01:34.19] 一句再见　让爱变得表面\\n[01:38.85] 真的不用说再见\\n[01:41.04] 就算再见　结局不能改变\\n[01:45.76] 就算我和你之间\\n[01:48.16] 两个世界　再也没有交接\\n[01:53.52] 不用抱歉　就真的再见\\n[01:58.75] 如果有缘　我们会再遇见\\n[02:02.28] 反正地球本来就很圆\\n[02:05.62] 就算今天　你要走得\\n多远\\n[02:09.21] 反正就是一条地平线\\n[02:12.91] 反正愿望不一定会实现\\n[02:16.28] 反正承诺不一定要兑现\\n[02:19.81] 反正睡醒是新的一天\\n[02:41.36] 别对我说再见\\n[02:43.77] 一句再见　让爱变得表面\\n[02:48.51] 真的不用说再见\\n[02:50.65] 就算再见　结局不能改变\\n[02:55.55] 就算我和你之间\\n[02:57.73] 两个世界　再也没有交接\\n[03:03.11] 不用抱歉　就真的再见\\n[03:10.85] 爱情到终点　我们只能说再见', 'http://p3nictroy.bkt.clouddn.com/邓紫棋 - 再见.mp3', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `tp_mv`
--

CREATE TABLE `tp_mv` (
  `vid` int(11) NOT NULL,
  `vname` char(50) NOT NULL,
  `vsinger` char(50) NOT NULL,
  `url` varchar(500) DEFAULT NULL COMMENT 'mv来源',
  `vintro` varchar(200) DEFAULT NULL,
  `pic` varchar(200) NOT NULL,
  `view_num` int(11) NOT NULL DEFAULT '0',
  `ishot` tinyint(2) NOT NULL DEFAULT '0',
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `delete_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tp_mv`
--

INSERT INTO `tp_mv` (`vid`, `vname`, `vsinger`, `url`, `vintro`, `pic`, `view_num`, `ishot`, `create_time`, `update_time`, `delete_time`) VALUES
(1, '体面', '于文文', 'http://p3nictroy.bkt.clouddn.com/%E4%BA%8E%E6%96%87%E6%96%87%20-%20%E4%BD%93%E9%9D%A2%20%20%E7%94%B5%E5%BD%B1%E3%80%8A%E5%89%8D%E4%BB%BB3%EF%BC%9A%E5%86%8D%E8%A7%81%E5%89%8D%E4%BB%BB%E3%80%8B%E6%8F%92%E6%9B%B2.mp4', '电影《前任3》主题曲', '/static/index/fengmian/mv/timian.jpg', 31, 1, NULL, NULL, NULL),
(2, '你还要我怎样', '薛之谦', 'http://p3nictroy.bkt.clouddn.com/%E8%96%9B%E4%B9%8B%E8%B0%A6%20-%20%E4%BD%A0%E8%BF%98%E8%A6%81%E6%88%91%E6%80%8E%E6%A0%B7.mp4', '电影《前任3》主题曲', '/static/index/fengmian/mv/nihaiyaowozenyang.jpg', 17, 1, NULL, NULL, NULL),
(3, '告白气球', '周二珂', 'http://p3nictroy.bkt.clouddn.com/%E5%91%A8%E4%BA%8C%E7%8F%82%20-%20%E5%91%8A%E7%99%BD%E6%B0%94%E7%90%83.mp4', '周二珂《告白气球》', '/static/index/fengmian/mv/gaobaiqiqiu.jpg', 12, 1, NULL, NULL, NULL),
(4, '这个世界会好么', '李志', 'http://p3nictroy.bkt.clouddn.com/%E6%9D%8E%E5%BF%97%20-%20%E8%BF%99%E4%B8%AA%E4%B8%96%E7%95%8C%E4%BC%9A%E5%A5%BD%E5%90%972015.mp4', '电影《前任3》主题曲', '/static/index/fengmian/mv/zhegeshijiehuihaome.jpg', 1, 1, NULL, NULL, NULL),
(5, '意外', '薛之谦', 'http://p3nictroy.bkt.clouddn.com/%E8%96%9B%E4%B9%8B%E8%B0%A6%20-%20%E6%84%8F%E5%A4%96.mp4', '薛之谦=意外', '/static/index/fengmian/mv/yiwai.jpg', 1, 1, NULL, NULL, NULL),
(6, '说散就散', '袁娅维', 'http://p3nictroy.bkt.clouddn.com/%E8%A2%81%E5%A8%85%E7%BB%B4%20-%20%E8%AF%B4%E6%95%A3%E5%B0%B1%E6%95%A3.mp4', '说散就散', '/static/index/fengmian/mv/shuosanjiusan.jpg', 9, 1, NULL, NULL, NULL),
(7, '撒发v是', '防水层', 'http://p3nictroy.bkt.clouddn.com/4.mp4', '是DVD', '/uploads/20180228/a7cb7b8f53d42a0cf2dc98978cb9f2ae.jpg', 0, 0, 1519786787, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `tp_mvpost`
--

CREATE TABLE `tp_mvpost` (
  `id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `vid` int(11) NOT NULL,
  `content` varchar(200) NOT NULL,
  `create_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tp_mvpost`
--

INSERT INTO `tp_mvpost` (`id`, `pid`, `uid`, `vid`, `content`, `create_time`) VALUES
(21, 20, 34, 4, '啊上档次v', 1519529213),
(22, 0, 34, 2, '阿斯蒂芬干活', 1519532654),
(23, 0, 39, 1, '客户借款还款', 1519723137),
(24, 23, 39, 1, '记号记号', 1519723152),
(25, 8, 38, 6, '啊上档次v', 1519729018),
(26, 9, 38, 3, '没喝过', 1519799745),
(27, 0, 38, 3, '321231', 1519799755),
(28, 22, 38, 2, '啊哈哈', 1519809664),
(29, 0, 37, 1, '撒地方v', 1519895229),
(30, 22, 37, 2, '1234他', 1519895242);

-- --------------------------------------------------------

--
-- 表的结构 `tp_node`
--

CREATE TABLE `tp_node` (
  `nid` int(11) UNSIGNED NOT NULL,
  `ename` varchar(100) DEFAULT NULL,
  `name` varchar(30) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL COMMENT '父节点,对于父级的id',
  `level` int(10) DEFAULT NULL COMMENT '项目1模块2操作3'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tp_node`
--

INSERT INTO `tp_node` (`nid`, `ename`, `name`, `status`, `pid`, `level`) VALUES
(1, '/admin', '后台', NULL, 0, 1),
(2, '/admin/play', '歌单管理', NULL, 1, 2),
(3, '/admin/permission', '权限管理', NULL, 1, 2),
(4, '/admin/mv', 'mv管理', NULL, 1, 2),
(5, '/admin/song', '歌曲管理', NULL, 1, 2),
(6, '/admin/user', '用户管理', NULL, 1, 2),
(7, '/admin/banner', '轮播管理', NULL, 1, 2),
(8, '/admin/mv/mvlist', 'mv列表', NULL, 4, 3),
(9, '/admin/permission/permisslist', '权限列表', NULL, 3, 3),
(10, '/admin/song/songlist', '歌曲列表', NULL, 5, 3),
(11, '/admin/user/userlist', '用户列表', NULL, 6, 3),
(12, '/admin/play/playlist', '歌单列表', NULL, 2, 3),
(22, '/admin/banner/bannerlist', '轮播列表', NULL, 7, 3),
(26, '/admin/sys', '网站建设', NULL, 1, 2),
(27, '/admin/sys/webinfo', '站点信息', NULL, 26, 3),
(28, '/admin/sys/link', '友情链接', NULL, 26, 3),
(31, '/admin/permission/rolelist', '角色列表', NULL, 3, 3),
(32, '/admin/permission/adminlist', '管理员列表', NULL, 3, 3),
(33, '/admin/singer', '歌手管理', NULL, 1, 2),
(34, '/admin/singer/singerlist', '歌手列表', NULL, 33, 3),
(35, '/admin/classify', '分类管理', NULL, 1, 2),
(36, '/admin/classify/classifylist', '分类列表', NULL, 35, 3);

-- --------------------------------------------------------

--
-- 表的结构 `tp_playlist`
--

CREATE TABLE `tp_playlist` (
  `pid` int(11) NOT NULL,
  `pname` char(50) NOT NULL,
  `pic` varchar(200) NOT NULL,
  `play_type` tinyint(2) NOT NULL DEFAULT '1' COMMENT '1:怀旧，2:电子，3:轻音乐',
  `view_num` int(11) DEFAULT NULL,
  `remark` varchar(200) DEFAULT NULL COMMENT '歌单描述',
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `delete_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tp_playlist`
--

INSERT INTO `tp_playlist` (`pid`, `pname`, `pic`, `play_type`, `view_num`, `remark`, `create_time`, `update_time`, `delete_time`) VALUES
(10, '多一句怕打扰 少一句怕遗憾', '/static/index/fengmian/play/10.jpg', 1, 21, '', 1517638553, NULL, NULL),
(11, '多想回到最初遇见你的时光', '/static/index/fengmian/play/11.jpg', 2, 47, '', 1517638553, NULL, NULL),
(12, '老歌越听越经典  旧人越看越无情', '/static/index/fengmian/play/12.jpg', 3, 23, '', 1517638553, NULL, NULL),
(13, '【喜欢你】可爱的歌名和可爱的你', '/static/index/fengmian/play/13.jpg', 3, 16, '', 1517638553, NULL, NULL),
(14, '我们的青春-周杰伦', '/static/index/fengmian/play/14.jpg', 2, 44, '', 1517638553, NULL, NULL),
(15, '刹车', '/uploads/20180228/b2f6819e6c59ca2722ac485d34a6922d.jpg', 1, NULL, '山东肥城', 1519787247, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `tp_playtype`
--

CREATE TABLE `tp_playtype` (
  `id` int(11) NOT NULL COMMENT '歌单主键',
  `playname` varchar(200) NOT NULL COMMENT '歌单类型名字'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tp_playtype`
--

INSERT INTO `tp_playtype` (`id`, `playname`) VALUES
(1, '怀旧'),
(2, '电子'),
(3, '轻音乐');

-- --------------------------------------------------------

--
-- 表的结构 `tp_play_user`
--

CREATE TABLE `tp_play_user` (
  `pu_id` int(10) UNSIGNED NOT NULL,
  `pid` int(10) NOT NULL,
  `uid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tp_play_user`
--

INSERT INTO `tp_play_user` (`pu_id`, `pid`, `uid`) VALUES
(4, 10, 5),
(6, 10, 1),
(7, 11, 37);

-- --------------------------------------------------------

--
-- 表的结构 `tp_role`
--

CREATE TABLE `tp_role` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `rname` varchar(40) NOT NULL,
  `static` tinyint(1) DEFAULT '0',
  `remark` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tp_role`
--

INSERT INTO `tp_role` (`role_id`, `rname`, `static`, `remark`) VALUES
(1, '站长', 0, '拥有本站的所有权限'),
(2, '超级管理员', 0, '拥有本站管理权限的权限'),
(3, '管理员', 0, '实现对本站的所有素材的管理权限'),
(4, '普通管理员', 0, '管理本站的某一分类的素材管理'),
(5, '傀儡', 0, '空的，这个角色都是空的');

-- --------------------------------------------------------

--
-- 表的结构 `tp_role_user`
--

CREATE TABLE `tp_role_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tp_role_user`
--

INSERT INTO `tp_role_user` (`id`, `role_id`, `user_id`) VALUES
(1, 1, 34),
(2, 2, 35),
(3, 2, 41),
(8, 3, 48),
(11, 5, 51);

-- --------------------------------------------------------

--
-- 表的结构 `tp_singer`
--

CREATE TABLE `tp_singer` (
  `aid` int(11) UNSIGNED NOT NULL,
  `singer_name` varchar(20) DEFAULT NULL,
  `sex` tinyint(1) DEFAULT NULL,
  `province` varchar(50) DEFAULT NULL,
  `intro` varchar(2000) DEFAULT NULL,
  `song` varchar(50) DEFAULT NULL,
  `pic` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tp_singer`
--

INSERT INTO `tp_singer` (`aid`, `singer_name`, `sex`, `province`, `intro`, `song`, `pic`) VALUES
(2, '周杰伦', 1, '台湾', '周杰伦（Jay Chou），1979年1月18日出生于台湾省新北市，中国台湾流行乐男歌手、音乐人、演员、导演、编剧、监制、商人。 2000年发行首张个人专辑《Jay》。2001年发行的专辑《范特西》奠定其融合中西方音乐的风格[1]  。2002年举行“The One”世界巡回演唱会[2]  。2003年成为美国《时代周刊》封面人物[3-4]  。2004年获得世界音乐大奖中国区最畅销艺人奖[5]  。2005年凭借动作片《头文字D》获得台湾电影金马奖、香港电影金像奖最佳新人奖[6]  。2006年起连续三年获得世界音乐大奖中国区最畅销艺人奖[7]  。2007年自编自导的文艺片《不能说的秘密》获得台湾电影金马奖年度台湾杰出电影奖[8]  。 2008年凭借歌曲《青花瓷》获得第19届金曲奖最佳作曲人奖[9]  。2009年入选美国CNN评出的“25位亚洲最具影响力的人物”[10]  ；同年凭借专辑《魔杰座》获得第20届金曲奖最佳国语男歌手奖[11]  。2010年入选美国《Fast Company》评出的“全球百大创意人物”[12]  。2011年凭借专辑《跨时代》再度获得金曲奖最佳国语男歌手奖，并且第4次获得金曲奖最佳国语专辑奖[13]  ；同年主演好莱坞电影《青蜂侠》[14]  。2012年登福布斯中国名人榜榜首[15]  。2014年发行华语乐坛首张数字音乐专辑《哎呦，不错哦》[16]  。2018年举行“地表最强2世界巡回演唱会”[17]  。 演艺事业外，他还涉足商业、设计等领域。2007年成立杰威尔有限公司[18]  。2011年担任华硕笔电设计师并入股香港文化传信集团[19-20]  。 周杰伦热心公益慈善，多次向中国内地灾区捐款捐物。2008年捐款援建希望小学[21]  。2014年担任中国禁毒宣传形象大使[22]  。', NULL, '/static/index/fengmian/tiantiande.jpg'),
(3, '蔡健雅', 0, '新加坡', '蔡健雅（Tanya Chua），1975年1月28日出生于新加坡，祖籍中国江苏省，现定居于台湾。新加坡籍华裔女歌手、中国台湾流行乐女歌手，音乐制作人、词曲创作人。\n1997年在新加坡发行英语专辑《Bored》正式出道；1999年签约宝丽金唱片推出同名国语专辑《Tanya蔡健雅》即入围第11届台湾金曲奖最佳新人奖；2003年将国语唱片签约于台湾华纳唱片，发行专辑《陌生人》；2005年发行专辑《双栖动物》，凭借此专辑入围第17届台湾金曲奖三项提名，获得最佳国语女演唱人奖[1-2]  ；2007年签约亚神娱乐发行专辑《Goodbye & Hello》，凭借此专辑入围第19届台湾金曲奖5项提名，获得最佳专辑制作人奖和最佳国语女歌手奖[3-4]  ；2008年发行专辑《My Space》，凭借此专辑入围第21届台湾金曲奖4项提名[5-6]  ；2011年发行中文专辑《说到爱》和英文专辑《just say so》，凭专辑《说到爱》入围第23届台湾金曲奖6项提名，个人第三次获得台湾金曲奖最佳国语女歌手奖[7-8]  ，成为第一位三度获得金曲奖最佳国语女歌手奖的华语歌手[9]  ；2013年发行专辑《天使与魔鬼的对话》；2014年和2015年作为导师参加CCTV-3综艺节目《中国好歌曲》；2015年发行专辑《失语者》[10]  。', NULL, '/static/index/fengmian/beixunfudexiang.jpg'),
(4, 'rain', NULL, '重庆市', '郑智薰（Rain），1982年6月25日出生于韩国首尔，韩国流行男歌手、演员、编舞师、音乐制作人[1]  。\r\n2002年以艺名Rain发行个人首张专辑《First Drop》[1]  。其后发行了《Rain 2》《It\'s Raining》《Rainism》等专辑[2-4]  ，荣获Mnet亚洲音乐大奖、首尔歌谣大赏、金唱片大赏等韩国音乐奖项[3]  。 2005年成为首位获得中、日、泰三国的亚洲MTV韩国最佳艺人奖的亚洲歌手[6]  [7]  。2006年起在中、美、日、澳、泰等多个国家开启了首个世界巡回演唱会[8-10]  。担任2008年北京奥运会闭幕式和2010年广州亚运会闭幕式表演嘉宾[11-12]  。2008年荣获韩国形象基石奖[13]  ，并以Rain之名被写入大英百科全书网络版[14]  。2011年成为首位两度获选美国《时代周刊》全球最具影响力100人的亚洲艺人[15]  。\r\n2003年首部主演电视剧《尚道上学去》获KBS演技大赏最佳新人奖[16]  。2004年主演《浪漫满屋》获KBS演技大赏优秀男演技奖[17]  。2007年凭电影处女作《电子人也无所谓》获百想艺术大赏最佳男新人奖[18]  。2008年以出演电影《极速赛车手》进军好莱坞[19]  ，2010年凭好莱坞动作片《忍者刺客》荣获美国MTV电影大奖Biggest Badass Star奖，成为首位担任好莱坞主流电影主角并获美国本土电影颁奖奖项的韩星[20]  。同年还荣获好莱坞电影节‘Green Planet Movie Awards’亚洲十佳明星、亚洲文化大使、亚洲最佳艺人三大奖项[21]  。\r\n退伍后于2014年推出亲自作曲作词的专辑《Rain Effect》[22]  ，受邀出演美、中、韩影视作品[23-25]  ，全面同步回归影视歌三栖。\r\n除演艺事业外，他还热心慈善公益并积极宣传推广[26-28]  ，获颁韩国总统表彰状[29]  。', NULL, '/uploads/20180228/41a273770d333a054744e446280b960e.jpg');

-- --------------------------------------------------------

--
-- 表的结构 `tp_song`
--

CREATE TABLE `tp_song` (
  `sid` int(11) NOT NULL,
  `sname` char(50) NOT NULL COMMENT '歌曲名',
  `singer` char(50) NOT NULL COMMENT '作者',
  `pic` varchar(300) NOT NULL COMMENT '歌曲头像',
  `url` varchar(500) NOT NULL COMMENT '来源',
  `intro` varchar(200) DEFAULT NULL,
  `ispay` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否付费',
  `song_type` int(11) NOT NULL COMMENT '1：流行，2：治愈，3：粤语，4：电音',
  `view_num` int(11) NOT NULL DEFAULT '0' COMMENT '点播次数',
  `ishot` int(11) NOT NULL DEFAULT '0' COMMENT '0：非推荐，1：推荐',
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `delete_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tp_song`
--

INSERT INTO `tp_song` (`sid`, `sname`, `singer`, `pic`, `url`, `intro`, `ispay`, `song_type`, `view_num`, `ishot`, `create_time`, `update_time`, `delete_time`) VALUES
(7, 'Wake', 'hillsong young and free', '/static/index/fengmian/wake.jpg', 'http://p3nictroy.bkt.clouddn.com/Wake.mp3', '故事的小黄花，从出生那年就飘着', 0, 4, 146, 1, 123, 123, 123),
(8, '让全世界知道我爱你', '六哲', '/static/index/fengmian/rangquanshijiezhidaowoaini.jpg', 'http://p3nictroy.bkt.clouddn.com/%E5%85%AD%E5%93%B2%20-%20%E8%AE%A9%E5%85%A8%E4%B8%96%E7%95%8C%E7%9F%A5%E9%81%93%E6%88%91%E7%88%B1%E4%BD%A0.mp3', '岁月神偷，金岐玟', 0, 2, 67, 0, NULL, NULL, NULL),
(11, '战争世界', '姚贝娜', '/static/index/fengmian/zhanzhengshijie.jpg', 'http://p3nictroy.bkt.clouddn.com/%E5%A7%9A%E8%B4%9D%E5%A8%9C%20-%20%E6%88%98%E4%BA%89%E4%B8%96%E7%95%8C.mp3', 'retfh', 0, 2, 17, 0, 1517994021, NULL, NULL),
(12, '趁早', '张宇', '/static/index/fengmian/chenzao.jpg', 'http://p3nictroy.bkt.clouddn.com/%E5%BC%A0%E5%AE%87%20-%20%E8%B6%81%E6%97%A9.mp3', '张宇的趁早', 0, 3, 9, 0, 1517994021, NULL, NULL),
(13, '开往春天的地铁', '方便便', '/static/index/fengmian/congnidequanshijieluguo.jpg', 'http://p3nictroy.bkt.clouddn.com/%E6%96%B9%E4%BE%BF%E4%BE%BF%20-%20%E3%80%8A%E4%BB%8E%E4%BD%A0%E7%9A%84%E5%85%A8%E4%B8%96%E7%95%8C%E8%B7%AF%E8%BF%87%E3%80%8B%E7%BA%AF%E9%9F%B3%E4%B9%90%E6%8F%92%E6%9B%B2-%E5%BC%80%E5%BE%80%E6%98%A5%E5%A4%A9%E7%9A%84%E5%9C%B0%E9%93%81.mp3', '从你的全世界路过 插曲', 0, 2, 1, 0, 1517994021, NULL, NULL),
(14, '刚好遇见你', '李玉刚', '/static/index/fengmian/ganghaoyujianni.jpg', 'http://p3nictroy.bkt.clouddn.com/%E6%9D%8E%E7%8E%89%E5%88%9A%20-%20%E5%88%9A%E5%A5%BD%E9%81%87%E8%A7%81%E4%BD%A0.mp3', '李玉刚《刚好遇见你》', 0, 1, 4, 0, NULL, NULL, NULL),
(15, '明天你好', '牛奶咖啡', '/static/index/fengmian/mingtiannihao.jpg', 'http://p3nictroy.bkt.clouddn.com/%E7%89%9B%E5%A5%B6%E5%92%96%E5%95%A1%20-%20%E6%98%8E%E5%A4%A9%E4%BD%A0%E5%A5%BD.mp3', '牛奶咖啡 - 明天你好.mp3', 0, 2, 7, 0, NULL, NULL, NULL),
(16, '红色高跟鞋', '蔡健雅', '/static/index/fengmian/hongsegaogenxie.jpg', 'http://p3nictroy.bkt.clouddn.com/%E8%94%A1%E5%81%A5%E9%9B%85%20-%20%E7%BA%A2%E8%89%B2%E9%AB%98%E8%B7%9F%E9%9E%8B.mp3', '牛奶咖啡 - 明天你好.mp3', 0, 1, 6, 0, NULL, NULL, NULL),
(17, '意外', '薛之谦', '/static/index/fengmian/yiwai.jpg', 'http://p3nictroy.bkt.clouddn.com/%E8%96%9B%E4%B9%8B%E8%B0%A6%20-%20%E6%84%8F%E5%A4%96.mp3', '薛之谦-意外', 0, 1, 3, 0, NULL, NULL, NULL),
(18, '岁月神偷', '金玟岐', '/static/index/fengmian/suiyueshentou.jpg', 'http://p3nictroy.bkt.clouddn.com/%E9%87%91%E7%8E%9F%E5%B2%90%20-%20%E5%B2%81%E6%9C%88%E7%A5%9E%E5%81%B7.mp3', '薛之谦-意外', 0, 1, 0, 0, NULL, NULL, NULL),
(19, '被驯服的象', '蔡健雅', '/static/index/fengmian/beixunfudexiang.jpg', 'http://p3nictroy.bkt.clouddn.com/%E8%94%A1%E5%81%A5%E9%9B%85%20-%20%E8%A2%AB%E9%A9%AF%E6%9C%8D%E7%9A%84%E8%B1%A1.mp3', NULL, 0, 1, 0, 0, NULL, NULL, NULL),
(20, '最美的期待', '周笔畅', '/static/index/fengmian/zuimeideqidai.jpg', 'http://p3nictroy.bkt.clouddn.com/%E5%91%A8%E7%AC%94%E7%95%85%20-%20%E6%9C%80%E7%BE%8E%E7%9A%84%E6%9C%9F%E5%BE%85.mp3', NULL, 0, 1, 45, 1, NULL, NULL, NULL),
(21, '周杰伦', '爱在西元前', '/static/index/fengmian/aizaixiyuanqian.jpg', 'http://p3nictroy.bkt.clouddn.com/%E5%91%A8%E6%9D%B0%E4%BC%A6%20-%20%E7%88%B1%E5%9C%A8%E8%A5%BF%E5%85%83%E5%89%8D.mp3', NULL, 0, 1, 1, 0, NULL, NULL, NULL),
(22, '阿婆说', '陈一发', '/static/index/fengmian/aposhuo.jpg', 'http://p3nictroy.bkt.clouddn.com/%E9%99%88%E4%B8%80%E5%8F%91%E5%84%BF%20-%20%E9%98%BF%E5%A9%86%E8%AF%B4.mp3', NULL, 1, 2, 4, 0, NULL, NULL, NULL),
(23, '甜甜的', '周杰伦', '/static/index/fengmian/tiantiande.jpg', 'http://p3nictroy.bkt.clouddn.com/%E5%91%A8%E6%9D%B0%E4%BC%A6%20-%20%E7%94%9C%E7%94%9C%E7%9A%84.mp3', NULL, 0, 2, 36, 1, NULL, NULL, NULL),
(24, '搁浅', '周杰伦', '/static/index/fengmian/tiantiande.jpg', 'http://p3nictroy.bkt.clouddn.com/%E5%91%A8%E6%9D%B0%E4%BC%A6%20-%20%E6%90%81%E6%B5%85.mp3', NULL, 0, 2, 0, 0, NULL, NULL, NULL),
(25, 'Fade', 'Alan Walker', '/static/index/fengmian/fade.jpg', 'http://p3nictroy.bkt.clouddn.com/Alan%20Walker%20-%20Fade.mp3', NULL, 0, 4, 11, 0, NULL, NULL, NULL),
(26, '童话镇', '陈一发', '/static/index/fengmian/tonghuazhen.jpg', 'http://p3nictroy.bkt.clouddn.com/%E9%99%88%E4%B8%80%E5%8F%91%E5%84%BF%20-%20%E7%AB%A5%E8%AF%9D%E9%95%87.mp3', NULL, 0, 2, 32, 1, NULL, NULL, NULL),
(27, '骄傲的少年', '南征北战', '/static/index/fengmian/jiaoaodeshaonian.jpg', 'http://p3nictroy.bkt.clouddn.com/%E5%8D%97%E5%BE%81%E5%8C%97%E6%88%98%20-%20%E9%AA%84%E5%82%B2%E7%9A%84%E5%B0%91%E5%B9%B4.mp3', NULL, 0, 3, 0, 0, NULL, NULL, NULL),
(28, '简单爱', '周杰伦', '/static/index/fengmian/tiantiande.jpg', 'http://p3nictroy.bkt.clouddn.com/%E5%91%A8%E6%9D%B0%E4%BC%A6%20-%20%E7%AE%80%E5%8D%95%E7%88%B1.mp3', NULL, 0, 3, 4, 0, NULL, NULL, NULL),
(30, '晴天', '周杰伦', '/static/index/fengmian/qingtian.jpg', 'http://p3nictroy.bkt.clouddn.com/%E5%91%A8%E6%9D%B0%E4%BC%A6%20-%20%E6%99%B4%E5%A4%A9.mp3', NULL, 1, 1, 0, 1, NULL, NULL, NULL),
(31, '一路向北', '周杰伦', '/static/index/fengmian/yiluxiangbei.jpg', 'http://p3nictroy.bkt.clouddn.com/%E5%91%A8%E6%9D%B0%E4%BC%A6%20-%20%E4%B8%80%E8%B7%AF%E5%90%91%E5%8C%97.mp3', NULL, 0, 1, 2, 0, NULL, NULL, NULL),
(32, '序曲', '李志', '/static/index/fengmian/xuqu.jpg', 'http://p3nictroy.bkt.clouddn.com/%E6%9D%8E%E5%BF%97%20-%20%E5%BA%8F%E6%9B%B2.mp3', NULL, 0, 4, 11, 0, NULL, NULL, NULL),
(33, '光辉岁月', 'beyond', '/static/index/fengmian/guanghuisuiyue.jpg', 'http://p3nictroy.bkt.clouddn.com/Beyond%20-%20%E5%85%89%E8%BE%89%E5%B2%81%E6%9C%88.mp3', NULL, 0, 3, 8, 0, NULL, NULL, NULL),
(34, '小半', '陈粒', '/static/index/fengmian/xiaoban.jpg', 'http://p3nictroy.bkt.clouddn.com/%E9%99%88%E7%B2%92%20-%20%E5%B0%8F%E5%8D%8A.mp3', NULL, 1, 2, 3, 0, NULL, NULL, NULL),
(35, 'Alive', 'Krewella', '/static/index/fengmian/alive.jpg', 'http://p3nictroy.bkt.clouddn.com/Krewella%20-%20Alive%20%28Original%20Mix%29.mp3', NULL, 0, 4, 2, 0, NULL, NULL, NULL),
(36, '不能和你分手', '赵薇', '/uploads/20180228/8dfe5c0b6af8d2fb5b54b413e74e056b.jpg', 'http://p3nictroy.bkt.clouddn.com/赵薇 - 不能和你分手.mp3', '撒的vf', 0, 1, 4, 0, 1519786012, NULL, NULL),
(37, '再见', '是大法官', '/uploads/20180301/55598406eb2059ac6649fe4e3398e1a1.jpg', 'http://p3nictroy.bkt.clouddn.com/邓紫棋 - 再见.mp3', 'asd', 0, 1, 0, 0, 1519865887, NULL, NULL),
(38, 'Fade', 'Walker/Iselin Solheim', '/uploads/20180301/2afe1ff2ec6dd0d412329380e1dfa623.jpg', 'http://p3nictroy.bkt.clouddn.com/Fade - Alan Walker.mp3', 'acs', 0, 1, 0, 0, 1519868653, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `tp_songpost`
--

CREATE TABLE `tp_songpost` (
  `tid` int(11) NOT NULL,
  `content` varchar(200) NOT NULL,
  `likes` int(11) NOT NULL DEFAULT '0',
  `create_time` int(11) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `sid` int(11) NOT NULL,
  `isup` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tp_songpost`
--

INSERT INTO `tp_songpost` (`tid`, `content`, `likes`, `create_time`, `uid`, `sid`, `isup`) VALUES
(4, 'wef', 3, NULL, 3, 4, 0),
(5, 'erty', 4, NULL, 4, 5, 0),
(10, 'erf', 345, NULL, 4, 4, 0),
(11, 'rt', 456, NULL, 4, 4, 0),
(12, 'wake wake', 0, 1519542316, 3, 7, 0),
(13, 'AXCVBN', 0, 1519550792, 3, 22, 0),
(14, 'SDFVC', 0, 1519652282, 3, 15, 0),
(15, 'SDFVC ASDVF C', 0, 1519652284, 3, 15, 0),
(16, 'WKS', 0, 1519652365, 3, 7, 0),
(17, '和代发货的', 0, 1519656533, 3, 28, 0),
(18, '两节课', 0, 1519722814, 37, 20, 0),
(19, '和环境规划结构', 0, 1519722902, 37, 20, 0),
(20, '（づ￣3￣）づ╭❤～3', 0, 1519809637, 38, 8, 0),
(21, '无色电饭煲v', 0, 1519823290, 43, 34, 0),
(22, '12345他', 0, 1519895214, 37, 26, 0);

-- --------------------------------------------------------

--
-- 表的结构 `tp_songtype`
--

CREATE TABLE `tp_songtype` (
  `id` int(11) NOT NULL,
  `stname` varchar(50) NOT NULL,
  `number` int(11) NOT NULL,
  `cover` varchar(200) DEFAULT NULL COMMENT '歌曲类型封面',
  `pid` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tp_songtype`
--

INSERT INTO `tp_songtype` (`id`, `stname`, `number`, `cover`, `pid`) VALUES
(1, '流行', 1, '/static/index/fengmian/play/1.jpg', NULL),
(2, '治愈', 1, '/static/index/fengmian/play/2.jpg', NULL),
(3, '粤语', 1, '/static/index/fengmian/play/3.jpg', NULL),
(4, '电音', 1, '/static/index/fengmian/play/4.jpg', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `tp_song_play`
--

CREATE TABLE `tp_song_play` (
  `id` int(10) UNSIGNED NOT NULL,
  `sid` int(10) NOT NULL,
  `pid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tp_song_play`
--

INSERT INTO `tp_song_play` (`id`, `sid`, `pid`) VALUES
(13, 10, 10),
(14, 16, 10),
(15, 17, 10),
(16, 30, 10),
(17, 23, 14),
(18, 24, 14),
(28, 17, 14),
(30, 30, 14),
(31, 31, 14),
(32, 8, 11),
(33, 12, 11),
(34, 32, 12),
(35, 33, 12),
(37, 34, 12),
(38, 8, 13),
(39, 14, 13),
(40, 20, 13),
(41, 23, 13),
(42, 11, 12);

-- --------------------------------------------------------

--
-- 表的结构 `tp_song_user`
--

CREATE TABLE `tp_song_user` (
  `su_id` int(11) UNSIGNED NOT NULL,
  `sid` int(11) NOT NULL,
  `uid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tp_song_user`
--

INSERT INTO `tp_song_user` (`su_id`, `sid`, `uid`) VALUES
(6, 7, 4),
(7, 8, 3),
(8, 11, 37),
(9, 28, 3),
(13, 34, 43);

-- --------------------------------------------------------

--
-- 表的结构 `tp_suf`
--

CREATE TABLE `tp_suf` (
  `lid` int(11) NOT NULL,
  `pic` varchar(200) NOT NULL COMMENT '图片',
  `url` varchar(200) NOT NULL COMMENT '来源',
  `intro` varchar(200) NOT NULL COMMENT '介绍'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tp_suf`
--

INSERT INTO `tp_suf` (`lid`, `pic`, `url`, `intro`) VALUES
(1, '/static/index/fengmian/wake.jpg', '/index/index/songplay?sid=7', 'hillsong young and free乐队 歌曲《wake》'),
(2, '/static/index/fengmian/mv/gaobaiqiqiu.jpg', '/index/index/mvplay?vid=3', '告白气球 周二珂深情演唱'),
(3, '/uploads/20180228/5a6c015d4759d9ee997d5c24962692ff.jpg', '/index/index/songplay?sid=11', '战争世界  姚贝娜'),
(4, '/static/index/fengmian/yiluxiangbei.jpg', '/index/index/songplay?sid=31', '第六届百事音乐风云榜颁奖盛典最佳影视歌曲提名《一路向北》'),
(5, '/static/index/fengmian/tonghuazhen.jpg', '/index/index/songplay?sid=26', ' 《童话镇》   2016年度云音乐分享排名第八名的佳绩');

-- --------------------------------------------------------

--
-- 表的结构 `tp_user`
--

CREATE TABLE `tp_user` (
  `uid` int(11) NOT NULL,
  `username` char(16) NOT NULL,
  `password` char(32) DEFAULT NULL,
  `email` char(32) DEFAULT NULL,
  `phone` bigint(11) DEFAULT NULL,
  `sex` int(2) DEFAULT NULL COMMENT '0:女，1：男',
  `pic` varchar(200) DEFAULT '/static/index/fengmian/tiantiande.jpg',
  `signature` varchar(200) DEFAULT NULL COMMENT '个性签名',
  `type` tinyint(1) DEFAULT '1',
  `undertype` tinyint(2) DEFAULT NULL COMMENT '用户身份的判定,为1时是qq用户,为2时是微博用户,为3时是红钻,为0时拥有奔站的管理权限',
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `delete_time` int(11) DEFAULT NULL,
  `isred` char(10) NOT NULL DEFAULT '0' COMMENT '0：普通 1：红钻',
  `lastime` int(11) DEFAULT NULL,
  `regip` char(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tp_user`
--

INSERT INTO `tp_user` (`uid`, `username`, `password`, `email`, `phone`, `sex`, `pic`, `signature`, `type`, `undertype`, `create_time`, `update_time`, `delete_time`, `isred`, `lastime`, `regip`) VALUES
(1, '景松旺', '200820e3227815ed1756a6b531e7e0d2', '895770532@qq.com', 18435154504, 1, '/uploads/20180228/b8edc0201b5242ff3c98dbaeeb6d87eb.jpg', '啊上档次v', 1, NULL, NULL, NULL, 1, '1.3', NULL, NULL),
(4, '每天都有川流不息的感觉', NULL, NULL, NULL, 0, 'http://tva2.sinaimg.cn/crop.59.194.598.598.180/005LYL94jw8f9vaprry84j30m80ty0ya.jpg', NULL, 3, NULL, NULL, NULL, 2, '0.1', NULL, NULL),
(5, '痴心的迷恋、只等你回眸', NULL, NULL, NULL, 1, 'http://q.qlogo.cn/qqapp/100378832/B7034D5BDAD76A5A284D26079E07E8CC/100', NULL, 2, NULL, NULL, NULL, NULL, '0', NULL, NULL),
(28, '每天都有川流不息的', '3f931c18b44ac93ac5b4b6c653f7c0b0', 'werty@ert.g', 234567, NULL, NULL, NULL, 1, NULL, 1517897566, NULL, NULL, '0', NULL, NULL),
(29, '小样儿', '96f0f08c0188ba04898ce8cc465c19c4', '2608153909@qq.com', 15732863771, NULL, '/uploads/20180201\\0783a4ebd625e2a9a47a386a792e4149.jpg', NULL, 0, NULL, 1517964315, NULL, NULL, '0', NULL, NULL),
(30, '松仔', '96f0f08c0188ba04898ce8cc465c19c4', '2608153909@qq.com', 15610911135, NULL, '/uploads/20180201\\0783a4ebd625e2a9a47a386a792e4149.jpg', NULL, 0, NULL, 1517964381, NULL, NULL, '0', NULL, NULL),
(31, '每天每天', '96f0f08c0188ba04898ce8cc465c19c4', 'ewrty@ewrty.ere', 18435154504, NULL, '/uploads/20180201\\0783a4ebd625e2a9a47a386a792e4149.jpg', NULL, 1, NULL, 1517984774, NULL, NULL, '0', NULL, NULL),
(32, '每天', '0e9fc7aa1d02215abd9010ba731f0042', '我问他2345', 2345678, NULL, '/uploads/20180201\\0783a4ebd625e2a9a47a386a792e4149.jpg', NULL, 1, NULL, 1517984815, NULL, NULL, '0', NULL, NULL),
(33, '每每', '040b7cf4a55014e185813e0644502ea9', 'wert@wert.dsfg', 234565, NULL, '/uploads/20180201\\0783a4ebd625e2a9a47a386a792e4149.jpg', NULL, 1, NULL, 1517987209, NULL, NULL, '0', NULL, NULL),
(34, 'me', '7815696ecbf1c96e6894b779456d330e', '2608153909@qq.com', 15732863771, NULL, 'http://q.qlogo.cn/qqapp/100378832/B7034D5BDAD76A5A284D26079E07E8CC/100', NULL, 0, NULL, 1518059739, NULL, NULL, '1', NULL, NULL),
(36, 'kaixuan', '200820e3227815ed1756a6b531e7e0d2', '895770532@qq.com', 18435154504, NULL, '/uploads/20180226\\065e3bcda80b41b99f2bbe2bb2038d42.jpg', '321', 1, NULL, NULL, NULL, NULL, '1', NULL, NULL),
(37, '邵凯旋', '200820e3227815ed1756a6b531e7e0d2', '8989@qq.com', 15732863771, NULL, '/uploads/20180228/f1f1b8a6384f2d86b108d0d7f9c48e3a.jpg', '阿斯蒂芬VB', 1, NULL, NULL, NULL, NULL, '0', NULL, NULL),
(39, '_', NULL, NULL, NULL, 1, 'http://thirdqq.qlogo.cn/qqapp/100378832/57F7AA80B3CE9B00917EEB6EC7EAF2AE/100', NULL, 2, NULL, 1519723030, NULL, NULL, '1', NULL, NULL),
(40, '带着灵魂漫步', NULL, NULL, NULL, 1, 'http://thirdqq.qlogo.cn/qqapp/100378832/4366F7441575B29053DB9CB602ECFA51/100', NULL, 2, NULL, 1519723201, NULL, NULL, '1', NULL, NULL),
(41, 'asd', '7815696ecbf1c96e6894b779456d330e', '2608153909@qq.com', 15732863771, NULL, '/uploads/20180201\\0783a4ebd625e2a9a47a386a792e4149.jpg', NULL, 0, NULL, 1519810803, NULL, NULL, '0', NULL, NULL),
(44, 'zxc', '7815696ecbf1c96e6894b779456d330e', '2608153909@qq.com', 15732863771, NULL, '/static/index/fengmian/tiantiande.jpg', NULL, 0, NULL, 1519862313, NULL, NULL, '0', NULL, NULL),
(48, 'asdqw1', '7815696ecbf1c96e6894b779456d330e', '2608153909@qq.com', 15732863771, NULL, '/static/index/fengmian/tiantiande.jpg', NULL, 0, NULL, 1519863060, NULL, NULL, '0', NULL, NULL),
(51, 'asd4', '7815696ecbf1c96e6894b779456d330e', '2608153909@qq.com', 15732863771, NULL, '/static/index/fengmian/tiantiande.jpg', NULL, 0, NULL, 1519864431, NULL, NULL, '0', NULL, NULL),
(53, '赤脚青春', NULL, NULL, NULL, 1, 'http://thirdqq.qlogo.cn/qqapp/100378832/CCCA9B9D25147F9F21C3C8090303AB92/100', NULL, 2, NULL, 1519878631, NULL, NULL, '0', NULL, NULL),
(54, '13.10.6', NULL, NULL, NULL, 1, 'http://thirdqq.qlogo.cn/qqapp/100378832/20AAA41662986CFF12806E12629A5717/100', NULL, 2, NULL, 1519893420, NULL, NULL, '0', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `tp_webinfo`
--

CREATE TABLE `tp_webinfo` (
  `id` int(10) UNSIGNED NOT NULL,
  `url` varchar(200) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `icp` varchar(50) DEFAULT NULL,
  `isclose` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tp_webinfo`
--

INSERT INTO `tp_webinfo` (`id`, `url`, `name`, `icp`, `isclose`) VALUES
(1, 'au.skxto9314.com', '哎呦,不错哦', '冀ICP备17025209号', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `codepay_order`
--
ALTER TABLE `codepay_order`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `main` (`pay_id`,`pay_time`,`money`,`type`,`pay_tag`),
  ADD UNIQUE KEY `pay_no` (`pay_no`,`type`);

--
-- Indexes for table `codepay_user`
--
ALTER TABLE `codepay_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tp_access`
--
ALTER TABLE `tp_access`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tp_classify`
--
ALTER TABLE `tp_classify`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `tp_link`
--
ALTER TABLE `tp_link`
  ADD PRIMARY KEY (`lid`);

--
-- Indexes for table `tp_music`
--
ALTER TABLE `tp_music`
  ADD PRIMARY KEY (`mid`);

--
-- Indexes for table `tp_mv`
--
ALTER TABLE `tp_mv`
  ADD PRIMARY KEY (`vid`);

--
-- Indexes for table `tp_mvpost`
--
ALTER TABLE `tp_mvpost`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tp_node`
--
ALTER TABLE `tp_node`
  ADD PRIMARY KEY (`nid`);

--
-- Indexes for table `tp_playlist`
--
ALTER TABLE `tp_playlist`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `tp_playtype`
--
ALTER TABLE `tp_playtype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tp_play_user`
--
ALTER TABLE `tp_play_user`
  ADD PRIMARY KEY (`pu_id`);

--
-- Indexes for table `tp_role`
--
ALTER TABLE `tp_role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `tp_role_user`
--
ALTER TABLE `tp_role_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tp_singer`
--
ALTER TABLE `tp_singer`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `tp_song`
--
ALTER TABLE `tp_song`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `tp_songpost`
--
ALTER TABLE `tp_songpost`
  ADD PRIMARY KEY (`tid`);

--
-- Indexes for table `tp_songtype`
--
ALTER TABLE `tp_songtype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tp_song_play`
--
ALTER TABLE `tp_song_play`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tp_song_user`
--
ALTER TABLE `tp_song_user`
  ADD PRIMARY KEY (`su_id`);

--
-- Indexes for table `tp_suf`
--
ALTER TABLE `tp_suf`
  ADD PRIMARY KEY (`lid`);

--
-- Indexes for table `tp_user`
--
ALTER TABLE `tp_user`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `tp_webinfo`
--
ALTER TABLE `tp_webinfo`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `codepay_order`
--
ALTER TABLE `codepay_order`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
--
-- 使用表AUTO_INCREMENT `codepay_user`
--
ALTER TABLE `codepay_user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '用户ID', AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `tp_access`
--
ALTER TABLE `tp_access`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=308;
--
-- 使用表AUTO_INCREMENT `tp_classify`
--
ALTER TABLE `tp_classify`
  MODIFY `cid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- 使用表AUTO_INCREMENT `tp_link`
--
ALTER TABLE `tp_link`
  MODIFY `lid` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- 使用表AUTO_INCREMENT `tp_mv`
--
ALTER TABLE `tp_mv`
  MODIFY `vid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- 使用表AUTO_INCREMENT `tp_mvpost`
--
ALTER TABLE `tp_mvpost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- 使用表AUTO_INCREMENT `tp_node`
--
ALTER TABLE `tp_node`
  MODIFY `nid` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- 使用表AUTO_INCREMENT `tp_playlist`
--
ALTER TABLE `tp_playlist`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- 使用表AUTO_INCREMENT `tp_playtype`
--
ALTER TABLE `tp_playtype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '歌单主键', AUTO_INCREMENT=4;
--
-- 使用表AUTO_INCREMENT `tp_play_user`
--
ALTER TABLE `tp_play_user`
  MODIFY `pu_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- 使用表AUTO_INCREMENT `tp_role`
--
ALTER TABLE `tp_role`
  MODIFY `role_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- 使用表AUTO_INCREMENT `tp_role_user`
--
ALTER TABLE `tp_role_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- 使用表AUTO_INCREMENT `tp_singer`
--
ALTER TABLE `tp_singer`
  MODIFY `aid` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- 使用表AUTO_INCREMENT `tp_song`
--
ALTER TABLE `tp_song`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- 使用表AUTO_INCREMENT `tp_songpost`
--
ALTER TABLE `tp_songpost`
  MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- 使用表AUTO_INCREMENT `tp_songtype`
--
ALTER TABLE `tp_songtype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- 使用表AUTO_INCREMENT `tp_song_play`
--
ALTER TABLE `tp_song_play`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- 使用表AUTO_INCREMENT `tp_song_user`
--
ALTER TABLE `tp_song_user`
  MODIFY `su_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- 使用表AUTO_INCREMENT `tp_suf`
--
ALTER TABLE `tp_suf`
  MODIFY `lid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- 使用表AUTO_INCREMENT `tp_user`
--
ALTER TABLE `tp_user`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- 使用表AUTO_INCREMENT `tp_webinfo`
--
ALTER TABLE `tp_webinfo`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
