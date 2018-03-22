<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Session;
use app\admin\model\Singer as SingerModel;
use think\Page;

class Singer extends Controller
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

	
	// ~~~~~~~		歌手列表	~~~~~~~~~
	public function singerlist()
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

		if(!in_array('/admin/singer/singerlist', $ename))
		{
			exit ("<script>alert('您并没有此权限');history.go(-1);</script>");
		}
		
		
		$num = Db::name('singer')->count();
		$page = new Page(3,$num);
		$singer = Db::name('singer')->limit($page->limit())->select();
		$allPage = $page->allPage();
		$this->assign('singer' , $singer);
		$this->assign('num' , $num);
		$this->assign('allPage' , $allPage);
		return $this->fetch();
	}

	// ~~~~~~~		添加歌手	~~~~~~~~~
	public function addsinger()
	{
		$this->vertify();
		$node = session('node');

		$ename = [];

		foreach($node as $value)
		{
			$ename[] = $value['ename'];
		}

		if(!in_array('/admin/singer', $ename))
		{
			exit ("<script>alert('您并没有此权限');history.go(-1);</script>");
		}
		return $this->fetch();
	}

	// ~~~~~~~		执行添加歌手	~~~~~~~~~
	public function doaddsinger()
	{
		$this->vertify();
		$node = session('node');

		$ename = [];

		foreach($node as $value)
		{
			$ename[] = $value['ename'];
		}

		if(!in_array('/admin/singer', $ename))
		{
			exit ("<script>alert('您并没有此权限');history.go(-1);</script>");
		}
		$sname = input('post.singer');

		if(!empty($sname))
		{
			$res = Db::name('singer')->where("singer_name")->select();
			if($res)
			{	
				exit ("<script>alert('该歌手已存在');history.go(-1);</script>");
			}else
			{
				$data['singer_name'] = $sname;
			}
		}

		$file = request()->file('cover');
		
		if(!empty($file)){
			// 移动到框架应用根目录/public/uploads/ 目录下
			$info = $file->move(ROOT_PATH . 'public' . DS . 'uploads' );
			$data['pic'] = '/uploads/' . $info->getSaveName();

		}else
		{
			exit ("<script>alert('请添加歌手写真');history.go(-1);</script>");		
		}

		$pro = input('post.pro');
		if(empty($pro))
		{
			exit ("<script>alert('请添加歌手归属地');history.go(-1);</script>");					
		}
		$data['province'] = $pro;		

		$remark = input('post.intro');
		if(!empty($remark))
		{
			$data['intro'] = $remark;
		}

		$add = Db::name('singer')->insertGetId($data);

		if($add)
		{	
			exit ("<script>alert('添加歌手成功');history.go(-1);</script>");
		}else
		{
			exit ("<script>alert('添加歌手失败');history.go(-1);</script>");
		}

	}

	// ~~~~~~~		删除歌手	~~~~~~~~~
	public function delsinger()
	{
		$this->vertify();
		$node = session('node');

		$ename = [];

		foreach($node as $value)
		{
			$ename[] = $value['ename'];
		}

		if(!in_array('/admin/singer', $ename))
		{
			exit ("<script>alert('您并没有此权限');history.go(-1);</script>");
		}
		$aid = input('get.aid');
		$res = Db::name('singer')->delete($aid);

		if($res)
		{
			return json_encode(['state' => 1]);
		}else
		{
			return json_encode(['state' => 0]);
		}
	}

	// ~~~~~~~		批量删除歌手	~~~~~~~~~
	public function delall()
	{
		$this->vertify();
		$node = session('node');

		$ename = [];

		foreach($node as $value)
		{
			$ename[] = $value['ename'];
		}

		if(!in_array('/admin/singer', $ename))
		{
			exit ("<script>alert('您并没有此权限');history.go(-1);</script>");
		}
		foreach($_GET['all'] as $value)
		{
			$res = Db::name('singer')->delete($value);			
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