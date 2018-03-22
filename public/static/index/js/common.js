var so = {
	init : function () {
		//搜索切换
		$('.keytxt').hover(function () {
			$("#seh_sort").show();
		}, function () {
			$("#seh_sort").hide();
		});
		$('.seh_sort').hover(function () {
			$("#seh_sort").show();
		}, function () {
			$("#seh_sort").hide();
		});
	}
}
//搜索选项
function getsearch(type, text) {
	$("#keytype").val(type);
	$("#keytxt").html(text);
	$("#seh_sort").hide();
}
//搜索
function search_ok() {
	var key = $(".seh_v").val();
	var type = $("#keytype").val();
	if (key == '') {
		asyncbox.tips("请输入您要搜索的内容！", "alert", 1500);
	} else {
		var url = web_url + "include/search.php?ac=" + type + "&key=" + key;
		window.location.href=url;
	}
}
$(document).ready(function(){$(".seh_v").keydown(function(e){var curKey = e.which;if(curKey == 13){search_ok();return false;}});});
//首页歌曲全部播放
function playsong(n) {
	var v = [];
	var nums = $('.x5_player #song-' + n).length;
	for (var i = 0; i < nums; i++) {
		var did = $('.x5_player #song-' + n + ':eq(' + i + ')').attr('did');
		v.push(did);
	}
	window.open(web_url + 'include/lplayer.php?id=' + v.join(','), 'player');
}
//首页幻灯片
var total;		
var int;
function showBanner(){
			$('.solid0').css("background","#000").fadeIn(5000);
			$("#solid ul li").eq(0).fadeIn(400);
		    total=$("#solid ul").children().length;
	        var _html ='';
	        for(var a=0; a<total; a++){
	            _html+='<span></span>'
	        }
	        $('#btt').append(_html)
	        $("#solid ul li,#btt span").mouseenter(function(){
				window.clearInterval(int);
			});
			$("#btt span").mouseenter(function(){
				if($(this).index()!=now){
					now=$(this).index()-1;
					clock();
				}
			});
			//var int=self.setInterval("clock()",3000)
			$("#solid ul li,#solid span").mouseleave(function(){
				int=self.setInterval("clock()",3000)
			});
			//clock();
			$("#solid ul li").eq(0).fadeIn(1000);
			$('.solid0').fadeIn(1000).css("background",$("#solid ul li").eq(0).attr("data"));
		    $("#btt span").eq(0).css("background","#e85252");
		}
		var now=0;
		function clock() {
			  if(now==total -1){
				now=0; 
			  }else{
				  now=now+1;
			  }
			  for(i=0;i<total;i++){
				   $("#solid ul li").eq(i).css("display","none");
				   $("#btt span").eq(i).css("background","#fff");
			  }
		  $("#solid ul li").eq(now).fadeIn(1000);
		  $('.solid0').fadeIn(1000).css("background",$("#solid ul li").eq(now).attr("data"));
		  $("#btt span").eq(now).css("background","#e85252");
		}

function readylogin() {
	$('.x5music-popover-mask').fadeIn(100);
	$('#loginPop').slideDown(200);
}

function closelogin() {
	$('.x5music-popover-mask').fadeOut(10);
	$('#loginPop').slideUp(20);
}
function play_tips_ready() {
	$('.play_tips_popover_mask').fadeIn(100);
	$('.play_tips_popover').slideDown(200);
}

