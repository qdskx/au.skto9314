<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Page;
use think\Session;
use think\Model\Song as SongModel;
require '../vendor/sdk/autoload.php';
        // 引入鉴权类
use Qiniu\Auth;
// 引入上传类
use Qiniu\Storage\UploadManager;
// 需要填写你的 Access Key 和 Secret Key

// 逐个删除歌曲的时候,用户收藏的第一个歌曲不能删除	？？？？？？？？？？？

class Song extends Controller
{

	public function vertify()
	{
        if(empty(session('uid')))
        {
            exit ("<script>alert('请您先去登录');location.href='/admin/user/login';</script>");
        }

		if(empty(session('node')))
		{
            exit ("<script>alert('抱歉,您没有任何权限,随便玩玩吧');location.href='/admin/index';</script>");
		}
	}

	// ~~~~~~~		歌曲列表	~~~~~~~~~
	public function songlist()
	{
        if(empty(session('uid')))
        {
            exit ("<script>alert('请您先去登录');location.href='/admin/user/login';</script>");
        }

		if(empty(session('node')))
		{
            exit ("<script>alert('抱歉,您没有任何权限,随便玩玩吧');location.href='/admin/index';</script>");
		}

		$node = session('node');

		$ename = [];

		foreach($node as $value)
		{
			$ename[] = $value['ename'];
		}

		if(!in_array('/admin/song/songlist', $ename))
		{
			exit ("<script>alert('您并没有此权限');history.go(-1);</script>");
		}

		$num = Db::name('song , tp_songtype')->where('song_type=id')->count();
		$page = new Page(3,$num);
		$songinfo = Db::name('song , tp_songtype')->where('song_type=id')->order('sid asc')->limit($page->limit())->select();
		$allPage = $page->allPage();
		$this->assign('songinfo' , $songinfo);
		$this->assign('num' , $num);
		$this->assign('allPage' , $allPage);
		return $this->fetch();
	}

	// ~~~~~~~~~~~~~		添加歌曲		~~~~~~
	public function addsong()
	{
		$this->vertify();
		$node = session('node');

		$ename = [];

		foreach($node as $value)
		{
			$ename[] = $value['ename'];
		}

		if(!in_array('/admin/song', $ename))
		{
			exit ("<script>alert('您并没有此权限');history.go(-1);</script>");
		}
		$songtype = Db::name('songtype')->select();
		$this->assign('songtype' , $songtype);
		return  $this->fetch();
	}

	// ~~~~~~~		修改歌曲	~~~~~~~~~~
	public function editsong()
	{
		$this->vertify();
		$node = session('node');

		$ename = [];

		foreach($node as $value)
		{
			$ename[] = $value['ename'];
		}

		if(!in_array('/admin/song', $ename))
		{
			exit ("<script>alert('您并没有此权限');history.go(-1);</script>");
		}
		$songtype = Db::name('songtype')->select();
		$this->assign('songtype' , $songtype);
		$sid = input('get.sid');
		$info = Db::name('song')->where("sid=$sid")->select();
		$this->assign('info' , $info);
		return $this->fetch();
	}

	// ~~~~~~~~~~		执行修改歌曲		~~~~~~~~~~~
	public function doeditsong()
	{
		$this->vertify();
		$node = session('node');

		$ename = [];

		foreach($node as $value)
		{
			$ename[] = $value['ename'];
		}

		if(!in_array('/admin/song', $ename))
		{
			exit ("<script>alert('您并没有此权限');history.go(-1);</script>");
		}
		$sid = input('post.sid');
		$orignInfo = Db::name('song')->where("sid=$sid")->select();

		// 获取表单上传文件 例如上传了001.jpg
		$file = request()->file('file');
	
		if(!empty($file)){
			// 移动到框架应用根目录/public/uploads/ 目录下
			$info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
			$pic= '/uploads/' . $info->getSaveName();

			if($pic != $orignInfo[0]['pic'])
			{
				$data['pic'] = $pic;
			}

		}
	
		$sname = input('post.sname');
		$song_type = input('post.songtype');
		$intro = input('post.intro');

		if($sname != $orignInfo[0]['sname'])
		{
			$data['sname'] = $sname;
		}

		if($song_type != $orignInfo[0]['song_type'])
		{
			$data['song_type'] = $song_type;	
		}
		

		if($intro != $orignInfo[0]['intro'])
		{
			$data['intro'] = $intro;
		}


		$data['sid'] = $sid;
		$data['update_time'] = time();

		$res = Db::name('song')->update($data);

		if($res)
		{
			exit ("<script>alert('更新成功');history.go(-1);</script>");
		}else
		{
			exit ("<script>alert('更新失败');history.go(-1);</script>");
		}
	}

