<?php

///删除权限分类
	public function del_cate(){
		$perid = request()->post('perid');
		//查出这个大分类的小分类
		$xiao = Db::table('mc_permission')->where('pid',$perid)->select();
		///不为空的话，将小分类id放在数组里面
		if (!empty($xiao)) {
			foreach ($xiao as $key => $value) {
				$xi[] = $value['perid'];
			}
			//查询在rp表里有没有小分类
			$rpxiao = Db::table('mc_role_per')->where('perid' ,'in', $xi)->select();
			if (!empty($rpxiao)) {
				//rp表里有小分类，一定有大分类，删除大分类
				//删除rp角色权限表的大分类
				Db::table('mc_role_per')->where('perid',$perid)->delete();
				//遍历删rp除角色权限表的所有小分类
				foreach ($rpxiao as $key => $val) {
					Db::table('mc_role_per')->where('perid',$val['perid'])->delete();
				}
			}
			///删除p表里面的小分类
			Db::table('mc_permission')->where('pid',$perid)->delete();
		}
		//查询角色权限表的大分类
		 $rpbig = Db::table('mc_role_per')->where('perid',$perid)->select();
		if (!empty($rpbig)) {
			//rp表里有单独的一个分类，直接删除
			Db::table('mc_role_per')->where('perid',$perid)->delete();
		}
		//删除p里面这个大分类
		$del = Db::table('mc_permission')->where('perid',$perid)->delete();
		


		if ($del) {
			echo json_encode(['status'=>1]);
		} else {
			echo json_encode(['status'=>0]);
		}






	}


	x_admin_show('编辑',"/admin/index/linkmodify?lid="+jj);

















	//智能问答
    public function wenda($keyword)
    {
        $appkey = '3fae3d43b6fc0b64';//你的appkey c334531d37fe7092
        $question = $keyword;//问题(utf8)


        $url = "http://api.jisuapi.com/iqa/query?appkey=$appkey&question=$question";
         
        $result = $this->curlOpen($url);
        $jsonarr = json_decode($result, true);
        //var_dump($jsonarr);
        if($jsonarr['status'] != 0)
        {
            echo $jsonarr['msg'];
            exit();
        }
        $result = $jsonarr['result'];
        file_put_contents('msg.txt', $result);
        echo $result['type'].' '.$result['content'] . '<br>';
		foreach($result['relquestion'] as $val)
		{
		    echo $val.'<br>';
		}
        return $contentStr = $result['content'] ;
    }