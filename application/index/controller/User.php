<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Request;
use think\Session;
use think\open51094;
use think\Ucpaas as Ucpaas;
class User extends Controller
{
    //登录注册页面展示
    public function login()
    {
        return $this->fetch('index/login');
    }
    //注册判断
    function doregister()
    {
        // dump(input('param.'));
        //ajax判断用户名
        if(!empty(input('param.name'))){
            $username = trim(input('param.name'));
            $result = Db::name('user')->where('username',$username)->select();
            if($result){
                echo json_encode(['state'=>1]);
                exit;
            }else{
                echo json_encode(['state'=>0]);
                exit;
            }
        }
        //获取数据
        $username = input('param.username');
        $password = input('param.password');
        $repass = input('param.repass');
        $email = input('param.email');
        $phone = input('param.phone');
        $yzm = input('param.yzm');
        $code = Session::get('code');
        // dump($code);

        if(empty($password)){
            exit ("<script>alert('密码不能为空');history.go(-1);</script>");
        }
        if(empty($email)){
            exit ("<script>alert('邮箱不能为空');history.go(-1);</script>");
        }
        if($password != $repass){
            exit ("<script>alert('两次密码不一样');history.go(-1);</script>");
        }
        if($code != $yzm){
            exit ("<script>alert('验证码不正确');history.go(-1);</script>");
        }
        $data = ['username'=>$username,'password'=>md5($password),'email'=>$email,'phone'=>$phone,'create_time'=>time()];
        $result=Db::name('user')->insert($data);
        if($result){
             exit ("<script>alert('注册成功');history.go(-1);</script>");
        }else{
            exit ("<script>alert('注册失败');history.go(-1);</script>");
        }

    }
    public function phonecode()
    {
        //初始化必填
        $options['accountsid']='c8135d44edc63ce53d696e81865930a7';
        $options['token']='e3527de55c83a8c4a8ca9edf4eb552f1';

        //初始化 $options必填
        $ucpass = new Ucpaas($options);

        //开发者账号信息查询默认为json或xml
        header("Content-Type:text/html;charset=utf-8");
        //封装验证码
        $str = '1234567890123567654323894325789';
        $code = substr(str_shuffle($str),0,5);
        // $_SESSION['code']=$code;
        Session::set('code',$code);
        //短信验证码（模板短信）,默认以65个汉字（同65个英文）为一条（可容纳字数受您应用名称占用字符影响），超过长度短信平台将会自动分割为多条发送。分割后的多条短信将按照具体占用条数计费。
        $appId = "33ead697cf974ec5b911622a50b36bad";
        //给那个手机号发送
        $to = $_GET['phone'];
        //模板id
        $templateId = "280883";
        //这就是验证码
        $param=$code;
        // Session::set('code',$param);
        echo $ucpass->templateSMS($appId,$to,$templateId,$param);
    }
    //登录判断
    function dologin()

    {

        $post = input('post.');
        //第三方登录
        if(empty($post)){
            $open = new open51094();
            $code = $_GET['code'];
            // dump( $open->me($code) );die;
            $data = $open->me($code);
            $username = $data['name'];
            $type = $data['from'];
            $img = $data['img'];
            $sex = $data['sex'];
            if($type=='weibo'){
                $type= 3;
            }else{
                $type = 2;
            }
            //判断是否登陆过
            $result = Db::name('user')->where('username',"$username")->select();
            if($result){
                $lahei = DB::name('user')->where('username',$username)->where('delete_time',1)->select();
                if($lahei){
                    exit ("<script>alert('您已被拉入黑名单，禁止登录');history.go(-1);</script>");
                }
                Session::set('username',$username);
                // $this->success('登陆成功','/index/index/index');
                exit ("<script>alert('登陆成功');location.href='/index/index/index';</script>");

            }else{
                //没登录，把数据插入数据库
                $ins = ['username'=>$username,'pic'=>$img,'sex'=>$sex,'type'=>$type,'create_time'=>time()];
                $result = Db::name('user')->insert($ins);
                Session::set('username',$username);
                // $this->success('登陆成功','/index/index/index');
                exit ("<script>alert('登陆成功');location.href='/index/index/index';</script>");
            }
        }else{
            $username=input('post.username');
            $password = input('post.password');
            //不为空的话判断用户名
            if(!empty($username)){
                $result = Db::name('user')->where('username',$username)->select();

                if($result){
                    $lahei = DB::name('user')->where('username',$username)->where('delete_time',1)->select();
                    if($lahei){
                        exit ("<script>alert('您已被拉入黑名单，禁止登录');history.go(-1);</script>");
                    }
                    if($result[0]['password'] == md5($password)){
                        Session::set('username',$username);
                         exit ("<script>alert('登陆成功');location.href='/index/index/index';</script>");
                        // $this->success('登陆成功','/index/index/index');
                        // exit;
                    }else{
                            exit ("<script>alert('密码错误');history.go(-1);</script>");
                    }
                }else{
                    exit ("<script>alert('用户名不存在');history.go(-1);</script>");
                }
            }else{
                exit ("<script>alert('用户名不能为空');history.go(-1);</script>");
            }
        }

    }
    /*----------------------------------忘记密码------------------------------*/
    function forgetpwd2()
    {

        return $this->fetch();
    }
    function doforgetpwd2()
    {
        $username = input('param.username');
        $email = input('post.email');
        if(!empty(input('param.name'))){
            $username = trim(input('param.name'));
            $result = Db::name('user')->where('username',$username)->select();
            if($result){
                echo json_encode(['state'=>1]);
                exit;
            }else{
                echo json_encode(['state'=>0]);
                exit;
            }
        }
        $res = Db::name('user')->where('username',"$username")->where('email',"$email")->select();
        if($res){
            exit ("<script>alert('验证成功');location.href='/index/user/forgetPwd3?username=$username';</script>");
        }else{
            exit ("<script>alert('验证不成功');history.go(-1);</script>");
        }
    }
    function forgetpwd3()
    {
        $username = input('param.username');
        $this->assign('username',$username);
        return $this->fetch();
    }
    function doforgetpwd3()
    {
        $username = input('param.username');
        $pass = input('param.pass');
        $repass = input('param.repass');
        if($pass != $repass){
            exit ("<script>alert('两次密码不一致');history.go(-1);</script>");
        }
        if(is_numeric($pass)){
            exit ("<script>alert('密码不能为纯数字');history.go(-1);</script>");
        }
        $update = Db::name('user')->where('username',$username)->update(['password'=>md5($pass)]);
        if($update){
            exit ("<script>alert('修改成功');location.href='/index/user/forgetPwd4';</script>");
        }else{
            exit ("<script>alert('您新设的密码是原密码,请直接登录');location.href='/index/user/login';</script>");
        }
    }
    function forgetpwd4()
    {
        return $this->fetch();
    }
    //退出登录
    function loginout()
    {
        Session::clear();
        // $this->success('退出成功','index/index/index');
        exit ("<script>alert('退出成功');location.href='/index/index/index';</script>");

    }

}