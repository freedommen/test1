<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<!--<head>-->
	<!--<meta charset="UTF-8" />-->
	<!--<meta name="keywords" content="">-->
	<!--<meta name="description" content="">-->
	<!--<title></title>-->
	<!--<link rel="stylesheet" type="text/css" href="../css/common.css">-->
	<!--<link rel="stylesheet" type="text/css" href="../font-awesome-4.7.0/css/font-awesome.min.css">-->
	<!--<link rel="stylesheet" type="text/css" href="../css/fuFengStyle.css">-->
	<!--<link rel="stylesheet" type="text/css" href="../css/newStyle.css">-->
	<!--<script src="../js/echarts.min.js"></script>-->
	<!--<script src="../js/china.js"></script>-->
<!--</head>-->


<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="">
    <meta name="description" content="">
    <title><?php echo ($meta_title); ?> | 中智尚联</title>
    <link rel="stylesheet" type="text/css" href="/Application/Admin//Public/Admin/css/font-awesome/css/font-awesome.min.css">
    <!--[if lt IE 7] -->
    <link rel="stylesheet" type="text/css" href="/Application/Admin//Public/Admin/css/font-awesome/css/font-awesome-ie7.min.css">
    <!-- [endif] -->

    <!--<link rel="stylesheet" type="text/css" href="/Application/Admin//Public/Admin/css/font-awesome-4.7.0/css/font-awesome.min.css">-->
    <link rel="stylesheet" type="text/css" href="/Application/Admin//Public/Admin/css/ffcommon.css">
    <link rel="stylesheet" type="text/css" href="/Application/Admin//Public/Admin/css/fuFengStyle.css">
	<!--<link rel="stylesheet" type="text/css" href="/Application/Admin//Public/Admin/css/newStyle.css">-->

    <!--[if lt IE 9] -->
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <!-- [endif]-->

    <!--[if lte IE9]>
    <script type="text/javascript">
        document.write("<div style='position: fixed; top: 0; left: 0; right: 0; bottom: 0; z-index: 100; width: 100%; min-width: 1000px;  height: 100%; min-height: 500px; overflow: auto; padding-top: 6%;  background-color: #fff'><p style='width: 900px; overflow: auto; margin: 0 auto; font-size: 22px; line-height: 48px; color: #333;'><span style='font-size: 28px; width: 100%; display: block; color: #999'>当前浏览器版本过低</span><br>请使用高版本IE浏览器，<br><a style='color: #3986d6; font-size: 14px; line-height: 28px; display: block;'  href=' ' target='_blank'>下载地址：https://support.microsoft.com/zh-cn/help/17621/internet-explorer-downloads</a ><br>\n" +
                "或使用以下浏览器：<br> <a style='color: #3986d6; font-size: 14px; line-height: 28px; display: block;'  href='http://www.mozillaonline.com/' target='_blank'>Firefox下载地址：http://www.mozillaonline.com/</a ><a style='color: #3986d6; font-size: 14px; display: block; line-height: 28px;'  href='http://www.google.com/chrome/?hl=zh-CN' target='_blank'>Chrome下载地址：http://www.google.com/chrome/?hl=zh-CN</a ></p ></div>")
    </script>
    <![endif]-->

    <!-- 百度插件 -->
    <script src="/Application/Admin//Public/Admin/js/ff/echarts.min.js"></script>
    <script src="/Application/Admin//Public/Admin/js/ff/china.js"></script>

    <script src="/Application/Admin//Public/Admin/js/ff/jquery.js"></script>
    <script src="/Application/Admin//Public/Admin/js/ff/common.js"></script>
    <script src="/Application/Admin//Public/Admin/js/ff/westeros.js"></script>


