<?php
namespace app\admin\controller;
use think\Db;
use think\Controller;
use think\Session;

class Sys extends Controller
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

	

	public function link()
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

		if(!in_array('/admin/sys/link', $ename))
		{
			exit ("<script>alert('您并没有此权限');history.go(-1);</script>");
		}

		$info = Db::name('link')->select();
		$num = Db::name('link')->count();
		$this->assign('info' , $info);
		$this->assign('num' , $num);
		return $this->fetch();
	}

	// ~~~~~~~~~	删除友情链接	~~~~~~~
	public function delink()
	{
		$this->vertify();
		$node = session('node');

		$ename = [];

		foreach($node as $value)
		{
			$ename[] = $value['ename'];
		}

		if(!in_array('/admin/sys', $ename))
		{
			exit ("<script>alert('您并没有此权限');history.go(-1);</script>");
		}
		$lid = input('get.lid');

		$res = Db::name('link')->delete($lid);
		if($res)
		{
			return json_encode(['state' => 1]);
		}else
		{
			return json_encode(['state' => 0]);
		}
	}

	// ~~~~~~~~~	批量删除友情链接	~~~~~~~
	public function delallink()
	{
		$this->vertify();
		$node = session('node');

		$ename = [];

		foreach($node as $value)
		{
			$ename[] = $value['ename'];
		}

		if(!in_array('/admin/sys', $ename))
		{
			exit ("<script>alert('您并没有此权限');history.go(-1);</script>");
		}
         foreach ($_GET['all'] as $key => $value) {
            $res =Db::name('link')->delete($value);           
        }

		if($res)
		{
			return json_encode(['state' => 1]);
		}else
		{
			return json_encode(['state' => 0]);
		}

	}

	public function addlink()
	{
		$this->vertify();
		$node = session('node');

		$ename = [];

		foreach($node as $value)
		{
			$ename[] = $value['ename'];
		}

		if(!in_array('/admin/sys', $ename))
		{
			exit ("<script>alert('您并没有此权限');history.go(-1);</script>");
		}		return $this->fetch();
	}

	public function doaddlink()
	{
		$this->vertify();
		$node = session('node');

		$ename = [];

		foreach($node as $value)
		{
			$ename[] = $value['ename'];
		}

		if(!in_array('/admin/sys', $ename))
		{
			exit ("<script>alert('您并没有此权限');history.go(-1);</script>");
		}
		$name = input('post.name');
		$link = input('post.link');
		$desc = input('post.desc');

		if(empty($name))
		{
			exit ("<script>alert('链接名不能为空');history.go(-1);</script>");
		}
		$data['name'] = $name;

		if(empty($link))
		{
			exit ("<script>alert('链接地址不能为空');history.go(-1);</script>");
		}
		$data['url'] = $link;	
		$data['addtime'] = time();

		$isExists = Db::name('link')->where("name='$name' and url='$link'")->select();

		if($isExists)
		{
			exit ("<script>alert('链接已存在');history.go(-1);</script>");
		}else
		{
			$res = Db::name('link')->insertGetId($data);

			if($res)
			{
				exit ("<script>alert('添加成功');history.go(-1);</script>");
			}else{
				exit ("<script>alert('添加失败');history.go(-1);</script>");
			}			
		}

	
	}	


	public function webinfo()
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

		if(!in_array('/admin/sys/webinfo', $ename))
		{
			exit ("<script>alert('您并没有此权限');history.go(-1);</script>");
		}

		$info = Db::name('webinfo')->select();
		$this->assign('url' , $info[0]['url']);
		$this->assign('name' , $info[0]['name']);
		$this->assign('icp' , $info[0]['icp']);
		$this->assign('isclose' , $info[0]['isclose']);

		return $this->fetch();
	}

	public function update()
	{
		$this->vertify();
		$node = session('node');

		$ename = [];

		foreach($node as $value)
		{
			$ename[] = $value['ename'];
		}

		if(!in_array('/admin/sys', $ename))
		{
			exit ("<script>alert('您并没有此权限');history.go(-1);</script>");
		}
		$status = input('post.close');

		if($status == 1)
		{
			$data['isclose'] = 1;
		}else
		{
			$data['isclose'] = 2;
		}

		$data['id'] = 1;

		$res = Db::name('webinfo')->update($data);

		if(!$res)
		{
			exit ("<script>alert('修改站点失败');history.go(-1);</script>");
		}else{
			// header('location:/admin/sys/webinfo');
			// die;

			exit ("<script>alert('修改站点成功');history.go(-1);</script>");
		}	
	}
}
