/* 
 * jQuery Fixed Plugins 1.5.1
 * Author:
 * Url:
 * Data
 *
 *  Update Log:
 * 
 *  Status       Date            Name      Version           BUG-Description
 *  ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 *  Created      2012-08-15    	 Ru	       1.0               None
 
 *  Modified     2012-09-02      Ru        1.4.1             修复了webkit内核浏览器右边浮动有一定距离的bug(负外边距),增加了悬浮靠边的定位、是否显示关闭按钮、是否垂直居中定位
 
 *  Modified     2013-01-02    	 Ru	       1.5.1             增加了垂直方向的位置;把核心函数(关闭、展开、定位、最小化)重构,修复了webkit内核浏览器右边浮动最小化时没有显示出来
 *  ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/

(function($){
    $.fn.fix = function(options){
        var defaults = {
            position 		: "left",	//悬浮位置 - left或right
			horizontal  	: 0,		//水平方向的位置 - 默认为数字
			vertical    	: null,		//垂直方向的位置 - 默认为null
			halfTop     	: false,	//是否垂直居中位置
			minStatue 		: false,	//是否最小化
			hideCloseBtn 	: false,	//是否隐藏关闭按钮
			skin 			: "gray",	//风格皮肤
			showBtnWidth 	: 28,       //show_btn_width
			contentBoxWidth : 154, 		//side_content_width
			durationTime 	: 1000		//完成时间
        }
        var options = $.extend(defaults, options);		

        this.each(function(){			
            //获取对象
			var thisBox = $(this),
				closeBtn = thisBox.find(".close_btn"),
				show_btn = thisBox.find(".show_btn"),
				contentBox = thisBox.find(".content_box"),
				sideList = thisBox.find(".side_list")
				;	
			
			//设置内容的高度
			thisBox.height( contentBox.height() );
			
			//最小化
			if(options.minStatue){
				show_btn.show();
				if(options.position=="left"){
					contentBox.css({ left: -options.contentBoxWidth });
				}else if(options.position=="right"){
					contentBox.css({ right: -options.contentBoxWidth });
				}
				thisBox.css({ width: options.showBtnWidth });
			}
			//皮肤控制
			if(options.skin) thisBox.addClass("skin_" + options.skin);
			//隐藏关闭按钮
			if(options.hideCloseBtn) closeBtn.css("display", "none");
			
			//定位			
			var boxTop = null,
				defaultTop = thisBox.offset().top,	//对象的默认top
				halfTop = ($(window).height() - thisBox.height())/2  //垂直居中时候的top
				;
			if(options.vertical == null){
				boxTop = defaultTop;
			}else {
				boxTop = options.vertical;
			}
			if( options.halfTop ) {	boxTop = halfTop; }
			
			thisBox.css(options.position, options.horizontal);
			thisBox.css("top", boxTop);
						
						
			//核心scroll事件			
			$(window).bind("scroll",function(){
				var offsetTop = boxTop + $(window).scrollTop() + "px";
	            thisBox.animate({
	                top: offsetTop
	            },{
	            	duration: options.durationTime,	
	                queue: false    //此动画将不进入动画队列
	            });
			});
			
			//关闭
			closeBtn.bind("click",function(){
				show_btn.show();
				if(options.position=="left"){
					contentBox.animate({left: -options.contentBoxWidth},"fast");
				}else if(options.position=="right"){
					contentBox.animate({right: -options.contentBoxWidth },"fast");
				}
				thisBox.animate({width: options.showBtnWidth },"fast");
			});
			
			//展开
			 show_btn.bind("click", function() {
				if(options.position=="left"){
					contentBox.animate({left: 0},"fast");
				}
				else if(options.position=="right"){
					contentBox.animate({right: 0},"fast");
				}
				thisBox.animate({width: options.contentBoxWidth },"fast");
				show_btn.hide();
	        });
				
        });	//end this.each

    };
})(jQuery);