</head>
<link rel="stylesheet" type="text/css" href="/Application/Admin//Public/Admin/css/newStyle.css">
<body onload="aTim();getVisitorData(1);" class="GZHSJbody KLCountBody travelBody">
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
		<!--<div class="nav">-->
			<!--<div class="nav-left">-->
				<!--<ul class="clearfix">-->
					<!--<li><a href="../dataProfile.html">数据概况</a></li>-->
					<!--<li><a href="../dateAnalysis/passengerFlow.html">数据分析</a></li>-->
					<!--<li><a href="../publicOpinion.html">舆情监测</a></li>-->
					<!--<li class="active"><a href="javascript:;">景区分析</a></li>-->
					<!--<li><a href="../hotel.html">酒店监测</a></li>-->
					<!--<li><a href="../wlxw.html">网络行为</a></li>-->
					<!--<li><a href="../passengerFlowForecast.html">客流预测</a></li>-->
				<!--</ul>-->
			<!--</div>-->
			<!--<div class="nav-right float-right clearfix">-->
				<!--<div class="quit-content">-->
					<!--<span>|</span>-->
					<!--<a href="javascript:;" class="quit">退出</a>-->
				<!--</div>-->
				<!--<div class="date-left">-->
					<!--<p class="date">2017年11月29日</p>-->
					<!--<p class="time">12:03:08</p>-->
					<!--&lt;!&ndash;<span class="week">星期三</span>&ndash;&gt;-->
					<!--&lt;!&ndash;<span class="weather"> 晴 ≤3级风 9℃</span>&ndash;&gt;-->
				<!--</div>-->
			<!--</div>-->
		<!--</div>-->
		<!--<div><img src="../img/top-fgx.png"></div>-->

		<div class="main">
			<div class="secondLevelNav">
				<ul>
	<?php if(is_array($__MENU__["child"])): $i = 0; $__LIST__ = $__MENU__["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sub_menu): $mod = ($i % 2 );++$i;?><li>
			<?php if($sub_menu["class"] != 'on'): ?><a href="<?php echo (u($sub_menu["url"])); ?>"><?php echo ($sub_menu["name"]); ?></a>
			<?php else: ?>
				<a href="javascript:;" class="active"><?php echo ($sub_menu["name"]); ?></a><?php endif; ?>
        </li><?php endforeach; endif; else: echo "" ;endif; ?>
</ul>
				<!--<ul>-->
					<!--<li><a href="javascript:;" class="active">景区概况</a></li>-->
					<!--<li><a href="<?php echo U('Attraction/passengerFlow');?>">景区客流</a></li>-->
					<!--<li><a href="<?php echo U('Scenic/carFlow');?>">景区车流</a></li>-->
					<!--<li><a href="<?php echo U('Scenic/ticketAnalysis');?>">票务分析</a></li>-->
				<!--</ul>-->
			</div>
			<div class="onelineOne countModuleBox">
				<ul class="clearfix">
					<li class="countModule gradient">
						<div class="countModule-inner clearfix">
							<h4>近7日接待客流数</h4>
							<p class="float-left"><i class="fa fa-3x fa-area-chart"></i></p>
							<p class="float-right"><span><?php echo ((isset($data["week_num"]) && ($data["week_num"] !== ""))?($data["week_num"]):0); ?></span>人</p>
						</div>
					</li>
					<li class="countModule gradient">
						<div class="countModule-inner clearfix">
							<h4>今日接待客流数</h4>
							<p class="float-left"><i class="fa fa-3x fa-user"></i></p>
							<p class="float-right"><span><?php echo ((isset($data["user_num"]) && ($data["user_num"] !== ""))?($data["user_num"]):0); ?></span>人</p>
						</div>
					</li>
					<li class="countModule gradient">
						<div class="countModule-inner clearfix">
							<h4>本月接待客流数</h4>
							<p class="float-left"><i class="fa fa-3x fa-line-chart"></i></p>
							<p class="float-right"><span><?php echo ((isset($data["month_total"]) && ($data["month_total"] !== ""))?($data["month_total"]):0); ?></span>人</p>
						</div>
					</li>
					<li class="countModule gradient">
						<div class="countModule-inner clearfix">
							<h4>昨日接待客流数</h4>
							<p class="float-left"><i class="fa fa-3x fa-users"></i></p>
							<p class="float-right"><span><?php echo ((isset($data["yesterday_total"]) && ($data["yesterday_total"] !== ""))?($data["yesterday_total"]):0); ?></span>人</p>
						</div>
					</li>
					<li class="countModule gradient">
						<div class="countModule-inner clearfix">
							<h4>本年度接待客流</h4>
							<p class="float-left"><i class="fa fa-3x fa-bar-chart"></i></p>
							<p class="float-right"><span><?php echo ((isset($data["tear_total"]) && ($data["tear_total"] !== ""))?($data["tear_total"]):0); ?></span>笔</p>
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
							<div class="box-content-top clearfix">
								<h4>景区客流统计</h4>
								<p>
									<span class="active" onclick="getVisitorNumByDate(1)">7天</span>
									<span onclick="getVisitorNumByDate(2)">30天</span>
									<span onclick="getVisitorNumByDate(3)">90天</span>
									<span onclick="getVisitorNumByDate(4)">半年</span>
									<span onclick="getVisitorNumByDate(5)">一年</span>
								</p>
							</div>
							<div class="char-plate">
								<div id="scenicPassengerCount" style="width: 550px; height:350px; margin-top: 30px;"></div>
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
								<h4>景区车流量统计</h4>
								<p>
									<span class="active" onclick="getCarNumByDate(1)">7天</span>
									<span onclick="getCarNumByDate(2)">30天</span>
									<span onclick="getCarNumByDate(3)">90天</span>
									<span onclick="getCarNumByDate(4)">半年</span>
									<span onclick="getCarNumByDate(5)">一年</span>
								</p>
							</div>
							<div class="char-plate">
								<div id="scenicCarCount" style="width: 550px; height:350px; margin-top: 30px;"></div>
							</div>
						</div>
					</li>
				</ul>
			</div>

			<div class="onelineOne clearfix">
				<div class="box-content">
					<span class="left-top"></span>
					<span class="right-top"></span>
					<span class="left-bottom"></span>
					<span class="right-bottom"></span>
					<div class="box-content-top clearfix">
						<h4>景区游客客源地统计</h4>
						<p>
							<span class="active" onclick="getVisitorFrom(1)">7天</span>
							<span onclick="getVisitorFrom(2)">30天</span>
							<span onclick="getVisitorFrom(3)">90天</span>
							<span onclick="getVisitorFrom(4)">半年</span>
							<span onclick="getVisitorFrom(5)">一年</span>
						</p>
					</div>
					<div class="char-plate clearfix">
						<div class="float-left" id="carSourceOtherProvinces" style="width: 600px; height:400px;"></div>
						<div class="float-left" id="scenicProvinceTop10" style="width: 300px; height:300px; margin-top: 50px"></div>
						<div class="float-left" id="scenicCityTop10" style="width: 300px; height:300px; margin-top: 50px"></div>
					</div>
				</div>
			</div>

			<div class="onelineTwo">
				<ul class="clearfix">
					<li>
						<div class="box-content">
							<span class="left-top"></span>
							<span class="right-top"></span>
							<span class="left-bottom"></span>
							<span class="right-bottom"></span>
							<div class="box-content-top clearfix">
								<h4>游客性别与年龄统计</h4>
								<p>
									<span class="active" onclick="getVisitSex(1);">7天</span>
									<span onclick="getVisitSex(2);">30天</span>
									<span onclick="getVisitSex(3);">90天</span>
									<span onclick="getVisitSex(4)">半年</span>
									<span onclick="getVisitSex(5);">一年</span>
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
							<div class="box-content-top clearfix">
								<h4>景区游客客流排行</h4>
								<p>
									<span class="active" onclick="getVisitorFlow(1)">7天</span>
									<span onclick="getVisitorFlow(2)">30天</span>
									<span onclick="getVisitorFlow(3)">90天</span>
									<span onclick="getVisitorFlow(4)">半年</span>
									<span onclick="getVisitorFlow(5)">一年</span>
								</p>
							</div>
							<div class="char-plate clearfix">
								<div id="passengerTOP10Scenic" style="width: 550px; height:350px"></div>
							</div>
						</div>
					</li>
				</ul>
			</div>

			<div class="onelineOne clearfix">
				<div class="box-content">
					<span class="left-top"></span>
					<span class="right-top"></span>
					<span class="left-bottom"></span>
					<span class="right-bottom"></span>
					<div class="box-content-top">
						<h4>景区近7天平均值统计</h4>
					</div>
					<div class="char-plate dayAverageValue clearfix">
						<div id="averageValue"></div>
						<div id="touristAverageStay"></div>
						<div id="averageAdvance"></div>
						<div id="carAverageStay"></div>
					</div>
				</div>
			</div>


		</div>
	</div>
</body>
<script src="/Application/Admin//Public/Admin/js/ff/jquery.js"></script>
<script src="/Application/Admin//Public/Admin/js/ff/common.js"></script>
<script src="/Application/Admin//Public/Admin/js/ff/westeros.js"></script>
<!--<script src="/Application/Admin//Public/Admin/js/ff/scenicAreaProfile.js"></script>-->

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
		$('.addBtnSpan').click(function () {
			$('.chose-box').slideToggle(150);
        });
		$(".box-content tbody tr").click(function () {
            $(".box-content tbody tr").removeClass("active");
			$(this).addClass("active");
        });
    });
	//模块选中状态判断
	$(function(){
		$(".clearfix span").click(function(){
			$(this).addClass("active");
			$(this).siblings().removeClass("active");
		});
	});
	//模块图标数据
	function getVisitorData(s_day) {
		getVisitorNumByDate(s_day);//景区客流统计
		getCarNumByDate(s_day);//景区车流量统计
		getVisitorFrom(s_day);//景区游客客源地统计
		getVisitorFromByProvince(s_day);//客源地省份top10
		getVisitorFromByCity();//客源地城市top10
		getVisitSex(s_day);//游客性别占比
		getVisitorFlow(s_day);//景区游客客流TOP10
		getWeekAvg();//景区近7天平均值统计
		getVisitorAge(s_day);//年龄统计
	}
	//景区客流统计
	function getVisitorNumByDate(s_day){
		$.get("<?php echo U('getVisitorNumByDate');?>",{s_day:s_day},function (res) {
//			if(res.code == 1){
				var r =res.data;
				//景区客流统计
				var scenicPassengerCountChart = echarts.init(document.getElementById('scenicPassengerCount') , 'westeros');
				option = {
					tooltip: {
						trigger: 'axis'
					},
					xAxis: [
						{
							type: 'category',
							data: r.s_date,//['9.15','9.16','9.17','9.18','9.19','9.20','9.21'],
							axisPointer: {
								type: 'line'
							},
							splitLine: {
								"show": false
							}
						}
					],
					yAxis: [
						{
							type: 'value',
							name: '客流量：（人）',
							// min: 0,
							// max: 1000,
							// interval: 200
						}
					],
					series: [
						{
							name:'客流',
							type:'line',
							data:r.num,//[102, 1033, 1234, 1930, 1305, 1000, 802],
							markPoint:{
								data:[
									{
										type:'max',name:'最大值'
									}
								]
							}
						}
					]
				};
				scenicPassengerCountChart.setOption(option);
//			}
		});
	}
	//景区车流量统计
	function getCarNumByDate(s_day) {
		$.get("<?php echo U('getCarNumByDate');?>",{s_day:s_day},function (res) {
//			if(res.code == 1){
				var r = res.data;
				//景区车流量统计
				var scenicCarCountChart = echarts.init(document.getElementById('scenicCarCount') , 'westeros');
				option = {
					tooltip: {
						trigger: 'axis'
					},
					xAxis: [
						{
							type: 'category',
							boundaryGap: false,
							data: r.s_date,//['9.15','9.16','9.17','9.18','9.19','9.20','9.21'],
							axisPointer: {
								type: 'line'
							},
							splitLine: {
								"show": false
							}
						}
					],
					yAxis: [
						{
							type: 'value',
							name: '车流量：（辆）',
							// min: 0,
							// max: 1000,
							// interval: 200
						}
					],
					series: [
						{
							name:'车流',
							type:'line',
							data:r.num,//[102, 133, 234, 330, 135, 100, 202],
							itemStyle:{
								normal:{
									areaStyle: {
										type: "default",
										color:new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
											offset: 0,
											color: 'rgba(58,140,251,.6)'
										}, {
											offset: 1,
											color: 'rgba(58,140,251,.2)'
										}], false)
									}
								}
							},
							markPoint:{
								data:[
									{
										type:'max',name:'最大值'
									}
								]
							}
						}
					]
				};
				scenicCarCountChart.setOption(option);
