<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

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
<script src="/Application/Admin//Public/Admin/js/ff/carFlow.js"></script>
<body onload="aTim()" class="GZHSJbody KLCountBody travelBody">
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
				<!--<ul>
					<li><a href="<?php echo U('Attraction/index');?>">景区概况</a></li>
					<li><a href="<?php echo U('Attraction/passengerFlow');?>">景区客流</a></li>
					<li><a href="javascript:;" class="active">景区车流</a></li>
					<li><a href="<?php echo U('Scenic/ticketAnalysis');?>">票务分析</a></li>
				</ul>-->
				<ul>
	<?php if(is_array($__MENU__["child"])): $i = 0; $__LIST__ = $__MENU__["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sub_menu): $mod = ($i % 2 );++$i;?><li>
			<?php if($sub_menu["class"] != 'on'): ?><a href="<?php echo (u($sub_menu["url"])); ?>"><?php echo ($sub_menu["name"]); ?></a>
			<?php else: ?>
				<a href="javascript:;" class="active"><?php echo ($sub_menu["name"]); ?></a><?php endif; ?>
        </li><?php endforeach; endif; else: echo "" ;endif; ?>
</ul>
			</div>
			<div class="onelineOne countModuleBox">
				<ul class="clearfix">
					<li class="countModule gradient">
						<div class="countModule-inner clearfix">
							<h4>今日接待游客车流</h4>
							<p class="float-left"><i class="fa fa-3x fa-car"><e>今</e></i></p>
							<p class="float-right"><span><?php echo (number_format((isset($flow_info["car_num"]) && ($flow_info["car_num"] !== ""))?($flow_info["car_num"]):0)); ?></span>辆</p>
						</div>
					</li>
					<li class="countModule gradient">
						<div class="countModule-inner clearfix">
							<h4>昨日接待游客车流</h4>
							<p class="float-left"><i class="fa fa-3x fa-car"><e>昨</e></i></p>
							<p class="float-right"><span><?php echo (number_format((isset($flow_info["yesterday_total"]) && ($flow_info["yesterday_total"] !== ""))?($flow_info["yesterday_total"]):0)); ?></span>辆</p>
						</div>
					</li>
					<li class="countModule gradient">
						<div class="countModule-inner clearfix">
							<h4>近7日接待游客车流</h4>
							<p class="float-left"><i class="fa fa-3x fa-car"><e>7</e></i></p>
							<p class="float-right"><span><?php echo (number_format((isset($flow_info["sevenday_total"]) && ($flow_info["sevenday_total"] !== ""))?($flow_info["sevenday_total"]):0)); ?></span>辆</p>
						</div>
					</li>
					<li class="countModule gradient">
						<div class="countModule-inner clearfix">
							<h4>本月接待游客车流</h4>
							<p class="float-left"><i class="fa fa-3x fa-car"><e>月</e></i></p>
							<p class="float-right"><span><?php echo (number_format((isset($flow_info["month_total"]) && ($flow_info["month_total"] !== ""))?($flow_info["month_total"]):0)); ?></span>辆</p>
						</div>
					</li>
					<li class="countModule gradient">
						<div class="countModule-inner clearfix">
							<h4>今年接待游客车流</h4>
							<p class="float-left"><i class="fa fa-3x fa-car"><e>年</e></i></p>
							<p class="float-right"><span><?php echo (number_format((isset($flow_info["year_total"]) && ($flow_info["year_total"] !== ""))?($flow_info["year_total"]):0)); ?></span>辆</p>
						</div>
					</li>
				</ul>
			</div>
			<div class="onelineOne">
				<div class="box-content">
					<span class="left-top"></span>
					<span class="right-top"></span>
					<span class="left-bottom"></span>
					<span class="right-bottom"></span>
					<div class="box-content-top clearfix">
						<h4>车辆实时监控数据</h4>
					</div>
					<div class="char-plate clearfix">
						<div class="float-left">
							<div id="carMonitor" style="width: 850px; height:400px;"></div>
						</div>
						<div class="float-right carType-contain">
							<div id="carType" style="width: 330px; height:360px;"></div>
							<ul>
							<?php if(is_array($type_info)): $i = 0; $__LIST__ = $type_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li><span><?php echo ((isset($v["car_num"]) && ($v["car_num"] !== ""))?($v["car_num"]):0); ?></span>辆</li><?php endforeach; endif; else: echo "" ;endif; ?>
							</ul>
						</div>
					</div>
				</div>
			</div>

			<div class="onelineOne">
				<div class="box-content">
					<span class="left-top"></span>
					<span class="right-top"></span>
					<span class="left-bottom"></span>
					<span class="right-bottom"></span>
					<div class="box-content-top clearfix">
						<h4>车辆来源省份统计（外省）</h4>
						<p style="margin-left: 730px;"><span class="active" onclick="getProvince(1);">7天</span><span onclick="getProvince(2);">30天</span><span onclick="getProvince(3);">90天</span><span onclick="getProvince(4);">半年</span><span onclick="getProvince(5);">一年</span></p>
					</div>
					<div class="char-plate clearfix">
						<div id="carSourceOtherProvinces" style="width: 1200px; height:400px;"></div>
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
								<h4>车辆来源地城市分布（本省）</h4>
								<p><span class="active" onclick="getCity(1);">7天</span><span onclick="getCity(2);">30天</span><span onclick="getCity(3);">90天</span><span onclick="getCity(4);">半年</span><span onclick="getCity(5);">一年</span></p>
							</div>
							<div class="char-plate">
								<div id="carSourceThisProvince" style="width: 550px; height:350px; margin-top: 30px;"></div>
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
								<h4>
									外省与本省车流统计分析
								</h4>
								<p><span class="active" onclick="getProvinceIO(1);">7天</span><span onclick="getProvinceIO(2);">30天</span><span onclick="getProvinceIO(3);">90天</span><span onclick="getProvinceIO(4);">半年</span><span onclick="getProvinceIO(5);">一年</span></p>
							</div>
							<div class="char-plate">
								<div id="carProvinceAnalysis" style="width: 550px; height:350px; margin-top: 30px;"></div>
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
							<div class="box-content-top clearfix">
								<h4>车辆停留时长统计</h4>
								<p><span class="active" onclick="getRemain(1);">7天</span><span onclick="getRemain(2);">30天</span><span onclick="getRemain(3);">90天</span><span onclick="getRemain(4);">半年</span><span onclick="getRemain(5);">一年</span></p>
							</div>
							<div class="char-plate">
								<div id="carStayTime" style="width: 550px; height:350px; margin-top: 30px;"></div>
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
								<h4>
									车流量景区排行
								</h4>
								<p><span class="active" onclick="getScenic(1);">7天</span><span onclick="getScenic(2);">30天</span><span onclick="getScenic(3);">90天</span><span onclick="getScenic(4);">半年</span><span onclick="getScenic(5);">一年</span></p>
							</div>
							<div class="char-plate">
								<div id="carTOP10Scenic" style="width: 550px; height:350px; margin-top: 30px;"></div>
							</div>
						</div>
					</li>
				</ul>
			</div>

		</div>
	</div>
</body>
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
	$(function() {
		//车辆实时监控数据
	    var carMonitorChart = echarts.init(document.getElementById('carMonitor') , 'westeros');
	    option = {
	        grid: [
	            {
	                width:'85%',
	                left:'10%'
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
	                data: <?php echo ($real_data_hour); ?>
	            }
	        ],
	        yAxis: [
	            {
	                name:'单位：辆',
	                type: "value",
	                axisLine: {
	                    show: true
	                }
	            }
	        ],
	        series: [
	            {
	                name: "实时车辆",
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
	                data: <?php echo ($real_data); ?>,
	                markPoint: {
	                    data: [
	                        {type: 'max', name: '最大值'}
	                    ]
	                }
	            }
	        ]
	    };
	    carMonitorChart.setOption(option);

	    //车辆类型占比
	    var carTypeChart = echarts.init(document.getElementById('carType') , 'westeros');
	    option = {
	        tooltip: {
	            trigger: 'item',
	            formatter: "{b}<br/> 车流：{c} <br/> 占比：{d}%"
	        },
	        legend: {
	            orient: 'vertical',
	            x: '5%',
	            y: 'bottom',
	            icon: 'square',
	            data:['5座小车','中巴车辆','大巴车辆']
	        },
	        series: [
	            {
	                type:'pie',
	                roseType:'area',
	                radius: ['0', '40%'],
	                center: ['50%', '40%'],
	                avoidLabelOverlap: true,
	                label: {
	                    normal:{
	                        formatter:'{b}\n{d}%'
	                    },
	                    emphasis: {
	                        show: true,
	                        textStyle: {
	                            fontWeight: 'bold'
	                        }
	                    }
	                },
	                labelLine: {
	                    normal: {
	                        show: true
	                    }
	                },
	                data:<?php echo ($type_data); ?>
	            }
	        ]
	    };
	    carTypeChart.setOption(option);

	    //车辆来源省份TOP10统计（外省）
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
	    option = {
	        //tooltip: {},
	        visualMap: {
	            min: 0,
	            max: <?php echo ($province_max); ?>,
	            left: '2%',
	            top: '2%',
	            text: ['High','Low'],
	            textStyle: {
	                color: '#3986d8'
	            },
	            seriesIndex: [1],
	            inRange: {
	                color: ['#7fe1ef', '#0286de']
	            },
	            calculable : true,
	            itemWidth: 8,
	            itemHeight: 50
	        },
	        geo: {
	            width: '40%',
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
	        //排行
	        tooltip: {
	            trigger: 'axis',
	            formatter: "{b} <br/> 车流： {c}",
	            axisPointer: {
	                type: 'shadow'
	            }
	        },
	        legend: {
	            x: 'right',
	            y: 'top',
	            icon: 'circle',
	            data: ['车流量']
	        },
	        grid: {
	            width: '35%' ,
	            left: '60%',
	            right: '2%',
	            bottom: '2%',
	            containLabel: true
	        },
	        xAxis: {
	            show: false
	            // type: 'value',
	            // boundaryGap: [0, 0.01]
	        },
	        yAxis: {
	            splitLine: {           // 分隔线
	                show: false
	            },
	            axisLine: {show: false},
	            inverse: false,
	            axisTick: {show: false},
	            color: '#666',
	            data: <?php echo ($province); ?>
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
	                data:<?php echo ($province_num); ?>
	            },
	            //排行
	            {
	                width: '40%',
	                name: '车流',
	                type: 'bar',
	                barWidth: '30%',
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
	                        formatter: "{c}",
	                        show: true,
	                        textStyle:{
	                            color:'#ddd'
	                        },
	                        position:  "right"
	                    }
	                },
	                data: <?php echo ($province_car_num); ?>
	            }
	        ]
	    };
	    carSourceOtherProvincesChart.setOption(option);

	    //车辆来源地城市分布（本省）
	    var carSourceThisProvinceChart = echarts.init(document.getElementById('carSourceThisProvince') , 'westeros');
	    option = {
	        tooltip: {
	            trigger: 'item',
	            formatter: "{b} <br/> 车流： {c} <br/> 占比： {d}%"
	        },
	        legend: {
	            orient: 'vertical',
	            x: '2%',
	            y: 'top',
	            icon: 'square',
	            data:<?php echo ($city); ?>
	        },
	        series: [
	            {
	                type:'pie',
	                radius: ['40%', '60%'],
	                center: ['60%', '50%'],
	                avoidLabelOverlap: true,
	                label: {
	                    normal:{
	                        formatter: '{b}\n{d}%'
	                    },
	                    emphasis: {
	                        show: true,
	                        textStyle: {
	                            fontSize: '14',
	                            fontWeight: 'bold'
	                        }
	                    }
	                },
	                labelLine: {
	                    normal: {
	                        show: true
	                    }
	                },
	                data:<?php echo ($city_num); ?>
	            }
	        ]
	    };
	    carSourceThisProvinceChart.setOption(option);

	    //外省与本省车流统计分析
	    var carProvinceAnalysisChart = echarts.init(document.getElementById('carProvinceAnalysis') , 'westeros');
	    option = {
	        tooltip: {
	            trigger: 'item',
	            formatter: "{b} <br/>车流： {c} <br/>占比： {d}%"
	        },
	        legend: {
	            orient: 'vertical',
	            x: '2%',
	            y: 'top',
	            icon: 'square',
	            data:['外省','本省']
	        },
	        series: [
	            {
	                type:'pie',
	                radius: ['40%', '60%'],
	                center: ['60%', '50%'],
	                avoidLabelOverlap: true,
	                label: {
	                    normal:{
	                        formatter: '{b}\n{d}%'
	                    },
	                    emphasis: {
	                        show: true,
	                        textStyle: {
	                            fontSize: '14',
	                            fontWeight: 'bold'
	                        }
	                    }
	                },
	                labelLine: {
	                    normal: {
	                        show: true
	                    }
	                },
	                data:<?php echo ($in_out_province_num); ?>
	            }
	        ]
	    };
	    carProvinceAnalysisChart.setOption(option);

	    //车辆停留时长统计
	    var carStayTimeChart = echarts.init(document.getElementById('carStayTime') , 'westeros');
	    option = {
	        title: {
	            text: '平均停留时长',
	            subtext: <?php echo ($average_reamin_hour); ?>+'H',
	            textStyle:{
	                fontSize: 14,
	                fontWight:'normal',
	                color: '#80a6f8'
	            },
	            subtextStyle:{
	                fontSize: 20,
	                color: '#eee'
	            },
	            top: '45%',
	            left: '60%',
	            textAlign: 'center'
	        },
	        tooltip: {
	            trigger: 'item',
	            formatter: "{a}{b} <br/>车流： {c} <br/>占比： {d}%"
	        },
	        legend: {
	            orient: 'vertical',
	            x: '2%',
	            y: 'top',
	            icon: 'square',
	            data:['<1H', '1-2H', '2-3H' , '>3H']
	        },
	        series: [
	            {
	                name:'',
	                type:'pie',
	                radius: ['40%', '60%'],
	                center: ['60%', '50%'],
	                avoidLabelOverlap: true,
	                label: {
	                    normal:{
	                        formatter: '{b}\n{d}%'
	                    },
	                    emphasis: {
	                        show: true,
	                        textStyle: {
	                            fontSize: '14',
	                            fontWeight: 'bold'
	                        }
	                    }
	                },
	                data:<?php echo ($remain_num); ?>
	            }
	        ]
	    };
	    carStayTimeChart.setOption(option);

	    //车流量TOP10景区
	    var carTOP10ScenicChart = echarts.init(document.getElementById('carTOP10Scenic') , 'westeros');
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
	                data : <?php echo ($scenic); ?>,
	                axisTick: {
	                    alignWithLabel: true
	                },
	                axisLabel: {rotate: 50, interval: 0}
	            }
	        ],
	        yAxis : [
	            {
	                name:'单位：辆',
	                type : 'value'
	            }
	        ],
	        series : [
	            {
	                name:'车流',
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
	                data:<?php echo ($scenic_car_num); ?>
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
	                data:<?php echo ($percent); ?>
	            }
	        ]
	    };
	    carTOP10ScenicChart.setOption(option);

	});
</script>