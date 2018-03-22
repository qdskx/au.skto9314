<?php
namespace app\admin\controller;
use think\Controller;
use think\Request;
use think\Db;
use think\Session;
include 'curl.func.php';

class Index extends Controller
{



	public function index()
	{
		$uid = Session::get('uid');
		if(!empty($uid))
		{
			$role = Db::name('role_user')->where("user_id=$uid")->select();

			$rid = $role[0]['role_id'];

			$node = Db::table('tp_role r , tp_access a,tp_node n')->field('n.level,n.name,n.ename,n.pid,n.nid')->where("r.role_id=$rid and r.role_id=a.role_id and a.node_id=n.nid")->select();
			$this->assign('node' , $node);

			$request = Request::instance();
			$modules = $request->module();
			$controller = $request->controller();
			$path = '/' . $modules . '/' . $controller;

			session::set('node' , $node , 'think');

			$str = $this->history();

			// dump($str);

			if(!empty($str))
			{
				$this->assign('str' , $str);
			}

			

			return $this->fetch();
		}else
		{
			return $this->fetch('/user/login');
		}
		
	}

	public function welcome()
	{
		return $this->fetch();
	}

	//智能问答
    public function dowelcome()
    {
    	$keyword = input('param.cont');
        $appkey = '3fae3d43b6fc0b64';//你的appkey c334531d37fe7092
        $question = $keyword;//问题(utf8)


        $url = "http://api.jisuapi.com/iqa/query?appkey=$appkey&question=$question";
         
        $result = $this->curlOpen($url);
        $jsonarr = json_decode($result, true);
        // var_dump($jsonarr);
        if($jsonarr['status'] != 0)
        {
            echo $jsonarr['msg'];
            exit();
        }
        $result = $jsonarr['result'];

        // var_dump($result);

        file_put_contents('msg.txt', $result);
        // echo $result['type'].' '.$result['content'] . '<br>';
		// foreach($result['relquestion'] as $val)
		// {
		//     echo $val.'<br>';
		// }
        $contentStr = $result['content'] ;
        $pic = session::get('pic');
        
        $str = '        <div class="x-body" style="position:relative;width:1200px;height:400px;background:rgba(255,255,255,0.2)"> 

            
            <p style="position:absolute;top:10px;left:600px;">' . $keyword . '<img src="' .$pic.'" alt="" style="width:50px;height:50px;border-radius:50%;"></p>


            <img src="../../static/admin/images/qq.jpg" alt="" style="position:absolute;top:60px;left:40px;width:50px;height:50px;border-radius:50%;">
            <p style="position:absolute;top:80px;left:100px;width:700px;">'. $contentStr . '</p>

            <form action="/admin/index/dowelcome" method="post" style="position:absolute;top:150px;left:180px;">
                <input type="text" name="cont" style="border:1px solid #eaeaea;width:300px;height:45px;float:left;padding-left:5px;" placeholder="聊点什么呢" />
                <input type="submit" value="发送" style="width:80px;height:47px;border:none;float:left;background:#169386;color:#fff;" />
            </form>


            
        </div>';

        return $str;
    }

    function curlOpen($url, $config = array())
    {
        $arr = array('post' => false,'referer' => $url,'cookie' => '', 'useragent' => 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0; Trident/4.0; SLCC1; .NET CLR 2.0.50727; .NET CLR 3.0.04506; customie8)', 'timeout' => 20, 'return' => true, 'proxy' => '', 'userpwd' => '', 'nobody' => false,'header'=>array(),'gzip'=>true,'ssl'=>false,'isupfile'=>false);
        $arr = array_merge($arr, $config);
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, $arr['return']);
        curl_setopt($ch, CURLOPT_NOBODY, $arr['nobody']);  
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, $arr['useragent']);
        curl_setopt($ch, CURLOPT_REFERER, $arr['referer']);
        curl_setopt($ch, CURLOPT_TIMEOUT, $arr['timeout']);
        //curl_setopt($ch, CURLOPT_HEADER, true);//获取header
        if($arr['gzip']) curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');
        if($arr['ssl'])
        {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        }
        if(!empty($arr['cookie']))
        {
            curl_setopt($ch, CURLOPT_COOKIEJAR, $arr['cookie']);
            curl_setopt($ch, CURLOPT_COOKIEFILE, $arr['cookie']); 
        } 
        
        if(!empty($arr['proxy']))
        {
            //curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);  
            curl_setopt ($ch, CURLOPT_PROXY, $arr['proxy']);
            if(!empty($arr['userpwd']))
            {            
                curl_setopt($ch,CURLOPT_PROXYUSERPWD,$arr['userpwd']);
            }        
        }    
        
        //ip比较特殊，用键值表示
        if(!empty($arr['header']['ip']))
        {
            array_push($arr['header'],'X-FORWARDED-FOR:'.$arr['header']['ip'],'CLIENT-IP:'.$arr['header']['ip']);
            unset($arr['header']['ip']);
        }   
        $arr['header'] = array_filter($arr['header']);
        
        if(!empty($arr['header']))
        {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $arr['header']); 
        }

        if ($arr['post'] != false)
        {
            curl_setopt($ch, CURLOPT_POST, true);
            if(is_array($arr['post']) && $arr['isupfile'] === false)
            {
                $post = http_build_query($arr['post']);            
            } 
            else
            {
                $post = $arr['post'];
            }
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        }    
        $result = curl_exec($ch);
        //var_dump(curl_getinfo($ch));
        curl_close($ch);

        return $result;
    }	

	public function history()
	{
		$appkey = '3fae3d43b6fc0b64';//你的appkey

		$month = date('n' , time());
		$day = date('j' , time());
        // dump($month);
        // dump($day);
		$url = "http://api.jisuapi.com/todayhistory/query?appkey=$appkey&month=$month&day=$day";
		$result = curlOpen($url);
		$jsonarr = json_decode($result, true);
		//exit(var_dump($jsonarr));
		 
		if($jsonarr['status'] != 0)
		{
		  	$str = '暂无数据';
		    return $str;
		}
		 
		$result = $jsonarr['result'];
        if(!empty($result))
        {

            foreach($result as $val)
            {
                $str = $val['year'].'年 '.$val['month'].'月 '.$val['day'].'日 '.$val['title'];
            }

          
        }else
        {
            $str = '暂无数据';
        }

        return $str;

	}
}