//			}
		});
	}
	//景区游客客源地统计
	function getVisitorFrom(s_day) {
		getVisitorFromByProvince(s_day);//客源地省份top10
		getVisitorFromByCity(s_day);//客源地城市top10
		$.get("<?php echo U('getVisitorFrom');?>",{s_day:s_day},function (res) {
//			if(res.code == 1){
				var r = res.data;
				var max = r.max ? r.max : '';
				var ite =  r.data? r.data : '';
				//景区游客客源地统计
				var carSourceOtherProvincesChart = echarts.init(document.getElementById('carSourceOtherProvinces') , 'westeros');
				var data = [
					{name: '海南', value: 9},
					{name: '山东', value: 12},
					{name: '河南', value: 12},
					{name: '重庆', value: 14},
					{name: '四川', value: 15},
					{name: '北京', value: 19},
					{name: '广西', value: 24},
					{name: '西藏', value: 25},
					{name: '天津', value: 26},
					{name: '上海', value: 27},
					{name: '浙江', value: 38},
					{name: '福建', value: 54}
				];
				var geoCoordMap = {
					'海门':[121.15,31.89],
					'鄂尔多斯':[109.781327,39.608266],
					'招远':[120.38,37.35],
					'舟山':[122.207216,29.985295],
					'齐齐哈尔':[123.97,47.33],
					'盐城':[120.13,33.38],
					'赤峰':[118.87,42.28],
					'青岛':[120.33,36.07],
					'乳山':[121.52,36.89],
					'金昌':[102.188043,38.520089],
					'泉州':[118.58,24.93],
					'莱西':[120.53,36.86],
					'日照':[119.46,35.42],
					'胶南':[119.97,35.88],
					'南通':[121.05,32.08],
					'拉萨':[91.11,29.97],
					'云浮':[112.02,22.93],
					'梅州':[116.1,24.55],
					'文登':[122.05,37.2],
					'上海':[121.48,31.22],
					'攀枝花':[101.718637,26.582347],
					'威海':[122.1,37.5],
					'承德':[117.93,40.97],
					'厦门':[118.1,24.46],
					'汕尾':[115.375279,22.786211],
					'潮州':[116.63,23.68],
					'丹东':[124.37,40.13],
					'太仓':[121.1,31.45],
					'曲靖':[103.79,25.51],
					'烟台':[121.39,37.52],
					'福州':[119.3,26.08],
					'瓦房店':[121.979603,39.627114],
					'即墨':[120.45,36.38],
					'抚顺':[123.97,41.97],
					'玉溪':[102.52,24.35],
					'张家口':[114.87,40.82],
					'阳泉':[113.57,37.85],
					'莱州':[119.942327,37.177017],
					'湖州':[120.1,30.86],
					'汕头':[116.69,23.39],
					'昆山':[120.95,31.39],
					'宁波':[121.56,29.86],
					'湛江':[110.359377,21.270708],
					'揭阳':[116.35,23.55],
					'荣成':[122.41,37.16],
					'连云港':[119.16,34.59],
					'葫芦岛':[120.836932,40.711052],
					'常熟':[120.74,31.64],
					'东莞':[113.75,23.04],
					'河源':[114.68,23.73],
					'淮安':[119.15,33.5],
					'泰州':[119.9,32.49],
					'南宁':[108.33,22.84],
					'营口':[122.18,40.65],
					'惠州':[114.4,23.09],
					'江阴':[120.26,31.91],
					'蓬莱':[120.75,37.8],
					'韶关':[113.62,24.84],
					'嘉峪关':[98.289152,39.77313],
					'广州':[113.23,23.16],
					'延安':[109.47,36.6],
					'太原':[112.53,37.87],
					'清远':[113.01,23.7],
					'中山':[113.38,22.52],
					'昆明':[102.73,25.04],
					'寿光':[118.73,36.86],
					'盘锦':[122.070714,41.119997],
					'长治':[113.08,36.18],
					'深圳':[114.07,22.62],
					'珠海':[113.52,22.3],
					'宿迁':[118.3,33.96],
					'咸阳':[108.72,34.36],
					'铜川':[109.11,35.09],
					'平度':[119.97,36.77],
					'佛山':[113.11,23.05],
					'海口':[110.35,20.02],
					'江门':[113.06,22.61],
					'章丘':[117.53,36.72],
					'肇庆':[112.44,23.05],
					'大连':[121.62,38.92],
					'临汾':[111.5,36.08],
					'吴江':[120.63,31.16],
					'石嘴山':[106.39,39.04],
					'沈阳':[123.38,41.8],
					'苏州':[120.62,31.32],
					'茂名':[110.88,21.68],
					'嘉兴':[120.76,30.77],
					'长春':[125.35,43.88],
					'胶州':[120.03336,36.264622],
					'银川':[106.27,38.47],
					'张家港':[120.555821,31.875428],
					'三门峡':[111.19,34.76],
					'锦州':[121.15,41.13],
					'南昌':[115.89,28.68],
					'柳州':[109.4,24.33],
					'三亚':[109.511909,18.252847],
					'自贡':[104.778442,29.33903],
					'吉林':[126.57,43.87],
					'阳江':[111.95,21.85],
					'泸州':[105.39,28.91],
					'西宁':[101.74,36.56],
					'宜宾':[104.56,29.77],
					'呼和浩特':[111.65,40.82],
					'成都':[104.06,30.67],
					'大同':[113.3,40.12],
					'镇江':[119.44,32.2],
					'桂林':[110.28,25.29],
					'张家界':[110.479191,29.117096],
					'宜兴':[119.82,31.36],
					'北海':[109.12,21.49],
					'西安':[108.95,34.27],
					'金坛':[119.56,31.74],
					'东营':[118.49,37.46],
					'牡丹江':[129.58,44.6],
					'遵义':[106.9,27.7],
					'绍兴':[120.58,30.01],
					'扬州':[119.42,32.39],
					'常州':[119.95,31.79],
					'潍坊':[119.1,36.62],
					'重庆':[106.54,29.59],
					'台州':[121.420757,28.656386],
					'南京':[118.78,32.04],
					'滨州':[118.03,37.36],
					'贵阳':[106.71,26.57],
					'无锡':[120.29,31.59],
					'本溪':[123.73,41.3],
					'克拉玛依':[84.77,45.59],
					'渭南':[109.5,34.52],
					'马鞍山':[118.48,31.56],
					'宝鸡':[107.15,34.38],
					'焦作':[113.21,35.24],
					'句容':[119.16,31.95],
					'北京':[116.46,39.92],
					'徐州':[117.2,34.26],
					'衡水':[115.72,37.72],
					'包头':[110,40.58],
					'绵阳':[104.73,31.48],
					'乌鲁木齐':[87.68,43.77],
					'枣庄':[117.57,34.86],
					'杭州':[120.19,30.26],
					'淄博':[118.05,36.78],
					'鞍山':[122.85,41.12],
					'溧阳':[119.48,31.43],
					'库尔勒':[86.06,41.68],
					'安阳':[114.35,36.1],
					'开封':[114.35,34.79],
					'济南':[117,36.65],
					'德阳':[104.37,31.13],
					'温州':[120.65,28.01],
					'九江':[115.97,29.71],
					'邯郸':[114.47,36.6],
					'临安':[119.72,30.23],
					'兰州':[103.73,36.03],
					'沧州':[116.83,38.33],
					'临沂':[118.35,35.05],
					'南充':[106.110698,30.837793],
					'天津':[117.2,39.13],
					'富阳':[119.95,30.07],
					'泰安':[117.13,36.18],
					'诸暨':[120.23,29.71],
					'郑州':[113.65,34.76],
					'哈尔滨':[126.63,45.75],
					'聊城':[115.97,36.45],
					'芜湖':[118.38,31.33],
					'唐山':[118.02,39.63],
					'平顶山':[113.29,33.75],
					'邢台':[114.48,37.05],
					'德州':[116.29,37.45],
					'济宁':[116.59,35.38],
					'荆州':[112.239741,30.335165],
					'宜昌':[111.3,30.7],
					'义乌':[120.06,29.32],
					'丽水':[119.92,28.45],
					'洛阳':[112.44,34.7],
					'秦皇岛':[119.57,39.95],
					'株洲':[113.16,27.83],
					'石家庄':[114.48,38.03],
					'莱芜':[117.67,36.19],
					'常德':[111.69,29.05],
					'保定':[115.48,38.85],
					'湘潭':[112.91,27.87],
					'金华':[119.64,29.12],
					'岳阳':[113.09,29.37],
					'长沙':[113,28.21],
					'衢州':[118.88,28.97],
					'廊坊':[116.7,39.53],
					'菏泽':[115.480656,35.23375],
					'合肥':[117.27,31.86],
					'武汉':[114.31,30.52],
					'大庆':[125.03,46.58]
				};

				function convertData(data) {
					var res = [];
					for (var i = 0; i < data.length; i++) {
						var geoCoord = geoCoordMap[data[i].name];
						if (geoCoord) {
							res.push({
								name: data[i].name,
								value: geoCoord.concat(data[i].value)
							});
						}
					}
					return res;
				};
				option = {
					//tooltip: {},
					visualMap: {
						min: 0,
						max: max,
						left: '2%',
						top: '2%',
						text: ['High','Low'],
						textStyle: {
							color: '#3986d8'
						},
						seriesIndex: [1],
						inRange: {
							color: ['#7fe1ef', '#0f59de']
						},
						calculable : true,
						itemWidth: 8,
						itemHeight: 50
					},
					geo: {
						width: '70%',
						left: '10%',
						map: 'china',
						roam: true,
						label: {
							normal: {
								show: true,
								textStyle: {
									color: 'rgba(0,0,0,0.4)'
								}
							}
						},
						itemStyle: {
							normal:{
								borderColor: 'rgba(0, 0, 0, 0.2)'
							},
							emphasis:{
								areaColor: null,
								shadowOffsetX: 0,
								shadowOffsetY: 0,
								shadowBlur: 20,
								borderWidth: 0,
								shadowColor: 'rgba(0, 0, 0, 0.5)'
							}
						}
					},
					series : [
						{
							type: 'scatter',
							coordinateSystem: 'geo',
							itemStyle: {
								show:false,
								normal: {
									color: '#F06C00'
								}
							}
						},
						{
							name: 'categoryA',
							type: 'map',
							geoIndex: 0,
							// tooltip: {show: false},
							data:ite,
						}
					]
				};

				carSourceOtherProvincesChart.setOption(option);
//			}
		});
	}
	//客源地省份top10
	function getVisitorFromByProvince(s_day) {
		$.get("<?php echo U('getVisitorFromByProvince');?>",{s_day:s_day},function (res) {
//			if(res.code == 1){
				var r = res.data;
				//客源地省份TOP10
				var scenicProvinceTop10Chart = echarts.init(document.getElementById('scenicProvinceTop10') , 'westeros');
				var saleDate = r ? r : "";
//			var saleDate=[
//				{name:'北京',age:132},
//				{name:'陕西',age:321},
//				{name:'江苏',age:452},
//				{name:'广东',age:190},
//				{name:'内蒙古',age:176},
//				{name:'湖北',age:376},
//				{name:'辽宁',age:387},
//				{name:'山东',age:176},
//				{name:'四川',age:376},
//				{name:'福建',age:387}
//			];
				//desc 倒序 asc 正序 固定写法 对 saleDate.age进行排序
//				saleDate.sort(getSortFun('asc','age'));
//				function getSortFun(order, sortBy) {
//					var ordAlpah = (order == 'asc') ?'>' : '<';
//					var sortFun = new Function('a', 'b', 'return a.'+ sortBy + ordAlpah + 'b.'+ sortBy + '?1:-1');
//					return sortFun;
//				}
				var datale=[], datale2=[];
				for(var i=0; i<saleDate.length; i++){
					datale.push(saleDate[i].name);
					datale2.push(saleDate[i].age)
				}
				option= {
					tooltip : {
						trigger: 'axis',
					},
					title:{
						text: '客源地省份TOP10',
						textStyle: {
							fontSize: "12",
							color: "#77a6ff"
						}
					},
					grid: {
						left: '3%',
						bottom: '1%',
						containLabel: true
					},
					yAxis : [
						{
							type : 'category',
							data : datale,
							textStyle:{
								verticalAlign:'bottom',
								lineHeight: 88,
							},
							axisLabel: {
								show: true,
								margin: 12,
								color: '#6da2f7',
								verticalAlign: 'middle',
								textAlign: 'right'
							},
							axisTick: {
								show:false,
								alignWithLabel: true
							},
							axisLine:{
								show:false
							},
							splitLine: {
								"show": false
							}
						}
					],
					xAxis : [
						{
							type : 'value',
							show:false
						}
					],
					series : [
						{
							name:'客流量',
							type:'bar',
							barWidth: '25%',
							itemStyle:{
								normal:{
									barBorderRadius:[5],
									color: {
										type: 'bar',
										colorStops:[{
											offset: 0,
											color: '#0286de'
										}, {
											offset: .8,
											color: '#992cee'
										}],
										globalCoord: false
									}
								}
							},

							label: {
								normal: {
									show: true,
									position:  "right",
									textStyle:{
										color: '#cedfff'
									}
								}
							},
							data:datale2
						}
					]
				};
				scenicProvinceTop10Chart.setOption(option);
//			}
		});
	}
	//客源地城市top10
	function getVisitorFromByCity(s_day) {
		$.get("<?php echo U('getVisitorFromByCity');?>",{s_day:s_day},function (res) {
//			if(res.code == 1){
				var r = res.data;
				//客源地城市TOP10
				var scenicCityTop10Chart = echarts.init(document.getElementById('scenicCityTop10') , 'westeros');
				var saleDate = r ? r : '';
//			var saleDate=[
//				{name:'城市名',age:132},
//				{name:'城市名称',age:321},
//				{name:'城市名称',age:452},
//				{name:'城市名称',age:190},
//				{name:'城市名称',age:176},
//				{name:'城市名称',age:376},
//				{name:'城市名称',age:387},
//				{name:'城市名称',age:176},
//				{name:'城市名称',age:376},
//				{name:'城市名称',age:387}
//			];
				//desc 倒序 asc 正序 固定写法 对 saleDate.age进行排序
//				saleDate.sort(getSortFun('asc','age'));
//				function getSortFun(order, sortBy) {
//					var ordAlpah = (order == 'asc') ?'>' : '<';
//					var sortFun = new Function('a', 'b', 'return a.'+ sortBy + ordAlpah + 'b.'+ sortBy + '?1:-1');
//					return sortFun;
//				}
				var datale=[], datale2=[];
				for(var i=0; i<saleDate.length; i++){
					datale.push(saleDate[i].name);
					datale2.push(saleDate[i].age)
				}

				option= {
					tooltip : {
						trigger: 'axis',
					},
					title:{
						text: '客源地城市TOP10',
						textStyle: {
							fontSize: "12",
							color: "#77a6ff"
						}
					},
					grid: {
						left: '3%',
						bottom: '1%',
						containLabel: true
					},
					yAxis : [
						{
							type : 'category',
							data : datale,
							textStyle:{
								verticalAlign:'bottom',
								lineHeight: 88,
							},
							axisLabel: {
								show: true,
								margin: 12,
								color: '#6da2f7',
								verticalAlign: 'middle',
								textAlign: 'right'
							},
							axisTick: {
								show:false,
								alignWithLabel: true
							},
							axisLine:{
								show:false
							},
							splitLine: {
								"show": false
							}
						}
					],
					xAxis : [
						{
							type : 'value',
							show:false
						}
					],
					series : [
						{
							name:'客流量',
							type:'bar',
							barWidth: '25%',
							itemStyle:{
								normal:{
									barBorderRadius:[5],
									color: {
										type: 'bar',
										colorStops:[{
											offset: 0,
											color: '#0286de'
										}, {
											offset: .8,
											color: '#992cee'
										}],
										globalCoord: false
									}
								}
							},

							label: {
								normal: {
									show: true,
									position:  "right",
									textStyle:{
										color: '#cedfff'
									}
								}
							},
							data:datale2
						}
					]
				};
				scenicCityTop10Chart.setOption(option);
//			}
		});
	}
	//游客性别占比
	function getVisitSex(s_day) {
		getVisitorAge(s_day);//游客年龄统计
		$.get("<?php echo U('getVisitSex');?>",{s_day:s_day},function (res) {
//			if(res.code == 1){
				var r = res.data;
				//游客性别占比
				var sexRatioChart = echarts.init(document.getElementById('sexRatio') , 'walden');
				var women = 'image://data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAACNElEQVRoge1Z0bGCMBC8EighkzRgB88SLMEyvPtKCXagJdCBdKAzCfqZ1wF24PtAFIVAiITwZtyZ/CHuJru5SwAICMNkYphMQv7H6DBMJprTTnEqtKCbFnRTnArNaTd7MTmjRZ34+1CcipzRIjbPVhgmky7ydRGzXAnFSfaRr4mQsfk2oDkaVwGa0zE23wacyd9HbL4N/HsBSmDmnAGBWWy+DeSC1q4CckHr2Hxb4bIKs5z9CobJRAtKOwSks6wB7zgLXGmBeyUwK1cF92eBq9i8rDBMJheGP0PGLFaiatyGbqG1ghavwbuTP3qTr1XlKCJGIR+rtRjSuDkXt6kavJzRYmzyjwI3xVlhVOtMbSWbdaq93p1sWSMmtZLNOorj1TCZKLZZOvudbZblCQ6vk1nJZp2qwg4VAFBV7Ams1LHrpI9nPAQAAGhL7zSalfqs83jOs50ObqU+6zxJ9N9I1Gb35WYimJVcrAMAkHPauu9A99nltH2ZqBBWapvVhnU+KGx1i9ispDgVXuQvbMP6rAMAoAUefAVogYf6u2w58m72NMdTp3UGBNcl0AAtx1KOJy/yAM8johKYvXt2aHBdAw1QZqqq7sFabZ/gugY6OEJ0pJPeWn8WXLdAB8MYwXUNdBAMuoUeOjia4AJsfcs4Aug3uIB7gNPq0upxedWsGV0zfWr8XlAa9fOTbzs9G3wFxMZXQGx8BcwBrgJi87RCd39eqkba/6ZIKA9AuG8/2+I1xAHlD4syumyld28JAAAAAElFTkSuQmCC';
				var men = 'image://data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAABwElEQVRoge2ZwbGCMBCGLeFPKrAEOniWYAmWQAl0gJddj1KCJdDB87zLTOxAO/AdFEcBFRQMz8k/s6fMwP9lQzZLJpMBhdQBqcOQ7+hdSB0sydqQ7i3r0bIeDenekqxHDwOS6Np4NQzpHiSRb5+NQurwyPwNxBgzYUmTZ+YvQZr49luTYXFtAQzJr2+/NbWe/XP49lvTvwcwrHnrJcSa+/ZbE0gWbQFAsvDtt1FtsjDK2S91rgWbBzVgM8oaUBW4mFuWzLDmp6xIBi7mvn3dCCQRWH96iU8eL8DFvEvRar8ziRs8S112mldjsB0KKzcd2vwFYuWmvQNYKpafArBULHsH6FJp3/8eBqgVXwlgWHNLmhjSXWeTpDtLmtx77kcAysbkleyUJpsaoQAQAAJAAAgAAaB3AMuSVV9Unt/fATh1b9VxyXoHAEl0a0C2ZX/7FkDqYFi2NxMzVIcGksiSJmCNr5vz+wCSNWWuukyQOoA1tqSJl7/X9wCw0hlWOnsG4F0BwLcCgG8FAN8KAL4VAHzrawHK8dEDgDWuGSTdlONN105gjX16rgmssSHdGdaDZcmuj9tIHc5XTgdDuuvT/B/L5uw/gnvI3QAAAABJRU5ErkJggg==';
				var maxData = r.num ? r.num : '';
				var mens = r.data.men ? r.data.men : '';
				var womens = r.data.women ? r.data.women : '';
				option = {

					//性别
					xAxis: {
						show: false
					},
					yAxis: {
						data: ['男', '女'],
						inverse: true,
						axisTick: {show: false},
						axisLine: {show: false},
						axisLabel: {
							margin: 10,
							textStyle: {
								color: '#eee',
								fontSize: 14
							}
						},
						splitLine: {           // 分隔线
							show: false
						}
					},
					grid: {
						width: '70%' ,
						top: 'center',
						height: 200,
						left: 40,
						right: 100
					},

					series: [

						//性别比例
						{
							// current data
							type: 'pictorialBar',
							symbolRepeat: 'fixed',
							symbolMargin: '20%',
							symbolClip: true,
							symbolSize: 20,
							symbolBoundingData: maxData,
							data:[{value: mens,symbol: men},{value:womens,symbol: women}],
							z: 10
						}, {
							// full data
							type: 'pictorialBar',
							itemStyle: {
								normal: {
									opacity: 0.2
								}
							},
							label: {
								normal: {
									show: true,
									formatter: function (params) {
										return (params.value / maxData * 100).toFixed(1) + ' %';
									},
									position: 'left , bottom',
									offset: [0, 65],
									textStyle: {
										color: '#fff',
										fontSize: 12
									}
								}
							},
							animationDuration: 0,
							symbolRepeat: 'fixed',
							symbolMargin: '20%',
							symbolSize: 20,
							symbolBoundingData: maxData,
							data:[{value: mens,symbol: men},{value:womens,symbol: women}],
							z: 5
						}
					]
				};
				sexRatioChart.setOption(option);
//			}
		});
	}
	//
	function getVisitorAge(s_day) {
		$.get("<?php echo U('getVisitorAge');?>",{s_day:s_day},function (res) {
//			if(res.code == 1){
				var r = res.data;
				var age_avg = r.age_avg ? r.age_avg : 0;
				var datas = r.data ? r.data : '';
				//游客年龄占比
				var AgeRatioChart = echarts.init(document.getElementById('AgeRatio') , 'westeros');

				option = {
					legend: {
						x: 'right',
						y: 'top',
						icon: 'circle',
						data:['1天','2天','3天','4天','5天以上']
					},
					title: {
						width: '65%' ,
						text: '游客平均年龄',
						subtext: age_avg+'岁',
						textStyle:{
							fontSize: 14,
							color: '#80a6f8'
						},
						subtextStyle:{
							fontSize: 20,
							color: '#eee'
						},
						top: '45%',
						left: '50%',
						textAlign: 'center'
					},
					tooltip: {
						trigger: 'item',
						formatter: "{a}： {b} <br/>客流： {c} <br/>占比： {d}%"
					},
					series: [
						{
							name: '游客年龄',
							type:'pie',
							radius: ['45%', '60%'],
							center: ['50%', '50%'],
							avoidLabelOverlap: true,
							label: {
								normal: {
									formatter: '{b}\n{d}%'
								},
								emphasis: {
									show: true,
									textStyle: {
										fontSize: '12',
										fontWeight: 'bold'
									}
								}
							},
							labelLine: {
								normal: {
									show: true
								}
							},
							data:datas,
//						data:[
//							{value:335, name:'<16岁'},
//							{value:432, name:'16-24岁'},
//							{value:335, name:'25-35岁'},
//							{value:432, name:'36-46岁'},
//							{value:432, name:'>46岁'}
//						]
						}
					]
				};
				AgeRatioChart.setOption(option);
//			}
		});
	}
	//景区游客客流TOP10
	function getVisitorFlow(s_day) {
		$.get("<?php echo U('getVisitorFlow');?>",{s_day:s_day},function (res) {
//			if(res.code == 1){
				var r = res.data;
				var num = r.num ? r.num : '';
				var name = r.name ? r.name : '';
				var radio = r.radio ? r.radio : '';
				//景区游客客流TOP10（近1周）
				var passengerTOP10ScenicChart = echarts.init(document.getElementById('passengerTOP10Scenic') , 'westeros');
				option = {
					tooltip : {
						trigger: 'axis',
						axisPointer : {            // 坐标轴指示器，坐标轴触发有效
							type : 'line'        // 默认为直线，可选为：'line' | 'shadow'
						}
					},
					grid: {
						left: '3%',
						right: '4%',
						bottom: '3%',
						containLabel: true
					},
					xAxis : [
						{
							type : 'category',
							splitLine: {           // 分隔线
								show: false
							},
							data : name,//['景区名称显示区域', '景区名称显示区域', '景区名称显示区域', '景区名称显示区域', '景区名称显示区域', '景区名称显示区域', '景区名称显示区域', '景区名称显示区域', '景区名称显示区域', '景区名称显示区域'],
							axisTick: {
								alignWithLabel: true
							},
							axisLabel: {rotate: 50, interval: 0}
						}
					],
					yAxis : [
						{
							name:'单位：人',
							type : 'value'
						}
					],
					series : [
						{
							name:'客流',
							type:'bar',
							barWidth: '30%',
							itemStyle:{
								normal:{
									barBorderRadius: [30, 30, 0, 0],
									color:new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
										offset: 0,
										color: '#0286de'
									}, {
										offset: .8,
										color: '#992cee'
									}], false)
								}
							},
							data:num,//[930, 778, 700, 628, 600, 534, 467, 330, 220, 120]
						},
						{
							name:'占比(%)',
							type:'bar',
							itemStyle: {
								normal:{
									label: {
										normal: {
											show: false,
											position: 'right',
											distance: 10,
											formatter: function(param) {
												return param.value + '%';
											},
											textStyle: {
												color: '#ffffff',
												fontSize: '16'
											}
										}
									}
								}
							},
							barWidth: '0.000000000000001%',
							data:radio,//[ 10.87, 5, 8, 9, 4, 3, 12, 8, 7, 6]
						}
					]
				};
				passengerTOP10ScenicChart.setOption(option);
