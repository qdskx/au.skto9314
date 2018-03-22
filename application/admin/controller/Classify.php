<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use app\admin\model\Classify as ClassifyModel;
use think\Page;
use think\Session;

class Classify extends Controller
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

	// 无限极分类
    function getTree4($list, $pid=0, $level=1)
    {
        $this->vertify();
        $node = session('node');

        $ename = [];

        foreach($node as $value)
        {
            $ename[] = $value['ename'];
        }

        if(!in_array('/admin/classify', $ename))
        {
            exit ("<script>alert('您并没有此权限');history.go(-1);</script>");
        }
        static $newlist = array();
        foreach($list as $key => $value)
            {
            if($value['pid']==$pid)
                {
                $value['level'] = $level;
                $newlist[] = $value;
                unset($list[$key]);
                $this->getTree4($list, $value['cid'], $level+1);
                }
            }
        return $newlist;
    }

    // 分类列表
    public function classifylist()
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

        if(!in_array('/admin/classify/classifylist', $ename))
        {
            exit ("<script>alert('您并没有此权限');history.go(-1);</script>");
        }
    	$info = DB::name('classify')->select();

    	$info = $this->getTree4($info);

    	$this->assign('info' , $info);

    	return $this->fetch();
    }

    // 添加分类
    public function addclassify()
    {
        $this->vertify();
        $node = session('node');

        $ename = [];

        foreach($node as $value)
        {
            $ename[] = $value['ename'];
        }

        if(!in_array('/admin/classify', $ename))
        {
            exit ("<script>alert('您并没有此权限');history.go(-1);</script>");
        }
        $parent = Db::name('classify')->select();

        $this->assign('parent' , $parent);

        return $this->fetch();
    }

    // 执行添加分类
    public function doaddclassify()
    {
        $this->vertify();
        $node = session('node');

        $ename = [];

        foreach($node as $value)
        {
            $ename[] = $value['ename'];
        }

        if(!in_array('/admin/classify', $ename))
        {
            exit ("<script>alert('您并没有此权限');history.go(-1);</script>");
        }
        $classname = input('post.classname');
        $pid = input('post.pid');

        if(empty($classname))
        {
            return json_encode(['state' => 2]);
        }else
        {
            $isExists = Db::name('classify')->where("classname='$classname'")->select();
            if($isExists)
            {
                return json_encode(['state' => 3]);
            }else
            {
                $data['classname'] = $classname;
                $data['pid'] = $pid;
                $data['create_time'] = time();

                $add = Db::name('classify')->insertGetId($data);

                if($add)
                {
                    return json_encode(['state' => 1]);
                }else
                {
                    return json_encode(['state' => 0]);
                }
            }
        }
    }

    // 修改分类
    public function editclassify()
    {
        $this->vertify();
        $node = session('node');

        $ename = [];

        foreach($node as $value)
        {
            $ename[] = $value['ename'];
        }

        if(!in_array('/admin/classify', $ename))
        {
            exit ("<script>alert('您并没有此权限');history.go(-1);</script>");
        }
        $cid = input('param.cid');

        $info = Db::name('classify')->where("cid=$cid")->select();

        $parent = Db::name('classify')->select();

        $this->assign('parent' , $parent);

        $this->assign('info' , $info);

        return $this->fetch();
    }

    // 执行修改分类
    public function doeditclassify()
    {
        $this->vertify();
        $node = session('node');

        $ename = [];

        foreach($node as $value)
        {
            $ename[] = $value['ename'];
        }

        if(!in_array('/admin/classify', $ename))
        {
            exit ("<script>alert('您并没有此权限');history.go(-1);</script>");
        }
        $cid = input('param.cid');

        $classname = input('param.classname');
        $pid = input('param.pid');

        $origin = Db::name('classify')->where("cid=$cid")->select();

        if(empty($classname))
        {
            return json_encode(['state' => 2 , 'msg' => '分类名不能为空']);
        }else if($classname != $origin[0]['classname'])
        {
            $data['classname'] = $classname;
        }

        if($pid != $origin[0]['pid'])
        {
            $data['pid'] = $pid;
        }

        $edit = Db::name('classify')->where("cid=$cid")->update($data);

        if($edit)
        {
            return json_encode(['state' => 1 , 'msg' => '修改成功']);
        }else
        {
            return json_encode(['state' => 0 , 'msg' => '修改失败']);
        }
    }

    // 删除分类
    public function delclassify()
    {
        $this->vertify();
        $node = session('node');

        $ename = [];

        foreach($node as $value)
        {
            $ename[] = $value['ename'];
        }

        if(!in_array('/admin/classify', $ename))
        {
            exit ("<script>alert('您并没有此权限');history.go(-1);</script>");
        }
        $cid = input('param.cid');

        $res = Db::name('classify')->where("cid=$cid or pid=$cid")->delete();

        if($res)
        {
            return json_encode(['state' => 1]);
        }else
        {
            return json_encode(['state' => 0]);
        }
    }
}