<?php

/**
 * 使用：   
 * echo curlOpen('http://www.baidu.com');   
 *   
 * POST数据   
 * $post = array('aa'=>'ddd','ee'=>'d')   
 * 或   
 * $post = 'aa=ddd&ee=d';   
 * echo curlOpen('http://www.baidu.com',array('post'=>$post));   
 * @param string $url
 * @param array $config
 */
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

