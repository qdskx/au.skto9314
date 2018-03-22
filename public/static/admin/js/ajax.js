//obj是一个对象，对象包含以下属性
/*
	{
		method:qing求方式
		url：请求地址
		async:同步或者异步
		data:{'username=goudan'} 参数
		success:成功之后要执行的方法

	}
	{
		method:'get',
		url:'goudan.php',
		async:true,
		data:{pwd:888,name:'呵呵'},
		success:success

	}

 */

function ajax(obj)
{

	//创建ajax对象
	var xhr = new XMLHttpRequest();
	//处理url，为了防止缓存，让他随机一下
	obj.url += '?rand=' + Math.random();
	//绑定函数的处理
	xhr.onreadystatechange = function () {
		if (xhr.readyState == 4) {

			if (xhr.status == 200) {

				obj.success(xhr.responseText);
			}
		}
	};
	//处理参数
	var params = [];
	//{name:'ghoduan',pwd:888}
	for (var name in obj.data) {
		//这个地方需要处理一下,将特殊的字符串处理一下
		var key = encodeURIComponent(name);
		var value = encodeURIComponent(obj.data[name]);


		params.push(key + '=' + value);

	}
		//params =  [name = 'goudan', pwd = 888]
		////////////////////
		//将参数拼接成咱们想要的形式 //
		//name='goudan'&pwd=888
		obj.data = params.join('&');
		//判断是否是get或者post
		if (obj.method == 'get') {
			//name='goudan'&pwd=888
			//goudan.php?rand=0.323&name='goudan'&pwd=888
			obj.url += '&' + obj.data;

		}	
		//接着进行open和send的操作
		xhr.open(obj.method, obj.url, obj.async);
		////////////////
		//执行send的方法 //
		if (obj.method == 'get') {
			xhr.send();
		}else {
			xhr.setRequestHeader('content-type','application/x-www-form-urlencoded');
			xhr.send(obj.data);
		}
	
}