$(function(){
	//左侧菜单
	$(".main-nav-item").on("click",function(){
		$(".main-nav-list").slideUp();
		$(".main-nav-item").removeClass("bjxs");
		$(this).next('.main-nav-list').slideDown();
		$(this).addClass("bjxs");
	});

	//图片删除按钮
	$("a.upload-delete").on("click",function(){
		$(this).parent().parent(".upload-img").remove();
	});

	//景区列表删除
	$(".s-delete").on("click",function(){
		$(this).parent().parent("tr").remove();
	});

	//综合管理
	$(".zhgl-tab a.tab-name").on("click",function(){
		$(".zhgl-tab a.tab-name").removeClass("tab-active");
		$(".two-stage").hide();
		$(this).addClass("tab-active");
		$(this).next(".two-stage").show();
	});

	//二级菜单
	$(".zhgl-tab .two-stage a").on("click",function(){
		$(".zhgl-tab .two-stage a").removeClass("stage-active");
		$(this).addClass("stage-active");
	});

    //下载报表按钮
    $(".report-download a").on("click",function(){
        $(this).next(".report-download-main").slideToggle("fast");
    });

	$(".report-download .report-download-main p span").on("click",function(){
        $(this).parent().parent(".report-download-main").slideToggle("fast");
    });



});