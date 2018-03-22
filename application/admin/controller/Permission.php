<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use app\admin\model\Permission as PermissionModel;
use think\Page;
use think\Request;
use think\Session;

class Permission extends Controller
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

		// $request=Request::instance();
  //  		$module= $request->module();
  //  		$controller= $request->controller();
   		
  //  		dump($controller);die;

  //  		$action= $request->action();

  //  		dump($action);die;

  // 		$path='/' . $module.'/'.$controller . '/' . $action;
	}
	
	// ~~~~~~~~~~~~~~~~~~		管理员		~~~~~~~~~~~~~~~~~~~
	// ~~~~~~~		管理员列表		~~~~~~~~~~
	public function adminlist()
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

		if(!in_array('/admin/permission/adminlist', $ename))
		{
			exit ("<script>alert('您并没有此权限');history.go(-1);</script>");
		}

		$num = Db::table('tp_user u , tp_role r,tp_role_user ru')->where('ru.role_id=r.role_id and ru.user_id=u.uid and type=0')->count();
		$page = new Page(3 , $num);
		$admin = Db::table('tp_user u , tp_role r,tp_role_user ru')->where('ru.role_id=r.role_id and ru.user_id=u.uid and type=0')->limit($page->limit())->select();
		$allPage = $page->allPage();

		$this->assign('admin' , $admin);
		$this->assign('num' , $num);
		$this->assign('allPage' , $allPage);
		return $this->fetch();		
	}

	// ~~~~~~~~~~~~~~~~~		添加管理员		~~~~~~~~~~~~~~~~~
	public function addadmin()
	{
		$this->vertify();

		$node = session('node');

		$ename = [];

		foreach($node as $value)
		{
			$ename[] = $value['ename'];
		}

		if(!in_array('/admin/permission', $ename))
		{
			exit ("<script>alert('您并没有此权限');history.go(-1);</script>");
		}	


		$role = Db::name('role')->select();
		$this->assign('role' , $role);
		return $this->fetch();
	}

	// ~~~~~~~~~~~~~~~~~		执行添加管理员		~~~~~~~~~~~~~~~~~
	function doaddadmin()
	{
		$this->vertify();
		$node = session('node');

		$ename = [];

		foreach($node as $value)
		{
			$ename[] = $value['ename'];
		}

		if(!in_array('/admin/permission', $ename))
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
			return json_encode(['state' => 8 , 'msg' => '用户名长度3~6']);
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
		$data['type'] = 0;
		$data['create_time'] = time();
		$data['password'] = md5($password);
		$data['phone'] = $phone;
		$data['email'] = $email;

		$aff_id = Db::name('user')->insertGetId($data);

		if($aff_id)
		{
			$add['role_id'] = input('post.role');
			
			$isExists = Db::name('role_user')->where("user_id=$aff_id")->select();

			if($isExists)
			{
				return json_encode(['state' => 3]);
			}else
			{
				$add['user_id'] = $aff_id;
				$res = Db::name('role_user')->insertGetId($add);

				if($res)
				{
					return json_encode(['state' => 1]);
				}else{
					return json_encode(['state' => 0]);
				}					
			}	

		}else
		{
			return json_encode(['state' => 0]);
		}		
	}

	// ~~~~~~~~~~~~~~~~~		修改管理员		~~~~~~~~~~~~~~~~~
	public function editadmin()
	{
		$this->vertify();
		$node = session('node');

		$ename = [];

		foreach($node as $value)
		{
			$ename[] = $value['ename'];
		}

		if(!in_array('/admin/permission', $ename))
		{
			exit ("<script>alert('您并没有此权限');history.go(-1);</script>");
		}
		$role = Db::name('role')->select();
		$this->assign('role' , $role);
		$uid = input('get.uid');
		$user = Db::table('tp_user u,tp_role r,tp_role_user ru')->where("u.uid=$uid and ru.user_id=u.uid and r.role_id=ru.role_id")->select();
		$this->assign('user' , $user);
		return $this->fetch();
	}

	// ~~~~~~~~~~~~~~~~~		执行修改管理员		~~~~~~~~~~~~~~~~~
	public function doeditadmin()
	{
		$this->vertify();
		
		$node = session('node');

		$ename = [];

		foreach($node as $value)
		{
			$ename[] = $value['ename'];
		}

		if(!in_array('/admin/permission', $ename))
		{
			exit ("<script>alert('您并没有此权限');history.go(-1);</script>");
		}

		$uid = input('post.uid');
		$origin = Db::table('tp_user u,tp_role r,tp_role_user ru')->where("
			u.uid=$uid and ru.user_id=u.uid and r.role_id=ru.role_id")->select();

		
		$username = input('post.username');
		$phone = input('post.phone');
		$email = input('post.email');
		$role = input('post.role');

		if($username != $origin[0]['username'])
		{
			$data['username'] = $username;
		}

		if($phone != $origin[0]['phone'])
		{	
			$data['phone'] = $phone;
		}

		if($email != $origin[0]['email'])
		{
			$data['email'] = $email;
		}

		if($role != $origin[0]['role_id'])
		{
			$roleinfo['role_id'] = $role;
			$roleinfo['id'] = $origin[0]['id'];
			$result = Db::name('role_user')->update($roleinfo);
		}

		$data['uid'] = $uid;

		$res = Db::name('user')->update($data);
		
		if($res)
		{
			return json_encode(['state' => 1]);
		}else
		{
			return json_encode(['state' => 0]);
		}

	}

	// ~~~~~~~~~~~~~~~~~	逐个删除管理员		~~~~~~~~~~~~~~~~~	
	public function deladmin()
	{
		$this->vertify();
		
		$node = session('node');

		$ename = [];

		foreach($node as $value)
		{
			$ename[] = $value['ename'];
		}

		if(!in_array('/admin/permission', $ename))
		{
			exit ("<script>alert('您并没有此权限');history.go(-1);</script>");
		}

		
		$uid = input('param.uid');
		$res = Db::table('tp_user')->delete($uid);	
		$result = Db::table('tp_role_user')->where('user_id' , $uid)->delete();

		if($res && $result)
		{
			return json_encode(['state' => 1]);
		}else
		{
			return json_encode(['state' => 0]);
		}


	}

	// ~~~~~~~~~~~~~~~~~		批量删除管理员		~~~~~~~~~~~~~~~~~
	public function delalladmin()
	{
		$this->vertify();
		
		$node = session('node');

		$ename = [];

		foreach($node as $value)
		{
			$ename[] = $value['ename'];
		}

		if(!in_array('/admin/permission', $ename))
		{
			exit ("<script>alert('您并没有此权限');history.go(-1);</script>");
		}

		

         foreach ($_GET['all'] as $key => $value) {
            $res =Db::name('user')->delete($value);

            $if = Db::name('role_user')->where('user_id' , $value)->select();

	        if($if)
           {
				$result = Db::name('role_user')->where('user_id' , $value)->delete();
           }

			           
        }

		if($res)
		{
			return json_encode(['state' => 1]);
		}else
		{
			return json_encode(['state' => 0]);
		}

	}







	// ~~~~~~~~~~~~~~~~~~		权限		~~~~~~~~~~~~~~~~~~~
	// ~~~~~~~		权限列表		~~~~~~~~~~
	public function permisslist()
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

		if(!in_array('/admin/permission/permisslist', $ename))
		{
			exit ("<script>alert('您并没有此权限');history.go(-1);</script>");
		}

		$node = Db::name('node')->select();
		$node = $this->getTree4($node);
		$num = Db::name('node')->count();
		$this->assign('node' , $node);
		$this->assign('num' , $num);
		return $this->fetch();
	}

	// ~~~~~~~		添加权限		~~~~~~~~~~
	public function addpermiss()
	{
		$this->vertify();
		
		$node = session('node');

		$ename = [];

		foreach($node as $value)
		{
			$ename[] = $value['ename'];
		}

		if(!in_array('/admin/permission', $ename))
		{
			exit ("<script>alert('您并没有此权限');history.go(-1);</script>");
		}

		
		$node = Db::name('node')->select();
		$this->assign('node' , $node);
		return $this->fetch();
	}

	// ~~~~~~~		执行添加权限		~~~~~~~~~~
	public function doaddpermiss()
	{
		$this->vertify();
		
		$node = session('node');

		$ename = [];

		foreach($node as $value)
		{
			$ename[] = $value['ename'];
		}

		if(!in_array('/admin/permission', $ename))
		{
			exit ("<script>alert('您并没有此权限');history.go(-1);</script>");
		}

		
		if(!empty(input('post.ename')) && !empty(input('post.name')) && !empty('post.sort'))
		{
			$ename = input('param.ename');
			$name = input('post.name');
		}
		
		$isExistsename = Db::name('node')->where("ename='$ename'")->select();
		if($isExistsename)
		{
			return json_encode(['state' => 2]);	
		}

		$isExistsname = Db::name('node')->where("name='$name'")->select();
		if($isExistsname)
		{
			return json_encode(['state' => 3]);	
		}

		$data['ename'] = $ename;
		$data['name'] = $name;
		$data['level'] = input('post.level');
		$data['pid'] = input('post.pid');


		$aff_id = Db::name('node')->insertGetId($data);

		if($aff_id)
		{
			return json_encode(['state' => 1]);
		}else
		{
			return json_encode(['state' => 0]);
		}		
	}

	// ~~~~~~~		修改权限	~~~~~~~~~	
	public function editpermiss()
	{
		$this->vertify();
		
		$node = session('node');

		$ename = [];

		foreach($node as $value)
		{
			$ename[] = $value['ename'];
		}

		if(!in_array('/admin/permission', $ename))
		{
			exit ("<script>alert('您并没有此权限');history.go(-1);</script>");
		}

		
		$nid = input('get.nid');
		$nodeinfo = Db::name('node')->where("nid=$nid")->select();

		$info = Db::name('node')->select();

		$this->assign('nodeinfo' , $nodeinfo);
		$this->assign('info' , $info);

		return $this->fetch();
	}

	// ~~~~~~~		执行修改权限	~~~~~~~~~
	public function doeditpermiss()
	{
		$this->vertify();
		
		$node = session('node');

		$ename = [];

		foreach($node as $value)
		{
			$ename[] = $value['ename'];
		}

		if(!in_array('/admin/permission', $ename))
		{
			exit ("<script>alert('您并没有此权限');history.go(-1);</script>");
		}

		
		$nid = input('param.nid');
		$name = input('param.name');
		$classify = input('param.classify');

		$origin = Db::name('node')->where("nid=$nid")->select();

		if($name != $origin[0]['name'])
		{	
			$data['name'] = $name;
		}

		if($classify != $origin[0]['pid'])
		{
			$data['pid'] = $classify;
		}


		$data['nid'] = $nid;
		$res = Db::name('node')->update($data);

		if($res)
		{
			return json_encode(['state' => 1]);
		}else
		{
			return json_encode(['state' => 0]);
		}

	}	

	// ~~~~~~~		删除权限		~~~~~~~~~~
	public function delpermiss()
	{
		$this->vertify();
		
		$node = session('node');

		$ename = [];

		foreach($node as $value)
		{
			$ename[] = $value['ename'];
		}

		if(!in_array('/admin/permission', $ename))
		{
			exit ("<script>alert('您并没有此权限');history.go(-1);</script>");
		}

		
		$nid = input('param.nid');

		$info = Db::name('node')->where("nid=$nid")->select();

		if($info[0]['level'] == 2)
		{
			$all = Db::name('node')->where("nid=$nid or pid=$nid")->select();

			foreach($all as $key => $value)
			{
				$node_id = $value['nid'];

				$isExists = Db::name('access')->where("node_id=$node_id")->select();

				if($isExists)
				{
					$result = Db::name('access')->where("node_id=$node_id")->delete();
				}
						
			}
			
			$res = Db::name('node')->where("nid=$nid or pid=$nid")->delete();
			
		}else if($info[0]['level'] == 3)
		{
			$res = Db::name('node')->delete($nid);

			$isExists = Db::name('access')->where("node_id=$nid")->select();

			if($isExists)
			{
				$result = Db::name('access')->where("node_id=$nid")->delete();
			}

		}else
		{
			return json_encode(['state' => 2]);
		}

		
		if($res)
		{
			return json_encode(['state' => 1]);
		}else
		{
			return json_encode(['state' => 0]);
		}		
	}











	// ~~~~~~~~~~~~~~~~~~		角色		~~~~~~~~~~~~~~~~~~~
	// 无限极分类
    function getTree4($list, $pid=0, $level=1)
    {
		$this->vertify();
		
        static $newlist = array();
        foreach($list as $key => $value)
            {
            if($value['pid']==$pid)
                {
                $value['level'] = $level;
                $newlist[] = $value;
                unset($list[$key]);
                $this->getTree4($list, $value['nid'], $level+1);
                }
            }
        return $newlist;
    }

	// ~~~~~~~		角色列表		~~~~~~~~~~
	public function rolelist()
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

		if(!in_array('/admin/permission/rolelist', $ename))
		{
			exit ("<script>alert('您并没有此权限');history.go(-1);</script>");
		}

		return $this->fetch();
	}

	public function dorolelist()
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

		if(!in_array('/admin/permission/rolelist', $ename))
		{
			exit ("<script>alert('您并没有此权限');history.go(-1);</script>");
		}

		$total = Db::name('role')->count();
		$page = new Page(3 , $total);
		$offset = $page->limit();
		$res['data'] = Db::name('role')->limit( $offset)->select();

		$res['allPage'] = $page->allPage();
		$res['num'] = $total;
		echo json_encode($res);

	}

	// ~~~~~~~		添加角色		~~~~~~~~~~
	public function addrole()
	{
		$this->vertify();
		
		$node = session('node');

		$ename = [];

		foreach($node as $value)
		{
			$ename[] = $value['ename'];
		}

		if(!in_array('/admin/permission', $ename))
		{
			exit ("<script>alert('您并没有此权限');history.go(-1);</script>");
		}

		

		$node = Db::name('node')->select();
		$this->assign('node' , $node);
		return $this->fetch();
	}

	// ~~~~~~~		执行添加角色		~~~~~~~~~~
	public function doaddrole()
	{
		$this->vertify();
		
		$node = session('node');

		$ename = [];

		foreach($node as $value)
		{
			$ename[] = $value['ename'];
		}

		if(!in_array('/admin/permission', $ename))
		{
			exit ("<script>alert('您并没有此权限');history.go(-1);</script>");
		}

		
		$name = input('post.name');

		$isExists = Db::name('role')->where("rname='$name'")->select();

		if($isExists)
		{
			return json_encode(['state' => 2]);
		}

		$data['rname'] = $name;
		$data['remark'] = input('post.remark');

		$aff_id = Db::name('role')->insertGetId($data);

		if($aff_id)
		{
			return json_encode(['state' => 1]);
		}else
		{
			return json_encode(['state' => 0]);
		}
	}

	// ~~~~~~~		逐个删除角色	~~~~~~~~~
	public function delrole()
	{
		$this->vertify();
		
		$node = session('node');

		$ename = [];

		foreach($node as $value)
		{
			$ename[] = $value['ename'];
		}

		if(!in_array('/admin/permission', $ename))
		{
			exit ("<script>alert('您并没有此权限');history.go(-1);</script>");
		}

		
		$role_id = input('param.role_id');
		$res = Db::name('role')->where("role_id=$role_id")->delete();

		// 先判断关联表用户角色表是否存在role_id=$role_id的记录
		$isExists = Db::table('tp_role_user')->where("role_id = $role_id")->select();
		if($isExists)
		{
			$result = Db::table('tp_role_user')->where("role_id=$role_id")->delete();
		}

		// 先判断关联表角色权限表是否存在role_id=$role_id的记录
		$isExists2 = Db::table('tp_access')->where("role_id = $role_id")->select();
		if($isExists2)
		{
			$r = Db::table('tp_access')->where("role_id=$role_id")->delete();
		}	


		if($res)
		{
			return json_encode(['state' => 1]);
		}else
		{
			return json_encode(['state' => 0]);
		}


	}

	// ~~~~~~~		批量删除角色 禁止了!!!	~~~~~~~~~
	public function delall()
	{

		$this->vertify();
		
		$node = session('node');

		$ename = [];

		foreach($node as $value)
		{
			$ename[] = $value['ename'];
		}

		if(!in_array('/admin/permission', $ename))
		{
			exit ("<script>alert('您并没有此权限');history.go(-1);</script>");
		}

		
        foreach ($_GET['all'] as $key => $value) {

            $res =Db::name('role')->delete($value);

			$isExists = Db::table('tp_role_user')->where("role_id = $value")->select();
			if($isExists)
			{
				$result = Db::table('tp_role_user')->where("role_id = $value")->delete();
			}

			$isExists2 = Db::table('tp_access')->where("role_id = $value")->select();
			if($isExists2)
			{
				$r = Db::table('tp_access')->where("role_id = $value")->delete(); 
			}
           
        }

		if($res)
		{
			return json_encode(['state' => 1]);
		}else
		{
			return json_encode(['state' => 0]);
		}

	}

	// ~~~~~~~		修改角色	~~~~~~~~~
	public function editrole()
	{	
		$this->vertify();
		
		$node = session('node');

		$ename = [];

		foreach($node as $value)
		{
			$ename[] = $value['ename'];
		}

		if(!in_array('/admin/permission', $ename))
		{
			exit ("<script>alert('您并没有此权限');history.go(-1);</script>");
		}

		

		//获取get到的rid
		$rid = $_GET['role_id'];

		//获取整个权限表的信息，用于最外部的foreach
		$res = Db::table('tp_node')->select();
		//获取这个角色的名字
		$role = Db::table('tp_role')->where('role_id' , $rid)->field('rname , remark , role_id')->select();
		//根据权限表和角色权限表，根据角色权限表，获得角色权限表，这个角色对应的权限，为了perid
		$result = Db::table('tp_access a,tp_node n')->where("a.role_id = $rid and a.node_id = n.nid")->field('n.name , n.nid')->select();
		//权限表的权限id，这个角色所对应的权限放到这个数组中
		$perid = [];
		foreach ($result as $value) {
			$perid[] = $value['nid'];
		}

		$this->assign('rname' , $role[0]['rname']);
		$this->assign('remark' , $role[0]['remark']);
		$this->assign('role_id' , $role[0]['role_id']);
		$this->assign('result' , $result);
		$this->assign('res' , $res);
		$this->assign('perid' , $perid);
		$this->assign('rid' , $rid);

		return $this->fetch();
	}

	// ~~~~~~~		执行修改角色	~~~~~~~~~
	public function doeditrole()
	{
		$this->vertify();
		
		$node = session('node');

		$ename = [];

		foreach($node as $value)
		{
			$ename[] = $value['ename'];
		}

		if(!in_array('/admin/permission', $ename))
		{
			exit ("<script>alert('您并没有此权限');history.go(-1);</script>");
		}

		
		$pid_arr = input('param.id');
		$rid = input('param.role_id');

		$pid_arr = explode(',', $pid_arr);
		$isExists = Db::table('tp_access')->where("role_id" , $rid)->select();
		if($isExists)
		{
			$del = Db::table('tp_access')->where('role_id' , $rid)->delete();
			if(!$del)
			{
				return json_encode(['state' => 0]);
			}
		}

		$data = [];
		$data2 = [];
		$data3 = [];
		foreach ($pid_arr as $value) {

			$data[] = explode('_', $value);
			foreach ($data as $val) {
				$data2[] = $val[1];
				$data3[] = $val[0];
				$data2 = array_unique($data2);
				$data3 = array_unique($data3);
				$data4 = array_merge($data2 , $data3);
			}
		}
		 $data5 = [];
		 foreach ($data4 as $value){
				$data5[] = array(
					'node_id'=>$value,
					'role_id'=>$rid
				);	
 		}
		
		$res = Db::table('tp_access')->insertAll($data5);

		
		if ($res) {
			return json_encode(['state'=>1]);
			
		} else {
			return json_encode(['state'=>0]);
		}	



	}

	
}