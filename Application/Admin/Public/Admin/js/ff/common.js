$(function(){
	//日期
	var date = new Date();
	var ye = date.getFullYear();
	var mo = date.getMonth()+1;
	var da=date.getDate();
	var weekday=new Array(7);
	weekday[1]="星期一"
	weekday[2]="星期二"
	weekday[3]="星期三"
	weekday[4]="星期四"
	weekday[5]="星期五"
	weekday[6]="星期六"
	weekday[7]="星期天"
	var day = date.getDay();
	$(".date-left .date").text(parseInt(ye) + "年" + parseInt(mo) + "月" + parseInt(da) + "日");
	$(".date-left .week").text(weekday[day]);
	//菜单
	$(".nav-left").mouseover(function(){
		$(".nav-left ul.list").show();
	})
	$(".nav-left").mouseout(function(){
		setTimeout(function(){
			$(".nav-left ul.list").hide();
		},1000);
	})	
	$(".nav-left ul.list").mouseover(function(){
		$(".nav-left ul.list").show();
	});
	//今日客流量
	var w = $(".jrkll-img").outerWidth() - $(".flux-icon").outerWidth();
	var h = $(".jrkll-img").outerHeight() - $(".flux-icon").outerHeight();
	$(".flux-icon").mousedown(function(e){
		var x = e.clientX - $(this).offset().left,
            y = e.clientY - $(this).offset().top;
		$(document).mousemove(function(e){
			var newx = e.clientX - x,
                newy = e.clientY - y;
            newx<=0?newx=0:newx;
            newx>=w?newx=w:newx;
            newy<=0?newy=0:newy;
            newy>=h?newy=h:newy;
            $('.flux-icon').css({left:newx});
		})
		$(document).mouseup(function(){
            $(document).off('mousemove mouseup');
        })
	})


//自定义select
    $(".nav-select>input").click(function () {
        $(this).next("ul").slideToggle(150);
        $(this).next().next("span").toggleClass("drop-down-span");
        $(this).next().next("span").toggleClass("upward-span")
    });

    $(".nav-select>ul>li").click(function () {
        var text = $(this).text();
        $(this).parent().parent().children("input").val(text);
        $(this).parent("ul").slideToggle(150);
        $(this).parent().parent().children("span").toggleClass("drop-down-span");
        $(this).parent().parent().children("span").toggleClass("upward-span");
    });

    $(".nav-select>span").click(function () {
        $(this).toggleClass("drop-down-span");
        $(this).toggleClass("upward-span");
        $(this).parent().children("ul").slideToggle(150);
    });



//
    $(".box-content-top-right>input").click(function () {
        $(this).next("ul").slideToggle(150);
        $(this).next().next("span").toggleClass("drop-down-span");
        $(this).next().next("span").toggleClass("upward-span")
    });

    $(".box-content-top-right>ul>li").click(function () {
        var text = $(this).text();
        $(this).parent().parent().children("input").val(text);
        $(this).parent("ul").slideToggle(150);
        $(this).parent().parent().children("span").toggleClass("drop-down-span");
        $(this).parent().parent().children("span").toggleClass("upward-span");
    });

    $(".box-content-top-right>span").click(function () {
        $(this).toggleClass("drop-down-span");
        $(this).toggleClass("upward-span");
        $(this).parent().children("ul").slideToggle(150);
    });


//
    $(".box-content-top-select>input").click(function () {
        $(this).next("ul").slideToggle(150);
        $(this).next().next("span").toggleClass("drop-down-span");
        $(this).next().next("span").toggleClass("upward-span")
    });

    $(".box-content-top-select>ul>li").click(function () {
        var text = $(this).text();
        $(this).parent().parent().children("input").val(text);
        $(this).parent("ul").slideToggle(150);
        $(this).parent().parent().children("span").toggleClass("drop-down-span");
        $(this).parent().parent().children("span").toggleClass("upward-span");
    });

    $(".box-content-top-select>span").click(function () {
        $(this).toggleClass("drop-down-span");
        $(this).toggleClass("upward-span");
        $(this).parent().children("ul").slideToggle(150);
    });



    /*checkbox样式更改*/
    $(".checkboxDiv label").click(function () {
        for (i = 0; i < 2; i++)          //对div#checkbox下的input[checkbox]进行遍历
        {
            var ifchecked = $(this).children("input").eq(i).prop("checked");
            //取其checked属性值赋给变量ifchecked
            if (ifchecked == true) {
                $(this).children("i").css("display", "block");
                $(this).children(".labelSpan").css("color", "#00b9ff");
            }
            if(ifchecked == false) {
                $(this).children("i").css("display", "none");
                $(this).children(".labelSpan").css("color", "#5a8de0");
            }
        }
    });


});