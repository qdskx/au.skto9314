<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Page;
use think\Session;
require '../vendor/sdk/autoload.php';
        // 引入鉴权类
use Qiniu\Auth;
// 引入上传类
use Qiniu\Storage\UploadManager;
// 需要填写你的 Access Key 和 Secret Key

class Mv extends Controller
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

	
	// ~~~~~~~~~~~~~~~~~~~~~~~~		MV列表		~~~~~~~~~~~~~~~~~
	public function mvlist()
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

		if(!in_array('/admin/mv/mvlist', $ename))
		{
			exit ("<script>alert('您并没有此权限');history.go(-1);</script>");
		}

		$num = Db::name('mv')->count();
		$page = new Page(3,$num);
		$mv = Db::name('mv')->order('vid asc')->limit($page->limit())->select();
		$allPage = $page->allPage();
		
		$this->assign('mv' , $mv);
		$this->assign('num' , $num);
		$this->assign('allPage' , $allPage);
		return $this->fetch();
	}

	// ~~~~~~~~~~~~~		添加mv		~~~~~~~~	
	public function addmv()
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
		return $this->fetch();
	}

	// ~~~~~~~~~~~~~		逐个删除mv		~~~~~~~~
	public function delmv()
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
		$res = Db::name('mv')->delete($vid);

		$isExists = DB::name('mvpost')->where("vid=$vid")->select();
		if($isExists)
		{
			$result = DB::name('mvpost')->where("vid=$vid")->delete();
		}

		if($res)
		{
			return json_encode(['state' => 1]);
		}else
		{
			return json_encode(['state' => 0]);
		}
	}

	// ~~~~~~~		批量删除mv	~~~~~~~~~
	public function delall()
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
            $res =Db::name('mv')->delete($value);

            $isExists = DB::name('mvpost')->where("vid=$value")->select();
            if($isExists)
            {	
            	$result = DB::name('mvpost')->where("vid=$value")->delete();
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

	// ~~~~~~~		修改mv	~~~~~~~~~~
	public function editmv()
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
		$vid = input('get.vid');
		$info = Db::name('mv')->where("vid=$vid")->select();
		$this->assign('info' , $info);
		return $this->fetch();
	}

	// ~~~~~~~~~~		执行修改mv		~~~~~~~~~~~
	public function doeditmv()
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
		$vid = input('post.vid');
		$orignInfo = Db::name('mv')->where("vid=$vid")->select();

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
	
		$vname = input('post.vname');
		$vsinger = input('post.vsinger');
		$intro = input('post.vintro');

		if($vname != $orignInfo[0]['vname'])
		{
			$data['vname'] = $vname;
		}

		if($vsinger != $orignInfo[0]['vsinger'])
		{
			$data['vsinger'] = $vsinger;
		}	

		if($intro != $orignInfo[0]['vintro'])
		{
			$data['vintro'] = $intro;
		}


		$data['vid'] = $vid;
		$data['update_time'] = time();

		$res = Db::name('mv')->update($data);

		if($res)
		{
			exit ("<script>alert('修改mv成功');history.go(-1);</script>");
		}else
		{
			exit ("<script>alert('修改mv失败');history.go(-1);</script>");
		}
	}


	// 添加MV
    function doupload()
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
        $accessKey ="K0tsxNEk7X8KKuoAJVMUumuArd2bRdWR6XVD7FlN";
        $secretKey = "6MeJ2Uwz55KM_j-IoPa7murByxgUBFTOJn6ARohS";
        $bucket = "au521";
        // 构建鉴权对象
        $auth = new Auth($accessKey, $secretKey);
        // 生成上传 Token
        $token = $auth->uploadToken($bucket);
        // 要上传文件的本地路径
        // $filePath = './php-logo.png';
        $filePath = $_FILES['mvmv']['tmp_name'][0];
        // dump($filePath);
        // 上传到七牛后保存的文件名
        $key = $_FILES['mvmv']['name'][0];


        // 初始化 UploadManager 对象并进行文件的上传。
        $uploadMgr = new UploadManager();
        // 调用 UploadManager 的 putFile 方法进行文件的上传。
        list($ret, $err) = $uploadMgr->putFile($token, $key, $filePath);

        if($ret['key']){

        	$url="http://p3nictroy.bkt.clouddn.com/".$ret['key'];
        }

		$data['url'] = $url;
		$file = request()->file('mvmv');
		
		$file = $file[1];

		if(!empty($file)){
			// 移动到框架应用根目录/public/uploads/ 目录下
			$info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
			$pic= '/uploads/' . $info->getSaveName();

		}
	
		$vname = input('post.vname');

		if(empty($vname))
		{
			exit ("<script>alert('请添加mv名字');history.go(-1);</script>");
		}else
		{
			$isExists = Db::name('mv')->where("vname='$vname'")->select();
			if($isExists)
			{
				exit ("<script>alert('mv已存在');history.go(-1);</script>");
			}
		}

		$data['vname'] = $vname;
		$data['vsinger'] = input('post.singer');

		// 上传mv之后返回的url	????????????
		

		if(!empty(input('post.remark')))
		{
			$data['vintro'] = input('post.remark');
		}

		$data['create_time'] = time();

		$aff_id = Db::name('mv')->insertGetId($data);

		if($aff_id)
		{	
			exit ("<script>alert('添加mv成功');history.go(-1);</script>");
		}else
		{
			exit ("<script>alert('添加mv失败');history.go(-1);</script>");
		}
    }
}