	// ~~~~~~~~		逐个删除歌曲		~~~~~~~~~
	public function delsong()
	{
		$this->vertify();
		$node = session('node');

		$ename = [];

		foreach($node as $value)
		{
			$ename[] = $value['ename'];
		}

		if(!in_array('/admin/song', $ename))
		{
			exit ("<script>alert('您并没有此权限');history.go(-1);</script>");
		}
		$sid = input('param.sid');

		// 删除用户收藏的歌曲
		$res = Db::name('song_user')->where("sid=$sid")->select();
		if($res)
		{	
			$delinuser = Db::name('song_user')->where("sid=$sid")->delete();
		}

		// 在歌单里面删除这首歌曲
		$result = Db::name('song_play')->where("sid=$sid")->select();
		if($result)
		{
			$delinplay = Db::name('song_play')->where("sid=$sid")->delete();
		}

		// 删除歌曲评论表里的歌曲
		$isExists = DB::name('songpost')->where('sid' , $sid)->select();
		if($isExists)
		{
			$delinSongpost = DB::name('songpost')->where("sid=$sid")->delete();
		}

		// 删除歌曲表里的歌曲
		$song = Db::name('song')->where("sid=$sid")->delete();
		if($song)
		{
			return json_encode(['state' => 1]);
		}else
		{
			return json_encode(['state' => 0]);
		}


	}

	// ~~~~~~~		批量删除歌曲	~~~~~~~~
	public function delall()
	{
		$this->vertify();
		$node = session('node');

		$ename = [];

		foreach($node as $value)
		{
			$ename[] = $value['ename'];
		}

		if(!in_array('/admin/song', $ename))
		{
			exit ("<script>alert('您并没有此权限');history.go(-1);</script>");
		}
		foreach($_GET['all'] as $key => $val)
		{
			// 删除用户收藏的歌曲
			$res = Db::name('song_user')->where("sid=$val")->select();
			if($res)
			{	
				$delinuser = Db::name('song_user')->where("sid=$val")->delete();
			}

			// 在歌单里面删除这首歌曲
			$result = Db::name('song_play')->where("sid=$val")->select();
			if($result)
			{
				$delinplay = Db::name('song_play')->where("sid=$val")->delete();
			}

			// 删除歌曲评论表里的歌曲
			$rr = Db::name('songpost')->where('sid' , $val)->select();
			if($rr)
			{
				$delinSongpost = Db::name('songpost')->where("sid=$val")->delete(); 
			}

			// 删除歌曲表里的歌曲
			$song = Db::name('song')->where("sid=$val")->delete();			
		}	

		if($song)
		{
			return json_encode(['state' => 1]);
		}else
		{
			return json_encode(['state' => 0]);
		}

	}

    function doupload()
    {
		$this->vertify();
		$node = session('node');

		$ename = [];

		foreach($node as $value)
		{
			$ename[] = $value['ename'];
		}

		if(!in_array('/admin/song', $ename))
		{
			exit ("<script>alert('您并没有此权限');history.go(-1);</script>");
		}
        $accessKey ="K0tsxNEk7X8KKuoAJVMUumuArd2bRdWR6XVD7FlN";
        $secretKey = "6MeJ2Uwz55KM_j-IoPa7murByxgUBFTOJn6ARohS";
        $bucket = "au521";
        // 构建鉴权对象
        $auth = new Auth($accessKey, $secretKey);
        // 生成上传 Token
        $token = $auth->uploadToken($bucket);
        // 要上传文件的本地路径
        // $filePath = './php-logo.png';
        $filePath = $_FILES['music']['tmp_name'][0];
        // dump($filePath);
        // 上传到七牛后保存的文件名
        $key = $_FILES['music']['name'][0];


        // 初始化 UploadManager 对象并进行文件的上传。
        $uploadMgr = new UploadManager();
        // 调用 UploadManager 的 putFile 方法进行文件的上传。
        list($ret, $err) = $uploadMgr->putFile($token, $key, $filePath);

        if($ret['key']){

        	$url="http://p3nictroy.bkt.clouddn.com/".$ret['key'];
        }

		$data['url'] = $url;
		$file = request()->file('music');
		
		$file = $file[1];

		if(!empty($file)){
			// 移动到框架应用根目录/public/uploads/ 目录下
			// $info = $file->move(ROOT_PATH . 'public' . DS . 'static' . DS . 'uploads' . DS . 'song' );
			$info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
			$data['pic'] = '/uploads/' . $info->getSaveName();

		}

		if(empty(input('post.sname')))
		{
			exit ("<script>alert('请添加歌曲名字');history.go(-1);</script>");
		}

		if(empty(input('post.singer')))
		{
			exit ("<script>alert('请添加歌手');history.go(-1);</script>");
		}

		$data['sname'] = input('post.sname');
		$data['singer'] = input('post.singer');



		if(!empty(input('post.intro')))
		{
			$data['intro'] = input('post.intro');
		}

		$data['song_type'] = input('post.songtype');
		$data['create_time'] = time();

		$aff_id = Db::name('song')->insertGetId($data);

		if($aff_id)
		{	
			exit ("<script>alert('添加歌曲成功');history.go(-1);</script>");
		}else
		{
			exit ("<script>alert('添加歌曲失败');history.go(-1);</script>");
		}

    }

}