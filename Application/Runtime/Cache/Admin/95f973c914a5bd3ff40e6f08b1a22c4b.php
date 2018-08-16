<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<!--<head>-->
	<!--<meta charset="UTF-8" />-->
	<!--<meta name="keywords" content="">-->
	<!--<meta name="description" content="">-->
	<!--<title></title>-->
	<!--<link rel="stylesheet" type="text/css" href="../css/common.css">-->
	<!--<link rel="stylesheet" type="text/css" href="../css/fuFengStyle.css">-->
	<!--<link rel="stylesheet" type="text/css" href="../css/newStyle.css">-->
	<!--<script src="../js/echarts.min.js"></script>-->
	<!--<script src="../js/china.js"></script>-->
<!--</head>-->

<head>
    <meta charset="UTF-8" />
    <meta name="keywords" content="">
    <meta name="description" content="">
    <title><?php echo ($meta_title); ?> | 中智尚联</title>
    <link rel="stylesheet" type="text/css" href="/Application/Admin//Public/Admin/css/font-awesome/css/font-awesome.min.css">
    <!--<link rel="stylesheet" type="text/css" href="/Application/Admin//Public/Admin/css/font-awesome-4.7.0/css/font-awesome.min.css">-->
    <link rel="stylesheet" type="text/css" href="/Application/Admin//Public/Admin/css/ffcommon.css">
    <link rel="stylesheet" type="text/css" href="/Application/Admin//Public/Admin/css/fuFengStyle.css">
	<!--<link rel="stylesheet" type="text/css" href="/Application/Admin//Public/Admin/css/newStyle.css">-->

    <!-- 百度插件 -->
    <script src="/Application/Admin//Public/Admin/js/ff/echarts.min.js"></script>
    <script src="/Application/Admin//Public/Admin/js/ff/china.js"></script>

    <script src="/Application/Admin//Public/Admin/js/ff/jquery.js"></script>
    <script src="/Application/Admin//Public/Admin/js/ff/common.js"></script>
    <script src="/Application/Admin//Public/Admin/js/ff/westeros.js"></script>
</head>
<link rel="stylesheet" type="text/css" href="/Application/Admin//Public/Admin/css/newStyle.css">
<body onload="aTim();getPayData(1)" class="GZHSJbody KLCountBody ZSAnalysisBody">
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
					<!--<li class="active"><a href="javascript:;">数据分析</a></li>-->
					<!--<li><a href="../publicOpinion.html">舆情监测</a></li>-->
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
					<!--<li><a href="<?php echo U('index');?>">客流统计</a></li>-->
					<!--<li><a href="<?php echo U('getHoliday');?>" >假日客流</a></li>-->
					<!--<li><a href="<?php echo U('getComplain');?>" >投诉分析</a></li>-->
					<!--<li><a href="<?php echo U('getConsumption');?>" class="active">消费分析</a></li>-->
				<!--</ul>-->
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
									游客支付方式统计分析
								</h4>
								<p class="clearfix">
									<span class="active" onclick="getPayType(1)">7天</span>
									<span onclick="getPayType(2)">30天</span>
									<span onclick="getPayType(3)">90天</span>
									<span onclick="getPayType(4)">半年</span>
									<span onclick="getPayType(5)">一年</span>
								</p>
							</div>
							<div class="char-plate">
								<div id="payWay" style="width: 550px; height:300px;"></div>
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
								<h4>旅游消费统计分析</h4>
								<p class="clearfix">
									<span class="active" onclick="getTourismPay(1)">7天</span>
									<span onclick="getTourismPay(2)">30天</span>
									<span onclick="getTourismPay(3)">90天</span>
									<span onclick="getTourismPay(4)">半年</span>
									<span onclick="getTourismPay(5)">一年</span>
								</p>
							</div>
							<div class="char-plate">
								<div id="consumptionStatistics" style="width: 550px; height:300px;margin-top: 20px;"></div>
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
									消费分布统计分析
								</h4>
								<p class="clearfix">
									<span class="active" onclick="getPayDistribute(1)">7天</span>
									<span onclick="getPayDistribute(2)">30天</span>
									<span onclick="getPayDistribute(3)">90天</span>
									<span onclick="getPayDistribute(4)">半年</span>
									<span onclick="getPayDistribute(5)">一年</span>
								</p>
							</div>
							<div class="char-plate">
								<div id="distributionStatistics" style="width: 550px; height:300px;"></div>
							</div>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
