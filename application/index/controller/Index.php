<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Request;
use think\Session;
use think\Page;
/*-------------上传所需--------------*/
require '../vendor/sdk/autoload.php';
// 引入鉴权类
use Qiniu\Auth;
// 引入上传类
use Qiniu\Storage\UploadManager;
use Qiniu\Storage\BucketManager;
// 需要填写你的 Access Key 和 Secret Key
/*------------上传所需结束----------*/


class Index extends Controller
{
    //首页展示
    function website()
    {
        return $this->fetch();
    }
    public function index()
    {
        $web =Db::name('webinfo')->where('id',1)->select();

        $close = $web[0]['isclose'];

        if($close == 1){
            exit("<script>alert('站点已经关闭..');location.href='/index/index/website';</script>");
        }
        $this->header();
        //轮播图展示
        $lun = Db::name('suf')->select();
        $this->assign('lun',$lun);
        //排行榜展示
        $song1pic = Db::name('songtype')->where('id',1)->find();
        $song2pic = Db::name('songtype')->where('id',2)->find();
        $song3pic = Db::name('songtype')->where('id',3)->find();
        $song4pic = Db::name('songtype')->where('id',4)->find();
        $this->assign('song1pic',$song1pic);
        $this->assign('song2pic',$song2pic);
        $this->assign('song3pic',$song3pic);
        $this->assign('song4pic',$song4pic);
        $song1 = Db::table('tp_song')->where('song_type=1')->order('view_num desc')->limit(4)->select();
        $song2 = Db::table('tp_song')->where('song_type=2')->order('view_num desc')->limit(4)->select();
        $song3 = Db::table('tp_song')->where('song_type=3')->order('view_num desc')->limit(4)->select();
        $song4 = Db::table('tp_song')->where('song_type=4')->order('view_num desc')->limit(4)->select();


        $song = Db::name('music')->select();
        $this->assign('song',$song);


        $this->assign('song1',$song1);
        $this->assign('song2',$song2);
        $this->assign('song3',$song3);
        $this->assign('song4',$song4);
        //热门歌单展示
        $hotsheet = Db::name('playlist')->order('view_num desc')->limit(4)->select();
        $this->assign('hotsheet',$hotsheet);
        //热门mv展示
        $hotmv = Db::name('mv')->order('view_num desc')->limit(4)->select();
        $this->assign('hotmv',$hotmv);
        //友情链接
        $link = Db::name('link')->where('ishow',1)->select();
        $this->assign('link',$link);

        return $this->fetch();
    }
    function header()
    {
        //查询用户等级
        $user = Session::get('username');
        $result = Db::name('user')->where('username',$user)->select();
        if(!empty($user)){
            $uid = $result[0]['uid'];
            $this->assign('uid',$uid);
        }

        $this->assign('result',$result);
    }