//			}
		});
	}
	//景区近7天平均值统计
	function getWeekAvg() {
		$.get("<?php echo U('getWeekAvg');?>",function (res) {
			if(res.code == 1){
				var r = res.data;
				//平均年龄
				var averageValueChart = echarts.init(document.getElementById('averageValue') , 'westeros');

				option = {
					title: {
						text: '游客平均年龄',
						subtext: r.age_avg+'岁',
						top: '40%',
						left: 'center',
						itemGap: 10,               // 主副标题纵向间隔，单位px，默认为10，
						textStyle: {
							fontSize: 12,
							fontWeight: 'normal',
							color: '#00e7ae'          // 主标题样式
						},
						subtextStyle: {            // 副标题样式
							fontSize: '24',
							fontWeight: 'bolder',
							color: '#00e7ae'
						}
					},
					legend: {
						show:false
					},
					tooltip: {
						trigger: 'item',
						show:false
					},
					series: [
						{
							type:'pie',
							radius: ['65%', '70%'],
							avoidLabelOverlap: true,
							hoverAnimation: false,
							itemStyle:{
								normal: {
									shadowBlur: 40,
									shadowColor: 'rgba(40, 40, 40, 0.5)'
								}
							},
							label: {
								show: false,
								emphasis: {
									show: false
								}
							},
							labelLine: {
								normal: {
									show: false
								}
							},
							data:[{
								value:29,
								itemStyle: {
									normal: {
										color: '#00e7ae',
										shadowColor: '#00e7ae',
										shadowBlur: 10
									}
								}
							}]
						}
					]
				};
				averageValueChart.setOption(option);


				//游客平均停留时长
				var touristAverageStayChart = echarts.init(document.getElementById('touristAverageStay') , 'westeros');

				option = {
					title: {
						text: '游客平均停留时长',
						subtext: r.visit_time+'小时',
						top: '40%',
						left: 'center',
						itemGap: 10,               // 主副标题纵向间隔，单位px，默认为10，
						textStyle: {
							fontSize: 12,
							fontWeight: 'normal',
							color: '#bb87ea'          // 主标题样式
						},
						subtextStyle: {            // 副标题样式
							fontSize: '24',
							fontWeight: 'bolder',
							color: '#bb87ea'
						}
					},
					tooltip: {
						trigger: 'item',
						show:false
					},
					series: [
						{
							name:'游客平均停留',
							type:'pie',
							radius: ['65%', '70%'],
							clockWise: false,
							hoverAnimation: false,
							avoidLabelOverlap: true,
							itemStyle:{
								normal: {
									shadowBlur: 40,
									shadowColor: 'rgba(40, 40, 40, 0.5)'
								}
							},
							label: {
								show: false,
								emphasis: {
									show: false
								}
							},
							labelLine: {
								normal: {
									show: false
								}
							},
							data:[{
								value:2,
								itemStyle: {
									normal: {
										color: '#bb87ea',
										shadowColor: '#bb87ea',
										shadowBlur: 10
									}
								}
							}]
						}
					]
				};
				touristAverageStayChart.setOption(option);


				//平均提前预定
				var averageAdvanceChart = echarts.init(document.getElementById('averageAdvance') , 'westeros');

				option = {
					title: {
						text: '平均提前预定天数',
						subtext: r.visit_fix+'天',
						top: '40%',
						left: 'center',
						itemGap: 10,               // 主副标题纵向间隔，单位px，默认为10，
						textStyle: {
							fontSize: 12,
							fontWeight: 'normal',
							color: '#3dd4de'          // 主标题样式
						},
						subtextStyle: {            // 副标题样式
							fontSize: '24',
							fontWeight: 'bolder',
							color: '#3dd4de'
						}
					},
					tooltip: {
						trigger: 'item',
						show:false
					},
					series: [
						{
							type:'pie',
							radius: ['65%', '70%'],
							avoidLabelOverlap: true,
							hoverAnimation: false,
							itemStyle:{
								normal: {
									shadowBlur: 40,
									shadowColor: 'rgba(40, 40, 40, 0.5)'
								}
							},
							label: {
								show: false,
								emphasis: {
									show: false
								}
							},
							labelLine: {
								normal: {
									show: false
								}
							},
							data:[{
								value:2,
								itemStyle: {
									normal: {
										color: '#3dd4de',
										shadowColor: '#3dd4de',
										shadowBlur: 10
									}
								}
							}]
						}
					]
				};
				averageAdvanceChart.setOption(option);


				//车辆平均停留时长
				var carAverageStayChart = echarts.init(document.getElementById('carAverageStay') , 'westeros');

				option = {
					title: {
						text: '车辆平均停留时长',
						subtext: r.visit_car+'小时',
						top: '40%',
						left: 'center',
						itemGap: 10,               // 主副标题纵向间隔，单位px，默认为10，
						textStyle: {
							fontSize: 12,
							fontWeight: 'normal',
							color: '#fe8b75'          // 主标题样式
						},
						subtextStyle: {            // 副标题样式
							fontSize: '24',
							fontWeight: 'bolder',
							color: '#fe8b75'
						}
					},
					tooltip: {
						trigger: 'item',
						show:false
					},
					series: [
						{
							type:'pie',
							radius: ['65%', '70%'],
							avoidLabelOverlap: true,
							hoverAnimation: false,
							label: {
								show: false,
								emphasis: {
									show: false
								}
							},
							labelLine: {
								normal: {
									show: false
								}
							},
							data:[
								{
									value: 3,
									itemStyle: {
										normal: {
											color: '#fe8b75',
											shadowColor: '#fe8b75',
											shadowBlur: 10
										}
									}
								}
							]
						}
					]
				};
				carAverageStayChart.setOption(option);
			}
		});
	}
</script>