function play_tips_close() {
	$('.play_tips_popover_mask').fadeOut(10);
	$('.play_tips_popover').slideUp(20);
}
function sHits(_id, _type) {
document.writeln("<script src=\""+web_url+"include/hits.php?ac="+_type+"&id="+_id+"\"></script>");
}
//评论
function message(type, id, did, pages) {
	document.writeln("<div id=\"frame_comment\"><div id=\"d_comment\"><iframe name=\"comment\" id=\"f_comment\" src=\"" + web_skin + "message.php?ac=" + type + "&id=" + id + "&did=" + did + "&pages=" + pages + "\" frameborder=\"0\" scrolling=\"no\" width=\"100%\" height=\"0\" style=\"height: 451px;\"></iframe></div></div>");
}
//ajax		
function createXMLHttpRequest() {
	if (window.XMLHttpRequest) { //www.x5mp3.com
		XMLHttpReq = new XMLHttpRequest();
	} else if (window.ActiveXObject) { //IE 浏览器
		try {
			XMLHttpReq = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try {
				XMLHttpReq = new ActiveXObject("Micrsost.XMLHTTP");
			} catch (e) {}
		}
	}
}
var cache = new Array();
function getHttpObject() {
	var objType = false;
	try {
		objType = new ActiveXObject('Msxml2.XMLHTTP');
	} catch (e) {
		try {
			objType = new ActiveXObject('Microsoft.XMLHTTP');
		} catch (e) {
			objType = new XMLHttpRequest();
		}
	}
	return objType;
}
//未登录状态
function getlogin() {
	var theHttpRequest = getHttpObject();
	theHttpRequest.onreadystatechange = function () {
		processAJAX();
	};
	theHttpRequest.open("GET", web_skin + "login.php?action=login", true);
	theHttpRequest.send(null);
	function processAJAX() {
		if (theHttpRequest.readyState == 4) {
			if (theHttpRequest.status == 200) {
				document.getElementById("userinfo").innerHTML = unescape(theHttpRequest.responseText);
			} else {
				document.getElementById("userinfo").innerHTML = "您请求的页面出现异常错误";
			}
		}
	}
}
//登录
function x5music_logadd() {
	var name = $("#cd_name").val();
	var pass = $("#cd_pass").val();
	if (name == '' || pass == "") {
		asyncbox.tips("请输入帐号密码!", "wait", 1500);
	} else {
		$.getJSON(web_skin + "login.php?action=dologin&name=" + name + "&pass=" + pass + "&random=" + Math.random() + "&callback=?", function (data) {
			if (data['error'] == '10001') { //用户名为空
				asyncbox.tips("帐号不能为空!", "wait", 1500);
			} else if (data['error'] == '10002') { //密码为空
				asyncbox.tips("密码不能为空!", "wait", 1500);
			} else if (data['error'] == '10003') { //帐号不存在
				asyncbox.tips("帐号或密码错误!", "wait", 1500);
			} else if (data['error'] == '10004') { //密码错误
				asyncbox.tips("密码错误!", "wait", 1000);
			} else if (data['error'] == '10005') { //帐号被锁定
				asyncbox.tips("对不起，该帐号已经被锁定!", "wait", 1500);
			} else if (data['error'] == '10007') { //邮件未激活
				asyncbox.tips("您的帐号未通过审核!", "wait", 1500);
			} else if (data['error'] == '10008') { //登录成功
				getlogin();
				asyncbox.tips("登录成功!", "success", 1500);
			} else if (data['error'] == '10009') { //登录成功
				asyncbox.tips("本站已关闭帐号登录！!", "error", 1500);
			} else {
				asyncbox.tips("您请求的页面出现异常错误！", "error", 3000);
			}
		});
	}
}
//退出登录
function x5music_logout() {
	$.getJSON(web_skin + "login.php?action=logout&random=" + Math.random() + "&callback=?", function (data) {
		if (data['error'] == '10001') {
			getlogin();
		} else {
			asyncbox.tips("您请求的页面出现异常错误！", "error", 3000);
		}
	});
}
//顶踩
function getdoHits(_id, _type) {
	var theHttpRequest = getHttpObject();
	theHttpRequest.onreadystatechange = function () {
		processAJAX();
	};
	theHttpRequest.open("GET", web_skin + "ajax.php?action=goodbad&type=" + _type + "&id=" + _id, true);
	theHttpRequest.send(null);
	function processAJAX() {
		if (theHttpRequest.readyState == 4) {
			if (theHttpRequest.status == 200) {
				document.getElementById("doHits").innerHTML = unescape(theHttpRequest.responseText);
			} else {
				document.getElementById("doHits").innerHTML = "您请求的页面出现异常错误";
			}
		}
	}
}
function up_down(_id, _do, _type) {
	createXMLHttpRequest();
	XMLHttpReq.open("GET", web_skin + "ajax.php?action=doHits&type=" + _type + "&id=" + _id + "&dowhat=" + _do, true);
	XMLHttpReq.onreadystatechange = function () {
		if (XMLHttpReq.readyState == 4) {
			if (XMLHttpReq.status == 200) {
				if (XMLHttpReq.responseText == "up_001") {
					asyncbox.tips("Good！+1", "success", 3000);
				}
				if (XMLHttpReq.responseText == "up_002") {
					asyncbox.tips("Oh No!", "success", 3000);
				}
				if (XMLHttpReq.responseText == "up_003") {
					asyncbox.tips("休息会吧！您已经给过评价啦!", "wait", 3000);
				}
				if (XMLHttpReq.responseText == "up_004") {
					asyncbox.tips("参数错误!", "error", 3000);
				}
				getdoHits(_id, _type);
			} else
				asyncbox.tips("网络异常，请检查网络连接！", "error", 1000);
		}
	}
	XMLHttpReq.send(null);
}
//收藏下载
function up_fav(_id, _type) {
	createXMLHttpRequest();
	XMLHttpReq.open("GET", web_skin + "ajax.php?action=dofav&type=" + _type + "&id=" + _id, true);
	XMLHttpReq.onreadystatechange = function () {
		if (XMLHttpReq.readyState == 4) {
			if (XMLHttpReq.status == 200) {
				if (XMLHttpReq.responseText == "upfav_001") {
					asyncbox.tips("收藏成功", "success", 3000);
				}
				if (XMLHttpReq.responseText == "upfav_002") {
					//asyncbox.tips("请先登录！", "wait", 3000);
					readylogin();
				}
				if (XMLHttpReq.responseText == "upfav_003") {
					asyncbox.tips("收藏的内容不存在！", "wait", 3000);
				}
				if (XMLHttpReq.responseText == "upfav_004") {
					asyncbox.tips("已经收藏过了！", "wait", 3000);
				}
				if (XMLHttpReq.responseText == "upfav_005") {
					asyncbox.tips("参数错误!", "error", 3000);
				}
			} else
				asyncbox.tips("网络异常，请检查网络连接！", "error", 1000);
		}
	}
	XMLHttpReq.send(null);
}