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
<script src="/Application/Admin//Public/Admin/js/ff/ticketAnalysis.js"></script>
<body onload="aTim()" class="GZHSJbody KLCountBody travelBody ticketBody">
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
							<h4>今日票务总收入</h4>
							<p class="float-left"><i class="fa fa-3x fa-database"><e>今</e></i></p>
							<p class="float-right"><span><?php echo (number_format((isset($ticket_info["amount"]) && ($ticket_info["amount"] !== ""))?($ticket_info["amount"]):0)); ?></span>元</p>
						</div>
					</li>
					<li class="countModule gradient">
						<div class="countModule-inner clearfix">
							<h4>
								今日销售票总量
							</h4>
							<p class="float-left"><i class="fa fa-3x fa-ticket"><e>今</e></i></p>
							<p class="float-right"><span><?php echo (number_format((isset($ticket_info["total"]) && ($ticket_info["total"] !== ""))?($ticket_info["total"]):0)); ?></span>张</p>
						</div>
					</li>
					<li class="countModule gradient">
						<div class="countModule-inner clearfix">
							<h4>今日网络销售票总数</h4>
							<p class="float-left"><i class="fa fa-3x fa-ticket fa-ticket"><e>网</e></i></p>
							<p class="float-right"><span><?php echo (number_format((isset($ticket_info["network_total"]) && ($ticket_info["network_total"] !== ""))?($ticket_info["network_total"]):0)); ?></span>张</p>
						</div>
					</li>
					<li class="countModule gradient">
						<div class="countModule-inner clearfix">
							<h4>近7天累计票务总收入</h4>
							<p class="float-left"><i class="fa fa-3x fa-database"><e>7</e></i></p>
							<p class="float-right"><span><?php echo (number_format((isset($ticket_info['sevenday_total']['amount']) && ($ticket_info['sevenday_total']['amount'] !== ""))?($ticket_info['sevenday_total']['amount']):0)); ?></span>元</p>
						</div>
					</li>
					<li class="countModule gradient">
						<div class="countModule-inner clearfix">
							<h4>近7天累计销售票量</h4>
							<p class="float-left"><i class="fa fa-3x fa-ticket"><e>7</e></i></p>
							<p class="float-right"><span><?php echo (number_format((isset($ticket_info['sevenday_total']['total']) && ($ticket_info['sevenday_total']['total'] !== ""))?($ticket_info['sevenday_total']['total']):0)); ?></span>张</p>
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
								<h4>售票量统计</h4>
								<p><span class="active" onclick="getTicket(1);">7天</span><span onclick="getTicket(2);">30天</span><span onclick="getTicket(3);">90天</span><span onclick="getTicket(4);">半年</span><span onclick="getTicket(5);">一年</span></p>
							</div>
							<div class="char-plate">
								<div id="ticketCount"></div>
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
								<h4>提前购票天数统计</h4>
								<p><span class="active" onclick="getReservations(1);">7天</span><span onclick="getReservations(2);">30天</span><span onclick="getReservations(3);">90天</span><span onclick="getReservations(4);">半年</span><span onclick="getReservations(5);">一年</span></p>
							</div>
							<div class="char-plate">
								<div id="advanceDays"></div>
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
								<h4>票务预订来源统计</h4>
								<p><span class="active" onclick="getSource(1);">7天</span><span onclick="getSource(2);">30天</span><span onclick="getSource(3);">90天</span><span onclick="getSource(4);">半年</span><span onclick="getSource(5);">一年</span></p>
							</div>
							<div class="char-plate">
								<div id="orderSource"></div>
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
								<h4>售票类型统计占比</h4>
								<p><span class="active" onclick="getType(1);">7天</span><span onclick="getType(2);">30天</span><span onclick="getType(3);">90天</span><span onclick="getType(4);">半年</span><span onclick="getType(5);">一年</span></p>
							</div>
							<div class="char-plate">
								<div id="ticketType"></div>
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
								<h4>售票渠道线上线下占比</h4>
								<p><span class="active" onclick="getChannel(1);">7天</span><span onclick="getChannel(2);">30天</span><span onclick="getChannel(3);">90天</span><span onclick="getChannel(4);">半年</span><span onclick="getChannel(5);">一年</span></p>
							</div>
							<div class="char-plate">
								<div id="SalesChannelTFRt"></div>
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
								<h4>支付方式统计分析</h4>
								<p><span class="active" onclick="getPay(1);">7天</span><span onclick="getPay(2);">30天</span><span onclick="getPay(3);">90天</span><span onclick="getPay(4);">半年</span><span onclick="getPay(5);">一年</span></p>
							</div>
							<div class="char-plate">
								<div id="PayWayTFRt"></div>
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
		//售票量统计
	    var ticketCountChart = echarts.init(document.getElementById('ticketCount') , 'westeros');
	    option = {
	        legend:{
	            data:['票量'],
	            right:'0',
	            icon:'circle'
	        },
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
	                boundaryGap: true,
	                axisLine: {
	                    show: true
	                },
	                splitLine: {
	                    "show": false
	                },
	                data: <?php echo ($ticket_num_date); ?>
	            }
	        ],
	        yAxis: [
	            {
	                name:'单位：张',
	                type: "value",
	                axisLine: {
	                    show: true
	                }
	            }
	        ],
	        series: [
	            {
	                name: "票量",
	                type: "bar",
	                barWidth:'40%',
	                smooth: true,
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
	                data: <?php echo ($ticket_num); ?>
	            }
	        ]
	    };
	    ticketCountChart.setOption(option);

	    //提前购票天数统计
	    var advanceDaysChart = echarts.init(document.getElementById('advanceDays') , 'westeros');
	    option = {
	        title: {
	            /*text: '平均提前预定天数',
	            subtext: '2天',
	            textStyle:{
	                fontSize: 14,
	                fontWight:'normal',
	                color: '#80a6f8'
	            },*/
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
	            formatter: "{b}<br/> 人数：{c} <br/> 占比：{d}%"
	        },
	        legend: {
	            orient: 'vertical',
	            x: '5%',
	            y: 'top',
	            icon: 'square',
	            data:['0天','1天','2天','3天','>3天']
	        },
	        series: [
	            {
	                type:'pie',
	                radius: ['50%', '70%'],
	                center: ['60%', '50%'],
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
	                data:<?php echo ($ticket_reservations); ?>
	            }
	        ]
	    };
	    advanceDaysChart.setOption(option);

	    //票务预订来源统计
	    var orderSourceChart = echarts.init(document.getElementById('orderSource') , 'westeros');
	    option = {
	        tooltip: {
	            trigger: 'item',
	            formatter: "{b}<br/> 票量：{c} <br/> 占比： {d}%"
	        },
	        legend: {
	            orient: 'vertical',
	            x: '5%',
	            y: 'top',
	            icon: 'square',
	            data:['窗口或自助机','携程','美团','驴妈妈','其他']
	        },
	        series: [
	            {
	                name:'售票预定来源',
	                type:'pie',
	                // roseType: 'area',
	                radius: ['50%', '70%'],
	                center: ['60%', '50%'],
	                avoidLabelOverlap: true,
	                label: {
	                    normal:{
	                        formatter: '{b}\n{d}%'
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
	                data:<?php echo ($ticket_source); ?>
	            }
	        ]
	    };
	    orderSourceChart.setOption(option);

	    //售票类型统计占比
	    var ticketTypeChart = echarts.init(document.getElementById('ticketType') , 'westeros');
	    option = {
	        tooltip: {
	            trigger: 'item',
	            formatter: "{b}<br/> 票量：{c} <br/>占比：{d}%"
	        },
	        legend: {
	            orient: 'vertical',
	            x: '5%',
	            y: 'top',
	            icon: 'square',
	            data:[ '散客票','团队票','活动票']
	        },
	        series: [
	            {
	                name:'售票类型',
	                type:'pie',
	                // roseType : 'area',
	                radius: ['50%', '70%'],
	                center: ['60%', '50%'],
	                avoidLabelOverlap: true,
	                label: {
	                    normal: {
	                        formatter: '{b}\n{d}%'
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
	                data:<?php echo ($ticket_type); ?>
	            }
	        ]
	    };

	    ticketTypeChart.setOption(option);

	    //售票渠道线上线下占比
	    var SalesChannelTFRtChart = echarts.init(document.getElementById('SalesChannelTFRt') , 'westeros');
	    option = {
	        tooltip: {
	            trigger: 'item',
	            formatter: "{b} <br/>票量 : {c} <br/>占比 : {d}%"
	        },
	        legend: {
	            orient: 'vertical',
	            x: '5%',
	            y: 'top',
	            icon: 'square',
	            data:['OTA','自助机','窗口']
	        },
	        series: [
	            {
	                type:'pie',
	                roseType: 'area',
	                radius: ['40%', '70%'],
	                center: ['60%', '50%'],
	                avoidLabelOverlap: true,
	                label: {
	                    normal: {
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
	                data:<?php echo ($ticket_channel); ?>
	            }
	        ]
	    };
	    SalesChannelTFRtChart.setOption(option);

		//支付方式统计分析
	    var PayWayTFRtChart = echarts.init(document.getElementById('PayWayTFRt') , 'westeros');
	    option = {
	        tooltip: {
	            trigger: 'item',
	            formatter: "{b}<br/> 数量：{c} <br/>占比：{d}%"
	        },
	        legend: {
	            orient: 'vertical',
	            x: '5%',
	            y: 'top',
	            icon: 'square',
	            data:['支付宝','微信','现金', '其他']
	        },
	        series: [
	            {
	                name:'支付方式',
	                type:'pie',
	                radius: ['40%', '70%'],
	                center: ['60%', '50%'],
	                avoidLabelOverlap: true,
	                roseType: 'area',
	                label: {
	                    normal: {
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
	                data:<?php echo ($ticket_pay); ?>
	            }
	        ]
	    };
	    PayWayTFRtChart.setOption(option);

	});
</script>