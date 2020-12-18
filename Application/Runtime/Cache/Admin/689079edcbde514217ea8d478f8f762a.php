<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<meta name="keywords" content="">
	<meta name="description" content="">
	<title></title>
	<link rel="stylesheet" type="text/css" href="/Application/Admin//Public/Admin/css/ffcommon.css">
	<link rel="stylesheet" type="text/css" href="/Application/Admin//Public/Admin/css/fuFengStyle.css">
	<link rel="stylesheet" type="text/css" href="/Application/Admin//Public/Admin/css/newStyle.css">
	<script src="/Application/Admin//Public/Admin/js/ff/echarts.min.js"></script>
	<script src="/Application/Admin//Public/Admin/js/ff/china.js"></script>
</head>
<body onload="aTim();onLoad(7);" class="GZHSJbody KLCountBody ZSAnalysisBody">
<header>
	<div class="box-top">
		<!--<h3>旅游大数据平台</h3>-->
	</div>
</header>
	<div class="body-content">
		
<div class="nav">
    <div class="nav-left">
        <ul class="clearfix" >
            <?php if(is_array($__MENU__["main"])): $i = 0; $__LIST__ = $__MENU__["main"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?><li class="<?php echo ((isset($menu["class"]) && ($menu["class"] !== ""))?($menu["class"]):''); ?>"><a href="<?php echo (u($menu["url"])); ?>"><span><?php echo ($menu["title"]); ?></span></a></li>
                <!--<li class="active"><a href="javascript:;">数据概况</a></li>-->
                <!--<li><a href="<?php echo U('Visitor/index');?>">客流统计</a></li>-->
                <!--<li><a href="<?php echo U('Opinion/index');?>">舆情监测</a></li>-->
                <!--<li><a href="javascript:;">酒店监测</a></li>-->
                <!--<li class="clearfix" ><a href="<?php echo U('Wx/index');?>">网络行为</a></li>--><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </div>
    <div class="nav-right float-right clearfix">
        <div class="quit-content">
            <span>|</span>
            <a href="<?php echo U('Public/logout');?>" class="quit">退出</a>
        </div>
        <div class="date-left">
            <p class="date"><?php echo (date("Y年n月j日",NOW_TIME)); ?></p>
            <p class="time"><?php echo (date("G:i:s",NOW_TIME)); ?></p>
            <!--<span class="week">星期三</span>-->
            <!--<span class="weather"> 晴 ≤3级风 9℃</span>-->
        </div>
    </div>
</div>
<div><img src="/Application/Admin//Public/Admin/images/ffimg/top-fgx.png"></div>

		<div class="main">
			<div class="secondLevelNav">
				<ul>
	<?php if(is_array($__MENU__["child"])): $i = 0; $__LIST__ = $__MENU__["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sub_menu): $mod = ($i % 2 );++$i;?><li>
			<?php if($sub_menu["class"] != 'on'): ?><a href="<?php echo (u($sub_menu["url"])); ?>"><?php echo ($sub_menu["name"]); ?></a>
			<?php else: ?>
				<a href="javascript:;" class="active"><?php echo ($sub_menu["name"]); ?></a><?php endif; ?>
        </li><?php endforeach; endif; else: echo "" ;endif; ?>
</ul>
			</div>

			<div class="onelineTwo">
				<ul class="clearfix">
					<li>
						<div class="box-content">
							<span class="left-top"></span>
							<span class="right-top"></span>
							<span class="left-bottom"></span>
							<span class="right-bottom"></span>
							<div class="box-content-top">
								<h4>酒店接待客流总数据统计</h4>
								<p class="clearfix">
									<span class="active" onclick="getInnOrdertotal(7);">7天</span>
									<span onclick="getInnOrdertotal(30);">30天</span>
									<span onclick="getInnOrdertotal(90);">90天</span>
									<span onclick="getInnOrdertotal(180);">半年</span>
									<span onclick="getInnOrdertotal(365);">一年</span></p>
							</div>
							<div class="char-plate">
								<div id="KLZS" style="width: 550px; height:350px;"></div>
							</div>
						</div>
					</li>
					<li>
						<div class="box-content">
							<span class="left-top"></span>
							<span class="right-top"></span>
							<span class="left-bottom"></span>
							<span class="right-bottom"></span>
							<div class="box-content-top">
								<h4>游客入住时长占比统计</h4>
								<p class="clearfix">
									<span class="active" onclick="getInnStayDays(7);">7天</span>
									<span onclick="getInnStayDays(30);">30天</span>
									<span onclick="getInnStayDays(90);">90天</span>
									<span onclick="getInnStayDays(180);">半年</span>
									<span onclick="getInnStayDays(365);">一年</span></p>
							</div>
							<div class="char-plate">
								<div id="RZSC" style="width: 550px; height:300px;margin-top: 20px;"></div>
							</div>
						</div>
					</li>
				</ul>
			</div>

			<div class="onelineTwo">
				<ul class="clearfix">
					<li>
						<div class="box-content">
							<span class="left-top"></span>
							<span class="right-top"></span>
							<span class="left-bottom"></span>
							<span class="right-bottom"></span>
							<div class="box-content-top">
								<h4>
									接待客流TOP10
								</h4>
								<p class="clearfix">
									<span class="active" onclick="getReceptionTop10(7);">7天</span>
									<span onclick="getReceptionTop10(30);">30天</span>
									<span onclick="getReceptionTop10(90);">90天</span>
									<span onclick="getReceptionTop10(180);">半年</span>
									<span onclick="getReceptionTop10(365);">一年</span>
								</p>
							</div>
							<div class="char-plate">
								<div id="ReceptionTOP10" style="width: 550px; height:350px;"></div>
							</div>
						</div>
					</li>
					<li>
						<div class="box-content">
							<span class="left-top"></span>
							<span class="right-top"></span>
							<span class="left-bottom"></span>
							<span class="right-bottom"></span>
							<div class="box-content-top">
								<h4>酒店预订渠道统计</h4>
								<p class="clearfix">
									<span class="active" onclick="getHotelBookingChannel(7);">7天</span>
									<span onclick="getHotelBookingChannel(30);">30天</span>
									<span onclick="getHotelBookingChannel(90);">90天</span>
									<span onclick="getHotelBookingChannel(180);">半年</span>
									<span onclick="getHotelBookingChannel(365);">一年</span>
								</p>
							</div>
							<div class="char-plate">
								<div id="HotelBookingChannel" style="width: 550px; height:300px;margin-top: 20px;"></div>
							</div>
						</div>
					</li>
				</ul>
			</div>

			<div class="onelineTwo">
				<ul class="clearfix">
					<li>
						<div class="box-content">
							<span class="left-top"></span>
							<span class="right-top"></span>
							<span class="left-bottom"></span>
							<span class="right-bottom"></span>
							<div class="box-content-top">
								<h4>
									酒店预定分布
								</h4>
								<p class="clearfix">
									<span class="active" onclick="getFavoriteHotel(7);">7天</span>
									<span onclick="getFavoriteHotel(30);">30天</span>
									<span onclick="getFavoriteHotel(90);">90天</span>
									<span onclick="getFavoriteHotel(180);">半年</span>
									<span onclick="getFavoriteHotel(365);">一年</span>
								</p>
							</div>
							<div class="char-plate">
								<div id="hotelTypePopular" style="width: 550px; height:350px;margin-top: 20px;"></div>
							</div>
						</div>
					</li>
					<li>
						<div class="box-content">
							<span class="left-top"></span>
							<span class="right-top"></span>
							<span class="left-bottom"></span>
							<span class="right-bottom"></span>
							<div class="box-content-top">
								<h4>酒店分销直销占比</h4>
								<p class="clearfix">
									<span class="active" onclick="getSaleChannel(7);">7天</span>
									<span onclick="getSaleChannel(30);">30天</span>
									<span onclick="getSaleChannel(90);">90天</span>
									<span onclick="getSaleChannel(180);">半年</span>
									<span onclick="getSaleChannel(365);">一年</span>
								</p>
							</div>
							<div class="char-plate">
								<div id="FXZX" style="width: 550px; height:350px;margin-top: 20px;"></div>
							</div>
						</div>
					</li>
				</ul>
			</div>

			<div class="onelineTwo">
				<ul class="clearfix">
					<li>
						<div class="box-content">
							<span class="left-top"></span>
							<span class="right-top"></span>
							<span class="left-bottom"></span>
							<span class="right-bottom"></span>
							<div class="box-content-top">
								<h4>
									住客性别与年龄统计
								</h4>
								<p class="clearfix">
									<span class="active" onclick="getHotelVisitorInfo(7);">7天</span>
									<span onclick="getHotelVisitorInfo(30);">30天</span>
									<span onclick="getHotelVisitorInfo(90);">90天</span>
									<span onclick="getHotelVisitorInfo(180);">半年</span>
									<span onclick="getHotelVisitorInfo(365);">一年</span>
								</p>
							</div>
							<div class="char-plate clearfix">
								<div id="sexRatio" style="width: 170px; height:200px; margin-top: 50px;"></div>
								<div id="AgeRatio" style="width: 400px; height:350px;"></div>
							</div>
						</div>
					</li>
					<li>
						<div class="box-content">
							<span class="left-top"></span>
							<span class="right-top"></span>
							<span class="left-bottom"></span>
							<span class="right-bottom"></span>
							<div class="box-content-top">
								<h4>入住率统计</h4>
								<p class="clearfix">
									<span class="active" onclick="getOccupancyRate(7);">7天</span>
									<span onclick="getOccupancyRate(30);">30天</span>
									<span onclick="getOccupancyRate(90);">90天</span>
									<span onclick="getOccupancyRate(180);">半年</span>
									<span onclick="getOccupancyRate(365);">一年</span>
								</p>
							</div>
							<div class="char-plate">
								<div id="occupancyRate" style="width: 430px; height:300px;margin-top: 20px;"></div>
								<div id="occupancyRate7Day" style="width: 120px; height:300px;margin-top: 20px;"></div>
							</div>
						</div>
					</li>
				</ul>
			</div>

			<div class="onelineOne onelineThree">
				<div class="box-content">
					<span class="left-top"></span>
					<span class="right-top"></span>
					<span class="left-bottom"></span>
					<span class="right-bottom"></span>
					<div class="box-content-top">
						<h4>住客客源地统计分析</h4>
						<p class="clearfix">
							<span class="active" onclick="getHotelVisitorArea(7);">7天</span>
							<span onclick="getHotelVisitorArea(30);">30天</span>
							<span onclick="getHotelVisitorArea(90);">90天</span>
							<span onclick="getHotelVisitorArea(180);">半年</span>
							<span onclick="getHotelVisitorArea(365);">一年</span>
						</p>
					</div>
					<div class="char-plates">
						<ul class="clearfix">
							<li>
								<div id="provinceTop10" style="width: 380px; height:300px;"></div>
							</li>
							<li>
								<div id="cityTop10" style="width: 380px; height:300px;"></div>
							</li>
							<li>
								<div id="provinceAnalysis" style="width: 380px; height:300px;"></div>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
<script src="/Application/Admin//Public/Admin/js/ff/jquery.js"></script>
<script src="/Application/Admin//Public/Admin/js/ff/common.js"></script>
<script src="/Application/Admin//Public/Admin/js/ff/westeros.js"></script>
<script src="/Application/Admin//Public/Admin/js/ff/dateAnalysisJS/accommodation.js"></script>

</html>	
<script>
	function onLoad(days) {
	    //接待总人数
        getInnOrdertotal(days);
        //住宿天数
        getInnStayDays(days);
        //酒店排行榜
        getReceptionTop10(days);
        //酒店预订渠道
        getHotelBookingChannel(days);
        //受欢迎的酒店
        getFavoriteHotel(days);
        //酒店销售方式（直销或分销）
        getSaleChannel(days);
        //受喜爱的酒店
        getFavoriteHotel(days);
        //旅客信息、性别、年龄分析
        getHotelVisitorInfo(days);
        //酒店入住率
        getOccupancyRate(days);
        //住客客源地统计分析
        getHotelVisitorArea(days);
    }
	function aTim(){
		var date = new Date();
		var hours = date.getHours();
		var min = date.getMinutes();
		min = min<10?"0"+min:min;
		var sec = date.getSeconds();
		sec = sec<10?("0"+sec):sec;
		$(".date-left .time").text(hours + ":" + min + ":" + sec);
		setTimeout("aTim()",1000);
	}
	$(document).ready(function () {
		$('.addBtnSpan').click(function () {
			$('.chose-box').slideToggle(150);
        });
		$(".box-content tbody tr").click(function () {
            $(".box-content tbody tr").removeClass("active");
			$(this).addClass("active");
        });

    })

	//日期选中样式
    $(function(){
        $(".clearfix span").click(function(){
            $(this).addClass("active");
            $(this).siblings().removeClass("active");
        });
    });
</script>