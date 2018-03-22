<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Session;
use think\Model\Banner as BannerModel;

class Banner extends Controller
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

	// ~~~~~~~~~~~~~~		轮播		~~~~~~~~~~~~~~~~~

	// ~~~~~~~~~~~~~		轮播列表		~~~~~~
	public function bannerlist()
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

		if(!in_array('/admin/banner/bannerlist', $ename))
		{
			exit ("<script>alert('您并没有此权限');history.go(-1);</script>");
		}

		$banner = Db::name('suf')->select();
		$num = Db::name('suf')->count();
		$this->assign('banner' , $banner);
		$this->assign('num' , $num);
		return $this->fetch();
	}

	// ~~~~~~~~~~~~~		更新轮播		~~~~~~
	public function editbanner()
	{
		$this->vertify();
		$node = session('node');

		$ename = [];

		foreach($node as $value)
		{
			$ename[] = $value['ename'];
		}

		if(!in_array('/admin/banner', $ename))
		{
			exit ("<script>alert('您并没有此权限');history.go(-1);</script>");
		}
		$lid = input('get.lid');
		$ing = Db::name('suf')->where('lid' , $lid)->select();
		$this->assign('ing' , $ing);
		return $this->fetch();
	}

	// ~~~~~~~~~~~~~		执行更新轮播		~~~~~~
	public function doeditbanner(){

		$this->vertify();
		$node = session('node');

		$ename = [];

		foreach($node as $value)
		{
			$ename[] = $value['ename'];
		}

		if(!in_array('/admin/banner', $ename))
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
	
		if(!empty(input('post.desc')) || !empty(input('post.link')))
		{
			$data['intro'] = input('post.desc');
			$data['url'] = input('post.link');			
		}

		$data['lid'] = input('post.id');


		$res = Db::name('suf')->update($data);

		if($res)
		{	
			exit ("<script>alert('更新成功');history.go(-1);</script>");
		}else
		{
			exit ("<script>alert('更新失败');history.go(-1);</script>");
		}

	}
}