    //-------------------------------------搜索页面展示
    public function seachres()
    {
        // $se = '';
        // $se2 = '';
        // $se3 = '';
        // $this->assign('se',$se);
        // $this->assign('se2',$se2);
        // $this->assign('se3',$se3);
        $this->header();
        return $this->fetch();
    }
    public function doseachres()
    {
        $type = input('param.type');
        $key = input('param.key');
        if(empty(trim($key))){
            exit("<script>alert('请输入搜索内容');history.go(-1)</script>");
        }
        if($type=="音乐"){
            $se = Db::name('song')->where('sname', 'like',"%$key%")->whereOr('singer', 'like',"%$key%")->select();
            if($se){
                $this->assign('se',$se);
                $this->header();
                return $this->fetch('seachres');
            }else{
                exit("<script>alert('无相关内容');location.href='/index/index/seachres';</script>");
            }
        }
        if($type=="MV"){
            $se2 = Db::name('mv')->where('vname','like',"%$key%")->whereOr('vsinger','like',"%$key%")->select();
            if($se2){
                $this->header();
                $this->assign('se2',$se2);
                return $this->fetch('seachres');
            }else{
                exit("<script>alert('无相关内容');location.href='/index/index/seachres';</script>");
            }
        }
        if($type=="歌单"){
            $se3 = Db::name('playlist')->where('pname','like',"%$key%")->select();
            if($se3){
                $this->header();
                $this->assign('se3',$se3);
                return $this->fetch('seachres');
            }else{
                exit("<script>alert('无相关内容');location.href='/index/index/seachres';</script>");
            }

        }


    }
    //--------------------------------------歌手列表
     function singerlist()
    {
        //展示全部歌手信息
        $singer = Db::name('singer')->field('aid,pic,singer_name,province')->select();
        $this->assign('singer',$singer);
        $this->header();
        return $this->fetch();
    }
    //歌手展示
    public function singerinfo()
    {
        //获取歌手aid
        $aid = input('param.aid');
        //查询歌手信息
        $singer = Db::name('singer')->where('aid',$aid)->select();
        $this->assign('singer',$singer);
        $this->header();
        return $this->fetch();
    }
    //----------------------------------歌曲列表展示
    public function songlist()
    {
        $this->header();
        //查询歌曲类别
        $type =Db::name('songtype')->select();
        // dump($type);
        $this->assign('type',$type);

        //查询歌曲
        $id = input('get.id');
        if (!empty($id)) {
            $sel = Db::name('song')->where('song_type',$id)->select();
            $this->assign('sel',$sel);
        }
        return $this->fetch();

    }
    public function songlist2()
    {
        $this->header();
        //查询歌曲类别
        $type =Db::name('songtype')->select();
        // dump($type);
        $this->assign('type',$type);
        //查询歌曲
        $id = input('param.id');
        if (!empty($id)) {
            $sel = Db::name('song')->where('song_type',$id)->select();
            $this->assign('sel',$sel);
            return $this->fetch();
        }


    }
    /*------------------------------------歌曲ajax分页----------------------------*/
    function songajax()
    {
        $sel = Db::name('song')->select();
        $total = Db::name('song')->count();
        $page = new Page(10, $total);
        $sql = DB::query('select * from tp_song limit ' . $page->limit());
        $data = [];
        foreach ($sql as $key => $value) {
            if($value['ispay'] == 1){
                $value['ispay'] = '会员专属';
            }else{
                $value['ispay'] = '免费试听';
            }
            $data[] = $value;
        }
        $sql = $data;

        $value['data'] = $sql;
        $value['allPage'] = $page->allPage();
        echo json_encode($value);
    }
    //------------------------------------歌单列表展示
    public function songsheet()
    {
        //歌单类型展示
        $type =Db::name('playtype')->select();
        $this->assign('type',$type);
        //查询歌曲
        $id = input('get.id');
        if (!empty($id)) {
            $sel = Db::name('playlist')->where('play_type',$id)->select();
        }else{
             $sel = Db::name('playlist')->select();
        }
        $this->assign('sel',$sel);
        $this->header();
        return $this->fetch();
    }
    //------------------------------------歌单里的歌曲展示-------------------------
    function playlist()
    {
        //歌单基本信息
        $pid = input('get.pid');
        $sel = Db::name('playlist')->where('pid',$pid)->select();
        $this->assign('sel',$sel);
        //首先增加点击量
        $add = Db::name('playlist')->where('pid',$pid)->setInc('view_num');
        //歌单所属类型
        $type = Db::name('playtype')->where('id',$sel[0]['play_type'])->value('playname');
        $this->assign('type',$type);
        //查询包含的歌曲
        $sid = Db::name('song_play')->where('pid',$sel[0]['pid'])->field('sid')->select();
        if(!empty($sid)){
            $data1 = [];
            foreach ($sid as $key => $value) {
                $song = Db::name('song')->where('sid',$value['sid'])->select();
                $data1[] = $song;
            }
            foreach ($data1 as $key => $value) {
                foreach ($value as $key => $val) {
                    $data[] = $val;
                }
            }
            $this->assign('data',$data);
        }


        $song = Db::name('music')->select();
        $this->assign('song',$song);


        //推荐歌单
        $hot = Db::name('playlist')->order('view_num desc')->limit(6)->select();
        $this->assign('hot',$hot);
        $this->header();
        return $this->fetch();
    }
    /*---------------------------------------歌单收藏---------------------------------*/
    function collectlist()
    {
        //判断是否登录
        $username = Session::get('username');
        if(empty($username)){
            exit("<script>alert('请先登录');history.go(-1)</script>");
        }else{
            //先查询是否收藏过
            $pid = input('param.pid');
            $uid = Db::name('user')->where('username',$username)->field('uid')->find();
            $sel = Db::name('play_user')->where('uid',$uid['uid'])->where('pid',$pid)->select();
            if($sel){
                exit("<script>alert('您已经收藏过');history.go(-1)</script>");
            }else{
                //把该歌单收藏到用户
                $ins = Db::name('play_user')->insert(['pid'=>$pid,'uid'=>$uid['uid']]);
                if($ins){
                    exit("<script>alert('收藏成功');history.go(-1)</script>");
                }else{
                    exit("<script>alert('收藏失败');history.go(-1)</script>");
                }
            }
        }
    }
    /*------------------------------------歌曲收藏--------------------------------------*/
    function collectsong()
    {
        //判断是否登录
        $username = Session::get('username');
        if(empty($username)){
            exit("<script>alert('请先登录');history.go(-1)</script>");
        }else{
            //获取歌曲sid
            $sid = input('param.sid');
            //查询用户id
            $uid = Db::name('user')->where('username',$username)->select();
            $uid = $uid[0]['uid'];
            //先查询是否收藏过
            $sel = Db::name('song_user')->where('uid',$uid)->where('sid',$sid)->select();
            if($sel){
                exit("<script>alert('您已经收藏过');history.go(-1)</script>");
            }else{
                //插入song_user表
                $ins = Db::name('song_user')->insert(['sid'=>$sid,'uid'=>$uid]);
                if($ins){
                    exit("<script>alert('收藏成功');history.go(-1)</script>");
                }else{
                    exit("<script>alert('收藏失败');history.go(-1)</script>");
                }
            }
        }
    }
    //视频mv展示
    function mvlist()
    {
        //查询所有mv
        $sel = Db::name('mv')->select();
        // dump($sel);
        $this->assign('sel',$sel);
        $this->header();
        return $this->fetch();
    }
    /*--------------------------------------------个人资料完善----------------------*/
    function updateuserinfo()
    {
        $this->header();
        return $this->fetch();
    }
    function doupuser()
    {
        $email = input('email');
        $phone = input('phone');
        $signature = input('signature');
        if(empty($email)){
            exit ("<script>alert('邮箱不能为空');history.go(-1);</script>");
        }
        if(empty($phone)){
            exit ("<script>alert('手机号不能为空');history.go(-1);</script>");
        }
        if(!is_numeric($phone)){
            exit ("<script>alert('手机号格式不正确');history.go(-1);</script>");
        }
        $reg = '/\w+@(\w+\.)+(cn|com|org|net|edu)/';
        if (preg_match($reg,$email,$match)){

        }else {
            exit("<script>alert('邮箱格式不正确');history.go(-1);</script>");
        }
        $username = Session::get('username');
        $up = Db::name('user')->where('username',$username)->update(['email'=>$email,'phone'=>$phone,'signature'=>$signature]);
        if($up){
            exit ("<script>alert('恭喜您,资料完善成功');location.href='/index/index/userinfo';</script>");
        }else{
            exit ("<script>alert('资料完善失败');history.go(-1);</script>");
        }

    }
    /*--------------------------------------------个人资料展示----------------------------*/
    public function userinfo()
    {
        //查询用户信息
        $user = Session::get('username');
        if(empty($user)){
            $this->error('请登录啊');
            exit;
        }
        $user = Db::name('user')->where('username',"$user")->select();
        if($user[0]['phone'] == null){
            exit ("<script>alert('请先完善资料');location.href='/index/index/updateuserinfo';</script>");
        }
        // dump($result);
        $this->assign('user',$user);
        $this->header();
        return $this->fetch();
    }
    //---------------------------------------------个人资料修改
    public function doUser()
    {
        //查询用户信息
        $user = Session::get('username');
        $signature =input('param.signature');
        $file = request()->file('image');
        if(empty($signature)){
            exit ("<script>alert('签名为空');history.go(-1);</script>");
        }
        if($file == null){
            $result = Db::name('user')->where('username',$user)->update(['signature'=>$signature]);
            return $this->success('修改成功','index/index/userinfo');
        }else{
            // 移动到框架应用根目录/public/uploads/ 目录下
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
            if($info){
                $data['signature'] = $signature;
                $data['pic'] = '/uploads/'.$info->getSaveName();
                $result = Db::name('user')->where('username',$user)->update($data);
                if($result){
                    $this->success('修改成功','index/index/userinfo');
                }else{
                     exit ("<script>alert('修改失败');history.go(-1);</script>");
                }
            }else{
                // 上传失败获取错误信息
                echo $file->getError();
            }
        }

    }
    /*-------------------------------------------------我的歌单展示-----------------------------------------------*/
    function usersheet()
    {
        $username = Session::get('username');
        $uid = Db::name('user')->where('username',$username)->field('uid')->find();
        $pid = Db::name('play_user')->where('uid',$uid['uid'])->field('pid')->select();
        if(!empty($pid)){
            $data1 = [];
            foreach ($pid as $key => $value) {
                $play = Db::name('playlist')->where('pid',$value['pid'])->select();
                $data1[] = $play;
            }
            $data = [];
            foreach ($data1 as $key => $value) {
                foreach ($value as $key => $val) {
                    $data[]= $val;
                }
            }
            $this->assign('data',$data);
        }
        $this->header();
        return  $this->fetch();
    }
    /*--------------------------------------------删除我的歌单---------------------------------------------------*/
    function cancelsheet()
    {
        $pid = input('param.pid');
        $user = Session::get('username');
        $uid = Db::name('user')->where('username',$user)->select();
        $uid = $uid[0]['uid'];
        //把用户对应的歌单删除
        $cancel = Db::name('play_user')->where('pid',$pid)->where('uid',$uid)->delete();
        if($cancel){
            exit ("<script>alert('删除歌单成功');history.go(-1);</script>");
        }else{
            exit ("<script>alert('删除失败');history.go(-1);</script>");
        }
    }
    /*----------------------------------------------我的歌曲展示---------------------------------------------------*/
    function usersong()
    {
        $user = Session::get('username');
        $uid = Db::name('user')->where('username',$user)->select();
        $uid = $uid[0]['uid'];
        $sid = Db::name('song_user')->where('uid',$uid)->select();
        if(!empty($sid)){
            $data1 = [];
            foreach ($sid as $key => $value) {
                 $song = Db::name('song')->where('sid',$value['sid'])->select();
                 $data1[] = $song;
            }
            foreach ($data1 as $key => $value) {
                foreach ($value as $key => $val) {
                    $data[] = $val;
                }
            }
            $this->assign('data',$data);
        }
        $this->header();
        return $this->fetch();
    }
    /*-------------------------------------------------删除我的歌曲-------------------------------------------------------*/
    function cancelsong()
    {
        $sid = input('param.sid');
        $user = Session::get('username');
        $uid = Db::name('user')->where('username',$user)->select();
        $uid = $uid[0]['uid'];
        if(!empty($sid)){
            $del = Db::name('song_user')->where('uid',$uid)->where('sid',$sid)->delete();
            if($del){
                 exit ("<script>alert('删除成功');history.go(-1);</script>");
            }else{
                 exit ("<script>alert('删除失败');history.go(-1);</script>");
            }
        }
        //多选删除
        $id = $_POST['id'];
        if(!empty($id)){
            foreach ($id as $key => $value) {
                $del = Db::name('song_user')->where('uid',$uid)->where('sid',$value)->delete();
            }
            if($del){
                 exit ("<script>alert('删除成功');history.go(-1);</script>");
            }else{
                 exit ("<script>alert('删除失败');history.go(-1);</script>");
            }
        }
    }
    /*---------------------------------------------------歌曲播放-------------------------------------------------*/
    function songplay()
    {
        $sid = input('param.sid');
        //首先判断是不是免费歌曲  是的话直接播放
        //不是的话 在判断是否登录  之后判断是否是红钻
        $m = Db::name('song')->where('sid',$sid)->field('ispay')->find();
        // dump($m);die;
        if($m['ispay'] == 1){
            $user = Session::get('username');
            //判断是否登录
            if($user){
                $red = Db::name('user')->where('username',$user)->field('isred')->select();
                if($red[0]['isred'] == 0){
                    exit ("<script>alert('红钻专属,请开通红钻会员');history.go(-1);</script>");
                }else{
                    //歌曲id传到页面
                    $this->assign('sid',$sid);
                    //查询sid歌曲表
                    $sel = Db::name('song')->where('sid',$sid)->select();
                    $this->assign('sel',$sel);
                    //首先增加点击量
                    $add = Db::name('song')->where('sid',$sid)->setInc('view_num');
                    //展示推荐列表
                    $hot = Db::name('song')->where('ishot',1)->order('view_num desc')->limit(5)->select();
                    $this->assign('hot',$hot);
                    //查询帖子
                    $post = Db::table('tp_songpost post,tp_user user')->where('post.sid',$sid)->where('post.uid = user.uid')->order('post.create_time desc')->field('post.likes,post.create_time,user.username,post.content,user.pic,post.tid')->select();
                    $this->assign('post',$post);
                }
            }else{
                exit ("<script>alert('红钻用户专属,请先登录');history.go(-1);</script>");
            }
        }else{
            //歌曲id传到页面
            $this->assign('sid',$sid);
            //查询sid歌曲表
            $sel = Db::name('song')->where('sid',$sid)->select();
            $this->assign('sel',$sel);
            //首先增加点击量
            $add = Db::name('song')->where('sid',$sid)->setInc('view_num');
            //展示推荐列表
            $hot = Db::name('song')->where('ishot',1)->order('view_num desc')->limit(5)->select();
            $this->assign('hot',$hot);
            //查询帖子
            $post = Db::table('tp_songpost post,tp_user user')->where('post.sid',$sid)->where('post.uid = user.uid')->order('post.create_time desc')->field('post.likes,post.create_time,user.username,post.content,user.pic,post.tid')->select();
            $this->assign('post',$post);
        }
        $this->header();
        return $this->fetch();
    }
    /*-------------------------------------------------mv播放页面--------------------------------------------*/
    function mvplay()
    {
        //获取播放的vid
        $vid = input('get.vid');
        $this->assign('vid',$vid);
        $sel = Db::name('mv')->where('vid',$vid)->select();
        $this->assign('vid',$vid);
        //增加点播量
        $add = Db::name('mv')->where('vid',$vid)->setInc('view_num');
        $post = Db::table('tp_mvpost post,tp_user user')->where('post.vid',$vid)->where('post.uid = user.uid')->order('post.create_time desc')->field('post.create_time,user.username,post.content,user.pic,post.pid,post.id')->select();
        $data = $this->getTree4($post);
        // dump($data);
        $this->assign('data',$data);
        $this->assign('sel',$sel);
        $this->header();
        return $this->fetch();
    }
    function getTree4($list, $pid=0, $level=1)
    {
        static $newlist = array();
        foreach($list as $key => $value)
            {
            if($value['pid']==$pid)
                {
                $value['level'] = $level;
                $newlist[] = $value;
                unset($list[$key]);
                $this->getTree4($list, $value['id'], $level+1);
                }
            }
        return $newlist;
    }
    /*-----------------------------------------------发表帖子------------------------------------------*/
    function songpost()
    {
        $sid = input('get.sid');
        $user = Session::get('username');
        if($user == null){
            exit ("<script>alert('请先登录');history.go(-1);</script>");
        }
        //查询用户id
        $usel = Db::name('user')->where('username',$user)->field('uid')->select();
        $uid =$usel[0]['uid'];
        $content = trim(input('post.content'));
        if(empty($content)){
             exit ("<script>alert('评论不能为空');history.go(-1);</script>");
        }
        $data = [
            'uid'=>$uid,
            'content'=>$content,
            'sid'=>$sid,
            'create_time'=>time(),
        ];
        $ins = Db::name('songpost')->insert($data);
        if($ins){
            exit ("<script>alert('评论成功');history.go(-1);</script>");
        }

    }
    function mvpost()
    {
        // echo 123;die;
        $vid = input('get.vid');
        $user = Session::get('username');
        if($user == null){
            exit ("<script>alert('请先登录');history.go(-1);</script>");
        }
        //查询用户id
        $usel = Db::name('user')->where('username',$user)->field('uid')->select();
        $uid =$usel[0]['uid'];
        $content = trim(input('post.content'));
        if(empty($content)){
             exit ("<script>alert('评论不能为空');history.go(-1);</script>");
        }
        if(!empty(input('param.id'))){
            $id=input('param.id');
        }else{
            $id=0;
        }
        $data = [
            'uid'=>$uid,
            'content'=>$content,
            'pid'=>$id,
            'vid'=>$vid,
            'create_time'=>time(),
        ];
        $ins = Db::name('mvpost')->insert($data);
        if($ins){
            exit ("<script>alert('评论成功');history.go(-1);</script>");
        }
    }
    /*--------------------------------------------开通会员---------------------------------*/
    function vip()
    {
        $user = Session::get('username');
        $vip = Db::name('user')->where('username',$user)->update(['isred'=>1]);
        if($vip){
            echo json_encode(['status'=>1]);
        }else{
            echo json_encode(['status'=>0]);
        }
    }
    function upload()
    {
        return $this->fetch();
    }
    function doupload()
    {

        $accessKey ="K0tsxNEk7X8KKuoAJVMUumuArd2bRdWR6XVD7FlN";
        $secretKey = "6MeJ2Uwz55KM_j-IoPa7murByxgUBFTOJn6ARohS";
        $bucket = "au521";
        // 构建鉴权对象
        $auth = new Auth($accessKey, $secretKey);
        // 生成上传 Token
        $token = $auth->uploadToken($bucket);
        // 要上传文件的本地路径
        // $filePath = './php-logo.png';
        $filePath = $_FILES['file']['tmp_name'];
        // dump($filePath);
        // 上传到七牛后保存的文件名
        $key = $_FILES['file']['name'];
        // 初始化 UploadManager 对象并进行文件的上传。
        $uploadMgr = new UploadManager();
        // 调用 UploadManager 的 putFile 方法进行文件的上传。
        list($ret, $err) = $uploadMgr->putFile($token, $key, $filePath);
        // echo "\n====> putFile result: \n";
        // if ($err !== null) {
        //     var_dump($err);
        // } else {
        //     var_dump($ret);
        // }

        if($ret['key']){
            $url="http://p3nictroy.bkt.clouddn.com/".$ret['key'];

            exit ("<script>alert('上传成功');history.go(-1);</script>");
        }
    }
}
