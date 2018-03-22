<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Session;
use think\Page;
use think\Model\Play as PlayModel;

class Play extends Controller
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

	// ~~~~~~~		歌单列表	~~~~~~~~~
	public function playlist()
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

		if(!in_array('/admin/play/playlist', $ename))
		{
			exit ("<script>alert('您并没有此权限');history.go(-1);</script>");
		}

		$num = Db::name('playlist,tp_playtype')->where("tp_playlist.play_type=tp_playtype.id")->count();
		$page = new Page(3,$num);
		$playlist = Db::name('playlist,tp_playtype')->where("tp_playlist.play_type=tp_playtype.id")->order('pid asc')->limit($page->limit())->select();
		$allPage = $page->allPage();

		$this->assign('playlist' , $playlist);
		$this->assign('num' , $num);
		$this->assign('allPage' , $allPage);
		return $this->fetch();
	}

	// ~~~~~~~~~~~~~		添加歌单		~~~~~~
	public function addplaylist()
	{
		$this->vertify();
		$node = session('node');

		$ename = [];

		foreach($node as $value)
		{
			$ename[] = $value['ename'];
		}

		if(!in_array('/admin/play', $ename))
		{
			exit ("<script>alert('您并没有此权限');history.go(-1);</script>");
		}
		$play_type = Db::name('playtype')->select();
		$this->assign('play_type' , $play_type);
		return  $this->fetch();
	}

	// ~~~~~~~~~~~~~		执行添加歌单		~~~~~~
	public function doaddplaylist(){

		$this->vertify();
		$node = session('node');

		$ename = [];

		foreach($node as $value)
		{
			$ename[] = $value['ename'];
		}

		if(!in_array('/admin/play', $ename))
		{
			exit ("<script>alert('您并没有此权限');history.go(-1);</script>");
		}
		// 获取表单上传文件 例如上传了001.jpg
		$file = request()->file('file');
	
		if(!empty($file)){
			// 移动到框架应用根目录/public/uploads/ 目录下
			$info = $file->move(ROOT_PATH . 'public' . DS . 'uploads' );
			$data['pic'] = '/uploads/' . $info->getSaveName();

		}
	
		if(empty(input('post.pname')))
		{
			exit ("<script>alert('请添加歌单名字');history.go(-1);</script>");
		}

		$data['pname'] = input('post.pname');

		if(!empty(input('post.remark')))
		{
			$data['remark'] = input('post.remark');
		}

		$data['pid'] = input('post.pid');
		$data['play_type'] = input('post.play_type');
		$data['create_time'] = time();

		$aff_id = Db::name('playlist')->insertGetId($data);

		if($aff_id)
		{	
			exit ("<script>alert('添加成功');history.go(-1);</script>");
		}else
		{
			exit ("<script>alert('添加失败');history.go(-1);</script>");
		}

	}


	// ~~~~~~~~		逐个删除歌单		~~~~~~~~~~
	public function delplaylist()
	{
		$this->vertify();
		$node = session('node');

		$ename = [];

		foreach($node as $value)
		{
			$ename[] = $value['ename'];
		}

		if(!in_array('/admin/play', $ename))
		{
			exit ("<script>alert('您并没有此权限');history.go(-1);</script>");
		}
		$pid = input('param.pid');

		// 先看用户有没有收藏此歌单
		$isExistsuser = Db::name('play_user')->where("pid=$pid")->select();
		if($isExistsuser)
		{
			$delinuser = Db::name('play_user')->where("pid=$pid")->delete();
		}

		// 看即将删除的歌单里有没有歌曲
		$isExists_songplay = Db::name('song_play')->where("pid=$pid")->select();
		if($isExists_songplay)
		{
			$delin_songplay = Db::name('song_play')->where("pid=$pid")->delete();
		}

		$play = Db::name('playlist')->where("pid=$pid")->delete();
		if($play)
		{
			return json_encode(['state' => 1]);
		}else
		{
			return json_encode(['state' => 0]);
		}
	
	}


	// ~~~~~~~		批量删除歌单	~~~~~~~~
	public function delall()
	{
		$this->vertify();
		$node = session('node');

		$ename = [];

		foreach($node as $value)
		{
			$ename[] = $value['ename'];
		}

		if(!in_array('/admin/play', $ename))
		{
			exit ("<script>alert('您并没有此权限');history.go(-1);</script>");
		}
		foreach($_GET['all'] as $key => $val)
		{
			$isExistsuser = Db::name('play_user')->where("pid=$val")->select();
			if($isExistsuser)
			{
				$delinuser = Db::name('play_user')->where("pid=$val")->delete();
			}

			$isExists_songplay = Db::name('song_play')->where("pid=$val")->select();
			if($isExists_songplay)
			{
				$delin_songplay = Db::name('song_play')->where("pid=$val")->delete();
			}

			$play = Db::name('playlist')->where("pid=$val")->delete();
		}

		if($play)
		{
			return json_encode(['state' => 1]);
		}else
		{
			return json_encode(['state' => 0]);
		}

	}







	// ~~~~~~~~~~~~~		修改歌单		~~~~~~
	public function editplaylist()
	{
		$this->vertify();
		$node = session('node');

		$ename = [];

		foreach($node as $value)
		{
			$ename[] = $value['ename'];
		}

		if(!in_array('/admin/play', $ename))
		{
			exit ("<script>alert('您并没有此权限');history.go(-1);</script>");
		}
		$play_type = Db::name('playtype')->select();
		$this->assign('play_type' , $play_type);

		$pid = input('get.pid');
		$info = Db::name('playlist')->where('pid' , $pid)->select();

		$this->assign('info' , $info);
		return $this->fetch();
	}

	// ~~~~~~~~~~~~~		执行修改歌单		~~~~~~
	public function doeditplaylist(){

		$this->vertify();
		$node = session('node');

		$ename = [];

		foreach($node as $value)
		{
			$ename[] = $value['ename'];
		}

		if(!in_array('/admin/play', $ename))
		{
			exit ("<script>alert('您并没有此权限');history.go(-1);</script>");
		}
		$pid = input('post.pid');
		$orignInfo = Db::name('playlist')->where("pid=$pid")->select();

		// 获取表单上传文件 例如上传了001.jpg
		$file = request()->file('file');
	
		if(!empty($file)){
			// 移动到框架应用根目录/public/uploads/ 目录下
			$info = $file->move(ROOT_PATH . 'public' . DS . 'uploads' );
			$pic= '/uploads/' . $info->getSaveName();

			if($pic != $orignInfo[0]['pic'])
			{
				$data['pic'] = $pic;
			}

		}
	
		$pname = input('post.pname');
		$play_type = input('post.play_type');
		$remark = input('post.remark');

		if($pname != $orignInfo[0]['pname'])
		{
			$data['pname'] = $pname;
		}

		if($play_type != $orignInfo[0]['play_type'])
		{
			$data['play_type'] = $play_type;	
		}
		

		if($remark != $orignInfo[0]['remark'])
		{
			$data['remark'] = $remark;
		}


		$data['pid'] = $pid;
		$data['update_time'] = time();

		$res = Db::name('playlist')->update($data);

		if($res)
		{
			exit ("<script>alert('修改成功');history.go(-1);</script>");
		}else
		{
			exit ("<script>alert('修改失败');history.go(-1);</script>");
		}

	}

	// ~~~~~~~~		添加歌曲		~~~~~~~~~~
	public function addsong()
	{
		$this->vertify();
		$node = session('node');

		$ename = [];

		foreach($node as $value)
		{
			$ename[] = $value['ename'];
		}

		if(!in_array('/admin/play', $ename))
		{
			exit ("<script>alert('您并没有此权限');history.go(-1);</script>");
		}
		$song = Db::name('song')->select();
		$this->assign('song' , $song);

		$pid = input('param.pid');

		$this->assign('pid' , $pid);
		return $this->fetch();
	}

	// ~~~~~~~~~~~~~		执行添加歌曲		~~~~~~~~~~
	public function doaddsong()
	{
		$this->vertify();
		$node = session('node');

		$ename = [];

		foreach($node as $value)
		{
			$ename[] = $value['ename'];
		}

		if(!in_array('/admin/play', $ename))
		{
			exit ("<script>alert('您并没有此权限');history.go(-1);</script>");
		}
		$sid = input('param.sid');
		$pid = input('param.pid');



		$isExists = Db::name('song_play')->where("sid=$sid and pid=$pid")->select();
		if($isExists)
		{
			return json_encode(['state' => 2]);
		}else
		{
			$data['sid'] = $sid;
			$data['pid'] = $pid;
			$add = Db::name('song_play')->insertGetId($data);

			if($add)
			{
				return json_encode(['state' => 1]);
			}else
			{
				return json_encode(['state' => 0]);
			}
		}
	}

	// 查看当前歌单的歌曲
	public function songplaylist()
	{
		$this->vertify();
		$node = session('node');

		$ename = [];

		foreach($node as $value)
		{
			$ename[] = $value['ename'];
		}

		if(!in_array('/admin/play', $ename))
		{
			exit ("<script>alert('您并没有此权限');history.go(-1);</script>");
		}

		$pid = input('param.pid');

		if(!empty($pid))
		{
			$num = Db::table('tp_playlist p, tp_song_play sp, tp_song s')->where("p.pid=$pid and sp.pid=p.pid and s.sid=sp.sid")->count();

			$page = new Page(3,$num);

			$res = Db::table('tp_playlist p, tp_song_play sp, tp_song s')->where("p.pid=$pid and sp.pid=p.pid and s.sid=sp.sid")->order('s.sid asc')->limit($page->limit())->select();

			$allPage = $page->allPage();

			$this->assign('num' , $num);
			$this->assign('res' , $res);
			$this->assign('allPage' , $allPage);

			return $this->fetch();
		}
	}

}