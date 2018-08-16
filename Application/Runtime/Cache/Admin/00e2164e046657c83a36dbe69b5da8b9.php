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
<body onload="aTim();onload(10);" class="GZHSJbody KLCountBody forecastBody">
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

	<div class="main holiday-main">

		<div class="onelineTwo">
			<ul class="clearfix">
				<li>
					<div class="box-content">
						<span class="left-top"></span>
						<span class="right-top"></span>
						<span class="left-bottom"></span>
						<span class="right-bottom"></span>
						<div class="box-content-top clearfix">
							<h4>未来客流预测</h4>
							<div class="box-content-top-right">
								<input value="未来7天" readonly>
								<ul style="display: none">
									<li onclick="getTouristFlow(0)">未来7天</li>
									<li onclick="getTouristFlow(1)">清明节</li>
									<li onclick="getTouristFlow(2)">劳动节</li>
									<li onclick="getTouristFlow(3)">端午节</li>
									<li onclick="getTouristFlow(4)">国庆节</li>
									<!--<li onclick="getTouristFlow(5)">中秋节</li>-->
								</ul>
								<span class="drop-down-span"></span>
							</div>
						</div>
						<div class="char-plate">
							<div id="klForecast" style="width: 550px; height:300px;"></div>
						</div>
					</div>
				</li>
				<li>
					<div class="box-content">
						<span class="left-top"></span>
						<span class="right-top"></span>
						<span class="left-bottom"></span>
						<span class="right-bottom"></span>
						<div class="box-content-top clearfix">
							<h4>未来车流预测</h4>
							<div class="box-content-top-right">
								<input value="未来7天" readonly>
								<ul style="display: none">
									<li onclick="getCarFlow(0)">未来7天</li>
									<li onclick="getCarFlow(1)">清明节</li>
									<li onclick="getCarFlow(2)">劳动节</li>
									<li onclick="getCarFlow(3)">端午节</li>
									<li onclick="getCarFlow(4)">国庆节</li>
									<!--<li onclick="getCarFlow(5)">中秋节</li>-->
								</ul>
								<span class="drop-down-span"></span>
							</div>
						</div>
						<div class="char-plate">
							<div id="carForecast" style="width: 550px; height:300px;"></div>
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
				<div class="box-content-top clearfix">
					<h4>游客客源地预测</h4>
					<div class="box-content-top-right">
						<input value="未来7天" readonly >
						<ul style="display: none">
							<li onclick="getSourceArea(0)">未来7天</li>
							<li onclick="getSourceArea(1)">清明节</li>
							<li onclick="getSourceArea(2)">劳动节</li>
							<li onclick="getSourceArea(3)">端午节</li>
							<li onclick="getSourceArea(4)">国庆节</li>
							<!--<li onclick="getSourceArea(5)">中秋节</li>-->
						</ul>
						<span class="drop-down-span"></span>
					</div>
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
<script src="/Application/Admin//Public/Admin/js/ff/passengerFlowForecast.js"></script>

</html>
<script>
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
        /*$('.DBAdd-more-btn').click(function () {
            $('.chose-box').addClass('opened-chose-box')
        })*/
        $(".box-content tbody tr").click(function () {
            $(".box-content tbody tr").removeClass("active");
            $(this).addClass("active");
        });

    })
	function onload(days) {
        getTouristFlow(days);
        getCarFlow(days);
        getSourceArea(days);
    }
</script>