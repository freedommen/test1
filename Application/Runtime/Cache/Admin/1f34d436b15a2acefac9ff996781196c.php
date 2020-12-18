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
<body onload="aTim();getData(1);" class="GZHSJbody KLCountBody travelBody">
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
					<!--<li><a href="<?php echo U('Attraction/index');?>">景区概况</a></li>-->
					<!--<li><a href="javascript:;" class="active">景区客流</a></li>-->
					<!--<li><a href="<?php echo U('Scenic/carFlow');?>">景区车流</a></li>-->
					<!--<li><a href="<?php echo U('Scenic/ticketAnalysis');?>">票务分析</a></li>-->
				<!--</ul>-->
			</div>

			<div class="onelineOne">
				<div class="box-content">
					<span class="left-top"></span>
					<span class="right-top"></span>
					<span class="left-bottom"></span>
					<span class="right-bottom"></span>
					<div class="box-content-top clearfix">
						<h4>景区实时客流</h4>
					</div>
					<div class="char-plate clearfix">
						<div id="JQSSKL" style="width: 1200px; height:400px;"></div>
					</div>
				</div>
			</div>

			<div class="onelineOne">
				<div class="box-content clearfix">
					<span class="left-top"></span>
					<span class="right-top"></span>
					<span class="left-bottom"></span>
					<span class="right-bottom"></span>
					<div class="box-content-top clearfix">
						<h4>景区客流统计</h4>
						<p>
							<span class="active" onclick="getVisitorData(1)">7天</span>
							<span onclick="getVisitorData(2)">30天</span>
							<span onclick="getVisitorData(3)">90天</span>
							<span onclick="getVisitorData(4)">半年</span>
							<span onclick="getVisitorData(5)">一年</span>
						</p>
					</div>
					<div class="char-plate float-left">
						<div id="JQKLCount" style="width: 700px; height:350px; "></div>
					</div>
					<div class="float-right rankingTable">
						<table>
							<thead>
								<tr>
									<th>排名</th><th>景区名称</th><th>游客数量</th>
								</tr>
							</thead>
							<tbody class="spot_rank">
								<!--<tr class="highLight">-->
									<!--<td>1</td><td>法门寺</td><td>6078</td>-->
								<!--</tr>-->
								<!--<tr class="highLight">-->
									<!--<td>2</td><td>七星河湿地公园</td><td>4281</td>-->
								<!--</tr>-->
								<!--<tr class="highLight">-->
									<!--<td>3</td><td>野河山风景区</td><td>3066</td>-->
								<!--</tr>-->
								<!--<tr>-->
									<!--<td>4</td><td>周原遗址博物馆</td><td>3009</td>-->
								<!--</tr>-->
								<!--<tr>-->
									<!--<td>5</td><td>扶风县城</td><td>1909</td>-->
								<!--</tr>-->
								<!--<tr>-->
									<!--<td>6</td><td>关中风情园</td><td>1002</td>-->
								<!--</tr>-->
								<!--<tr>-->
									<!--<td>7</td><td>扶风县博物馆</td><td>1066</td>-->
								<!--</tr>-->
								<!--<tr>-->
									<!--<td>8</td><td>扶风县城</td><td>1009</td>-->
								<!--</tr>-->
								<!--<tr>-->
									<!--<td>9</td><td>关中风情园</td><td>902</td>-->
								<!--</tr>-->
								<!--<tr>-->
									<!--<td>10</td><td>扶风县博物馆</td><td>666</td>-->
								<!--</tr>-->
							</tbody>
						</table>
					</div>
				</div>
			</div>

		</div>
	</div>
</body>
<script src="/Application/Admin//Public/Admin/js/ff/jquery.js"></script>
<script src="/Application/Admin//Public/Admin/js/ff/common.js"></script>
<script src="/Application/Admin//Public/Admin/js/ff/westeros.js"></script>
<!--<script src="/Application/Admin//Public/Admin/js/ff/scenicAreaPassengerFlow.js"></script>-->

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
	//页面预加载函数
	function getData(s_day){
		getRealVisitorFlow();//景区实时客流
		getVisitorCount(s_day);//景区客流统计及景区排名
	}
	//客流统计及景区排名
	function getVisitorData(s_day){
		getVisitorCount(s_day);//景区客流统计及景区排名
	}
	//景区实时客流
	function getRealVisitorFlow() {
		$.get("<?php echo U('getRealVisitorFlow');?>",function (res) {
//			if(res.code == 1){
				var r = res.data;
				var s_time = r.s_time ? r.s_time : '';
				var num  = r.num ? r.num : '';
				//景区实时客流
				var JQSSKLChart = echarts.init(document.getElementById('JQSSKL') , 'westeros');
				option = {
					grid: [
						{
							width:'90%',
							left:'6%'
						}
					],
					tooltip: {
						trigger: "axis",
						axisPointer: {
							lineStyle: {
								color: "rgb(0, 185, 255)",
								type: "solid",
								width: 1
							},
							type: "line",
							areaStyle: {
								type: "default"
							}
						}
					},
					calculable: true,
					xAxis: [
						{
							type: "category",
							boundaryGap: false,
							axisLine: {
								show: true
							},
							splitLine: {
								"show": false
							},
							data: s_time,//["8:00", "9:00", "10:00", "11:00", "12:00", "13:00", "14:00", "15:00", "16:00"]
						}
					],
					yAxis: [
						{
							name:'单位：人',
							type: "value",
							axisLine: {
								show: true
							}
						}
					],
					series: [
						{
							name: "在园",
							type: "line",
							smooth: true,
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
							data: num,//[40, 89, 126, 100, 187, 134, 124, 90, 60],
							markPoint: {
								data: [
									{type: 'max', name: '最大值'}
								]
							}
						}
					]
				};
				JQSSKLChart.setOption(option);
//			}
		});
	}
	//景区客流统计
	function getVisitorCount(s_day) {
		$.get("<?php echo U('getVisitorCount');?>",{s_day:s_day},function (res) {
//			if(res.code == 1){
				var r = res.data;
				var s_date = r.s_date ? r.s_date : '';
				var num  = r.num ? r.num : '';
				//景区客流统计
				var JQKLCountChart = echarts.init(document.getElementById('JQKLCount') , 'westeros');
				option = {
					tooltip: {
						trigger: 'axis',
						// axisPointer: {
						//     type: 'cross',
						//     crossStyle: {
						//         color: '#999'
						//     }
						// }
					},
					legend: {
						data:['行程单数','接待客流']
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
							name: '单位：人',
							// min: 0,
							// max: 1000,
							// interval: 200
						}
					],
					series: [
						{
							name:'客流',
							type:'bar',
							barWidth: '30%',
							itemStyle:{
								normal:{
									// barBorderRadius: [100, 100, 0, 0],
									color:new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
										offset: 0,
										color: '#0286de'
									}, {
										offset: .8,
										color: '#992cee'
									}], false)
								}
							},
							data:r.num,//[12312, 4324, 5332, 7532, 2555, 3421, 8754]
						}
					]
				};
				JQKLCountChart.setOption(option);
				//景区排名
				var str = '';
				var highLight = '';
				if(r.rank){
					$.each(r.rank,function(index,item){
						highLight = index<=2 ? "class='highLight'" : '';
						str += '<tr '+highLight+'>'+ '<td>'+(index+1)+'</td>'+'<td>'+item.name+'</td>'+'<td>'+item.num+'</td>'+'</tr>';
					});
				}
				$('.spot_rank').html(str);
//			}
		});
	}
</script>