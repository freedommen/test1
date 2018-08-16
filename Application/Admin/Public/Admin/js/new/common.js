$(function(){
	$("a,button").focus(function(){this.blur()});
	//导航菜单
	$("header nav ul li").click(function(){
		$("header nav ul li").removeClass("on");
		$(this).addClass("on");
	})

	//左侧菜单
	$(".content .menu .list li").click(function(){
		//alert(1);
		//$(this).addClass("on").siblings().removeClass("on");
		$(this).toggleClass("on");
	})

	$(".content .menu .list h4").click(function(){
		// $(".content .menu .list h4").removeClass("on");
		// $(this).addClass("on");
		$(this).toggleClass("on");
		// $(".content .menu .list ul").hide();
		// $(this).next('ul').show();
		$(this).next('ul').toggle();
	})

	//登录页面
	$(".sign-kuang p.ma label").on("click",function(){
		var checkboxId = $(this).attr('name');
	    $(this).toggleClass('checked');
	    $('#' + checkboxId).attr('checked');
	})

	//radio
	$('.sign-kuang p.js label').on("click",function(){
	    var radioId = $(this).attr('name');
	    $(this).attr('class', 'checked').siblings("label").removeAttr('class');
	    $('input[type="radio"]').removeAttr('checked') && $('#' + radioId).attr('checked', 'checked');
	});
	
	//左侧菜单
	$(".main-nav-item").on("click",function(){
		$(".main-nav-list").slideUp();
		$(".main-nav-item").removeClass("bjxs");
		$(this).next('.main-nav-list').slideDown();
		$(this).addClass("bjxs");
	})

	//下载报表按钮
    $(".report-download a").on("click",function(){
        $(this).next(".report-download-main").slideToggle("fast");
    });

	$(".report-download .report-download-main p span").on("click",function(){
        $(this).parent().parent(".report-download-main").slideToggle("fast");
    });
})