</body>
<script src="/Application/Admin//Public/Admin/js/ff/jquery.js"></script>
<script src="/Application/Admin//Public/Admin/js/ff/common.js"></script>
<script src="/Application/Admin//Public/Admin/js/ff/westeros.js"></script>
<!--<script src="/Application/Admin//Public/Admin/js/ff/consumption.js"></script>-->

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

    })
	//模块选中状态判断
	$(function(){
		$(".clearfix span").click(function(){
			$(this).addClass("active");
			$(this).siblings().removeClass("active");
		});
	});
	//模块图标数据
	function getPayData(s_day) {
		getPayType(s_day);//支付方式统计分析
		getTourismPay(s_day);//旅游消费统计分析
		getPayDistribute(s_day);//消费分布统计分析
	}
	//获取支付方式统计数据
	function getPayType(s_day){
		$.get("<?php echo U('getConsumptionAnalysis');?>",{s_day:s_day},function (res) {
//			if(res.code == 1){
				var r = res.data;
				var payType = r.payType ? r.payType : '';
				var payAmount = r.payAmount ? r.payAmount : '';
				//游客支付方式统计分析
				var payWayChart = echarts.init(document.getElementById('payWay') , 'westeros');
				option = {
					legend: {
						x: 'right',
						y: 'top',
						icon: 'circle',
						data:payType,//['支付宝','银联卡','微信','财付通','现金']
					},
					tooltip: {
						trigger: 'item',
						formatter: "{a}： {b} <br/>占比： {d}%"
					},
					series: [
						{
							name: '支付方式',
							type:'pie',
							radius: [0, '60%'],
							center: ['50%', '55%'],
							avoidLabelOverlap: true,
							selectedMode: 'single',
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
							data:payAmount,
//						]
						}
					]
				};
				payWayChart.setOption(option);
//			}
		});
	}
	//旅游消费统计分析
	function getTourismPay(s_day){
		$.get("<?php echo U('tourismPay');?>",{s_day:s_day},function (res) {
//			if(res.code == 1){
				var r = res.data;
				var payType = r.payType ? r.payType : '';
				var payAmount = r.payAmount ? r.payAmount : '';
				//旅游消费统计分析
				var consumptionStatisticsChart = echarts.init(document.getElementById('consumptionStatistics') , 'westeros');
				option = {
					legend: {
						x: 'right',
						y: 'top',
						icon: 'circle',
						data:payType,//['3000以下','3001-6000','6001-8000','8001-10000','10001以上']
					},
					tooltip: {
						trigger: 'item',
						formatter: "{a}： {b} <br/>占比： {d}%"
					},
					series: [
						{
							name: '消费金额',
							type:'pie',
							radius: [0, '60%'],
							center: ['50%', '55%'],
							avoidLabelOverlap: true,
							selectedMode: 'single',
							label: {
								normal: {
									formatter: '{b}\n{d}%',
									rich: {
										b: {
											fontSize: 20,
											lineHeight: 20
										},
										d: {
											fontSize: 30,
											lineHeight: 20
										}
									}
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
							data:payAmount,
//						data:[
//							{value:553, name:'3000以下', selected:true},
//							{value:342, name:'3001-6000'},
//							{value:234, name:'6001-8000'},
//							{value:123, name:'8001-10000'},
//							{value:89, name:'10001以上'}
//						]
						}
					]
				};
				consumptionStatisticsChart.setOption(option);
//			}
		});
	}
	//消费分布统计分析
	function getPayDistribute(s_day){
		$.get("<?php echo U('payDistribute');?>",{s_day:s_day},function (res) {
//			if(res.code == 1){
				var r = res.data;
				var payType = r.payType ? r.payType : '';
				var payAmount = r.payAmount ? r.payAmount : '';
				//消费分布统计分析
				var distributionStatisticsChart = echarts.init(document.getElementById('distributionStatistics') , 'westeros');
				option = {
					legend: {
						x: 'right',
						y: 'top',
						icon: 'circle',
						data:payType,//['景区','交通','购物','吃喝玩','其他']
					},
					tooltip: {
						trigger: 'item',
						formatter: "{a}： {b} <br/>占比： {d}%"
					},
					series: [
						{
							name: '消费分布',
							type:'pie',
							radius: [0, '60%'],
							center: ['50%', '55%'],
							avoidLabelOverlap: true,
							selectedMode: 'single',
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
							data:payAmount,
//						data:[
//							{value:325, name:'景区', selected:true},
//							{value:342, name:'交通'},
//							{value:423, name:'购物'},
//							{value:534, name:'吃喝玩'},
//							{value:312, name:'其他'}
//						]
						}
					]
				};
				distributionStatisticsChart.setOption(option);
//			}
		});
	}
//	function load_val(s_day=1,callback) {
//		$.get("<?php echo U('getConsumptionAnalysis');?>", {s_day: s_day}, function (res) {
//			r = res.data;
//			callback(res);//将返回结果当作参数返回
//		});
//	}
//	load_val(s_day=1,function(res){
//		return a = res;
//	});
</script>