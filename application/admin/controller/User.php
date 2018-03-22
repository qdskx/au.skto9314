<?php
namespace app\admin\controller;
use think\Controller;
use think\Session;
use think\Db;
use think\Model\User as UserModel;
use think\Page;

class User extends Controller
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

	// ~~~~~~~~~~~		用户列表		~~~~~~~~~~
	public function userlist()
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

		if(!in_array('/admin/user/userlist', $ename))
		{
			exit ("<script>alert('您并没有此权限');history.go(-1);</script>");
		}

		// 搜索内容
		$key = input('param.username');

		if(!empty($key))
		{
			$num = Db::name('user')->where("username like '%$key%' and type!=0")->count();
			$page = new Page(3,$num);
			$user = Db::name('user')->where("username like '%$key%' and type!=0")->limit($page->limit())->select();
			$allPage = $page->allPage();

			// 得到了sql语句
			$sql = Db::name('user')->getLastSql();

		}else{
			$num = Db::name('user')->where('type' , '<>' , 0)->count();
			$page = new Page(3,$num);
			$user = Db::name('user')->where("type != 0")->limit($page->limit())->select();
			$allPage = $page->allPage();			
		}			




		$this->assign('allPage' , $allPage);
		
		$this->assign('user' , $user);
		
		$this->assign('num' , $num);
		return $this->fetch();
	}

	// ~~~~~~~~~~~		添加用户		~~~~~~~~~~
	public function adduser()
	{
		$this->vertify();
		$node = session('node');

		$ename = [];

		foreach($node as $value)
		{
			$ename[] = $value['ename'];
		}

		if(!in_array('/admin/user', $ename))
		{
			exit ("<script>alert('您并没有此权限');history.go(-1);</script>");
		}
		return $this->fetch();
	}

	// ~~~~~~~~~~~		执行添加用户		~~~~~~~~~~
	public function doadduser()
	{
		$this->vertify();
		$node = session('node');

		$ename = [];

		foreach($node as $value)
		{
			$ename[] = $value['ename'];
		}

		if(!in_array('/admin/user', $ename))
		{
			exit ("<script>alert('您并没有此权限');history.go(-1);</script>");
		}
		$username = input('post.username');
		$password = input('post.pass');
		$phone = input('post.phone');
		$email = input('post.email');

		$isExistsusername = Db::name('user')->where("username='$username'")->select();

		if(mb_strlen($username) <= 2 || mb_strlen($username) >= 7)
		{
			return json_encode(['state' => 3 , 'msg' => '用户名长度3~6']);
		}else if($isExistsusername)
		{
			return json_encode(['state' => 2]);			
		}

		if(!preg_match("/^1[3|4|5|7|8][0-9]{9}$/" , $phone))
		{
			return json_encode(['state' => 4 , 'msg' => '手机号码不合法']);
		}

		$pattern='/^[\w-]+@([a-zA-Z0-9-]+\.)+((com)|(cn)|(net)|(edu))$/i';
		if(!preg_match($pattern, $email))
		{
			return json_encode(['state' => 5 , 'msg' => '请输入正确的邮箱']);
		}

		if(mb_strlen($password) <3 || mb_strlen($password) >6)
		{
			return json_encode(['state' => 6 , 'msg' => '密码长度3~6']);
		}else if(preg_match("/^[0-9]*$/",$password)){
			 return json_encode(['state' => 7 , 'msg' => '密码不能为纯数字']);
		}

		
		

		$data['username'] = $username;
		$data['password'] = md5($password);
		$data['phone'] = $phone;
		$data['email'] = $email;
		$data['type'] = 1;
		$data['create_time'] = time();

		$aff_id = Db::name('user')->insertGetId($data);

		if($aff_id)
		{
			return json_encode(['state' => 1]);
		}else
		{
			return json_encode(['state' => 0]);
		}
	}

	// ~~~~~~~~~~~~~		逐个删除用户		~~~~~~~~
	public function deluser()
	{
		$this->vertify();
		$node = session('node');

		$ename = [];

		foreach($node as $value)
		{
			$ename[] = $value['ename'];
		}

		if(!in_array('/admin/user', $ename))
		{
			exit ("<script>alert('您并没有此权限');history.go(-1);</script>");
		}
		$uid = input('param.uid');

		$res = Db::name('user')->delete($uid);

		if($res)
		{
			return json_encode(['state' => 1]);
		}else
		{
			return json_encode(['state' => 0]);
		}
	}

	// ~~~~~~~		批量删除用户	~~~~~~~~~
	public function delall()
	{
		$this->vertify();
		$node = session('node');

		$ename = [];

		foreach($node as $value)
		{
			$ename[] = $value['ename'];
		}

		if(!in_array('/admin/user', $ename))
		{
			exit ("<script>alert('您并没有此权限');history.go(-1);</script>");
		}

        foreach ($_GET['all'] as $key => $value) {
            $res = Db::name('user')->delete($value);
        }

		if($res)
		{
			return json_encode(['state' => 1]);
		}else
		{
			return json_encode(['state' => 0]);
		}

	}

	// 拉黑用户
	public function blackuser()
	{
		$this->vertify();
		$node = session('node');

		$ename = [];

		foreach($node as $value)
		{
			$ename[] = $value['ename'];
		}

		if(!in_array('/admin/user', $ename))
		{
			exit ("<script>alert('您并没有此权限');history.go(-1);</script>");
		}
		$uid = input('param.uid');

		$info = Db::name('user')->where("uid=$uid")->select();

		if($info[0]['delete_time'] == 1)
		{
			$data['delete_time'] = 0;
			$res = Db::name('user')->where("uid=$uid")->update($data);
		}else if($info[0]['delete_time'] == 0)
		{
			$data['delete_time'] = 1;
			$res = Db::name('user')->where("uid=$uid")->update($data);
		}

		if($res)
		{
			return json_encode(['state' => 1]);
		}else
		{
			return json_encode(['state' => 0]);
		}
	}

	public function login()
	{
		return $this->fetch();
	}

	public function dologin()
	{

		// $this->vertify();
		$username = input('param.username');
		$password = md5(input('param.password'));

		$isExistsusername = Db::name('user')->where("username='$username' and type=0")->select();
		if($isExistsusername)
		{
			$isExistsuser = Db::name('user')->where("username='$username' and password='$password' and type=0")->select();

			if($isExistsuser)
			{
				$uid = $isExistsusername[0]['uid'];
				$pic = $isExistsusername[0]['pic'];
				Session::set('username' , $username , 'think');
				Session::set('password' , $password , 'think');
				Session::set('uid' , $uid , 'think');
				Session::set('pic' , $pic , 'think');


				header('location:/admin/index');
				die;
			}else
			{
				exit ("<script>alert('密码错误');history.go(-1);</script>");
			}

		}else
		{
			exit ("<script>alert('用户名不存在');history.go(-1);</script>");
		}
	}

	public function loginout()
	{
		session::delete('username' , 'think');
		session::delete('password' , 'think');
		session::delete('uid' , 'think');
		session::delete('pic' , 'think');

		// session::(null);


		

		header('location:/index');
				die;
	}

	// 切换账号
	public function change()
	{
		// $this->vertify();
		session::delete('username' , 'think');
		session::delete('password' , 'think');
		session::delete('uid' , 'think');
		session::delete('pic' , 'think');

		return $this->fetch('/user/login');		
	}

}