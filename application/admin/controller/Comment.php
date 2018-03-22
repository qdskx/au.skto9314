<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Page;

class Comment extends Controller
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
	
	// ~~~~~~~~~~		mv评论列表		~~~~~~~~~~~~~~~~~
	public function mvcomlist()
	{
		$this->vertify();
		$node = session('node');

		$ename = [];

		foreach($node as $value)
		{
			$ename[] = $value['ename'];
		}

		if(!in_array('/admin/mv', $ename))
		{
			exit ("<script>alert('您并没有此权限');history.go(-1);</script>");
		}
		$vid = input('param.vid');

		if(!empty($vid))
		{
			$num = Db::name('mvpost , tp_user')->where("tp_user.uid=tp_mvpost.uid and vid=$vid")->count();

			$page = new Page(3,$num);

			$res = Db::name('mvpost , tp_user')->where("tp_user.uid=tp_mvpost.uid and vid=$vid")->limit($page->limit())->select();
			$allPage = $page->allPage();

			$this->assign('res' , $res);
			$this->assign('num' , $num);
			$this->assign('allPage' , $allPage);
			return $this->fetch();
		}

	}	

	// ~~~~~~~~~~~~~		逐个删除mv评论		~~~~~~~~
	public function delcomv()
	{
		$this->vertify();
		$node = session('node');

		$ename = [];

		foreach($node as $value)
		{
			$ename[] = $value['ename'];
		}

		if(!in_array('/admin/mv', $ename))
		{
			exit ("<script>alert('您并没有此权限');history.go(-1);</script>");
		}
		$tid = input('get.id');
		$res = Db::name('mvpost')->delete($tid);

		
		if($res)
		{
			return json_encode(['state' => 1]);
		}else
		{
			return json_encode(['state' => 0]);
		}
	}

	// ~~~~~~~		批量删除mv评论	~~~~~~~~~
	public function delallmv()
	{
		$this->vertify();
		$node = session('node');

		$ename = [];

		foreach($node as $value)
		{
			$ename[] = $value['ename'];
		}

		if(!in_array('/admin/mv', $ename))
		{
			exit ("<script>alert('您并没有此权限');history.go(-1);</script>");
		}

        foreach ($_GET['all'] as $key => $value) {
            $res =Db::name('mvpost')->delete($value);
        }

		if($res)
		{
			return json_encode(['state' => 1]);
		}else
		{
			return json_encode(['state' => 0]);
		}

	}	

	// ~~~~~~~~~~		歌曲评论列表		~~~~~~~~~~~~~~~~~
	public function songcomlist()
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

		if(!empty($sid))
		{
			$num = Db::name('songpost , tp_user')->where("tp_user.uid=tp_songpost.uid and sid=$sid")->count();

			$page = new Page(3,$num);

			$res = Db::name('songpost , tp_user')->where("tp_user.uid=tp_songpost.uid and sid=$sid")->limit($page->limit())->select();
			$allPage = $page->allPage();

			$this->assign('res' , $res);
			$this->assign('num' , $num);
			$this->assign('allPage' , $allPage);
			return $this->fetch();
		}	
	}

	// ~~~~~~~~~~~~~		逐个删除歌曲评论		~~~~~~~~
	public function delcomsong()
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
		$tid = input('get.tid');
		$res = Db::name('songpost')->delete($tid);

		
		if($res)
		{
			return json_encode(['state' => 1]);
		}else
		{
			return json_encode(['state' => 0]);
		}
	}

	// ~~~~~~~		批量删除歌曲评论	~~~~~~~~~
	public function delallsong()
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

        foreach ($_GET['all'] as $key => $value) {
            $res =Db::name('songpost')->delete($value);
        }

		if($res)
		{
			return json_encode(['state' => 1]);
		}else
		{
			return json_encode(['state' => 0]);
		}

	}
}